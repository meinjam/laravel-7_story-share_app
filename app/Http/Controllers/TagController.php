<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller {
    public function index() {
        //
    }

    public function create() {

        $tags = Tag::orderBy( 'id', 'desc' )->paginate( 10 );
        return view( 'tags.create', compact( 'tags' ) );
    }

    public function store( Request $request ) {

        $rules = [
            'tag' => ['required', 'min:3', 'max:20'],
        ];
        $this->validate( $request, $rules );

        $tags = new Tag();
        $tags->tag = $request->tag;
        $tags->slug = Str::slug( $request->tag );
        $tags->save();
        return redirect()->route( 'create.story' )->with( 'success', 'Tag created successfully.' );
    }

    public function show( $name ) {

        $tag = Tag::where( 'tag', $name )->firstOrFail();
        // $stories = $tag->stories()->where('is_published', 1)->paginate( 5 );
        $stories = $tag->stories()->paginate( 5 );
        // $categories = Category::orderBy( 'id', 'desc' )->get();
        // $tagssss = Tag::orderBy( 'id', 'desc' )->get();
        $categories = Category::withCount( 'stories' )->orderBy('stories_count', 'desc')->take(5)->get();
        $tagssss = Tag::withCount( 'stories' )->orderBy('stories_count', 'desc')->take(5)->get();
        return view( 'frontend.tag', compact( 'tag', 'categories', 'tagssss', 'stories' ) );
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
