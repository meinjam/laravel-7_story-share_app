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
        $stories = Story::orderBy( 'id', 'desc' )->where('is_published', '1')->paginate( 10 );
        return view( 'admin.home', compact( 'user', 'admin', 'stories', 'category', 'tag', 'comment', 'story' ) );
    }

    public function blocked_stories() {

        $user = User::where( 'is_admin', '0' )->get();
        $admin = User::where( 'is_admin', '1' )->get();
        $story = Story::all();
        $category = Category::all();
        $tag = Tag::all();
        $comment = Comment::all();
        $stories = Story::latest()->where('is_published', '0')->paginate( 10 );
        return view( 'admin.blocked-stories', compact( 'user', 'admin', 'stories', 'category', 'tag', 'comment', 'story' ) );
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
        return view( 'admin.search-story', compact( 'search', 'user', 'admin', 'result', 'category', 'tag', 'comment', 'story' ) );
        // return response()->json($users);
    }

    public function search_category( Request $request ) {

        $search = $request->get( 'search' );
        
        $user = User::where( 'is_admin', '0' )->get();
        $admin = User::where( 'is_admin', '1' )->get();
        $story = Story::all();
        $category = Category::all();
        $tag = Tag::all();
        $comment = Comment::all();
        $categories = Category::where( 'name', 'like', '%' . $search . '%' )->firstOrFail();
        $result = $categories->stories()->paginate(20);
        return view( 'admin.search-category', compact( 'search', 'user', 'admin', 'result', 'category', 'tag', 'comment', 'story' ) );
        // return response()->json($result);
    }

    public function search_tag( Request $request ) {

        $search = $request->get( 'search' );
        
        $user = User::where( 'is_admin', '0' )->get();
        $admin = User::where( 'is_admin', '1' )->get();
        $story = Story::all();
        $category = Category::all();
        $tag = Tag::all();
        $comment = Comment::all();
        $tags = Tag::where( 'tag', 'like', '%' . $search . '%' )->firstOrFail();
        $result = $tags->stories()->paginate(20);
        return view( 'admin.search-tag', compact( 'search', 'user', 'admin', 'result', 'category', 'tag', 'comment', 'story' ) );
        // return response()->json($result);
    }

    public function category() {
        
        $user = User::where( 'is_admin', '0' )->get();
        $admin = User::where( 'is_admin', '1' )->get();
        $story = Story::all();
        $category = Category::all();
        $tag = Tag::all();
        $comment = Comment::all();
        $categories = Category::latest()->paginate(10);
        return view( 'admin.category', compact( 'user', 'admin', 'categories', 'category', 'tag', 'comment', 'story' ) );
        // return response()->json($users);
    }

    public function tag() {
        
        $user = User::where( 'is_admin', '0' )->get();
        $admin = User::where( 'is_admin', '1' )->get();
        $story = Story::all();
        $category = Category::all();
        $tag = Tag::all();
        $comment = Comment::all();
        $tags = Tag::latest()->paginate(10);
        return view( 'admin.tag', compact( 'user', 'admin', 'tags', 'category', 'tag', 'comment', 'story' ) );
        // return response()->json($users);
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
