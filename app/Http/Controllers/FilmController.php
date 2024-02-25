<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class FilmController extends Controller
{


    public static function readFilms(): array
    {
        // Read the JSON file containing film information.
        $filmsJson = json_decode(Storage::get('/public/films.json'), true);
        // dd($filmsJson);
        $filmsDB = DB::table('films')->select('name', 'year', 'genre', 'country', 'duration', 'img_url')->get()->toArray();

        $filmsDB = json_decode(json_encode($filmsDB), true);

        $films = array_merge($filmsDB, $filmsJson);
        return $films; // Decode the JSON into an associative array.
    }

    public function listOldFilms($year = null)
    {
        $old_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {

            if ($film->year < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }

    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film->year >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }

    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];
        $title = "List of All Films";
        $films = FilmController::readFilms();

        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year) {
                $title = "List of All Films Filtered by Year";
                $films_filtered[] = $film;
            } else if ((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)) {
                $title = "List of All Films Filtered by Genre";
                $films_filtered[] = $film;
            } else if (!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year) {
                $title = "List of All Films Filtered by Genre and Year";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function filmsByYear($year = null)
    {
        $films_filtered = [];
        $title = "List of All Films";
        $films = FilmController::readFilms();

        if (is_null($year))
            return view('films.list', ["films" => $films, "title" => $title]);

        foreach ($films as $film) {
            if ((!is_null($year)) && $film['year'] == $year) {
                $title = "List of All Films Filtered by Year";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function filmsByGenre($genre = null)
    {
        $films_filtered = [];
        $title = "List of All Films";
        $films = FilmController::readFilms();

        if (is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        foreach ($films as $film) {
            if ((!is_null($genre)) && strtolower($film['genre']) == strtolower($genre)) {
                $title = "List of All Films Filtered by Genre";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function sortByYear()
    {
        $title = "Listado ordenado por año";

        $films = FilmController::readFilms();


        usort($films, function ($a, $b) {
            return $a['year'] - $b['year'];
        });

        return view('films.list', ["films" => $films, "title" => $title]);
    }

    public function countFilms()
    {

        $title = "Number of movies";
        $films = FilmController::readFilms();

        $films = count($films);


        return view('films.count', ["films" => $films, "title" => $title]);
    }

    public function getFilmsFromJson()
    {
        $path = storage_path('app/public/films.json');

        if (!file_exists($path)) {
            return [];
        }

        $content = file_get_contents($path);
        $films = json_decode($content, true);

        return $films ?: [];
    }

    private function saveFilmsToJson($films)
    {
        $jsonContent = json_encode($films, JSON_PRETTY_PRINT);
        $filePath = storage_path('app/public/films.json');


        if ($filePath !== false) {
            Storage::disk('public')->put('films.json', $jsonContent);
        }
    }

    public function checkAndAddFilm(Request $request)
    {
        $filmName = $request->input('name');

        if ($this->isFilm($filmName)) {
            return redirect('/')->with('error', 'Film already exists.');
        } else {

            $this->addFilm($request);
            return $this->listFilteredFilms();
        }
    }

    public function isFilm($filmUser)
    {
        $films = FilmController::readFilms();
        foreach ($films as $film) {
            if ($film["name"] === $filmUser["name"]) {
                return true;
            }
        }
        return false;
    }

    public function createFilm(Request $request)
    {
        $source = env('SOURCE_DATA', 'database');
        $title = "All Films";
        $films = FilmController::readFilms();
        $filmUser = [
            'name' => $request->input('name'),
            'year' => $request->input('year'),
            'genre' => $request->input('genre'),
            'country' => $request->input('country'),
            'duration' => $request->input('duration'),
            'img_url' => $request->input('img_url'),
        ];

        if ($this->isFilm($filmUser)) {
            return view('welcome', ["error" => "Movie already exists"]);
        } else {
            if ($source === 'json') {
                $films[] = $filmUser;
                Storage::put("/public/films.json", json_encode($films));
            } else {
                DB::table('films')->insert($filmUser);
            }
            $films = FilmController::readFilms();
            return view('films.list', ["films" => $films, "title" => $title]);
        }
    }

    public function listFilteredFilms($year = null, $genre = null)
    {
        $films_filtered = [];
        $title = "Listado de todas las pelis";
        $films = $this->getFilmsFromJson();


        foreach ($films as $film) {
            if ((is_null($year) || $film->year == $year) && (is_null($genre) || strtolower($film->genre) == strtolower($genre))) {
                $films_filtered[] = $film;
            }
        }

        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
}
