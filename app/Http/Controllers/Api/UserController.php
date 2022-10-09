<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::select('idUser','nickname','email','password', 'commonname')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'name'=>'required',
            // 'description'=>'required',
        ]);


        try{
            // $imageName = Str::random().'.'.$request->image->getClientOriginalExtension();
            // Storage::disk('public')->putFileAs('product/image', $request->image,$imageName);
            $password = Hash::make($request->password);
            // dd($request); 
            $user = new User($request->post());
            $user->password = $password;
            // $user->nickname = $request->nickname;
            $user->save();

            return response()->json([
                'message'=>'User Created Successfully!!'
            ]);
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>$e
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'user'=>$user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    // public function edit(User $User)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'name'=>'required',
            // 'description'=>'required',
            // 'image'=>'nullable'
        ]);

        
        try{   

            $userData = new User($request->post());
            $password = Hash::make($request->password);
            $userData = User::find($id);
            $userData->password = $password;
            // print_r($userData->password); 
            $userData->update();


            // $user = User::find($id);
            // $user->fill($request->post())->update();

            // $user->save();
          

            return response()->json([
                'message'=>'User Updated Successfully!!',
                'data' => $userData
            ]);

        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>$e
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {

            // if($product->image){
            //     $exists = Storage::disk('public')->exists("product/image/{$product->image}");
            //     if($exists){
            //         Storage::disk('public')->delete("product/image/{$product->image}");
            //     }
            // }

            $user->delete();

            return response()->json([
                'message'=>'User Deleted Successfully!!'
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while deleting a User!!'
            ]);
        }
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $pw = $request->password;
        $hash = $user->password;
        // dd($hash);
        if(!$user || !Hash::check($pw, $hash))
        {
            return ['error'=> 'Email or Password wrong'];
        }
            return "Berhasil";

        // return $user;
    }
}
