<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Story;
use App\Tag;

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
        $category->save();
        return redirect()->route( 'create.story' )->with( 'success', 'Category created successfully.' );
    }

    public function show( $name ) {
        
        $category = Category::where( 'name', $name )->firstOrFail();
        $categories = Category::orderBy( 'id', 'desc' )->take('5')->get();
        $tagssss = Tag::orderBy( 'id', 'desc' )->take('5')->get();
        // return response()->json($category->stories);
        return view( 'frontend.category', compact( 'category', 'categories', 'tagssss' ) );
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
