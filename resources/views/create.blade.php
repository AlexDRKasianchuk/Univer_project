
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{__('public.create')}}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <style>
        .wrapper {
            display: flex;
            flex-direction: column;
            height: 100vh;
            align-items: center;
        }



        header,
        footer,
        .content {
            margin: auto;
            width: 100%;
        }

        header .section,
        footer .section,
        .content .section {
            height: 100%;
            width: 80%;
            margin: auto;
        }

        header,
        footer {
            flex: 0 0 92px;
        }

        .content {
            flex: 1;
        }

        body {
            color: white;
            min-width: 320px;
            background: rgb(0, 0, 0);
            background: linear-gradient(90deg, rgba(0, 0, 0, 1) 0%, rgba(139, 43, 48, 1) 100%);
            background-size: 400% 400%;
            -webkit-animation: Gradient 15s ease infinite;
            -moz-animation: Gradient 15s ease infinite;
            animation: Gradient 15s ease infinite;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        @-webkit-keyframes Gradient {
            0% {
                background-position: 0% 500%
            }

            50% {
                background-position: 100% 20%
            }

            100% {
                background-position: 0% 70%
            }
        }

        @-moz-keyframes Gradient {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        @keyframes Gradient {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        .dropbtn {
            color: gray;
            cursor: pointer;
        }

        .drop {
            position: relative;
            display: inline-block;
        }

        .drop-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .drop-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .drop-content a:hover {
            background-color: #f1f1f1
        }

        .drop:hover .drop-content {
            display: block;
        }

        .drop:hover .dropbtn {
            color: white;
        }

        .pd {
            padding-top: 10%;
        }

        .pdb {
            padding: 20px 0 10px;
        }

        footer,
        header {
            background-color: #262626;
            color: white;
            opacity: .8;
        }

        footer:hover,
        header:hover {
            opacity: 1;
        }

        i {
            color: white;
        }

        i:hover {
            color: blue;
        }

        .cor {
            height: calc(100vh-79px);
        }

    </style>
</head>

<body>
<div class="wrapper">
        <header>
            <div class="section">
                @if (Route::has('login'))

                <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Eighth navbar example">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/home') }}"><img src="img/gerb.png" alt="gerbLogo"
                                style='width: 50px;'></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="true"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        @auth
                        <div class="navbar-collapse collapse show" id="navbarsExample07">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="{{ url('/home') }}">{{__('public.home') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  active" href="{{ url('/create') }}">{{__('public.create')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/history') }}">{{__('public.history') }}</a>
                                </li>
                            </ul>

                            <div class="drop">
                                <span class="dropbtn">{{ Auth::user()->name }}</span>
                                <div class="drop-content">
                                    <a href="{{ route('profile.show') }}">{{__('public.profile')}}</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">{{__('public.logout')}}</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endauth
                    </div>
                </nav>
                @endif
            </div>
        </header>
@if ($errors->any())
    <div class="alert alert-danger anime">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@error('title')
    <div class="alert alert-danger anime">{{ $message }}</div>
@enderror

    <div class="content">
            <div class="section">
        <div class="container">
            <br>
            <div>
                <h5>{{__('public.createNew')}}</h5>
                <form action="" method="post">
                    @csrf
                    
                    <div>
                        <label for="variant" >{{__('public.variant')}}</label>
                        <input type="number"  id="variant" name="variant" value="1">
                    </div>
                    <div>
                        <label for="amountOfData" >{{__('public.amountOfData')}}</label>
                        <input type="number"" id="amountOfData" name="amountOfData" value="20">
                    </div>
                    <div >
                        <label for="min" >{{__('public.min')}}</label>
                        <input type="number" id="min" name="min" value="0">
                    </div>
                    <div >
                        <label for="max" >{{__('public.max')}}</label>
                        <input type="number"  id="max" name="max" value="20">
                    </div>
                    <div >
                        <label for="intOrReal" >{{__('public.intOrReal')}}</label>
                        <input type="checkbox"  id="intOrReal" name="intOrReal" >
                    </div>
                    <div >
                        <label for="normalDistribution" >{{__('public.normalDistribution')}}</label>
                        <input type="checkbox"  id="normalDistribution" name="normalDistribution" >
                        <input type="number"  name="stdDeviation"value="1">(стандартне відхилення якщо нормальний розподіл)
                    </div>

                    <hr>

                    <div>
                        <label for="frequencies" >{{__('public.frequencies')}}</label>
                        <input type="checkbox"  id="frequencies" name="frequencies" checked>
                    </div>
                    <div >
                        <label for="relativeFrequencies" >{{__('public.relativeFrequencies')}}</label>
                        <input type="checkbox"  id="relativeFrequencies" name="relativeFrequencies" >
                    </div>
                    <div >
                        <label for="average" >{{__('public.average')}}</label>
                        <input type="checkbox"  id="average" name="average" checked>
                    </div>
                    <div >
                        <label for="fashion" >{{__('public.fashion')}}</label>
                        <input type="checkbox"  id="fashion" name="fashion" >
                    </div>
                    <div >
                        <label for="median" >{{__('public.median')}}</label>
                        <input type="checkbox"  id="median" name="median" >
                    </div>
                    <div>
                        <label for="dispersion" >{{__('public.dispersion')}}</label>
                        <input type="checkbox" id="dispersion" name="dispersion" checked>
                    </div>
                    <div >
                        <label for="standardDeviation" >{{__('public.standardDeviation')}}</label>
                        <input type="checkbox"  id="standardDeviation" name="standardDeviation" >
                    </div>
                    <div>
                        <label for="coefficientOfVariation" >{{__('public.coefficientOfVariation')}}</label>
                        <input type="checkbox"  id="coefficientOfVariation" name="coefficientOfVariation" >
                    </div>
                    <div >
                        <label for="coefficientOfVariation">{{__('public.decileCoefficient')}}</label>
                        <input type="checkbox" id="decileCoefficient" name="decileCoefficient" >
                    </div>
                    <div>
                        <label for="lowerQuartile" >{{__('public.lowerQuartile')}}</label>
                        <input type="checkbox"  id="lowerQuartile" name="lowerQuartile" checked>
                    </div>
                    <div >
                        <label for="upperQuartile" >{{__('public.upperQuartile')}}</label>
                        <input type="checkbox"  id="upperQuartile" name="upperQuartile" checked>
                    </div>
                    <div >
                        <label for="levelQuantileP" >{{__('public.levelQuantileP')}}</label>
                        <input type="checkbox"  id="levelQuantileP" name="levelQuantileP" >
                        <input type="number" id="levelQuantileP" name="levelP"value="1">(P= якщо true)
                    </div>
                    <div >
                        <label for="confidenceIntervalWithGammaReliability" >{{__('public.confidenceIntervalWithGammaReliability')}}</label>
                        <input type="checkbox"  id="confidenceIntervalWithGammaReliability" name="confidenceIntervalWithGammaReliability" >
                    </div>
                    <div >
                        <label for="histogram" >{{__('public.histogram')}}</label>
                        <input type="checkbox"  id="histogram" name="histogram" checked>
                    </div>
                    <div >
                        <label for="cumulata" >{{__('public.cumulata')}}</label>
                        <input type="checkbox"  id="cumulata" name="cumulata" >
                    </div>
                    <button type="submit" class="btn btn-success">{{__('public.send')}}</button>

                </form>
            </div>
        </div>
    </div>
    </div>

    <footer class="container-fluid pdb">
            <div class="section">
                <div class="container">
                    <div class="d-flex justify-content-between ">

                        <div class="d-flex align-items-center">
                            <div style='padding-right: 25px;'>
                                <img src="img/gerb.png" alt="gerb VNU" style="width:50px;">
                            </div>
                            <div>
                                <h5>{{__('public.nameOfUniversity')}}</h5>
                            </div>

                        </div>
                        <div class="social padding d-flex align-items-center">
                            <a href="https://www.instagram.com/vnu_university/" style='padding: 5px;'><i
                                    class="fab fa-instagram"></i></a>
                            <a href="https://www.facebook.com/vnu.edu.ua/" style='padding: 5px;'><i
                                    class="fab fa-facebook"></i></a>
                            <a href="https://twitter.com/VnuEduUa" style='padding: 5px;'><i
                                    class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


    </div>

</body>

</html>
