<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Affiliates Within 100km</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        table {
            margin: 0 auto !important;
            width: 50% !important;
        }

        caption {
            text-align: center;
            font-weight: bold;
            font-size: 32px;
            text-decoration: underline;
        }
    </style>
</head>

<body class="justify-center">
    <table class="table table-striped" w>
        <caption>
            Affiliates within {{$range.''.$unit}} from Dublin Office
        </caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Distance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($affiliates as $affiliate)
            <tr>
                <td>{{ $affiliate['id'] }}</td>
                <td>{{ $affiliate['name'] }}</td>
                <td>{{ $affiliate['distance'] }} {{$unit}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
