<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{

    public function listActors()
    {
        // Retrieve all actors using the query builder
        $actors = DB::table('actors')->get();

        // Return the retrieved actors
        return view('actors.list', ['actors' => $actors]);
    }
    public function listActorsByDecade()
    {
        $decadaSelect = $_GET['decada'];

        $InicioDecada = $decadaSelect;
        $FinalDecada = $InicioDecada + 10;

        $actorsList = DB::table('actors')->get();
        $actors = array();

        foreach ($actorsList as $actor) {
            $añoNacimiento = $actor->birthdate;

            if ($añoNacimiento >= $InicioDecada && $añoNacimiento <= $FinalDecada) {
                $actors[] = $actor;
            }
        }
        $FinalDecada = $InicioDecada + 9;
        $title = "Listado de Actores por Década ($InicioDecada - $FinalDecada)";
        return view('actors.list', ['actors' => $actors, 'title' => $title]);
    }
    public function countActors()
    {
        // Retrieve all actors using the query builder
        $numOfActors = count(DB::table('actors')->get());

        // Return the retrieved actors
        return view('actors.count', ['count' => $numOfActors]);
    }
    public function deleteActor($id)
    {
        // Encontrar al actor por su ID
        $actor = DB::table("actors")->where('id', $id)->first();

        if ($actor) {
            // Eliminar el actor
            DB::table("actors")->where('id', $id)->delete();
            return response()->json(['acción' => 'delete', 'status' => 'true']);
        } else {
            return response()->json(['acción' => 'delete', 'status' => 'false']);
        }
    }
}
