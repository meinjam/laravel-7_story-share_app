<?php

namespace App\Http\Controllers;

use App\Story;
use Illuminate\Http\Request;
use App\Category;
use App\Tag;

class FrontendController extends Controller {

    public function index() {

        $stories = Story::orderBy( 'id', 'desc' )->where( 'is_published', '1' )->paginate( 10 );
        $categories = Category::orderBy( 'id', 'desc' )->get();
        $tagssss = Tag::orderBy( 'id', 'desc' )->get();
        return view( 'frontend.home', compact( 'stories', 'categories', 'tagssss' ) );
    }

    public function single_story($slug) {
        
        $story = Story::where( 'slug', $slug )->firstOrFail();
        $tags = Tag::orderBy( 'id', 'desc' )->get();
        $categories = Category::orderBy( 'id', 'desc' )->get();
        return view( 'frontend.single_story', compact( 'story', 'tags', 'categories' ) );
    }

    public function contact() {
        
        return view('frontend.contact');
    }

    public function store( Request $request ) {
        //
    }

    public function show( $id ) {
        //
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
