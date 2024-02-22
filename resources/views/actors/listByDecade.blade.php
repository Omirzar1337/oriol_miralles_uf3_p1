<!-- actors.blade.php -->

@extends('layouts.master')

@section('content')
<h1>List of Actors</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Birthday</th>
        <th>Country</th>
        <th>Image</th>
    </tr>
    @foreach ($actors as $actor)
    <tr>
        <td>{{ $actor->id }}</td>
        <td>{{ $actor->name }}</td>
        <td>{{ $actor->surname }}</td>
        <td>{{ $actor->birthdate }}</td>
        <td>{{ $actor->country }}</td>
        <td><img src="{{ $actor->img_url }}" alt="{{ $actor->name }}'s image"></td>
    </tr>
    @endforeach
</table>
@endsection