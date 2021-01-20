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
    <a class="btn btn-primary btn-lg" href="{{ route('start') }}"> Play again</a>
    <br><br>
    <p>Accident which happend is <b>{{$accident_name}}</b> </p>

    @foreach($finish_data as $key => $value)
        @if ($loop->first)
            <p> Winner is  <b>{{$value->name }}</b> because have biggest sum of power</p>
        @endif
    @endforeach
    <div class="mx-auto"><strong>Rank</strong>

        <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Number of soldiers</th>
            <th>Power sum</th>
        </tr>
        @foreach ($finish_data as $data)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{$data->name }}</td>
                <td>{{$data->counter }}</td>
                <td>{{$data->total }}</td>
            </tr>
        @endforeach
    </table>
<br>
    <div class="mx-auto"><strong>Number of died soldiers </strong>
        <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Number of died</th>
        </tr>
        @foreach ($dead_soldiers as $data)
            <tr>
                <td>{{$data->name }}</td>
                <td>{{$data->died }}</td>
            </tr>
        @endforeach
        <tr>
            <td>Total sum</td>
            <td>{{$dead_soldiers->sum('died')}}</td>
            <td></td>
        </tr>
    </table>
</div>
</body>
</html>



