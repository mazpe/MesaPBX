<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Request;
use Illuminate\Http\Response;


class AuthController extends Controller {

    public function login() {
        if(Auth::attempt(array('email' => Request::Input('email'),'password' => Request::Input('password')))) {
            return response()->json(Auth::user());
        } else {
            return response()->json(array('flash' => 'Invalid username or password'), 500);
        }
    }

    public function logout() {
        Auth::logout();
        return response()->jason(array('flash' => 'Logged out'));
    }

}
