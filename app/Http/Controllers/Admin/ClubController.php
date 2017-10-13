<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Club;

class ClubController extends Controller
{

    // バリデーションのルール
    public $validateRules = [
        'name' => 'required|max:255',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Club::orderBy('id', 'asc')->paginate(20);
        return view('admin.club.index', compact('clubs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.club.create');
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
        Club::create($request->all());
        \Session::flash('flash_message2', 'クラブを作成しました。');
        return redirect('admin/club');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $club = Club::findOrFail($id);
        return view('admin.club.show', compact('club'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $club = Club::findOrFail($id);
        return view('admin.club.edit', compact('club'));
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
        $club = Club::findOrFail($id);
        $club->update($request->all());
        \Session::flash('flash_message2', 'クラブの情報を更新しました。');
        return redirect('admin/club');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $club = Club::findOrFail($id);
        $club->delete($id);
        \Session::flash('flash_message2', '選手を削除しました。');
        return redirect('admin/club');

    }
}
