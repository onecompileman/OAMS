<?php

namespace App\Http\Controllers;

use App\sport;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Sports extends Controller
{
    function view(){
            $Sport= new sport();
            $contents = $Sport->get();
            return view('home',compact('contents'));
    }
}
