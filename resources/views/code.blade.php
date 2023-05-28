<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

* {
  margin: 0;
  color: white;
  font-family: "Roboto"
}
h1 {
  font-size: 4rem;
}
main {
    background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
	background: linear-gradient(to right, #FF4B2B, #FF416C);
 
}
main div {
  width: 100%;
  text-align: center;
}
.container {
  min-height: 100vh;
  display: flex;
  align-items: center;
  max-width: 1200px;
  margin: auto
}

a {
	border-radius: 20px;
	border: 1px solid white;
	background-color: white;
	color: black;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
}

a:active {
	transform: scale(0.95);
}

a:focus {
	outline: none;
}

button.ghost {
	background-color: transparent;
	border-color: #FFFFFF;
}



@media (max-width: 700px){
  .container {
    display: grid;
  }
}
    </style>
<main>
  <div class="container">
    
    <div class="text-container">
      <h1>Se ha enviado un correo exitoso</h1>
     <br>
      <a href="{{ route('admin.login') }}" >Volver al inicio</a>
    </div>
    
    <div>
      <!-- Codigo lottie -->
      <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_lqge6px5.json"  background="transparent" style="max-width: 100%"  speed="0.7" loop autoplay></lottie-player>
      <!-- Codigo lottie final -->
    </div>
    
  </div>
</main>