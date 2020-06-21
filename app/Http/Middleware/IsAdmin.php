<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsAdmin {

    public function handle( $request, Closure $next ) {

        if ( Auth::user()->is_admin ) {
            return $next( $request );
        }
        return redirect( '/' );
    }
}
