<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller {
    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store( Request $request ) {
        //
    }

    public function show( $id ) {

        $user = User::findOrFail( $id );
        return view( 'profile.editinfo' );
    }

    public function updateinfo( Request $request ) {
        
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'string', 'min:6', 'max:25'],
            'phone' => ['required', 'string', 'min:10', 'max:25'],
            'gender' => ['required', 'string', 'max:10'],
        ];

        $this->validate( $request, $rules );

        $user = Auth::user();
        $user->name = $request->get( 'name' ) ;
        $user->dob = $request->get( 'dob' ) ;
        $user->phone = $request->get( 'phone' ) ;
        $user->gender = $request->get( 'gender' ) ;
        $user->save();
        return redirect()->route( 'home' )->with( 'success', 'Profile Updated Successfully.' );
    }

    public function edit_pro_pic( $id ) {

        $user = User::findOrFail( $id );
        return view( 'profile.editprofilepic' );
    }

    public function update_pro_pic( Request $request ) {
        
        $rules = [
            'avatar' => ['required', 'image', 'max:2000'],
        ];

        $this->validate( $request, $rules );

        $oldpicture = Auth::user()->avatar;

        $image = $request->file('avatar');
        $imageName = 'p_picture-' . time() . Str::random(10);
        $extension = strtolower($image->getClientOriginalExtension());
        $imageFullName = $imageName. '.' .$extension;
        $uploadPath = 'img/profile-pic/';
        $imageURL = $uploadPath . $imageFullName;
        $success = $image->move($uploadPath, $imageFullName);


        $user = Auth::user();
        $user->avatar = $imageURL;
        $user->save();
        unlink($oldpicture);
        return redirect()->route( 'home' )->with( 'success', 'Profile Picture Updated Successfully.' );
    }

    public function updatepassword( $id ) {

        $user = User::findOrFail( $id );
        return view( 'profile.updatepassword' );
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
        return redirect()->route( 'home' )->with( 'success', 'Password Changer Successfully.' );
    }

    public function destroy( $id ) {
        //
    }
}
