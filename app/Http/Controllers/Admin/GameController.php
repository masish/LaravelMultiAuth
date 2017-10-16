<?php

namespace App\Http\Controllers\Admin;

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
     * Display a listing of the resource.
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
        return view('admin.game.index', compact('games','stadiums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clubs = \App\Club::orderBy('id','asc')->pluck('name', 'id');
        $players = \App\Player::orderBy('id','asc')->pluck('name', 'id');
        $players->prepend('',0);
        $stadiums = Config::get('stadium');
        return view('admin.game.create', compact('clubs','players','stadiums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameRequests $request)
    {
        $game = Game::create($request->except(['g_date','g_time']));
        if (!$game->game_time) {
            $game->game_time = null;
        }
        $game->save();
        //Game::create($request->all());
        \Session::flash('flash_message', 'ゲームを作成しました。');
        return redirect('admin/game');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::findOrFail($id);
        return view('admin.game.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clubs = \App\Club::orderBy('id','asc')->pluck('name', 'id');
        $players = \App\Player::orderBy('id','asc')->pluck('name', 'id');
        $players->prepend('',0);
        $stadiums = Config::get('stadium');
        $game = Game::findOrFail($id);
        $gameTime = explode(' ', $game->game_time);
        $game->g_date = $gameTime[0];
        $game->g_time = $gameTime[1];
        return view('admin.game.edit', compact('game','clubs','players','stadiums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GameRequests $request, $id)
    {
        $game = Game::findOrFail($id);
        $game->update($request->except(['g_date','g_time']));
        \Session::flash('flash_message', 'ゲームの情報を更新しました。');
        return redirect('admin/game');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete($id);
        \Session::flash('flash_message', 'ゲームの情報を削除しました。');
        return redirect('admin/game');
    }
}
