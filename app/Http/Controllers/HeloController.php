<?php

namespace App\Http\Controllers;


class HeloController extends Controller
{
    public function index(){
        return "Inside Index method";

//        return view('kalai');
    }

    public function helo(){
//        return "Inside helo method";

        return view('kalai');
    }
}
