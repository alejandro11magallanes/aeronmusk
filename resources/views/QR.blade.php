<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
    body {
		     --tw-bg-opacity: 1;
            background-color: rgba(17, 24, 39, var(--tw-bg-opacity));
			font-family:'verdana';
		}
		.id-card-holder {
			width: 300px;
		    padding: 4px;
		    margin: 0 auto;
		    background-color: #1f1f1f;
		    border-radius: 5px;
		    position: relative;
		}
		.id-card-holder:after {
		    content: '';
		    width: 7px;
		    display: block;
		    background-color: #0a0a0a;
		    height: 100px;
		    position: absolute;
		    top: 105px;
		    border-radius: 0 5px 5px 0;
		}
		.id-card-holder:before {
		    content: '';
		    width: 7px;
		    display: block;
		    background-color: #0a0a0a;
		    height: 100px;
		    position: absolute;
		    top: 105px;
		    left: 300px;
		    border-radius: 5px 0 0 5px;
		}
		.id-card {
			
			background-color: #fff;
    height: 50%;
    border-radius: 10px;
    text-align: center;
    /* margin: 0; */
    box-shadow: 0 0 1.5px 0px #b9b9b9;
    /* display: block; */
    padding-top: 90px;
		}
		.id-card img {
			margin: 0 auto;
		}
		.header img {
			width: 100px;
    		margin-top: 15px;
		}
		.photo img {
			width: 80px;
    		margin-top: 15px;
		}
		h2 {
			font-size: 15px;
			margin: 5px 0;
		}
		h3 {
			font-size: 12px;
			margin: 2.5px 0;
			font-weight: 300;
		}
		.qr-code img {
			width: 50px;
		}
		p {
			font-size: 5px;
			margin: 2px;
		}
		.id-card-hook {
			background-color: #000;
		    width: 70px;
		    margin: 0 auto;
		    height: 15px;
		    border-radius: 5px 5px 0 0;
		}
		.id-card-hook:after {
			content: '';
		    background-color: #d7d6d3;
		    width: 47px;
		    height: 6px;
		    display: block;
		    margin: 0px auto;
		    position: relative;
		    top: 6px;
		    border-radius: 4px;
		}
		.id-card-tag-strip {
			width: 45px;
		    height: 40px;
		    background-color: #0950ef;
		    margin: 0 auto;
		    border-radius: 5px;
		    position: relative;
		    top: 9px;
		    z-index: 1;
		    border: 1px solid #0041ad;
		}
		.id-card-tag-strip:after {
			content: '';
		    display: block;
		    width: 100%;
		    height: 1px;
		    background-color: #c1c1c1;
		    position: relative;
		    top: 10px;
		}
		.id-card-tag {
			width: 0;
			height: 0;
			border-left: 100px solid transparent;
			border-right: 100px solid transparent;
			border-top: 100px solid #0958db;
			margin: -10px auto -30px auto;
		}
		.id-card-tag:after {
			content: '';
		    display: block;
		    width: 0;
		    height: 0;
		    border-left: 50px solid transparent;
		    border-right: 50px solid transparent;
		    border-top: 100px solid black;
		    margin: -10px auto -30px auto;
		    position: relative;
		    top: -130px;
		    left: -50px;
		}

        h1 {
  color: #fff; /* establece el color del texto en blanco */
  text-align: center; /* establece el alineamiento del texto en el centro */
}
</style>

<div class="id-card-tag"></div>
	<div class="id-card-tag-strip"></div>
	<div class="id-card-hook"></div>
	<div class="id-card-holder">
		<div class="id-card">
			
			<div class="photo">
			{{ $otra }}
			</div>
			
			
			

		</div>
	</div>
    <div>
        <h1>Escanea QR</h1>
    </div>

	
	<script src="{{ asset('js/app.js') }}"></script>
        
      

<script>
           Echo.channel('my-channel')
    .listen('MyEvent', (event) => {
        console.log(event);
    });
        </script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>

	
    // Conectarse a Pusher
    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true
    });
	$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    // Escuchar el evento "qr-event" en el canal "qr-channel"
    var channel = pusher.subscribe('my-channel');
    channel.bind('qr-event', function(data) {

		x = data.message;
		$.ajax({
  url: '/mi',
  type: 'POST',
  data: {
    miDato: x
  },
  success: function(response) {
    console.log(response);
	location.reload();
	window.location.href = '/admin/dashboard';
  }

  
});
/*
		$.ajax({
    type: 'GET',
    url: '/mi-ruta',
    dataType: 'json',
    success: function(response) {
        var miDato = response.miDato;
		document.cookie = "qr=" + miDato;
        // Haz algo con el valor de la cookie
    }
});
*/
		///datosJson = json_encode(data.message);
		//document.cookie = "qr=data;"
		//console.log("data",data)
		//document.cookie = "qr=" + data;
        // Actualizar la vista con los nuevos datos de la tabla QR
        //
		//document.cookie = "qr=eyJpdiI6InVFWUIwNEhiUk12RkloNVpxMXNRSnc9PSIsInZhbHVlIjoibTg3RmlPR0UwbUhrbHhYRVlJVGh0NHpmUGFhdFNtdEJ2UG9pcmN2bm5sYzQ5N1NCeGpiYjF4b0cwMHdJK3UycEpCYUhyZkRtNHp4QVRERnlVYWNLYk1vQ3pKRWRuTTA3cktmbmwrRmJXUUExejdHOHFqUGNEMXl4c2FqRjRuRG8iLCJtYWMiOiJjZjY5MWViMmM4MDcyYzcyMjU4N2MzMGM2ZWRkMTc3OThkZWIwMjI1MzdkN2RhMDdmOTI4ZWYzYmZhMjVlZWI3IiwidGFnIjoiIn0%3M;";
		//document.cookie = "miCooqrkie=" + nuevoValor
		//
		//document.cookie = "qr=eyJpdiI6InVFWUIwNEhiUk12RkloNVpxMXNRSnc9PSIsInZhbHVlIjoibTg3RmlPR0UwbUhrbHhYRVlJVGh0NHpmUGFhdFNtdEJ2UG9pcmN2bm5sYzQ5N1NCeGpiYjF4b0cwMHdJK3UycEpCYUhyZkRtNHp4QVRERnlVYWNLYk1vQ3pKRWRuTTA3cktmbmwrRmJXUUExejdHOHFqUGNEMXl4c2FqRjRuRG8iLCJtYWMiOiJjZjY5MWViMmM4MDcyYzcyMjU4N2MzMGM2ZWRkMTc3OThkZWIwMjI1MzdkN2RhMDdmOTI4ZWYzYmZhMjVlZWI3IiwidGFnIjoiIn0%3M;";
		//document.cookie = "qr=eyJpdiI6InVFWUIwNEhiUk12RkloNVpxMXNRSnc9PSIsInZhbHVlIjoibTg3RmlPR0UwbUhrbHhYRVlJVGh0NHpmUGFhdFNtdEJ2UG9pcmN2bm5sYzQ5N1NCeGpiYjF4b0cwMHdJK3UycEpCYUhyZkRtNHp4QVRERnlVYWNLYk1vQ3pKRWRuTTA3cktmbmwrRmJXUUExejdHOHFqUGNEMXl4c2FqRjRuRG8iLCJtYWMiOiJjZjY5MWViMmM4MDcyYzcyMjU4N2MzMGM2ZWRkMTc3OThkZWIwMjI1MzdkN2RhMDdmOTI4ZWYzYmZhMjVlZWI3IiwidGFnIjoiIn0%3M;";
		//document.cookie = "qr=eyJpdiI6InVFWUIwNEhiUk12RkloNVpxMXNRSnc9PSIsInZhbHVlIjoibTg3RmlPR0UwbUhrbHhYRVlJVGh0NHpmUGFhdFNtdEJ2UG9pcmN2bm5sYzQ5N1NCeGpiYjF4b0cwMHdJK3UycEpCYUhyZkRtNHp4QVRERnlVYWNLYk1vQ3pKRWRuTTA3cktmbmwrRmJXUUExejdHOHFqUGNEMXl4c2FqRjRuRG8iLCJtYWMiOiJjZjY5MWViMmM4MDcyYzcyMjU4N2MzMGM2ZWRkMTc3OThkZWIwMjI1MzdkN2RhMDdmOTI4ZWYzYmZhMjVlZWI3IiwidGFnIjoiIn0%3M;";
		//document.cookie = "qr=eyJpdiI6InVFWUIwNEhiUk12RkloNVpxMXNRSnc9PSIsInZhbHVlIjoibTg3RmlPR0UwbUhrbHhYRVlJVGh0NHpmUGFhdFNtdEJ2UG9pcmN2bm5sYzQ5N1NCeGpiYjF4b0cwMHdJK3UycEpCYUhyZkRtNHp4QVRERnlVYWNLYk1vQ3pKRWRuTTA3cktmbmwrRmJXUUExejdHOHFqUGNEMXl4c2FqRjRuRG8iLCJtYWMiOiJjZjY5MWViMmM4MDcyYzcyMjU4N2MzMGM2ZWRkMTc3OThkZWIwMjI1MzdkN2RhMDdmOTI4ZWYzYmZhMjVlZWI3IiwidGFnIjoiIn0%3M;";
		//window.location.href = "/admin/dashboard?qr=qr=eyJpdiI6InVFWUIwNEhiUk12RkloNVpxMXNRSnc9PSIsInZhbHVlIjoibTg3RmlPR0UwbUhrbHhYRVlJVGh0NHpmUGFhdFNtdEJ2UG9pcmN2bm5sYzQ5N1NCeGpiYjF4b0cwMHdJK3UycEpCYUhyZkRtNHp4QVRERnlVYWNLYk1vQ3pKRWRuTTA3cktmbmwrRmJXUUExejdHOHFqUGNEMXl4c2FqRjRuRG8iLCJtYWMiOiJjZjY5MWViMmM4MDcyYzcyMjU4N2MzMGM2ZWRkMTc3OThkZWIwMjI1MzdkN2RhMDdmOTI4ZWYzYmZhMjVlZWI3IiwidGFnIjoiIn0%3M";
    });
</script>





