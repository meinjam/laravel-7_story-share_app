<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

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
