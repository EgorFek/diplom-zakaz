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
    <main class="container" style="min-height: 90vh">
        <div class="row">
            <div class="col-12 col-lg-3">
                @include('includes.admin_nav')
            </div>
            <div class="col-12 col-lg-9">
                @yield('content')
            </div>
        </div>
    </main>
    @include('includes.footer')
    <script src="/bootstrap/js/bootstrap.js"></script>
</body>

</html>
