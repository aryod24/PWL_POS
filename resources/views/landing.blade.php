<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('laptops.header')

    <div class="page-wrapper">
        @include('laptops.main')
    </div>

    @include('laptops.footer')

    <script src="{{ asset('js/laptop.js') }}"></script>
</body>
</html>