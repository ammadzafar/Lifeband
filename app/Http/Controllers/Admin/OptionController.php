<?php

namespace App\Http\Controllers\Admin;

use App\Model\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OptionController extends Controller
{
    public function store(Request $request)
    {

        foreach($request->options as $opt){
            $options = new Option();
            $options->question_id = $request->id;
            $options->name = $opt;
            $options->save();
        }
        $opt = Option::where('question_id',$request->id)->get();
//        dd($opt);
        return response()->json([
            'status'=>'success',
            'message'=>'question and options successfully created',
            'options'=>$opt,
        ]);
    }
    public function update(Request $request)
    {
        Option::where('id',$request->option_id)->update(['name'=>$request->update_option]);
        return response()->json([
           'status'=>'success',
           'message'=>'option updated successfully',
        ]);
    }
    public function delete(Request $request)
    {
//        dd($request->all());
        Option::where('id',$request->option_id)->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'option deleted successfully',
        ]);
    }
}
