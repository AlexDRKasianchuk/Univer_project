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
<div>
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
        @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
@endif
        <?php 
            if(count($datas)==0) echo 'Error';
        ?>
@foreach ($datas as $data)

id: {{$data -> id}} ,
Кількість варіантів: {{$data -> variant}} ,
Об'єм вибірки: {{$data -> amountOfData}} ,
Мін: {{$data -> min}} ,
Макс: {{$data -> max}} ,
    @if($data->intOrReal==true) дійсні,
    @else цілі, 
    @endif
    @if($data->normalDistribution==true) рівномірний 
    @else нормальний
    @endif
    <br>
    <hr>
    Частоти       {{$data -> frequencies}}  <br>
    Відносні частоти   {{$data -> relativeFrequencies}} <br>
    Середнє  {{$data -> average}}<br>
    Мода {{$data -> fashion}}<br>
    Медіана {{$data -> median}}<br>
    Дисперсія   {{$data -> dispersion}}<br>
    Стандартне відхилення   {{$data -> standardDeviation}}<br>
    Коефіцієнт варіації   {{$data -> coefficientOfVariation}}<br>
    Децильний коефіцієнт    {{$data -> decileCoefficient}}<br>
    Нижній квартиль   {{$data -> lowerQuartile}}<br>
    Верхній квартиль  {{$data -> upperQuartile}}<br>
    Квантиль рівня p    {{$data -> levelQuantileP}}<br>
    Довірчий інтервал з надійністю  gamma   {{$data -> confidenceIntervalWithGammaReliability}}<br> 
    Гістограма   {{$data -> histogram}}<br>
    Кумулята   {{$data -> cumulata}}<br>
       <a href="{{route('delete',$data->id)}}"><button class="btn btn-danger">Delete</button></a>
       <a href="{{route('selectData',$data->id)}}"><button class="btn btn-info">Create</button></a>
    <hr>
    <hr>
@endforeach
        </div>
</div>
</body>
</html>
