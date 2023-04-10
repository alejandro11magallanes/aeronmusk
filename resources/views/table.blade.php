
<meta name="csrf-token" content="{{ csrf_token() }}">
<h1>Tabla {{ $tableName }}</h1>
@if ($data->count() > 0)
    <table>
        <thead>
            <tr>
                @foreach ($data->first() as $key => $value)
                    <th>{{ $key }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    @foreach ($row as $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No hay registros en esta tabla.</p>
@endif
<head>
    <!-- ... -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        Echo.private('table.{{ $tableName }}')
            .listen('TableHasMultipleRows', (event) => {
                window.location.reload();
            });
    </script>

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('d65fe0cef59bacae743a', {
      cluster: 'us2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</head>