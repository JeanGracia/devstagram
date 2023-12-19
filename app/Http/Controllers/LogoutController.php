<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psy\TabCompletion\AutoCompleter;

class LogoutController extends Controller
{
    public function store()
    {
        //dd('Cerrando sesión');

        auth()->logout();

        return redirect()->route('login');
    }
}
