<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $contracts = auth()->user()->contracts()->with('partners')->get();
        dump($contracts);
        return view('home', [
            'username' => auth(),
            'contracts' => $contracts
        ]);
    }
}
