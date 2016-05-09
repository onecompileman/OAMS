<?php

namespace App\Http\Controllers;
use App\mac;
use App\users;
use App\staff;
use Illuminate\Http\Request;
use App\coach;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\athlete;
class login extends Controller
{
    function validateMac(){
        if(!isset($_SESSION))
            session_start();
        if(isset($_SESSION['isLogin']))
            if($_SESSION['isLogin'])
            return redirect()->route('loginAs');
        $Users = new users();
        $Mac = new mac();
        //Mac Address Validation
        ob_start();
        system("ipconfig /all");
        $mycom=ob_get_contents();
        ob_clean();
        $findme = "Physical";
$pmac = strpos($mycom, $findme);
$mac=substr($mycom,($pmac+36),17);

        $con=$Mac->where('mac_name',$mac)->get();
        if(count($con)==0)
            return view('errors.macerr',compact('mac'));
        return view('login');
    }
    function validateCredentials(Request $request){
           $Users = new users();


            $errorss="Wrong Login Credentials";
           $type=$Users->where('username',$request->input('username'))->where('password',$request->input('password'))->get();
           if(count($type)>0){
               if(!isset($_SESSION))
                   session_start();
               ob_start();
               $_SESSION['isLogin']=true;
                $_SESSION['id']=$type[0]->id;
               $_SESSION['type']=$type[0]->type;
               if($_SESSION['type']=='coach') {
                   $Coach = new coach();
                   $user_info = $Coach->where('user_id', '=', $_SESSION['id'])->get();
                   $_SESSION['user_info'] = $user_info[0];
               }
               if($_SESSION['type']=='athlete') {
                   $athlete = new athlete();
                   $user_info = $athlete->where('user_id', '=', $_SESSION['id'])->get();

                   $_SESSION['user_info'] = $user_info[0];
               }
               if($_SESSION['type']=='staff'){
                   $staff = new staff();
                   $user_info = $staff->where('user_id','=',$_SESSION['id'])->get()->except('updated_at','deleted_at','created_at');
                   $_SESSION['user_info'] = $user_info[0];
               }
               return redirect()->route('loginAs');
           }

            return view('login',compact('errorss'));

    }
}
