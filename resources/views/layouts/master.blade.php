<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Website Title</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add your custom CSS stylesheets, meta tags, etc. -->
</head>

<body>
    <header class="bg-dark text-white">
        <div class="container-fluid p-0">
            <img src="https://img.freepik.com/free-vector/online-cinema-banner-with-open-clapper-board-film-strip_1419-2242.jpg" class="img-fluid" alt="Header Image">
        </div>
    </header>

    <main class="container mt-4">
        @yield('content') <!-- This will be replaced by individual view content -->
    </main>

    <footer class="bg-dark text-white mt-4">
        <div class="container">
            <p>Page made with Laravel by Oriol Miralles</p>
            <nav>
                <ul>
                    <li><a href="https://github.com/Omirzar1337" class="text-white">Omirzar1337</a></li>
                </ul>
            </nav>
        </div>
    </footer>

    <!-- Bootstrap JS and jQuery (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>