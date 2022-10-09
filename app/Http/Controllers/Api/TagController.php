<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tag::select('idTag','name')->get();
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
            Tag::create($request->post());

            return response()->json([
                'message'=>'Tag Created Successfully!!'
            ]);
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while creating a Tag!!'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return response()->json([
            'tag'=>$tag
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    // public function edit(Tag $tag)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
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

            $tag = Tag::find($id);
            // print_r($tag->idTag); exit;
            $tag->fill($request->post())->update();
            // $tag->save();
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
                'message'=>'Tag Updated Successfully!!',
                'data' => $tag
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
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        try {

            // if($product->image){
            //     $exists = Storage::disk('public')->exists("product/image/{$product->image}");
            //     if($exists){
            //         Storage::disk('public')->delete("product/image/{$product->image}");
            //     }
            // }

            $tag->delete();

            return response()->json([
                'message'=>'Tag Deleted Successfully!!'
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while deleting a Tag!!'
            ]);
        }
    }
}
