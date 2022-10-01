<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Responses\Responses;
use Hash;

class ValidatorChangePasswordFromRequest
{
    public function handle(Request $request, Closure $next)
    {
        $rules = [
            'current_password'    => 'required|min:8|max:50' ,
            'new_password'        => 'required|min:8|max:50' ,
            'retype_new_password' => 'required|min:8|max:50' ,
        ];
        $request->validate($rules);

        // The entered current password does not matches with Auth::user()->password
        if (!( Hash::check($request->current_password, Auth::user()->password) ))
        {
            return Responses::failed('show_change_password_form' , '' , '<b style="color:blue;" >The current password you entered does not matches with your password<br>Try it again</b>' ) ;
        }
        // The entered current password does not match Re-EnterPassword
        if( $request->new_password !== $request->retype_new_password )
        {
            return Responses::failed('show_change_password_form' , '' , '<b style="color:blue;" >Your News Password is NOT EQUAL to Re-Type the New Password <br> Try it again</b>' ) ;
        }

        return $next($request);
    }
}
