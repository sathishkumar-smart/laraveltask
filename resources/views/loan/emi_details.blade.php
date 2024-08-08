<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .box-body {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 1200px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .table thead th {
            background-color: #007bff;
            color: #ffffff;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #e2e6ea;
        }

        .no-data img {
            display: block;
            margin: 0 auto;
        }

        .no-data h4 {
            color: #333;
            font-size: 25px;
            margin-top: 10px;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <div class="box-body no-padding">
        <div style="text-align: center; margin-top: 3%;">
            <h1><strong>Loan Details</strong></h1>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Client Id</th>
                        @foreach ($columns as $column)
                            @if (!in_array($column, ['id', 'updated_at', 'created_at']))
                                <th>{{ ucfirst($column) }}</th>
                            @endif
                        @endforeach
                        <th>Created On</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($results) < 1)
                        <tr>
                            <td colspan="{{ count($columns) + 3 }}">
                                <p id="no_data" class="lead no-data text-center">
                                    <img src="{{ asset('assets/images/dark-data.svg') }}"
                                        style="width:150px; margin-top:25px; margin-bottom:25px;" alt="">
                                <h4 class="text-center">No data found</h4>
                                </p>
                            </td>
                        </tr>
                    @else
                        @php    $i = 1; @endphp
                        @foreach($results as $result)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $result->id }}</td>
                                @foreach ($columns as $column)
                                    @if (!in_array($column, ['id', 'updated_at', 'created_at']))
                                        <td>{{ $result->$column }}</td>
                                    @endif
                                @endforeach
                                <td>{{ \Carbon\Carbon::parse($result->created_at)->format('d-m-Y')  }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>