<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {
    public function index() {
        //
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

        if ( Auth::id() !== $comment->user_id ) {
            return redirect()->back()->with( 'error', 'You don\'t have permission to delete this Comment.' );
        } else {
            $comment->delete();
            return redirect()->back()->with( 'success', 'Comment deleted Successfully.' );
        }
    }
}
