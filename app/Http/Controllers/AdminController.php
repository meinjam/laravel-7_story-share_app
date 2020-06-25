<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Story;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller {

    public function index() {

        $user = User::where( 'is_admin', '0' )->get();
        $admin = User::where( 'is_admin', '1' )->get();
        $story = Story::all();
        $category = Category::all();
        $tag = Tag::all();
        $comment = Comment::all();
        $stories = Story::orderBy( 'id', 'desc' )->paginate( 10 );
        return view( 'admin.home', compact( 'user', 'admin', 'stories', 'category', 'tag', 'comment', 'story' ) );
    }

    public function users() {

        $user = User::where( 'is_admin', '0' )->get();
        $admin = User::where( 'is_admin', '1' )->get();
        $story = Story::all();
        $category = Category::all();
        $tag = Tag::all();
        $comment = Comment::all();
        $users = User::where( 'is_admin', '0' )->orderBy( 'id', 'desc' )->paginate( 10 );
        return view( 'admin.users', compact( 'user', 'admin', 'users', 'category', 'tag', 'comment', 'story' ) );
        // return response()->json($users);
    }

    public function admins() {
        
        $user = User::where( 'is_admin', '0' )->get();
        $admin = User::where( 'is_admin', '1' )->get();
        $story = Story::all();
        $category = Category::all();
        $tag = Tag::all();
        $comment = Comment::all();
        $admins = User::where( 'is_admin', '1' )->orderBy( 'id', 'desc' )->paginate( 10 );
        return view( 'admin.admins', compact( 'user', 'admin', 'admins', 'category', 'tag', 'comment', 'story' ) );
        // return response()->json($users);
    }

    public function search( Request $request ) {

        $search = $request->get( 'search' );
        
        $user = User::where( 'is_admin', '0' )->get();
        $admin = User::where( 'is_admin', '1' )->get();
        $story = Story::all();
        $category = Category::all();
        $tag = Tag::all();
        $comment = Comment::all();
        $result = Story::where( 'title', 'like', '%' . $search . '%' )
            ->orWhere( 'story', 'like', '%' . $search . '%' )
            ->orderBy( 'id', 'desc' )
            ->paginate( 10 );
        return view( 'admin.search-story', compact( 'user', 'admin', 'result', 'category', 'tag', 'comment', 'story' ) );
        // return response()->json($users);
    }

    public function create() {
        //
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
