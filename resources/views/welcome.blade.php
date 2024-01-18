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
        <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
        <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
        <li><a href=/filmout/films>Pelis</a></li>
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

        <button type="submit">Register Film</button>
    </form>
    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->
    @endsection
</body>

</html>