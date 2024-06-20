<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $data = User::all();
        return view('index',compact('data'));
    }

    public function create() {
        return  view('add');
    }
    public function store(Request $request) {
        // return $request;

        $post_data = array(
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'gender' => $request->gender,
        );

        // return $post_data;

        $insert = User::create($post_data);

        if($insert){
            return "ok";
        }else{
            return "err";
        }
    }
    public function edit($id) {
        // return $id;
        $data = User::find($id);

        return view('edit',compact('data'));
    }
    public function update(Request $request) {
        // return $request;
        $id = $request->id;
        $post_data = array(
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'gender' => $request->gender,
        );

        // return $post_data;

        $insert = User::where('id',$id)->update($post_data);

        if($insert){
            return "ok";
        }else{
            return "err";
        }
    }
    public function delete(Request $request) {
        $id = $request->id;
        // return $id;

        $user = User::find($id);

        $user->delete();

        return redirect('');
    }
}
