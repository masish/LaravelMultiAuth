<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;
use App\Player;
use App\Club;
use Config;
use App\Http\Requests\GameRequests;

class GameController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = \DB::table('games')->orderBy('game_time','desc')->select('games.id as id','game_time','stadium_id','home.name as home_club', 'away.name as away_club', 'games.created_at as created_at')
                    ->join('clubs as home','games.home_club_id','=','home.id')
                    ->join('clubs as away','games.away_club_id','=','away.id')
                    ->get();
        $stadiums = Config::get('stadium');
        return view('game.index' ,compact('games','stadiums'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $players = Player::orderBy('number', 'asc');
        $positions = Config::get('position');
        $game = Game::findOrFail($id);
        $positions = Config::get('position');
        return view('game.show', compact('game','players','positions'));
    }


}
