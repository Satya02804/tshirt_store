<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            text-transform: capitalize;
            background: rgb(235, 235, 235);

        }

        .text {

            justify-content: center;
            align-items: center;
            /* height: 80vh; */
        }
        a{
            text-decoration: none;
            color: blue;
        }
    </style>

</head>

<body>
    <div class="text d-flex flex-column justify-content-center align-items-center vh-100">
        <h1>you don't have permissions.</h1>
        <h4><a href="{{ route('tshirt.index') }}">go back.</a></h4>
    </div>
</body>

</html>
