<?php

namespace App\Http\Controllers;

use App\Models\Wotd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


class APIController extends Controller
{
    public function fetchAPI () {  
        $wordOfTheDay = Http::get('https://random-word-api.vercel.app/api?words=1');
        $word = $wordOfTheDay[0];
        
        $wotd = Wotd::create([
            'word'=>$word,
        ]);

        return view("api", compact("word"));
    }

   // raisonnement : 
   // créer une fct qui fetch une api pour récupérer un mot et qui intègre le mot dans la DB.
   // créer une deuxième fct qui compare la date du jour avec la date dans le created_at du dernier mot fetché dans la DB.
   // appeler cette 2ème fct au moment du log de l'utilisateur
   // si la date du jour diffère de la date du created_at alors on rappelle la fct fetch (qui du coup réintègre un nouveau mot dans la DB)
   // 
}
