<script src="{{mix('js/app.js')}}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title> Some Git</title>
        <link rel="stylesheet" href="{{mix('css/app.css')}}">
    </head>
    <body>

        <div id="app">
            <!-- <main style="margin-right: 100px; margin-left: 100px; margin-top: 20px;">
                <router-view></router-view>
            </main> -->
        </div>

        <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>