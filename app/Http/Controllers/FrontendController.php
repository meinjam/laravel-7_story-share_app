<?php

namespace App\Http\Controllers;

use App\Category;
use App\Story;
use App\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller {

    public function index() {

        $stories = Story::orderBy( 'id', 'desc' )->where( 'is_published', '1' )->paginate( 5 );
        // $categories = Category::orderBy( 'id', 'desc' )->get();
        $categories = Category::withCount( 'stories' )->orderBy( 'stories_count', 'desc' )->take( 5 )->get();
        $tagssss = Tag::withCount( 'stories' )->orderBy( 'stories_count', 'desc' )->take( 5 )->get();
        // $tagssss = Tag::orderBy( 'id', 'desc' )->get();
        return view( 'frontend.home', compact( 'stories', 'categories', 'tagssss' ) );
    }

    public function single_story( $slug ) {

        $story = Story::where( 'slug', $slug )->firstOrFail();
        // $tags = Tag::orderBy( 'id', 'desc' )->get();
        // $categories = Category::orderBy( 'id', 'desc' )->get();
        $categories = Category::withCount( 'stories' )->orderBy( 'stories_count', 'desc' )->take( 5 )->get();
        $tags = Tag::withCount( 'stories' )->orderBy( 'stories_count', 'desc' )->take( 5 )->get();
        return view( 'frontend.single_story', compact( 'story', 'tags', 'categories' ) );
    }

    public function search( Request $request ) {

        $search = $request->get( 'search' );

        if ( $search == '' ) {
            return redirect()->route( 'homepage' )->with( 'error', 'Please type something and search.' );
        } else {
            $result = Story::whereHas( 'category', function ( $query ) use ( $search ) {
                $query->where( 'name', 'like', '%' . $search . '%' );
            } )->orWhereHas( 'tags', function ( $query ) use ( $search ) {
                $query->where( 'tag', 'like', '%' . $search . '%' );
            } )
                ->orWhere( 'title', 'like', '%' . $search . '%' )
                ->orWhere( 'story', 'like', '%' . $search . '%' )
                ->latest()
                ->paginate( 10 );

            $categories = Category::withCount( 'stories' )->orderBy( 'stories_count', 'desc' )->take( 5 )->get();
            $tagssss = Tag::withCount( 'stories' )->orderBy( 'stories_count', 'desc' )->take( 5 )->get();

            return view( 'frontend.search', compact( 'search', 'result', 'categories', 'tagssss' ) );
        }
    }

    public function contact() {

        return view( 'frontend.contact' );
    }

    public function about() {

        return view( 'frontend.about' );
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
