<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CabinetController extends Controller
{
    public function index(Request $request): View
    {
        // $request->user() — текущий авторизованный пользователь
        return view('cabinet.index', [
            'user' => $request->user(),
        ]);
    }
}