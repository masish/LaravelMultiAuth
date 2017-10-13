<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Player;
use Config;

class PlayerController extends Controller
{

    // バリデーションのルール
    public $validateRules = [
        'name' => 'required',
        'number' => 'required',
        'club_id' => 'required',
        'position' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::orderBy('number', 'asc')->paginate(20);
        $positions = Config::get('position');
        return view('admin.player.index', compact('players','positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $clubs = \App\Club::orderBy('id','asc')->pluck('name', 'id');
       $positions = Config::get('position');
       return view('admin.player.create', compact('clubs','positions'));
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
        Player::create($request->all());
        \Session::flash('flash_message', '選手を作成しました。');
        return redirect('admin/player');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $player = Player::findOrFail($id);
        $positions = Config::get('position');
        return view('admin.player.show', compact('player','positions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $player = Player::findOrFail($id);
        $clubs = \App\Club::orderBy('id','asc')->pluck('name', 'id');
        $positions = Config::get('position');
        return view('admin.player.edit', compact('player','clubs','positions'));
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
        $player = Player::findOrFail($id);
        $player->update($request->all());
        \Session::flash('flash_message', '選手の情報を更新しました。');
        return redirect('admin/player');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $player = Player::findOrFail($id);
        $player->delete($id);
        \Session::flash('flash_message', '選手を削除しました。');
        return redirect('admin/player');
    }
}
