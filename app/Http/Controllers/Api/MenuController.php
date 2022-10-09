<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Menu::select('idMenu','idCategory','name','description', 'price')->get();
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
            Menu::create($request->post());

            return response()->json([
                'message'=>'Menu Created Successfully!!'
            ]);
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while creating a menu!!'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return response()->json([
            'menu'=>$menu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    // public function edit(Menu $menu)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
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

            $menu = Menu::find($id);
            // print_r($request->post()); 
            $menu->fill($request->post())->update();
            // $menu->save();
            // if($request->hasFile('image')){

            //     // remove old image
            //     if($product->image){
            //         $exists = Storage::disk('public')->exists("product/image/{$product->image}");
            //         if($exists){
            //             Storage::disk('public')->delete("product/image/{$product->image}");
            //         }
            //     }

            //     $imageName = Str::random().'.'.$request->image->getClientOriginalExtension();
            //     Storage::disk('public')->putFileAs('product/image', $request->image,$imageName);
            //     $product->image = $imageName;
            //     $product->save();
            // }

            return response()->json([
                'message'=>'Menu Updated Successfully!!',
                'data' => $menu
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
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        try {

            // if($product->image){
            //     $exists = Storage::disk('public')->exists("product/image/{$product->image}");
            //     if($exists){
            //         Storage::disk('public')->delete("product/image/{$product->image}");
            //     }
            // }

            $menu->delete();

            return response()->json([
                'message'=>'Menu Deleted Successfully!!'
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while deleting a menu!!'
            ]);
        }
    }
}
