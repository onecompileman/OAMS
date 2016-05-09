<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\schedule;
use App\users;
use Illuminate\Support\Facades\Validator;

class athlete extends Controller
{
    public $rulesOfProfile=[
        'username'=>'alpha_num|alpha_dash|required|min:4',
        'password'=>'required|min:4',
        'Mac' =>'required|min:5'
    ];
    function viewCalendarSchedule(){
        $schedule= new schedule();
        $view='calendar';
        if(!isset($_SESSION)) session_start();

        $listOfSchedule=$schedule->where('teamType',$_SESSION['user_info']->team_type)->get();
        $pageCount = count($listOfSchedule);
        $noOfUpcoming = count($schedule->where('teamType',$_SESSION['user_info']->team_type)->where('date_of','>',date('Y-m-d'))->get());
        return view('scheduleAthlete',compact('listOfSchedule','pageCount','noOfUpcoming','view'));
    }
    function athleteProfile(){
        $user= new users();
        if(!isset($_SESSION)) session_start();
        $profile=$user->where('id',$_SESSION['id'])->get();
        return view('editAthleteProfile',compact('profile'));
    }
    function updateAthleteProfile(Request $request){
            $validator= Validator::make($request->all(),$this->rulesOfProfile);
            $Error=$validator->errors()->all();
            if($validator->passes()){
                $user= new users();

            }
        else    return view('editAthleteProfile')->with('Error',$Error);
    }
    function viewListSchedule(){

    }
}
