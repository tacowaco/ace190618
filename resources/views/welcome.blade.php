<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script> window.Laravel = { csrfToken: '{{ csrf_token() }}' } </script>

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
        *{
        box-sizing: border-box;
        }

        body{
        margin:0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size:1rem;
        font-weight:normal;
        line-height:1.5;
        color:#333;
        overflow-x:hidden;
        }
        </style>

    </head>
    <body>



            <div class="content" id="app">
                <navbar></navbar>
                <YT_select></YT_select>

            </div>



        <script src="{{ asset('js/app.js')}}"></script>
    </body>
</html>
