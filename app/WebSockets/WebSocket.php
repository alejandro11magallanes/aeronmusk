<?php
namespace App\WebSockets;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocket implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Nueva conexión: {$conn->resourceId}\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $pdo = new \PDO('pgsql:host=localhost;dbname=laravel', 'postgres', '123');
        $stmt = $pdo->query('SELECT COUNT(*) FROM qrs');
        $count = $stmt->fetchColumn();
    
        if ($count > 1) {
            // Si hay más de un registro en la tabla, redirecciona a la vista correspondiente.
            //header('Location: /ruta-a-la-vista');
            return response()->json([
                  'SI ENCONTRO' => '',
                ]);
            exit;
        }else{
            return response()->json([
                'NO ENCONTRO' => '',
              ]);
        }
        // Este método se ejecuta cada vez que un mensaje es enviado al servidor WebSocket.
        // Aquí es donde puedes agregar la lógica para escuchar los cambios en la tabla.
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Conexión cerrada: {$conn->resourceId}\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}