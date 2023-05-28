<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
@import url('https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,800');

html, body {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  font-family: 'Nunito Sans', sans-serif;
}

.page {
  witdh: 100vh;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #F1F1F1;
}

.card {
  width: 960px;
  height: 540px;
  background-color: white;
  box-shadow: 0px 50px 100px rgba(0, 0, 0, .4);
  display: flex;
  align-items: center;
  justify-content: center;
}

.container {
  height: 100%;
  width: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

.menu {
  width: 100%;
  height: 10%;
}

.menu h3 {
  font-size: 1em;
  margin-left: 25px;
  font-weight: 800;
  float: left;
}

i {
  float: right;
  font-size: 0.8em;
  margin: 20px 25px;
  transition: font-size 0.2s;
}

i:hover {
  font-size: 1em;
}

.content {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.content .text {
  margin-bottom: 50px;
}

.text h1 {
  font-size: 2.5em;
  line-height: 1;
}

.text p {
  color: rgb(0,0,0,0.5);
  margin-bottom: 40px;
  margin-top: -5px;
}

.text a {
  font-weight: 600;
  color: white;
  text-decoration: none;
  background-color: #fe864c;
  transition: background-color 0.2s;
  transition: color 0.2s;
  padding: 10px 20px;
  border: 2px solid #fe864c;
}

.text a:hover, .text a:active {
  background-color: white;
  color: #fe864c;
}

.photo {
  height: 100%;
  width: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-image: url("https://images.pexels.com/photos/33041/antelope-canyon-lower-canyon-arizona.jpg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: 50% 50%;
}
    </style>

   
    
<div class="page">
  <div class="card">
    <div class="container">
      <div class="menu">
        <h3>UTT</h3>
        <i class="fas fa-bars"></i>
      </div>
      <div class="content">
        <div class="text">
          <h1>Instituto Tomista <br>de la Laguna.</h1>
          <p>"Elevando los estándares de la educación".</p>
      
          @if(Route::has('admin.login'))
                                <a href="{{ route('admin.login') }}" >Inicio de sesion</a>

                        @endif
        </div>  
      </div>
    </div>
    <div class="photo"></div>
  </div>
</div>







<script src="{{ asset('js/app.js') }}"></script>
        
<script>
            Echo.channel('home').listen('NewMessage', (e) => {
                console.log(e.message)
            })
        </script>