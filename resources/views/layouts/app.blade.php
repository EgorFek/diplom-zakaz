<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ЛИГХТ</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <header class="mb-4">
        @include('includes.nav')
    </header>
    <main style="min-height: 90vh">
        @yield('content')
    </main>
    @include('includes.footer')
    <script src="/bootstrap/js/bootstrap.js"></script>
</body>

</html>
