
<!DOCTYPE html>
<html>
<head>
    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Game rules</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><b>Winner</b></h5>
                    <p>Winner is team witch has the biggest sum of power, based of number of lives soldiers grouped by ships.</p>
                    <p>On start user creates ships and soldiers, and game show predictions for some teams </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><b>Calculator</b></h5>
                    <p>Calculator is based on sum of attack of lives soldiers multiplied with ship power.</p>
                      <p>After the accident happened, chance for win is changing. </p>
                    <p>Remember: died soldier are not in calculation. </p>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <form action="{{ url('battles') }}">
                        <input type="submit" class="btn btn-lg btn-default " value="Start game"><br><br>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><b>Accident</b></h5>
                    <p>Accident is random picked based on chance and possibility of accident. Accident can destroy some soldiers </p>
                    <p>Types of accident: seasickness, storm, starvation, revolt  </p>

                </div>
            </div>
        </div>
    </div>
</body>

</html>


