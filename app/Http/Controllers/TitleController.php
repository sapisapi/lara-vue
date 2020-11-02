<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title;

class TitleController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required',
            ],
            [
                'title.required' => 'タイトルを入力してください',
            ]
        );
        Title::create($request->all());
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
        $title = Title::findOrFail($id);
        $title->update($request->all());
        $title->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $title = Title::findOrFail($id);
        $title->delete();
        return Title::latest()->get();
    }
}
