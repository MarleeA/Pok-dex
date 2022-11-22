<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

use function Termwind\style;

class PokemonController extends Controller
{
    protected $pokedex =
    [
        'Bulbizarre' => ['type' => 'Plante', 'attaque' => 49, 'defense' => 49, 'pv' => 45,],
        'Salamèche' => ['type' => 'Feu', 'attaque' => 52, 'defense' => 43, 'pv' => 39,],
        'Carapuce' => ['type' => 'Eau', 'attaque' => 48, 'defense' => 65, 'pv' => 44,]
    ];

    public function index()
    {
        $html="";
        $html.="<h2> Les Pokémons </h2>";
        foreach ($this->pokedex as $pokemon => $value) {
                  $html.= "<ul>". $pokemon;
                  $html.= "<li>Type : ". $value['type'] ."</li> ";
                  $html.= "<li>Attaque : ". $value['attaque'] ."</li> ";
                  $html.= "<li>Défense : ". $value['defense'] ."</li> ";
                  $html.= "<li>PV : " . $value['pv'] ."</li> ";
                  $html.="</ul>";
        };
        return response($html,200)->header('Content-Type','text/html');
    }

    public function create()
    {
        $html="";
        $html.= '<form action="/pokemons" method="POST"> 
                <input type="text" name="name" placeholder="Nom du pokémon">
                <input type="text" name="type" placeholder="Type">
                <input type="number" name="attaque" placeholder="Attaque">
                <input type="number" name="defense" placeholder="Défense">
                <input type="number" name="pv" placeholder="PV">
                <input type="submit" value="Créer">
                </form>';
                return response($html,200)->header('Content-Type','text/html');
    }

    public function store(Request $request)
    {
        $validate= $request->validate([
            'name'=>'required',
            'type'=>'required',
            'attaque'=>'required',
            'defense'=>'required',
            'pv'=>'required'
        ]);

        $name=$request->input('name');
        $type=$request->input('type');
        $attaque=$request->input('attaque');
        $defense=$request->input('defense');
        $pv=$request->input('pv');
        
            $html="";
            $html.= "<ul>". $name;
            $html.= "<li>Type : ". $type ."</li> ";
            $html.= "<li>Attaque : ". $attaque ."</li> ";
            $html.= "<li>Défense : ". $defense ."</li> ";
            $html.= "<li>PV : " . $pv ."</li> ";
            $html.="</ul>";
        
        return response($html,200)->header('Content-Type','text/html');
        
    }

    public function show($pokemon)
    {
        $newPokemon= isset($this->pokedex[$pokemon]);
       
        if($newPokemon){
            $html="";
            $html.= "<ul>". $pokemon;
            $html.= "<li>Type : ". $this->pokedex[$pokemon]['type'] ."</li> ";
            $html.= "<li>Attaque : ". $this->pokedex[$pokemon]['attaque'] ."</li> ";
            $html.= "<li>Défense : ". $this->pokedex[$pokemon]['defense'] ."</li> ";
            $html.= "<li>PV : " . $this->pokedex[$pokemon]['pv'] ."</li> ";
            $html.="</ul>";
        
        return response($html,200)->header('Content-Type','text/html');
        } else{
            return response("Ce pokémon n'existe pas",404)->header('Content-Type','text/html');
        }
    }

    public function edit($pokemon)
    {
        if(isset($this->pokedex[$pokemon])){
            $pokemon= $this->pokedex[$pokemon];
            $html = "";
            $html .= '<form action="/pokemons" method="POST"> 
                <input type="text" name="_method" type="hidden" value="PUT">
                <input type="text" name="type" value="'. $this->pokedex[$pokemon]['type'] .'" placeholder="Type">
                <input type="number" name="attaque" value="'. $this->pokedex[$pokemon]['attaque'] .'" placeholder="Attaque">
                <input type="number" name="defense" value="'. $this->pokedex[$pokemon]['defense'] .'" placeholder="Défense">
                <input type="number" name="pv" value="'. $this->pokedex[$pokemon]['pv'] .'" placeholder="PV">
                <input type="submit" value="Modifier">
                </form>
                <form action="/pokemons/'.$pokemon.'"method="POST">
                <input  name="_method" type="hidden" value="DELETE">
                <button>Supprimer</button>
                </form>';
                return response($html,200)->header('Content-Type','text/html');
        } else{
            return response("Ce pokémon est introuvable",404)->header('Content-Type','text/html');
        };

    }

    public function update($pokemon)
    {
    }

    public function destroy($pokemon)
    {
    }
}

?>

<style>
    li{
        list-style: none;
    }
</style>
