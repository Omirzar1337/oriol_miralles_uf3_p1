<!DOCTYPE html>
<html lang="en">
@extends('layouts.master')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Include any additional stylesheets or scripts here -->
</head>

<body class="container">
    @section('content')
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- Your existing form goes here -->
    <form action="{{ route('createFilm') }}" method="post">
        <!-- Form fields -->
    </form>


    <h1 class="mt-4">Lista de Peliculas</h1>
    <ul>
        <li class="mr-4"><a href="/filmout/oldFilms" class="hover:underline">Películas antiguas</a></li>
        <li class="mr-4"><a href="/filmout/newFilms" class="hover:underline">Películas nuevas</a></li>
        <li class="mr-4"><a href="/filmout/films" class="hover:underline">Películas</a></li>
        <li class="mr-4"><a href="/filmout/countFilms" class="hover:underline">Contador de películas</a></li>

    </ul>

    <form action="{{ route('createFilm') }}" method="post">
        @csrf <!-- Include CSRF token for security -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required><br><br>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required><br><br>

        <label for="country">Country:</label>
        <input type="text" id="country" name="country" required><br><br>

        <label for="duration">Duration:</label>
        <input type="number" id="duration" name="duration" required><br><br>

        <label for="url_image">URL Image:</label>
        <input type="text" id="url_image" name="url_image" required><br><br>

        <label for="insert_to_db">Insert into Database:</label>
        <input type="checkbox" id="insert_to_db" name="insert_to_db" value="true"><br><br>

        <button type="submit">Register Film</button>
    </form>

    <h1 class="mt-4">Lista de Actores</h1>
    <ul>
        <li><a href=/actorout/listactors>Actores</a></li>
        <li><a href=/actorout/countactors>Contador de actores</a></li>
        <div align="center">
            <h3>Buscar Actores por décadas</h3>
            <form action="{{ route('listActorsByDecade')}}" method="GET">
                <select name="decada" id="decada">
                    <option value="1970">1970s</option>
                    <option value="1980">1980s</option>
                    <option value="1990">1990s</option>
                    <option value="2000">2000s</option>
                    <option value="2010">2010s</option>
                    <option value="2020">2020s</option>
                </select>
                <button type="submit">Buscar</button>
            </form>

    </ul>
    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->
    @endsection
</body>

</html>