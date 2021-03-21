<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
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
    <body class="font-sans antialiased">
    <div class="wrapper">
            <header>
            <div class="section">
                @if (Route::has('login'))

                <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Eighth navbar example">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/home') }}"><img src="../img/gerb.png" alt="gerb"
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
                                    <a class="nav-link" aria-current="page" href="{{ url('/home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  active" href="{{ url('/create') }}">Create</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/history') }}">History</a>
                                </li>
                            </ul>

                            <div class="drop">
                                <span class="dropbtn">{{ Auth::user()->name }}</span>
                                <div class="drop-content">
                                    <a href="{{ route('profile.show') }}">Profile</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
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
           

            <main>
                {{ $slot }}
            </main>


            <footer class="container-fluid pdb">
            <div class="section">
                <div class="container">
                    <div class="d-flex justify-content-between ">

                        <div class="d-flex align-items-center">
                            <div style='padding-right: 25px;'>
                                <img src="../img/gerb.png" alt="gerb" style="width:50px;">
                            </div>
                            <div>
                                <h5>Волинський Національний університет імені Лесі Українки</h5>
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

        @stack('modals')

        @livewireScripts
    </body>
</html>
