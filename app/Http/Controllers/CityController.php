<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Http\RedirectResponse;

class CityController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
        ]);

        session(['city_id' => $request->city_id]);
        return back();
    }

    public function clear(): RedirectResponse
    {
        session()->forget('city_id');
        return back();
    }
}
