<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Story;
use App\Tag;
use App\User;

class CommentController extends Controller {

    public function index() {
        
        $user = User::where( 'is_admin', '0' )->get();
        $admin = User::where( 'is_admin', '1' )->get();
        $story = Story::all();
        $category = Category::all();
        $tag = Tag::all();
        $comment = Comment::all();
        $comments = Comment::orderBy( 'id', 'desc' )->paginate( 20 );
        return view( 'admin.comments', compact( 'user', 'admin', 'comments', 'category', 'tag', 'comment', 'story' ) );
        // return response()->json($users);
    }

    public function create() {
        //
    }

    public function store( Request $request, $post_id ) {
        $rules = [
            'comment'  => ['required', 'string', 'max:255'],
            'story_id' => ['required'],
            'user_id'  => ['required'],
        ];
        // $this->validate( $request, $rules );
        if($request->comment == '') {
            return redirect()->back()->with( 'error', 'Comment can not be empty.' );
        }

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->story_id = $post_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();
        return redirect()->back()->with( 'success', 'Comment Added successfully.' );
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

        $comment = Comment::findOrFail( $id );

        if ( Auth::user()->is_admin == 1 OR Auth::id() === $comment->user_id ) {
            $comment->delete();
            return redirect()->back()->with( 'success', 'Comment deleted Successfully.' );
        } else {
            return redirect()->back()->with( 'error', 'You don\'t have permission to delete this Comment.' );
        }
    }
}
