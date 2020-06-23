<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Category;
use App\Story;

class TagController extends Controller {
    public function index() {
        //
    }

    public function create() {

        $tags = Tag::orderBy( 'id', 'desc' )->paginate(10);
        return view( 'tags.create', compact( 'tags' ) );
    }

    public function store( Request $request ) {

        $rules = [
            'tag' => ['required', 'min:3', 'max:20'],
        ];
        $this->validate( $request, $rules );

        $tags = new Tag();
        $tags->tag = $request->tag;
        $tags->save();
        return redirect()->route( 'create.story' )->with( 'success', 'Tag created successfully.' );
    }

    public function show( $name ) {
        
        $tag = Tag::where( 'tag', $name )->firstOrFail();
        $categories = Category::orderBy( 'id', 'desc' )->get();
        $tagssss = Tag::orderBy( 'id', 'desc' )->get();
        // return response()->json($tag->stories);
        return view( 'frontend.tag', compact( 'tag', 'categories', 'tagssss' ) );
    }

    public function edit( $id ) {
        //
    }

    public function update( Request $request, $id ) {
        //
    }

    public function destroy( $id ) {
        //
    }
}
