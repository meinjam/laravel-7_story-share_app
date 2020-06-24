<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return redirect()->route( 'create.story' )->with( 'success', 'Category created successfully.' );
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
