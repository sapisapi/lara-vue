<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

class TestController extends Controller
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
                'question' => 'required',
                'answer' => 'required'
            ],
            [
                'question.required' => '問題を入力してください',
                'answer.required' => '答えを入力してください'
            ]
        );
        Test::create($request->all());
    }

    public function show(Request $request, $id)
    {
        return json_encode(Test::where('user_id',$request->user()->id)->where('title_id',$id)->get());
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
        $test = Test::findOrFail($id);
        $test->update($request->all());
        $test->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = Test::findOrFail($id);
        $test->delete();
        return Test::latest()->get();
    }
}
