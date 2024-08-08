<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Data</title>
    <style>
        /* Basic Reset */
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        /* Container */
        .container {
            text-align: center;
        }

        /* Button Styles */
        .process-btn {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 15px 30px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .process-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="{{route('processdata.create')}}">
            <button class="process-btn">Process Data</button>
        </form>
    </div>
</body>

</html>