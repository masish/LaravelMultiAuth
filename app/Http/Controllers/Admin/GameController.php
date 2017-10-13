<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;
use App\Player;
use App\Club;
use Config;

class GameController extends Controller
{

    // バリデーションのルール
    public $validateRules = [
        'game_time' => 'required|date',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = \DB::table('games')->orderBy('game_time','desc')->select('game_time','stadium_id','home.name as home_club', 'away.name as away_club')
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
       $stadiums = Config::get('stadium');
       return view('admin.game.create', compact('clubs','players','stadiums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validateRules);
        Game::create($request->all());
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
        $game = Game::findOrFail($id);
        return view('admin.game.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->validateRules);
        $game = Game::findOrFail($id);
        $game->update($request->all());
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
