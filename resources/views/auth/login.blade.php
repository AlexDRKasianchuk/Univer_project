<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('public.login_page')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        img {
            display: block;
            max-width: 20%;
            height: auto;
            margin-left: 50%;
            transform: translate(-50%);
            max-width:150px;
        }

        body {

            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            background: rgb(0, 0, 0);
            background: linear-gradient(90deg, rgba(0, 0, 0, 1) 0%, rgba(139, 43, 48, 1) 100%);
        }

        .logo {
            margin: 10% 0 0;
        }
        .form-signin{
            max-width:450px;
            margin-top: 200px;

            background-color: #262626;
            color: white;
            text-align: center;
            
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            padding: 50px 50px;
            border-radius: 10px;
            -webkit-box-shadow: 0px 0px 30px -5px rgba(255, 255, 255, 1);
            -moz-box-shadow: 0px 0px 30px -5px rgba(255, 255, 255, 1);
            box-shadow: 0px 0px 30px -5px rgba(255, 255, 255, 1);
        }
        .pad{
            margin-bottom: 25px;
        }
        .sb{
            display: flex;
            justify-content:space-between;
        }
        .tc{
            color: grey;
        }
        .tc:hover{
            color: rgb(179, 176, 176);
        }
        .hei{
            height: 35px;
        }
    </style>
</head>

<body class="text-center">
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div class="logo  position-relative">
                <img src="img/gerb.png" alt="gerb VNU">
            </div>
        </x-slot>

        <x-jet-validation-errors />

        @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
        @endif

        <main class="form-signin position-absolute start-50 translate-middle">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label for="email" class="visually-hidden">{{ __('public.login_Email') }}</label>
                <input  class="w-100 pad hei" id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="{{ __('Email') }}"/>
                <label for="password" class="visually-hidden">{{ __('public.login_Pass') }}</label>
                <input class="w-100 pad hei" id="password" type="password" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}"/>
                <div class="checkbox mb-3 sb">
                    <label for="remember_me">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span>{{ __('public.login_RM') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a class="underline tc text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('public.login_forgot') }}
                    </a>

                @endif
                </div>
                
                <button class="w-100 btn btn-secondary">{{ __('public.login_login') }}</button>
            </form>
        </main>
    </x-jet-authentication-card>
</body>

</html>


