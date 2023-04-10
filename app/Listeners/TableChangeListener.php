<?php

namespace App\Listeners;

use App\Events\TableHasMultipleRows;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Events\StatementExecuted;
use Illuminate\Support\Facades\DB;

class TableChangeListener implements ShouldQueue
{
    public function handle(StatementExecuted $event)
    {
        $tableName = $this->getTableName($event->pgsql);
        $rowCount = $this->getRowCount($event->pgsql);

        if ($rowCount > 1) {
            event(new TableHasMultipleRows('qrs'));
        }
    }

    private function getTableName($pgsql)
    {
        if (preg_match('/from `?(\w+)`?/i', $pgsql, $matches)) {
            return $matches[1];
        }

        return null;
    }

    private function getRowCount($pgsql)
    {
        return DB::select("SELECT ROW_COUNT() as count")[0]->count;
    }
}