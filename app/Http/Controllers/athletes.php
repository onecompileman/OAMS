<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\schedule;
use App\users;
use App\athlete;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\mac;

class athletes extends Controller
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
        $user= new users();
        $profile=$user->where('id',$_SESSION['id'])->get();
        if(!isset($_SESSION)) session_start();
        $Error=$validator->errors()->all();
        if($validator->passes() && $request->hasFile('profile_pic')){

            $athlete = new athlete();
            $mac = new mac();
            $user->where('id',$_SESSION['user_info']->user_id)->update($request->except('profile_pic','MAX_FILE_SIZE','Mac'));

            unlink("C:/Users/Stephen/Desktop/Online Athelete Management(DBMS2)/AthleteManagement/public/sys_files/img/profile_pic/user/".$_SESSION['user_info']->user_id.'.jpg');
            $request->file('profile_pic')->move('sys_files/img/profile_pic/user',$_SESSION['user_info']->user_id.'.jpg');
            $Macs = explode(',',$request->input('Mac'));
            $mac->where('user_id',$_SESSION['user_info']->user_id)->delete();
            foreach($Macs as $m) $mac->insert(['user_id'=>$_SESSION['user_info']->user_id,'mac_name'=>$m]);
            $athlete->where('user_id',$_SESSION['user_info']->user_id)->update(['profile_pic'=>$_SESSION['user_info']->user_id.'.jpg']);
            return view('editAthleteProfile',compact('profile'))->with('Added','Updated Successfully!');

        }
        else    return view('editAthleteProfile',compact('profile'))->with('Error',$Error);
    }
    function viewListSchedule($page){

        $schedule = new schedule();

        $listOfSchedule = $schedule->skip($page-1)->take(8)->get();
        $noOfUpcoming = count($schedule->where('date_of','>',date('Y-m-d'))->get());
        $pageCount=count($schedule->get());
        $view='list';
        if(($page-1*8)<=$pageCount)
            return view('scheduleAthlete',compact('listOfSchedule','pageCount','page','noOfUpcoming','view'));
        else
            abort('404');
    }
}
