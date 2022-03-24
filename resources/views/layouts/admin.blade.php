<!DOCTYPE html>
<html lang="{{ config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
            <a class="logo"><img src="{{ asset('img/logo_O buro.png') }}"></a>

            <p class="text-head"><span style="color: #26470b;">Spécialité</span><br> <span style="color:#ddbb22;">culinaires</span> <br><span style="color:#ed1520;">du cameroun</p>

            <ul>
                <li><a href="{{route('main.carte1')}}">Carte</a></li>
                <li><a href="{{route('main.contact')}}">Contact</a></li>
                <li><a href="{{route('main.reservation')}}">Réservation</a></li>
            </ul>
        </nav>
    </header>
    
    @section('content')
    @show
    <footer>
    <div class="footer">
    <div class="footer-parts">
    	<div class="footer-parts-h3"></div>
        <div class="footer-parts-p">
        653 98 80 66/ 698 25 30 94<br/>
        YAOUNDE, NGOA-EKELE<br/>
        FACE CITE UNIVERSITAIRE<br/>

        </div>
        <div class="footer-icons">
        	<ul>
            	<li><a href="#!"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#!"><i class="fa fa-twitter"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="footer-bottom">
	<div class="white">
        &copy; 
        <script language="javascript" type="text/javascript">
            document.write(new Date().getFullYear());
        </script>. 
        All rights reserved by <a href="http://www.freetimelearning.com/" target="_blank">Free Time Learn</a>.
    </div>
</div> 
    </footer>

</body>
</html>