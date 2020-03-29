<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a> @else
            <a href="{{ route('login') }}">Login</a> @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a> @endif @endauth
        </div>
        @endif
        <div class="container">
            <div class="card shadow mb-3 p-3">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">Select Settings</p>
                </div>
                <form method="post" action="{{url('/show')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="chart" class="h4">Select Chart :</label>
                        <select id="chart" class="form-control" name="chart" required="">
                            <option value="" disabled="disabled" selected="true">Select Chart</option>
                            <option value="bar">Bar</option>
                            <option value="pie">Pie</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="country" class="h4">Select Country :</label>
                        <select id="country" class="form-control" name="country" required="">
                            <option value="" disabled="disabled" selected="true">Select Country</option>
                            @if($options ?? '')
                            @foreach($options as $option)
                            <option value="{{$option}}">{{$option}}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div>
                        <label for="confirmed" class="h4" style="background-color: rgba(255, 205, 86, 2.0);">Confirmed :</label>
                        <h1 style="text-align: center;">{{$cofirmed}}</h1>

                        <label for="recovered" class="h4" style="background-color: rgba(22,160,133, 2.0);">Recovered :</label>
                        <h1 style="text-align: center;">{{$recovered}}</h1>

                        <label for="deaths" class="h4" style="background-color: rgba(255, 99, 132, 2.0);">Deaths :</label>
                        <h1 style="text-align: center;">{{$deaths}}</h1>
                    </div>

                    <div class="card-body">
                        <div class="form-group"><button class="btn btn-primary btn-sm" type="submit" style="float: right;">Fetch Data</button></div>
                    </div>
                </form>
                <div class="content">
                    <div style="width: 100%">
                        @if($covidChart ?? '') {!! $covidChart->container() !!} @if($covidChart) {!! $covidChart->script() !!} @endif @endif
                    </div>
                </div>
            </div>
        </div>
</body>

</html>