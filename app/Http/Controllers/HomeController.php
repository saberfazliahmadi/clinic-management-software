<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('back.home',
        [
            'title_of_page' => __('general.Welcome to MatabeOnline Clinic Management Software')
        ] ) ;
    }
}
