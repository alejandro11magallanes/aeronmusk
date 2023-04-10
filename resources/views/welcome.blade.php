<meta name="csrf-token" content="{{ csrf_token() }}" />

<x-front-guest-layout>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <main class="bg-white font-montserrat">
        <header class="h-24 sm:h-32 flex items-center">
            <div class="container mx-auto px-6 sm:px-12 flex items-center justify-between">
                <div class="text-black font-black text-2xl flex items-center">
                    <span class="w-6 h-6 rounded-full bg-blue-500 mr-4"></span> Dulceria 
                </div>
                <div class="flex items-center">
                    <nav class="text-black text-lg hidden lg:flex items-center">

                        @if(Route::has('admin.login'))
                                <a href="{{ route('admin.login') }}" class="py-2 px-6 flex hover:text-blue-500">Inicio de sesion</a>

                        @endif

                       
                    </nav>
                    <button class="lg:hidden flex flex-col">
                        <span class="w-6 h-px bg-gray-900 mb-1"></span>
                        <span class="w-6 h-px bg-gray-900 mb-1"></span>
                        <span class="w-6 h-px bg-gray-900 mb-1"></span>
                    </button>
                </div>
            </div>
        </header>
        <div class="container mx-auto px-6 sm:px-12 flex flex-col-reverse sm:flex-row items-center">
            <div class="sm:w-2/5 flex flex-col items-start mt-8 sm:mt-0">
                <h1 class="text-4xl lg:text-6xl leading-none mb-4"><strong class="font-black">Dulceria</strong> Barrilito</h1>
                <p class="lg:text-lg mb-4 sm:mb-12">¡Bienvenidos a nuestra dulcería, donde los dulces sueños se hacen realidad! Ofrecemos una amplia variedad de postres deliciosos y frescos, desde pasteles hasta galletas, chocolates y más!</p>
                <a href="#" class="font-semibold text-lg bg-blue-500 hover:bg-blue-400 text-white py-3 px-10 rounded-full">Learn more</a>
            </div>
            <div class="sm:w-3/5">
   
         
            <img src="{{URL::asset('images/dulces.jpg')}}"
                alt="" class="w-full">
               
            </div>
        </div>
    </main>







</x-front-guest-layout>

<script src="{{ asset('js/app.js') }}"></script>
        
<script>
            Echo.channel('home').listen('NewMessage', (e) => {
                console.log(e.message)
            })
        </script>