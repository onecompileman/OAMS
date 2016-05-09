<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class walaAkoMaisip extends Controller
{
    function lipat(){
       if(!isset($_SESSION))
           session_start();

        if(isset($_SESSION['isLogin'])){
            if($_SESSION['type']=='coach')
                return redirect()->route('viewAthlete');
            else if($_SESSION['type']=='athlete')
                return redirect()->route('athleteSchedule');
            else if($_SESSION['type'] == 'staff')
                return redirect()->route('adminHome');
        }
        else abort('401');

    }
    function logout(){
        if(!isset($_SESSION))
            session_start();
            session_destroy();
        return redirect()->route('login');
    }
}
