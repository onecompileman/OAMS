<?php

namespace App\Http\Controllers;

use App\users;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\logreport;
use App\logreportview;
use App\athlete;
use App\coach;
use App\message;
use App\sanctionathletes;
use App\hsvcount;
use App\applicant;
use App\team;
use App\sport;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class admin extends Controller
{
    //rules for Athlete Credentials
    public $athleteCredentialRules=[
      'username'=>'required|alpha_num|min:5|max:255',
      'password'=>'required|min:5|max:255'
    ];
    //rules for athlete
    public $athletesProfileRules=[
            'given_name'=> 'alpha|required|min:3',
            'last_name'=> 'alpha|required|min:2',
             'middle_name'=> 'alpha|required|min:2',
             'contact_number'=>'digits:11|required',
             'birth_place' => 'alpha_num|min:4|required',
             'nationality' => 'alpha_num|min:4|required',
             'home_address'=>'alpha_num|min:4|required',
             'contact_person' => 'alpha_dash|min:5|required',
             'emergency_detailed_address' =>'alpha_num|min:6|required',
             'father_last_name' => 'alpha|required|min:2',
             'father_given_name' => 'alpha|required|min:3',
             'father_middle_name' => 'alpha|required|min:2',
             'father_nickname' => 'alpha|required|min:2',
             'mother_last_name' => 'alpha|required|min:2',
             'mother_given_name' => 'alpha|required|min:3',
             'mother_middle_name' => 'alpha|required|min:2',
             'mother_nickname' => 'alpha|required|min:2',
             'profile_pic' => 'required|image|max:250000',
    ];


    function home(){
        if(!isset($_SESSION)) session_start();
        $messagesInbox = message::where('toU',$_SESSION['user_info']->user_id)->get();
        $messagesOutbox = message::where('fromU',$_SESSION['user_info']->user_id)->get();
        $athleteCount = athlete::count();
        $coachCount = coach::count();
        $sanctionedAthletes = sanctionathletes::count();
        $homeViewCount = (hsvcount::get(['view_count']));
        $homeViewCount = $homeViewCount[0]->view_count;
        $applicantCount = applicant::count();
        return view('staffHome',compact('messagesInbox','messagesOutbox','athleteCount','coachCount','sanctionedAthletes','homeViewCount','applicantCount'));
    }


    function viewAthlete(){
        $athleteLists = athlete::get();
        $sportList = sport::get();
        for($x=0;$x<count($athleteLists);$x++) {
            $team = team::where('id', $athleteLists[$x]->team_id)->get(['team_name']);
            $sanction = (count(sanctionathletes::where('athlete_id', $athleteLists[$x]->id)->get())>0)? "Yes":"No";
            $athleteLists[$x]['teamName'] = $team[0]['team_name'];
            $athleteLists[$x]['sanc'] = $sanction;
        }
        return view('staffviewAthlete',compact('athleteLists','sportList'));
    }


    function viewSpecificAthlete(Request $request){
            $athlete = athlete::where('id',intval($request->input('id')))->get();
        $athlete = $athlete[0];

            echo('
                    <img src="/sys_files/img/profile_pic/user/'.$athlete->profile_pic.'" width="180" height="170" class="img-rounded" style="margin-left: 20px;box-shadow: 0 0 3px 3px rgba(0,0,0,0.3);">
                           <br/>
                           <hr style="border: 2px solid #0b2644;">
                           <input id="playerId" type="hidden" value="'.$request->input('id').'">
                    <h4 id="athleteName"><b>Name:</b>'.$athlete->given_name.' '.$athlete->middle_name.', '.$athlete->last_name.'</h4>
                           <h4 id="athleteStudentID"><b>Student ID:</b>'.$athlete->student_id.'</h4>
                           <h4 id="athleteTeamType"><b>Team Type:</b>'.$athlete->team_type.'</h4>
                           <h4 id="athleteAge"><b>Age:</b>'.date_diff(date_create(strval($athlete->birth_day)),date_create(strval(date('Y-m-d'))))->y.'yrs old </h4>
                           <h4 id="athleteAddress"><b>Address:</b>'.$athlete->address.'</h4>
                           <h4 id="athleteCollege"><b>College:</b>'.$athlete->college_department.'</h4>
                           <h4 id="athleteGender"><b>Gender</b>'.$athlete->gender.'</h4>
                           <h4 id="athleteSince"><b>Playing Status:</b>'.$athlete->playing_status.'</h4>
                           <h4 id="athleteSince"><b>Contact No:</b>'.$athlete->contact_number.'</h4>
                           <h4 id="athleteSince"><b>Athlete Since:</b>'.date_format($athlete->created_at,'Y-m-d').'</h4>
                           <h4 id="athleteUaap"><b>UAAP Playing Years:</b></h4>
                           <h4 id="athleteStats"><b>UAAP Statistics:</b></h4>
            ');
    }


    function deleteAthlete($id){
        $playerName = athlete::where('id',$id)->get();
        unlink(public_path().'\\sys_files\\img\\profile_pic\\athlete\\'.$playerName[0]->profile_pic);
        Session::flash('success','Athlete named: '.$playerName[0]->given_name.' '.$playerName[0]->last_name.' has been successfully deleted!');
        athlete::where('id',$id)->delete();
        users::where('id',$playerName[0]->user_id)->delete();
        return redirect()->back();
    }


    function addAthlete(Request $request){
        $validate = Validator::make($request->all(),$this->athletesProfileRules);
        if($validate->fails()) {
            Session::flash('errors',$validate->errors()->all());
            return redirect()->back()->withInput($request->all());
        }
        Session::put('addAthlete',$request->all());
        return view('adminAthleteUserCredentials');
    }


    function addAthleteForReal(Request $request){
        $validate = Validator::make($request->all(),$this->athleteCredentialRules);
        if($validate->fails()){
            $errors = $validate->errors()->all();
            return redirect()->back()->withInput($request->all())->with('errors',$errors);
        }
        $athleteData = Session::pull('addAthlete');
        $athleteData->file('profile_pic')->move('sys_files/img/profile_pic/athlete',(athlete::count()+1).'.jpg');
        $athleteData->profile_pic = (athlete::count()+1).'.jpg';
        athlete::insert($athleteData);
        $athleteCred = $request->except(['Mac']);
        $athleteCred['type'] = 'athlete';
        users::insert($athleteCred);
        Session::flash('add',$athleteData->given_name.' '.$athleteData->last_name.' has been successfully added as athlete!');
        return redirect()->route('adminviewAthlete');
    }


    function viewAddAthlete(){
        $ListOfSport = sport::get();
        return view('adminAddAthlete',compact('ListOfSport'));
    }


    function addAthlete2(){
            return view('adminAthleteUserCredentials');
    }
}
