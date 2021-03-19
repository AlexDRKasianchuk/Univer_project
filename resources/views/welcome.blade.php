<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@if (Route::has('login'))
        <div>
            @auth
            <a href="{{ url('/home') }}" class="h2 p-3">Home</a>
            <a href="{{ url('/create') }}" class="h2 p-3">Create</a>
            <a href="{{ url('/last') }}" class="h2 p-3">Last</a>
            <a href="{{ url('/history') }}" class="h2 p-3">History</a>
            
            <span class="h2 p-3">{{ Auth::user()->name }}</span>

            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
           
            @else
            <a href="{{ route('login') }}" class="h2 p-3">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="h2 p-3">Register</a>
            @endif
            @endauth
        </div>
        @endif

   <div>
       <h1>welcome</h1>
    </div> 
</body>
</html>