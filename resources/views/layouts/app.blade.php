<!DOCTYPE html>
<html lang="{{ config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
@section('style')
<link rel="stylesheet" href="{{ asset('css/app.css')}}">
@show


@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="{{asset('js/app.js')}}" defer></script>
@show
</head>
<body>
<header class="header">
       
        <nav class="navigation">
            <a class="logo" href='/'><img src="{{ asset('img/logo_simple.png')}}"></a>

            <ul>
                <li><a href="{{route('main.carte')}}">Carte</a></li>
                <li><a href="{{route('main.contact')}}">Contact</a></li>
                <li><a href="{{route('main.reservation')}}">Réservation</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        @yield('contenu')
    </div>
    
    <!-- @section('content')
    @show -->
    <footer>
    <div class="footer">
    <ul>
        <a class="cta" href="{{ route('main.reservation')}}">Réserver</a>
        <li><b>O’Buro</b></li>
        <li>Yaoundé  Ngoa-Ekelé</li>
        <li>Face à la cité universitaire<li>
        <li>Tel (+237) 683 988</li>
    </ul>

    <!-- <div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1990.3946328607083!2d11.499516057793242!3d3.8553529754402898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x108bcfbda1d06019%3A0xe07d3b2893e4568d!2sRestaurant%20N%C2%B01%2C%20Joseph%20Tchooungui%20Akoa%2C%20Yaound%C3%A9%2C%20Cameroun!5e0!3m2!1sfr!2sfr!4v1646319792252!5m2!1sfr!2sfr" width="500" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div> -->

    
    <div class="icons-site">
        <img src="{{ asset('img/Facebook.png') }}">
        <img src="{{ asset('img/insta.png') }}">
    </div>


    </div>

</footer>

</body>
</html>