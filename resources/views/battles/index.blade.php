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
    <h1>Enter teams</h1>

    <p>Types of ships are: destroyer, frigate, battleship, submarine</p>
    <form action="{{ url('add-teams-and-soldiers') }}" method="POST">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <input type="submit" class="btn btn-lg btn-default submit" value="Submit"><br><br>
        <table class="table table-striped">
            <tr>
                <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>
                <th>S. No</th>
                <th>Complete type of ship</th>
                <th>Crew name</th>
                <th>Number of soldiers</th>
                <th class="hide">fk_identity_card</th>

            </tr>
            <tr>
                <td><input type='checkbox' class='chkbox'/></td>
                <td><span id='sn'>1.</span></td>
                <td><input class="form-control autocomplete_txt" type='text' data-type="ship" id='ship_1'
                           name='ship[]'/></td>
                <td><input class="form-control" data-type="name" id='name_1' name='name[]'/></td>
                <td><input class="form-control " type="number" data-type="number_of_soldier" id='number_of_soldier_1'
                           name='number_of_soldier[]'/></td>
                <td><input class="form-control " type="hidden" data-type="fk_ship_type" id='fk_ship_type_1'
                           name='fk_ship_type[]'/></td>
            </tr>
        </table>
        <button type="button" class='btn btn-danger delete'>- Delete</button>
        <button type="button" class='btn btn-success addbtn'>+ Add More</button>
    </form>
</div>
</body>

<script type="text/javascript">

    var broj = $('table tr').length;

    $(".submit").on('click', function () {
        count = $('table tr').length - 1;
        if (count < 2) {
            alert('Please enter minimun two teams');
            return false;
        }
    });

    $(".delete").on('click', function () {
        $('.chkbox:checkbox:checked').parents("tr").remove();
        $('.check_all').prop("checked", false);
        updateSerialNo();
    });
    var i = $('table tr').length;
    $(".addbtn").on('click', function () {
        count = $('table tr').length;

        var data = "<tr><td><input type='checkbox' class='chkbox'/></td>";
        data += "<td><span id='sn" + i + "'>" + count + ".</span></td>";
        data += "<td><input class='form-control autocomplete_txt' type='text' data-type='ship' id='ship_" + i + "' name='ship[]'></td>";
        data += "<td><input class='form-control '  data-type='name' id='name_" + i + "' name='name[]'/></td>";
        data += "<td><input class='form-control ' type='number'  data-type='number_of_soldier' id='number_of_soldier_" + i + "' name='number_of_soldier[]'/></td>";
        data += "<td><input class='form-control ' type='hidden'  data-type='fk_ship_type' id='fk_ship_type_" + i + "' name='fk_ship_type[]'/></td>";

        $('table').append(data);
        i++;
    });

    function select_all() {
        $('input[class=chkbox]:checkbox').each(function () {
            if ($('input[class=check_all]:checkbox:checked').length == 0) {
                $(this).prop("checked", false);
            } else {
                $(this).prop("checked", true);
            }
        });
    }

    function updateSerialNo() {
        obj = $('table tr').find('span');
        $.each(obj, function (key, value) {
            id = value.id;
            $('#' + id).html(key + 1);
        });
    }

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).on('focus', '.autocomplete_txt', function () {
        src = "{{ url('search') }}";
        type = $(this).data('type');

        if (type == 'ship') autoType = 'ship';
        if (type == 'fk_ship_type') autoType = 'id';

        $(this).autocomplete({

            source: function (request, response) {
                $.ajax({
                    url: src,
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        term: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                id_arr = $(this).attr('id');
                id = id_arr.split("_");
                elementId = id[id.length - 1];

                $('#ship_' + elementId).val(ui.item.label); // display the selected text
                $('#fk_ship_type_' + elementId).val(ui.item.id); // save selected id to input
                return false;
            }
        });
    });

</script>
</html>

