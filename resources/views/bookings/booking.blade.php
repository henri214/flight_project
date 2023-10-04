{{-- @extends('layouts.app')

@section('content')
    <x-table.table :headers="['Username', 'Flight Name', 'Email', 'Departure Time', 'Arrival Time', 'Price in $']">
        <tr>
            <td>{{ $username }}</td>
            <td>{{ $flight_name }}</td>
            <td width="180px">{{ $user_mail }}</td>
            <td width="180px">{{ $departure_time }}</td>
            <td width="180px">{{ $arrival_time }}</td>
            <td>{{ $price }}</td>
        </tr>
    </x-table.table>
@endsection --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>

    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 50px auto;
        }

        /* Zebra striping */
        tr:nth-of-type(odd) {
            background: #eee;
        }

        th {
            background: #3498db;
            color: white;
            font-weight: bold;
        }

        td,
        th {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 18px;
        }
    </style>

</head>

<body>

    <div style="width: 95%; margin: 0 auto;">
        <div style="width: 10%; float:left; margin-right: 20px;">
            {{-- <img src="{{ public_path('assets/images/logo.png') }}" width="100%"  alt=""> --}}
        </div>
        <div style="width: 50%; float: left;">
            <h1>Booking Details</h1>
        </div>
    </div>

    <table style="position: relative; top: 50px;">
        <thead>
            <tr>
                <th>Username</th>
                <th>Flight</th>
                <th>Email </th>
                <th>Departure Time</th>
                <th>Arrival Time</th>
                <th>Price in $</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td data-column="Username">{{ $username }}</td>
                <td data-column="Flight name">{{ $flight_name }}</td>
                <td data-column="User mail">{{ $user_mail }}</td>
                <td data-column="Departure_time">{{ $departure_time }}</td>
                <td data-column="Arrival time">{{ $arrival_time }}</td>
                <td data-column="Price">{{ $price }}</td>

            </tr>
        </tbody>
    </table>

</body>

</html>
