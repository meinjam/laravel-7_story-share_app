<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Category;
use App\Comment;
use App\Story;
use App\Tag;

class ProfileController extends Controller {

    public function index( $id ) {

        $user = User::where( 'slug', $id )->firstOrFail();
        $stories = $user->stories()->paginate(5);
        // $user = User::with('stories')->where( 'slug', $id )->first();
        return view( 'profile.home', compact( 'user', 'stories' ) );
        // return response()->json($user->stories);
    }

    public function edit_details() {

        return view( 'profile.edit-details' );
    }

    public function updateinfo( Request $request ) {

        $rules = [
            'name'   => ['required', 'string', 'max:255'],
            'dob'    => ['required', 'string', 'min:6', 'max:25'],
            'phone'  => ['required', 'string', 'min:10', 'max:25'],
            'gender' => ['required', 'string', 'max:10'],
        ];

        $this->validate( $request, $rules );

        $user = Auth::user();
        $user->name = $request->get( 'name' );
        $user->dob = $request->get( 'dob' );
        $user->phone = $request->get( 'phone' );
        $user->gender = $request->get( 'gender' );
        $user->save();
        return redirect( '/profile' . '/' . Auth::user()->slug )->with( 'success', 'Profile Updated Successfully.' );
    }

    public function edit_pro_pic( $id ) {

        $user = User::where( 'slug', $id )->first();
        return view( 'profile.editprofilepic', compact( 'user' ) );
    }

    public function update_pro_pic( Request $request ) {

        $rules = [
            'avatar' => ['required', 'image', 'max:2000'],
        ];

        $this->validate( $request, $rules );

        $oldpicture = Auth::user()->avatar;

        $image = $request->file( 'avatar' );
        $imageName = 'p_picture-' . time() . Str::random( 10 );
        $extension = strtolower( $image->getClientOriginalExtension() );
        $imageFullName = $imageName . '.' . $extension;
        $uploadPath = 'img/profile-pic/';
        $imageURL = $uploadPath . $imageFullName;
        $success = $image->move( $uploadPath, $imageFullName );

        $user = Auth::user();
        $user->avatar = $imageURL;
        $user->save();
        if($oldpicture){
            unlink( $oldpicture );
        }
        return redirect( '/profile' . '/' . Auth::user()->slug )->with( 'success', 'Profile Picture Updated Successfully.' );
    }

    public function updatepassword( $id ) {

        $user = User::where( 'slug', $id )->first();
        return view( 'profile.updatepassword', compact( 'user' ) );
    }

    public function updatepasswordstore( Request $request ) {

        if ( !( Hash::check( $request->get( 'old-password' ), Auth::user()->password ) ) ) {
            return redirect()->back()->with( 'error', 'Current Password does not match.' );
        }

        if ( $request->get( 'old-password' ) == $request->get( 'password' ) ) {
            return redirect()->back()->with( 'error', 'Current Password and New Password can not be same.' );
        }

        $rules = [
            'old-password' => ['required'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $this->validate( $request, $rules );

        $user = Auth::user();
        $user->password = Hash::make( $request->get( 'password' ) );
        $user->save();
        return redirect( '/profile' . '/' . Auth::user()->slug )->with( 'success', 'Password Changer Successfully.' );
    }

    public function admin( Request $request, $slug ) {
        
        $user = User::where( 'slug', $slug )->first();
        $user->is_admin = '1';
        $user->save();
        return redirect()->route('admin.all-admins')->with( 'success', 'You make ' . $user->name . ' as a Administrator of this website.' );
    }

    public function remove_admin( Request $request, $slug ) {
        
        $user = User::where( 'slug', $slug )->first();
        $user->is_admin = '0';
        $user->save();
        return redirect()->route('admin.all-admins')->with( 'success', 'You remove ' . $user->name . ' from admin panel.' );
    }

    public function destroy( $id ) {
        
        $profile = User::where( 'slug', $id )->firstOrFail();
        $image = $profile->avatar;
        $delete = $profile->delete();
        if ($delete) {
            if($image) {
                unlink( $image );
            }
            return redirect()->back()->with( 'success', 'User blocked Successfully.' );
        }
    }

    public function search(Request $request) {

        $search = $request->get( 'search' );

        if ( $search == '' ) {
            return redirect()->back()->with( 'error', 'Please type something and then search.' );
        } else {
            $result = User::where( 'name', 'like', '%' . $search . '%' )
            ->where( 'is_admin', '0' )
            ->orderBy( 'id', 'desc' )
            ->get();
        }
        $user = User::where( 'is_admin', '0' )->get();
        $admin = User::where( 'is_admin', '1' )->get();
        $story = Story::all();
        $category = Category::all();
        $tag = Tag::all();
        $comment = Comment::all();
        return view( 'admin.search-user', compact( 'user', 'admin', 'result', 'category', 'tag', 'comment', 'story' ) );
    }

    public function create() {
        
        $user = User::where( 'is_admin', '0' )->get();
        $admin = User::where( 'is_admin', '1' )->get();
        $story = Story::all();
        $category = Category::all();
        $tag = Tag::all();
        $comment = Comment::all();
        return view( 'admin.create-admin', compact( 'user', 'admin', 'category', 'tag', 'comment', 'story' ) );
    }

    public function store(Request $request) {
        
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        $this->validate( $request, $rules );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = true;
        $user->slug = Str::slug( $request->name . '-' . time() );
        $user->save();
        return redirect()->route( 'admin.all-admins' )->with( 'success', 'Admin Added successfully.' );
    }
}
