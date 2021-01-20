<!DOCTYPE html>
<html>
<head>
    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>

<div class="container">
    <br><br>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Number of soldiers</th>
            <th>Power sum</th>
            <th>Percentage</th>
        </tr>
        @foreach ($data as $attack)
            <tr>
                <td>{{$attack->name }}</td>
                <td>{{$attack->counter }}</td>
                <td>{{ $attack->total }}</td>
                <td>{{number_format(round(($attack->total/$data->sum('total'))*100))}} %</td>
            </tr>
        @endforeach
        <tr>
            <td>Total sum</td>
            <td>{{$data->sum('counter')}}</td>
            <td>{{$data->sum('total')}}</td>
            <td></td>
        </tr>
    </table>
    <form action="{{ url('killSoldiers') }}" method="get">
        @csrf
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

            <input type="submit" class="btn btn-primary btn-lg" value="Start battle">
        </div>
        <div class="col-md-6">
            <br><br>
            <p>Seasickness will decrement 25% soldiers attack on ships witch are not protected </p>
            <p>Storm will kill 35% soldiers on ships witch are not protected</p>
            <p>Starvation and Revolt will kill one captain on ships witch are not protected </p>
        </div>
    </form>
</div>
</body>
</html>
