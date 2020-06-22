<?php

namespace App\Http\Controllers;

use App\Category;
use App\Story;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoryController extends Controller {

    public function index() {

        $stories = Story::orderBy( 'id', 'desc' )->paginate( 10 );
    }

    public function create() {

        $categories = Category::all();
        $tags = Tag::all();
        if ( count( $categories ) == 0 ) {
            return redirect()->route( 'create.category' )->with( 'error', 'At Least one category need for creating your first story.' );
        }
        if ( count( $tags ) == 0 ) {
            return redirect()->route( 'create.tag' )->with( 'error', 'At Least one tag need for creating your first story.' );
        }
        return view( 'stories.create', compact( 'categories', 'tags' ) );
    }

    public function store( Request $request ) {

        $rules = [
            'title'       => 'required|min:8|max:255',
            'category_id' => 'required',
            'tags'        => 'required',
            'image'       => 'required|image|max:5000',
            'story'       => 'required|min:20|max:5000',
        ];

        $this->validate( $request, $rules );

        $story = new Story();
        $story->title = $request->title;
        $story->category_id = $request->category_id;
        $story->story = $request->story;
        $story->slug = Str::slug( $request->title . time() );
        $story->user_id = Auth::user()->id;

        $image = $request->file( 'image' );
        $imageName = 'p_img-' . time() . Str::random( 15 );
        $extension = strtolower( $image->getClientOriginalExtension() );
        $imageFullName = $imageName . '.' . $extension;
        $uploadPath = 'img/post-img/';
        $imageURL = $uploadPath . $imageFullName;
        $success = $image->move( $uploadPath, $imageFullName );
        $story['image'] = $imageURL;

        $story->save();
        $story->tags()->attach( $request->tags );
        return redirect( '/profile' . '/' . Auth::user()->slug )->with( 'success', 'Story Added Successfully.' );
    }

    public function show( $id ) {

        $story = Story::with( 'tags' )->get();
    }

    public function edit( $id ) {

        $story = Story::where( 'slug', $id )->firstOrFail();
        $categories = Category::all();
        $tags = Tag::all();
        return view( 'stories.edit', compact( 'story', 'categories', 'tags' ) );
    }

    public function update( Request $request, $id ) {

        $rules = [
            'title'       => 'required|min:8|max:255',
            'category_id' => 'required',
            'tags'        => 'required',
            'image'       => 'image|max:5000',
            'story'       => 'required|min:20|max:5000',
        ];

        $this->validate( $request, $rules );
        // dd($request->all());
        $story = Story::where( 'slug', $id )->first();
        $story->title = $request->title;
        $story->category_id = $request->category_id;
        $story->story = $request->story;
        $story->slug = Str::slug( $request->title . time() );
        // $story->user_id = Auth::user()->id;
        $image = $request->file( 'image' );
        $old_image = $story->image;

        if ( Auth::id() !== $story->user_id ) {
            return redirect()->back()->with( 'error', 'You don\'t have permission to edit this Story.' );
        } else {

            if ( $image ) {
    
                $image = $request->file( 'image' );
                $imageName = 'p_img-' . time() . Str::random( 15 );
                $extension = strtolower( $image->getClientOriginalExtension() );
                $imageFullName = $imageName . '.' . $extension;
                $uploadPath = 'img/post-img/';
                $imageURL = $uploadPath . $imageFullName;
                $success = $image->move( $uploadPath, $imageFullName );
                $story['image'] = $imageURL;
    
                $story->save();
                $story->tags()->sync( $request->tags );
                unlink( $old_image );
                return redirect( '/profile' . '/' . Auth::user()->slug )->with( 'success', 'Story Updated Successfully.' );
            } else {
                $story->save();
                $story->tags()->sync( $request->tags );
                return redirect( '/profile' . '/' . Auth::user()->slug )->with( 'success', 'Story Updated Successfully.' );
            }
        }

    }

    public function destroy( $id ) {

        $story = Story::where( 'slug', $id )->firstOrFail();
        $image = $story->image;

        if ( Auth::id() !== $story->user_id ) {
            return redirect()->back()->with( 'error', 'You don\'t have permission to delete this Story.' );
        } else {
            $delete = $story->delete();
            $story->tags()->detach();
            if ( $delete ) {
                unlink( $image );
                return redirect( '/profile' . '/' . Auth::user()->slug )->with( 'success', 'Story Deleted Successfully.' );
            }
        }
    }
}
