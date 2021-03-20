
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div>
        @if (Route::has('login'))
        <div>
            @auth
            <a href="{{ url('/home') }}" class="h2 p-3">Home</a>
            <a href="{{ url('/create') }}" class="h2 p-3">Create</a>
            <a href="{{ url('/last') }}" class="h2 p-3">Last</a>
            <a href="{{ url('/history') }}" class="h2 p-3">History</a>
            <span class="h2 p-3">{{ Auth::user()->name }}</span>
            <a href="{{ route('profile.show') }}" class="h2 p-3">Profile</a> 
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="h2 p-3">Log Out</a> 
            </form>
            @endauth
        </div>
        @endif

        <div class="container">
            <br>
            <div>
                <h5>Create new Data</h5>
                <form action="" method="post">
                    @csrf
                    
                    <div>
                        <label for="variant" >Кількість варіантів</label>
                        <input type="number"  id="variant" name="variant" value="1">
                    </div>
                    <div>
                        <label for="amountOfData" >Об'єм вибірки</label>
                        <input type="number"" id="amountOfData" name="amountOfData" value="20">
                    </div>
                    <div >
                        <label for="min" >Ліва межа</label>
                        <input type="number" id="min" name="min" value="0">
                    </div>
                    <div >
                        <label for="max" >Права межа</label>
                        <input type="number"  id="max" name="max" value="20">
                    </div>
                    <div >
                        <label for="intOrReal" >Дані цілі/дійсні</label>
                        <input type="checkbox"  id="intOrReal" name="intOrReal" >
                    </div>
                    <div >
                        <label for="normalDistribution" >Розподіл рівномірний / нормальний</label>
                        <input type="checkbox"  id="normalDistribution" name="normalDistribution" >
                        <input type="number"  name="stdDeviation"value="1">(стандартне відхилення якщо нормальний розподіл)
                    </div>

                    <hr>

                    <div>
                        <label for="frequencies" >Частоти</label>
                        <input type="checkbox"  id="frequencies" name="frequencies" checked>
                    </div>
                    <div >
                        <label for="relativeFrequencies" >Відносні частоти</label>
                        <input type="checkbox"  id="relativeFrequencies" name="relativeFrequencies" >
                    </div>
                    <div >
                        <label for="average" >Середнє</label>
                        <input type="checkbox"  id="average" name="average" checked>
                    </div>
                    <div >
                        <label for="fashion" >Мода</label>
                        <input type="checkbox"  id="fashion" name="fashion" >
                    </div>
                    <div >
                        <label for="median" >Медіана</label>
                        <input type="checkbox"  id="median" name="median" >
                    </div>
                    <div>
                        <label for="dispersion" >Дисперсія</label>
                        <input type="checkbox" id="dispersion" name="dispersion" checked>
                    </div>
                    <div >
                        <label for="standardDeviation" >Стандартне відхилення</label>
                        <input type="checkbox"  id="standardDeviation" name="standardDeviation" >
                    </div>
                    <div>
                        <label for="coefficientOfVariation" >Коефіцієнт варіації</label>
                        <input type="checkbox"  id="coefficientOfVariation" name="coefficientOfVariation" >
                    </div>
                    <div >
                        <label for="decileCoefficient">Децильний коефіцієнт </label>
                        <input type="checkbox" id="decileCoefficient" name="decileCoefficient" >
                    </div>
                    <div>
                        <label for="lowerQuartile" >Нижній квартиль</label>
                        <input type="checkbox"  id="lowerQuartile" name="lowerQuartile" checked>
                    </div>
                    <div >
                        <label for="upperQuartile" >Верхній квартиль</label>
                        <input type="checkbox"  id="upperQuartile" name="upperQuartile" checked>
                    </div>
                    <div >
                        <label for="levelQuantileP" >Квантиль рівня p</label>
                        <input type="checkbox"  id="levelQuantileP" name="levelQuantileP" >
                        <input type="number" id="levelQuantileP" name="levelP"value="1">(P= якщо true)
                    </div>
                    <div >
                        <label for="confidenceIntervalWithGammaReliability" >Довірчий інтервал з надійністю  gamma</label>
                        <input type="checkbox"  id="confidenceIntervalWithGammaReliability" name="confidenceIntervalWithGammaReliability" >
                    </div>
                    <div >
                        <label for="histogram" >Гістограма</label>
                        <input type="checkbox"  id="histogram" name="histogram" checked>
                    </div>
                    <div >
                        <label for="cumulata" >Кумулята</label>
                        <input type="checkbox"  id="cumulata" name="cumulata" >
                    </div>
                    <button type="submit" class="btn btn-success">Send</button>

                </form>
            </div>
        </div>
    </div>
</body>

</html>
