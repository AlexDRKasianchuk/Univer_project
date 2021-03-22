<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('public.reg_page')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        img {
            display: block;
            max-width: 20%;
            height: auto;
            margin-left: 50%;
            transform: translate(-50%);
            max-width: 150px;
        }

        body {
            color:white;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            background: rgb(0, 0, 0);
            background: linear-gradient(90deg, rgba(0, 0, 0, 1) 0%, rgba(139, 43, 48, 1) 100%);
        }

        .logo {
            margin: 10% 0 0;
        }

        .form-signin {
            max-width: 450px;
            margin-top: 250px;

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

        .pad {
            margin-bottom: 25px;
        }

        .sb {
            display: flex;
            justify-content: space-between;
        }

        .tc {
            color: grey;
        }

        .tc:hover {
            color: rgb(179, 176, 176);
        }

        .hei {
            height: 35px;
        }
        .pad-1{
            padding-bottom: 10px;
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

        <main class="form-signin position-absolute start-50 translate-middle">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                    <label for="name" class="visually-hidden">{{ __('public.reg_name') }}</label>
                    <input id="name" class="w-100 pad hei" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" placeholder="{{ __('public.reg_name') }}"/>
                    <label for="email" class="visually-hidden">{{ __('public.login_Email') }}</label>
                    <input id="email" class="w-100 pad hei" type="email" name="email" :value="old('email')"
                        required placeholder="{{ __('public.login_Email') }}"/>

                    <label for="password" class="visually-hidden">{{ __('public.login_Pass') }}</label>
                    <input id="password" class="w-100 pad hei" type="password" name="password" required
                        autocomplete="new-password" placeholder="{{ __('public.login_Pass') }}"/>

                    <label for="password_confirmation" class="visually-hidden">{{ __('public.profile_Conf') }}</label>
                    <input id="password_confirmation" class="w-100 pad hei" type="password"
                        name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('public.profile_Conf') }}"/>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                    class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of
                                    Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                    class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy
                                    Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
                @endif
                <div class="pad-1">
                    <a class="underline tc  text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('public.reg_AR') }}
                    </a>
                </div>
                    

                    <button class="w-100 btn btn-secondary">
                        {{ __('public.reg_reg') }}
                    </button>
                </div
            </form>
        </main>

    </x-jet-authentication-card>

</body>

</html>
