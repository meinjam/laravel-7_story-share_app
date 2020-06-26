<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\Story;
use App\User;

class CategoryController extends Controller {
    public function index() {
        //
    }

    public function create() {

        $categories = Category::orderBy( 'id', 'desc' )->paginate( 10 );
        return view( 'category.create', compact( 'categories' ) );
    }

    public function store( Request $request ) {

        $rules = [
            'category' => ['required', 'min:3', 'max:20'],
        ];
        $this->validate( $request, $rules );

        $category = new Category();
        $category->name = $request->category;
        $category->slug = Str::slug( $request->category );
        $category->save();

        if(Auth::user()->is_admin) {
            return redirect()->route( 'admin.category' )->with( 'success', 'Category created successfully.' );
        } else {
            return redirect()->route( 'create.story' )->with( 'success', 'Category created successfully.' );
        }

    }

    public function show( $name ) {

        $category = Category::where( 'name', $name )->firstOrFail();
        // $stories = $category->stories()->where('is_published', 1)->paginate( 5 );
        $stories = $category->stories()->paginate( 5 );
        // $categories = Category::orderBy( 'id', 'desc' )->take( '5' )->get();
        // $tagssss = Tag::orderBy( 'id', 'desc' )->take( '5' )->get();
        $categories = Category::withCount( 'stories' )->orderBy('stories_count', 'desc')->take(5)->get();
        $tagssss = Tag::withCount( 'stories' )->orderBy('stories_count', 'desc')->take(5)->get();
        return view( 'frontend.category', compact( 'category', 'categories', 'tagssss', 'stories' ) );
    }

    public function edit( $slug ) {
        
        $user = User::where( 'is_admin', '0' )->get();
        $admin = User::where( 'is_admin', '1' )->get();
        $story = Story::all();
        $category = Category::all();
        $tag = Tag::all();
        $comment = Comment::all();
        $categories = Category::where('slug', $slug)->firstOrFail();
        return view( 'category.edit', compact( 'user', 'admin', 'categories', 'category', 'tag', 'comment', 'story' ) );
        // return response()->json($users);
    }

    public function update( Request $request, $slug ) {
        
        $rules = [
            'category' => ['required', 'min:3', 'max:20'],
        ];
        $this->validate( $request, $rules );

        $category = Category::where('slug', $slug)->firstOrFail();
        $category->name = $request->category;
        $category->save();
        return redirect()->route('admin.category')->with( 'success', 'Category Updated Successfully.' );
    }

    public function destroy( $slug ) {
        
        $category = Category::where( 'slug', $slug )->firstOrFail()->delete();
        return redirect()->back()->with( 'success', 'Category Deleted Successfully.' );
    }
}
