<?php

namespace App\Http\Controllers;

use App\Category;
use App\Story;
use App\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller {

    public function index() {

        $stories = Story::orderBy( 'id', 'desc' )->where( 'is_published', '1' )->paginate( 10 );
        $categories = Category::orderBy( 'id', 'desc' )->get();
        $tagssss = Tag::orderBy( 'id', 'desc' )->get();
        return view( 'frontend.home', compact( 'stories', 'categories', 'tagssss' ) );
    }

    public function single_story( $slug ) {

        $story = Story::where( 'slug', $slug )->firstOrFail();
        $tags = Tag::orderBy( 'id', 'desc' )->get();
        $categories = Category::orderBy( 'id', 'desc' )->get();
        return view( 'frontend.single_story', compact( 'story', 'tags', 'categories' ) );
    }

    public function search( Request $request ) {

        $search = $request->get( 'search' );

        if ( $search == '' ) {
            return redirect()->route( 'homepage' )->with( 'error', 'Please type something and search.' );
        } else {
            $result = Story::where( 'title', 'like', '%' . $search . '%' )->orderBy( 'id', 'desc' )->paginate( 5 );
            $categories = Category::orderBy( 'id', 'desc' )->get();
            $tagssss = Tag::orderBy( 'id', 'desc' )->get();

            return view( 'frontend.search', compact( 'result', 'categories', 'tagssss' ) );
        }
        // $result = DB::table( 'stories' )
        //     ->join( 'categories', 'categories.id', '=', 'stories.category_id' )
        //     ->join( 'users', 'user.id', '=', 'stories.user_id' )
        //     ->select( 'stories.*', 'categories.name' )
        //     ->where( 'stories.title', 'like', '%' . $search . '%' )
        //     ->orWhere( 'stories.story', 'like', '%' . $search . '%' )
        //     ->orWhere( 'categories.name', 'like', '%' . $search . '%' )
        //     ->orderBy( 'id', 'desc' )
        //     // ->paginate( 10 );
        //     ->get();

        // $result = Story::with( 'category', 'tags' )
        //     ->where( 'title', 'like', '%' . $search . '%' )
        //     ->orWhere( 'story', 'like', '%' . $search . '%' )
        //     ->whereHas( 'category', function ( $query ) use ( $request ) {
        //         $query->where( 'name', 'like', '%' . $request . '%' );
        //     } )->get();

        // return response()->json( $result );
    }

    public function contact() {

        return view( 'frontend.contact' );
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
