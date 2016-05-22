<?php

namespace App\Http\Controllers;
use App\faq;
use App\blog;
use App\contactmessage;
use App\users;
use App\gameschedule;
use App\gamevenue;
use App\gameresult;
use Illuminate\Http\Request;
use App\dateplan;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\logreport;
use App\logreportview;
use App\athlete;
use App\coach;
use App\message;
use App\sanctionathletes;
use Illuminate\Support\Facades\Storage;
use App\hsvcount;
use App\applicant;
use App\team;
use App\sport;
use App\staff;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Events\EventExecuted;
use App\trainingvenue;
use App\uaapgameschedule;
use App\athleteattendance;
use App\trainingschedule;
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
            /* 'contact_number'=>'digits:11|required',
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
             'profile_pic' => 'required|image|max:250000',*/
    ];


    function home(){
        $messagecount = $this->navData();
        if(!isset($_SESSION)) session_start();
        $messagesInbox = message::where('toU',$_SESSION['user_info']->user_id)->get();
        $messagesOutbox = message::where('fromU',$_SESSION['user_info']->user_id)->get();
        $athleteCount = athlete::count();
        $coachCount = coach::count();
        $sanctionedAthletes = sanctionathletes::count();
        $homeViewCount = (hsvcount::get(['view_count']));
        $homeViewCount = $homeViewCount[0]->view_count;
        $applicantCount = applicant::count();
        return view('staffHome',compact('messagesInbox','messagesOutbox','athleteCount','coachCount','sanctionedAthletes','homeViewCount','applicantCount','messagecount'));
    }


    function viewAthlete(){
        $messagecount = $this->navData();
        $athleteLists = athlete::get();
        $sportList = sport::get();
        for($x=0;$x<count($athleteLists);$x++) {
            $team = team::where('id', $athleteLists[$x]->team_id)->get(['team_name']);
            $sanction = (count(sanctionathletes::where('athlete_id', $athleteLists[$x]->id)->get())>0)? "Yes":"No";
            $athleteLists[$x]['teamName'] = $team[0]['team_name'];
            $athleteLists[$x]['sanc'] = $sanction;
        }
        return view('staffviewAthlete',compact('athleteLists','sportList','messagecount'));
    }

    function viewTraining(){
        $venueList = trainingvenue::get();
        $messagecount = $this->navData();
        return view('adminTrainingVenue',compact('venueList','messagecount'));
    }

    function ajaxAddTraining(Request $request){
        trainingvenue::insert($request->input('data'));
        $out = "Venue ".$request->input('data')['venue_name'].' added successfully to the venue list';
        $out.= "separate";
        foreach((trainingvenue::get()) as $venue)
            $out.=$venue->venue_name.'*'.$venue->playerLimit.'/';
        echo($out);
    }

    function addTraining(Request $request){
        $data= $request->all();
        $data['created_at'] = date('Y-m-d');
        trainingvenue::insert($data);
        Session::flash('success','Sucessfully added '.$request->input('venue_name').' to the venue list');
        return redirect()->back();
    }

    function updateTraining(Request $request){
        $data= $request->except('id');
        $data['updated_at'] = date('Y-m-d');
        trainingvenue::where('id',$request->input('id'))->update($data);
        Session::flash('success','Sucessfully updated '.$request->input('venue_name').' to the venue list');
        return redirect()->back();
    }

    function getSchedule(Request $request){
        $out = '<table id="sch" class="table table-hover" cellspacing="0" width="100%"><thead><th><center>Team</center></th><th><center>Day(s)</center></th><th><center>Time</center></th><th><center>Venue</center></th></thead><tbody>';
        $count = uaapgameschedule::where('t_id',intval($request->input('id')))->whereNotNull('days')->count();
        $sched = uaapgameschedule::where('t_id',intval($request->input('id')))->get();
        for($x=0;$x<count($sched);$x++){
            $team = team::where('id',$sched[$x]->team_id)->get();
            if($sched[$x]->venue_id != null)
            $venue = trainingvenue::where('id',$sched[$x]->venue_id)->get();
            if($sched[$x]->days != null) {
                $day = str_replace('  ', '-', trim(strtoupper($sched[$x]->days)));
                if ($day == "S-M-T-W-TH-F-ST") $day = "Everyday";
            }
            $out.='<tr><td>'.$team[0]->team_name.'</td>';
            if($sched[$x]->days == null)
                $out.='<td colspan="3">Schedule havent set yet...</td></tr>';
            else
                $out.='<td>'.$day.'</td><td>'.date_format(date_create($sched[$x]->timeRangeFrom),'h:i A').'-'.date_format(date_create($sched[$x]->timeRangeTo),'h:i A').'</td><td>'.$venue[0]->venue_name.'</td></tr>';
        }
        $out.='</tbody></table>separate'.$count;
        echo($out);
    }

    function addDatePlan(Request $request){
        $schedule = uaapgameschedule::where('t_id',$request->input('id'))->whereNotNull('days')->get();
        $sched = trainingschedule::where('id',$request->input('id'))->get();
        $startDate = date_create(strval(date('Y-m-d')));
        $endDate = date_format(date_create($sched[0]->endDate),'Y-m-d');
        while($startDate!=$endDate) {
            foreach ($schedule as $s) {
                $dd = $s->days;
                $dd = str_replace('s ',' Sunday, ',$dd);
                $dd = str_replace('m ',' Monday, ',$dd);
                $dd = str_replace('t ',' Tuesday, ',$dd);
                $dd = str_replace('w ',' Wednesday, ',$dd);
                $dd = str_replace('th ',' Thursday, ',$dd);
                $dd = str_replace('f ',' Friday, ',$dd);
                $dd = str_replace('st ',' Saturday, ',$dd);
                if(strpos($dd,date_format($startDate,'l'))){
                    dateplan::insert(['dates'=>$startDate,'t_id',$request->input('id'),$s->team_id]);
                }
            }
            date_add($startDate,date_interval_create_from_date_string('1 days'));
        }
        Session::flash('success','Date plan successfully published!');
        return redirect()->back();
    }

    function viewTrainingSchedule(){
        $messagecount = $this->navData();
        $schedule = trainingschedule::get();
        $teamList = team::get();
        return view('adminTrainingSchedule',compact('messagecount','schedule','teamList'));
    }

    function printSchedule($id){
        $schedule = trainingschedule::where('id',$id)->get();
        $sched = uaapgameschedule::where('t_id',$id)->get();
        for($x=0;$x<count($sched);$x++){
            $team = team::where('id',$sched[$x]->team_id)->get();
            $venue = trainingvenue::where('id',$sched[$x]->venue_id)->get();
            $day = str_replace('  ','-',trim(strtoupper($sched[$x]->days)));
            if($day == "S-M-T-W-TH-F-ST") $day="Everyday";
            $sched[$x]['day'] = $day;
            $sched[$x]['team_name'] = $team[0]->team_name;
            if(count($venue))
            $sched[$x]['venue_name'] = $venue[0]->venue_name;
        }
        return view('adminPrintSchedulePlan',compact('schedule','sched'));
    }

    function viewTimeTable($id){
        $messagecount = $this->navData();
        $venueList = trainingvenue::get();
        $sch = trainingschedule::where('id',$id)->get();
        $schedule = uaapgameschedule::where('t_id',$id)->whereNotNull('days')->get();
        if(count($schedule) > 0){
            for($x=0;$x<count($schedule);$x++){
            $team = team::where('id',$schedule[$x]->team_id)->get();
                $venue = trainingvenue::where('id',$schedule[$x]->venue_id)->get();
                $schedule[$x]['team_name']=$team[0]->team_name;
                $schedule[$x]['venue_name']=$venue[0]->venue_name;
                }
        }
        return view('adminSchedulePlanTimeTable',compact('schedule','messagecount','venueList','sch'));
    }

    function updateTrainingSchedule(Request $request){
        $msg = $this->intersectsSchedulePlan($request->input('data'));
        if($msg != 'ok') {
            echo($msg);
        }
        else{
            uaapgameschedule::where('t_id', $request->input('data')['t_id'])->where('team_id', $request->input('data')['team_id'])->update($request->input('data'));
            $team = team::where('id',$request->input('data')['team_id'])->get();
            $scheds = trainingschedule::where('id',$request->input('data')['t_id'])->get();
            $success = ('Successfully updated team '.$team[0]->team_name.' season '.$scheds[0]->season.' schedule');
            $sched = uaapgameschedule::where('t_id', $request->input('data')['t_id'])->where('team_id', $request->input('data')['team_id'])->get();
            $venueList = trainingvenue::get();
            $venue = '';
            $sets ='';
            $ven = '';
            foreach($venueList as $v)
                $ven .= '<h1>'.intval($v->playerLimit).'</h1>';
            foreach(team::get() as $tt){
                if(count(uaapgameschedule::where('t_id',$request->input('data')['t_id'])->where('team_id',$tt->id)->get()) > 0)
                    $sets.= '<h1>Yes</h1>';
                else $sets.= '<h1>No</h1>';
            }

            $maxcount = athlete::where('team_id',$request->input('data')['t_id'])->count();
            $teamA = athlete::where('team_type','Team A')->where('team_id',$request->input('data')['t_id'])->count();
            $teamB = athlete::where('team_type','Team B')->where('team_id',$request->input('data')['t_id'])->count();
            if(count($sched) > 0) {
                foreach($venueList as $v){
                    if($v->id == $sched[0]->venue_id)
                        $venue.='<option value="'.$v->id.'" selected>'.$v->venue_name.'</option>';
                    else
                        $venue.='<option value="'.$v->id.'">'.$v->venue_name.'</option>';
                }

                $dayss = '';
                if ($sched[0]->days == ' s  m  t  w  th  f  st ') {

                    $dayss = "Everyday";
                }else{
                    $dd = $sched[0]->days;
                    $dd = str_replace('s ','Sunday, ',$dd);
                    $dd = str_replace('m ','Monday, ',$dd);
                    $dd = str_replace('t ','Tuesday, ',$dd);
                    $dd = str_replace('w ','Wednesday, ',$dd);
                    $dd = str_replace('th ','Thursday, ',$dd);
                    $dd = str_replace('f ','Friday, ',$dd);
                    $dd = str_replace('st ','Saturday, ',$dd);
                    $dayss = $dd;
                }
                $vv = trainingvenue::where('id',$sched[0]->id)->get();
                $teams = '';
                if($sched[0]->team_type == "both") $teams = '<option value="both" selected>Team A and B</option><option value="Team A">Team A</option><option value="Team B">Team B</option>';
                elseif($sched[0]->team_type == "Team A") $teams = '<option value="both">Team A and B</option><option value="Team A" selected>Team A</option><option value="Team B">Team B</option>';
                elseif($sched[0]->team_type == "Team B") $teams = '<option value="both">Team A and B</option><option value="Team A">Team A</option><option value="Team B" selected>Team B</option>';
                echo('<center><h4><b><span class="glyphicon glyphicon-calendar"></span></b>&nbsp; T R A I N I N G &nbsp; S C H E D U L
                                                                                                  E&nbsp; <div class="btn btn-info" id="toggEdit" title="Edit Schedule"><b><span class="glyphicon glyphicon-edit" onclick="togg()"></span></b>&nbsp;</div><div title="View Schedule" class="btn btn-info" id="toggView" onclick="togg()" onload="$(this).toggle()" style="display: none;"><b><span class="glyphicon glyphicon-eye-open"></span></b>&nbsp;</div></h4></center>
                                                                                    <hr style="border:2px solid white;box-shadow: 0 0 1px 1px rgba(0,0,0,0.1);"/>
                                                                                    <br/><br/>
<div class="row" id="trainDet">

                                                                                    <div class="row">

                                                                                       <div class="col-sm-6 col-sm-offset-1">
                                                                                           <h4><b>Venue:</b>&nbsp;<u>'.$vv[0]->venue_name.'</u></h4>
                                                                                           </div> <div class="col-sm-4 col-sm-offset-1">
                                                                                               <h4><b>Team Type:</b>&nbsp;<u>'.$sched[0]->team_type.'</u></h4>
                                                                                               </div><div class="col-sm-2"></div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                           <hr/>
                                                                                           <div class="col-sm-11 col-sm-offset-1"><h4><b>Days:</b> <u>&nbsp;'.$dayss.'</u></h4></div>
                                                                                            <br/>
                                                                                        <br/>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                            <hr />
                                                                                            <div class="col-sm-4 col-sm-offset-1">
                                                                                            <h4><label for="tf"  style="display: inline;">Start Time: </label><u>'.date_format(date_create($sched[0]->timeRangeFrom),'h:i A').'</h4></u>
                                </div>
                               <div class="col-sm-4 col-sm-offset-1">
                             <h4> <label for="tt" style="display: inline;">End Time: </label><u>'.date_format(date_create($sched[0]->timeRangeTo),'h:i A').'</u></h4>
                                   <br/>
                               <br/>
                                 </div></div></div>
<form class="form-group" action="" method="post" name="trainingSched" id="trainingSched" style="display:none;" onload="$(this).toggle()">

                                                                                    <div class="row">

                                                                                       <div class="col-sm-1 col-sm-offset-1">
                                                                                           <h5><b>Venue:</b></h5>
                                                                                           </div> <div class="col-sm-4"><select class="form-control" name="venue_id" id="venue" onchange="venueC()">' . $venue . '</select><a href="#" data-toggle="modal" data-target="#venues"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Add new Venue</a></div><div class="col-sm-2">
                                                                                               <h5><b>Team Type:</b></h5>
                                                                                               </div><div class="col-sm-3"><select class="form-control" name="team_type" id="team_type" onchange="change()" >'.$teams.'</select></div>
                                                                                    </div>
                                                                                     <div class="row">
                                                                                        <div class="col-sm-offset-3" id="playerLimit" style="color:#828282;position:relative;display:inline;margin-left:25%;">'.$venueList[0]->playerLimit.'  available players </div>
                                                                                        <div class="col-sm-2" id="playerSize" style="color:#828282;position:relative;display:inline;margin-left:25%;">'.$maxcount.'  players</div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                           <br/><br/><br/>
                                                                                        <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                        <div class="row">
                                          <center><h4><b><span class="glyphicon glyphicon-cloud" style="color: #3498db;"></span>&nbsp; Days of Effect</b></h4></center>
                                                                                           <hr/>
                                                                                           <center>
                                                                                           <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="s " '.((strpos($sched[0]->days,'s '))? "checked":"").' id="sun" name="days" />
                                        Sunday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" value="m " '.((strpos($sched[0]->days,'m '))? "checked":"").' id="mon" name="days" />
                                        Monday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="t " '.((strpos($sched[0]->days,'t '))? "checked":"").' id="tue" name="days" />
                                        Tuesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="w " '.((strpos($sched[0]->days,'w '))? "checked":"").' id="wed" name="days"/>
                                        Wednesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="th " '.((strpos($sched[0]->days,'th '))? "checked":"").' id="thur" name="days"/>
                                        Thursday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" value="f " '.((strpos($sched[0]->days,'f '))? "checked":"").' id="fri" name="days" />
                                        Friday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="st " '.((strpos($sched[0]->days,'st '))? "checked":"").' id="sat" name="days"/>
                                        Saturday</div>
                                                                                            </center>
                                                                                            <br/>
                                                                                        </div>
                                                                                        <br/>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                    <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                    <div class="row">
                                                                                        <center>
                                                                                            <h4><b><span class="glyphicon glyphicon-time" style="color:#3498db;"></span>&nbsp;Time Range</b></h4>
                                                                                            </center>
                                                                                            <hr />
                                                                                            <div class="col-sm-4">
                                                                                            <label for="tf"  style="display: inline;">From: </label>
                                <input class="form-control" name="timeRangeFrom" type="time" id="tf" style="display: inline;" value="'.$sched[0]->timeRangeFrom.'"/>
                                </div>
                               <div class="col-sm-4 col-sm-offset-1">
                              <label for="tt" style="display: inline;">To: </label>
                              <input class="form-control" name="timeRangeTo" type="time" id="tt" style="display: inline;" value="'.$sched[0]->timeRangeTo.'"/>
                                      </div>
                                   <br/>
                                </div>
                               <br/>
                                 </div></div></div>
                                  <br/>
                              <button class="btn btn-danger" style="margin-left: 35%;" id="deleteT"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete</button>
                                  <div class="btn btn-info" style="margin-left: 8%;" id="updateT" onclick="updateSched()"><b><span class="glyphicon glyphicon-send"></span></b>&nbsp; Update Schedule</div>
                                                                        <div id="not" style="display: none;">'.$sets.'</div>
                                                                                                            <div id="count" style="display:none;"><h1>'.$maxcount.'</h1><h1>'.$teamA.'</h1><h1>'.$teamB.'</h1></div>
<div id="vcount" style="display:none;">'.$ven.'</div>
                                 </form>
                                 separate
                                 '.$success.'
                                 ');
            }
            else{
                foreach($venueList as $v){
                    $venue.='<option value="'.$v->id.'">'.$v->venue_name.'</option>';
                }
                echo('       <form class="form-group" action="" method="post" name="trainingSched">


                                                                                <div class="row">
                                                                                    <center><h4><b><span class="glyphicon glyphicon-calendar"></span></b>&nbsp; T R A I N I N G &nbsp; S C H E D U L
                                        E</h4></center>
                                                                                    <hr style="border:2px solid white;box-shadow: 0 0 1px 1px rgba(0,0,0,0.1);"/>
                                                                                    <br/><br/>
                                                                                    <div class="row">

                                                                                       <div class="col-sm-1 col-sm-offset-1">
                                                                                           <h5><b>Venue:</b></h5>
                                                                                           </div> <div class="col-sm-4"><select class="form-control" name="venue_id" id="venue" onchange="venueC()">'.$venue.'</select><a href="#" data-toggle="modal" data-target="#venues"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Add new Venue</a></div><div class="col-sm-2">
                                                                                               <h5><b>Team Type:</b></h5>
                                                                                               </div><div class="col-sm-3"><select class="form-control" name="team_type" id="team_type" onchange="change()"><option value="both">Team A and B</option><option value="Team A">Team A</option><option value="Team B">Team B</option></select></div>
                                                                                    </div>
                                                                                     <div class="row">
                                                                                        <div class="col-sm-offset-3" id="playerLimit" style="color:#828282;position:relative;display:inline;margin-left:25%;">'.$venueList[0]->playerLimit.'  available players</div>
                                                                                        <div class="col-sm-2" id="playerSize" style="color:#828282;position:relative;display:inline;margin-left:25%;">'.$maxcount.'  players</div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                           <br/><br/><br/>
                                                                                        <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                        <div class="row">
                                          <center><h4><b><span class="glyphicon glyphicon-cloud" style="color: #3498db;"></span>&nbsp; Days of Effect</b></h4></center>
                                                                                           <hr/>
                                                                                           <center>
                                                                                           <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="s " id="sun" name="days" />
                                        Sunday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" value="m " id="mon" name="days" />
                                        Monday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="t " id="tue" name="days" />
                                        Tuesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="w " id="wed" name="days"/>
                                        Wednesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="th " id="thur" name="days"/>
                                        Thursday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" value="f " id="fri" name="days" />
                                        Friday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="st " id="sat" name="days"/>
                                        Saturday</div>
                                                                                            </center>
                                                                                            <br/>
                                                                                        </div>
                                                                                        <br/>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                    <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                    <div class="row">
                                                                                        <center>
                                                                                            <h4><b><span class="glyphicon glyphicon-time" style="color:#3498db;"></span>&nbsp;Time Range</b></h4>
                                                                                            </center>
                                                                                            <hr />
                                                                                            <div class="col-sm-4">
                                                                                            <label for="tf"  style="display: inline;">From: </label>
                                <input class="form-control" name="timeRangeFrom" type="time" id="tf" style="display: inline;"/>
                                </div>
                               <div class="col-sm-4 col-sm-offset-1">
                              <label for="tt" style="display: inline;">To: </label>
                              <input class="form-control" name="timeRangeTo" type="time" id="tt" style="display: inline;"/>
                                      </div>
                                   <br/>
                                </div>
                               <br/>
                                 </div></div></div>
                                  <br/>
                              <button type="reset" class="btn btn-warning" style="margin-left: 35%;" ><b><span class="glyphicon glyphicon-repeat"></span></b>&nbsp; Reset</button>
                                  <div class="btn btn-info" style="margin-left: 8%;" id="setSchedule" onclick="setSched()"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Set Schedule</div>
                                    <div id="not" style="display: none;">'.$sets.'</div>
                                                                                                            <div id="count" style="display:none;"><h1>'.$maxcount.'</h1><h1>'.$teamA.'</h1><h1>'.$teamB.'</h1></div>
<div id="vcount" style="display:none;">'.$ven.'</div>
                                 </form>
                                 separate'.$success.'

                                 ');}
        }

    }
    function addTrainingSchedule(Request $request)
    {
        $msg = $this->intersectsSchedulePlan($request->input('data'));
        if($msg != 'ok') {
            echo($msg);
        }
        else {
            uaapgameschedule::where('t_id', $request->input('data')['t_id'])->where('team_id', $request->input('data')['team_id'])->update($request->input('data'));
            $team = team::where('id', $request->input('data')['team_id'])->get();
            $scheds = trainingschedule::where('id', $request->input('data')['t_id'])->get();
            $success = ('Successfully updated team ' . $team[0]->team_name . ' season ' . $scheds[0]->season . ' schedule');

            $sched = uaapgameschedule::where('t_id', $request->input('data')['t_id'])->where('team_id', $request->input('data')['team_id'])->get();
            $venueList = trainingvenue::get();
            $venue = '';
            $sets = '';
            $ven='';
            foreach($venueList as $v)
                $ven .= '<h1>'.intval($v->playerLimit).'</h1>';
            foreach (team::get() as $tt) {
                if (count(uaapgameschedule::where('t_id', $request->input('data')['t_id'])->where('team_id', $tt->id)->get()) > 0)
                    $sets .= '<h1>Yes</h1>';
                else $sets .= '<h1>No</h1>';
            }

            $maxcount = athlete::where('team_id', $request->input('data')['t_id'])->count();
            $teamA = athlete::where('team_type', 'Team A')->where('team_id', $request->input('data')['t_id'])->count();
            $teamB = athlete::where('team_type', 'Team B')->where('team_id', $request->input('data')['t_id'])->count();
            if (count($sched) > 0) {
                foreach ($venueList as $v) {
                    if ($v->id == $sched[0]->venue_id)
                        $venue .= '<option value="' . $v->id . '" selected>' . $v->venue_name . '</option>';
                    else
                        $venue .= '<option value="' . $v->id . '">' . $v->venue_name . '</option>';
                }
                $ven = '';
                $dayss = '';
                if ($sched[0]->days == ' s  m  t  w  th  f  st ') {
                    $dayss = "Everyday";
                } else {
                    $dd = $sched[0]->days;
                    $dd = str_replace('s ', 'Sunday, ', $dd);
                    $dd = str_replace('m ', 'Monday, ', $dd);
                    $dd = str_replace('t ', 'Tuesday, ', $dd);
                    $dd = str_replace('w ', 'Wednesday, ', $dd);
                    $dd = str_replace('th ', 'Thursday, ', $dd);
                    $dd = str_replace('f ', 'Friday, ', $dd);
                    $dd = str_replace('st ', 'Saturday, ', $dd);
                    $dayss = $dd;
                }
                $vv = trainingvenue::where('id', $sched[0]->id)->get();
                $teams = '';
                if ($sched[0]->team_type == "both") $teams = '<option value="both" selected>Team A and B</option><option value="Team A">Team A</option><option value="Team B">Team B</option>';
                elseif ($sched[0]->team_type == "Team A") $teams = '<option value="both">Team A and B</option><option value="Team A" selected>Team A</option><option value="Team B">Team B</option>';
                elseif ($sched[0]->team_type == "Team B") $teams = '<option value="both">Team A and B</option><option value="Team A">Team A</option><option value="Team B" selected>Team B</option>';
                echo('<center><h4><b><span class="glyphicon glyphicon-calendar"></span></b>&nbsp; T R A I N I N G &nbsp; S C H E D U L
                                                                                                  E&nbsp; <div class="btn btn-info" id="toggEdit" title="Edit Schedule"><b><span class="glyphicon glyphicon-edit" onclick="togg()"></span></b>&nbsp;</div><div title="View Schedule" class="btn btn-info" id="toggView" onclick="togg()" onload="$(this).toggle()" style="display: none;"><b><span class="glyphicon glyphicon-eye-open"></span></b>&nbsp;</div></h4></center>
                                                                                    <hr style="border:2px solid white;box-shadow: 0 0 1px 1px rgba(0,0,0,0.1);"/>
                                                                                    <br/><br/>
<div class="row" id="trainDet">

                                                                                    <div class="row">

                                                                                       <div class="col-sm-6 col-sm-offset-1">
                                                                                           <h4><b>Venue:</b>&nbsp;<u>' . $vv[0]->venue_name . '</u></h4>
                                                                                           </div> <div class="col-sm-4 col-sm-offset-1">
                                                                                               <h4><b>Team Type:</b>&nbsp;<u>' . $sched[0]->team_type . '</u></h4>
                                                                                               </div><div class="col-sm-2"></div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                           <hr/>
                                                                                           <div class="col-sm-11 col-sm-offset-1"><h4><b>Days:</b> <u>&nbsp;' . $dayss . '</u></h4></div>
                                                                                            <br/>
                                                                                        <br/>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                            <hr />
                                                                                            <div class="col-sm-4 col-sm-offset-1">
                                                                                            <h4><label for="tf"  style="display: inline;">Start Time: </label><u>' . date_format(date_create($sched[0]->timeRangeFrom), 'h:i A') . '</h4></u>
                                </div>
                               <div class="col-sm-4 col-sm-offset-1">
                             <h4> <label for="tt" style="display: inline;">End Time: </label><u>' . date_format(date_create($sched[0]->timeRangeTo), 'h:i A') . '</u></h4>
                                   <br/>
                               <br/>
                                 </div></div></div>
<form class="form-group" action="" method="post" name="trainingSched" id="trainingSched" style="display:none;" onload="$(this).toggle()">

                                                                                    <div class="row">

                                                                                       <div class="col-sm-1 col-sm-offset-1">
                                                                                           <h5><b>Venue:</b></h5>
                                                                                           </div> <div class="col-sm-4"><select class="form-control" name="venue_id" id="venue" onchange="venueC()">' . $venue . '</select><a href="#" data-toggle="modal" data-target="#venues"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Add new Venue</a></div><div class="col-sm-2">
                                                                                               <h5><b>Team Type:</b></h5>
                                                                                               </div><div class="col-sm-3"><select class="form-control" name="team_type" id="team_type" onchange="change()" >' . $teams . '</select></div>
                                                                                    </div>
                                                                                     <div class="row">
                                                                                        <div class="col-sm-offset-3" id="playerLimit" style="color:#828282;position:relative;display:inline;margin-left:25%;">' . $venueList[0]->playerLimit . '  available players </div>
                                                                                        <div class="col-sm-2" id="playerSize" style="color:#828282;position:relative;display:inline;margin-left:25%;">' . $maxcount . '  players</div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                           <br/><br/><br/>
                                                                                        <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                        <div class="row">
                                          <center><h4><b><span class="glyphicon glyphicon-cloud" style="color: #3498db;"></span>&nbsp; Days of Effect</b></h4></center>
                                                                                           <hr/>
                                                                                           <center>
                                                                                           <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="s " ' . ((strpos($sched[0]->days, 's ')) ? "checked" : "") . ' id="sun" name="days" />
                                        Sunday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" value="m " ' . ((strpos($sched[0]->days, 'm ')) ? "checked" : "") . ' id="mon" name="days" />
                                        Monday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="t " ' . ((strpos($sched[0]->days, 't ')) ? "checked" : "") . ' id="tue" name="days" />
                                        Tuesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="w " ' . ((strpos($sched[0]->days, 'w ')) ? "checked" : "") . ' id="wed" name="days"/>
                                        Wednesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="th " ' . ((strpos($sched[0]->days, 'th ')) ? "checked" : "") . ' id="thur" name="days"/>
                                        Thursday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" value="f " ' . ((strpos($sched[0]->days, 'f ')) ? "checked" : "") . ' id="fri" name="days" />
                                        Friday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="st " ' . ((strpos($sched[0]->days, 'st ')) ? "checked" : "") . ' id="sat" name="days"/>
                                        Saturday</div>
                                                                                            </center>
                                                                                            <br/>
                                                                                        </div>
                                                                                        <br/>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                    <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                    <div class="row">
                                                                                        <center>
                                                                                            <h4><b><span class="glyphicon glyphicon-time" style="color:#3498db;"></span>&nbsp;Time Range</b></h4>
                                                                                            </center>
                                                                                            <hr />
                                                                                            <div class="col-sm-4">
                                                                                            <label for="tf"  style="display: inline;">From: </label>
                                <input class="form-control" name="timeRangeFrom" type="time" id="tf" style="display: inline;" value="' . ($sched[0]->timeRangeFrom) . '"/>
                                </div>
                               <div class="col-sm-4 col-sm-offset-1">
                              <label for="tt" style="display: inline;">To: </label>
                              <input class="form-control" name="timeRangeTo" type="time" id="tt" style="display: inline;" value="' . $sched[0]->timeRangeTo. '"/>
                                      </div>
                                   <br/>
                                </div>
                               <br/>
                                 </div></div></div>
                                  <br/>
                              <button class="btn btn-danger" style="margin-left: 35%;" id="deleteT"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete</button>
                                  <div class="btn btn-info" style="margin-left: 8%;" id="updateT" onclick="updateSched()"><b><span class="glyphicon glyphicon-send"></span></b>&nbsp; Update Schedule</div>
                                                                        <div id="not" style="display: none;">' . $sets . '</div>
                                                                                                            <div id="count" style="display:none;"><h1>' . $maxcount . '</h1><h1>' . $teamA . '</h1><h1>' . $teamB . '</h1></div>
<div id="vcount" style="display:none;">'.$ven.'</div>
                                 </form>
                                 separate
                                 '.$success.'
                                 ');
            } else {
                foreach ($venueList as $v) {
                    $venue .= '<option value="' . $v->id . '">' . $v->venue_name . '</option>';
                }
                echo('       <form class="form-group" action="" method="post" name="trainingSched">


                                                                                <div class="row">
                                                                                    <center><h4><b><span class="glyphicon glyphicon-calendar"></span></b>&nbsp; T R A I N I N G &nbsp; S C H E D U L
                                        E</h4></center>
                                                                                    <hr style="border:2px solid white;box-shadow: 0 0 1px 1px rgba(0,0,0,0.1);"/>
                                                                                    <br/><br/>
                                                                                    <div class="row">

                                                                                       <div class="col-sm-1 col-sm-offset-1">
                                                                                           <h5><b>Venue:</b></h5>
                                                                                           </div> <div class="col-sm-4"><select class="form-control" name="venue_id" id="venue" onchange="venueC()">' . $venue . '</select><a href="#" data-toggle="modal" data-target="#venues"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Add new Venue</a></div><div class="col-sm-2">
                                                                                               <h5><b>Team Type:</b></h5>
                                                                                               </div><div class="col-sm-3"><select class="form-control" name="team_type" id="team_type" onchange="change()"><option value="both">Team A and B</option><option value="Team A">Team A</option><option value="Team B">Team B</option></select></div>
                                                                                    </div>
                                                                                     <div class="row">
                                                                                        <div class="col-sm-offset-3" id="playerLimit" style="color:#828282;position:relative;display:inline;margin-left:25%;">' . $venueList[0]->playerLimit . '  available players</div>
                                                                                        <div class="col-sm-2" id="playerSize" style="color:#828282;position:relative;display:inline;margin-left:25%;">' . $maxcount . '  players</div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                           <br/><br/><br/>
                                                                                        <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                        <div class="row">
                                          <center><h4><b><span class="glyphicon glyphicon-cloud" style="color: #3498db;"></span>&nbsp; Days of Effect</b></h4></center>
                                                                                           <hr/>
                                                                                           <center>
                                                                                           <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="s " id="sun" name="days" />
                                        Sunday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" value="m " id="mon" name="days" />
                                        Monday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="t " id="tue" name="days" />
                                        Tuesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="w " id="wed" name="days"/>
                                        Wednesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="th " id="thur" name="days"/>
                                        Thursday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" value="f " id="fri" name="days" />
                                        Friday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="st " id="sat" name="days"/>
                                        Saturday</div>
                                                                                            </center>
                                                                                            <br/>
                                                                                        </div>
                                                                                        <br/>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                    <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                    <div class="row">
                                                                                        <center>
                                                                                            <h4><b><span class="glyphicon glyphicon-time" style="color:#3498db;"></span>&nbsp;Time Range</b></h4>
                                                                                            </center>
                                                                                            <hr />
                                                                                            <div class="col-sm-4">
                                                                                            <label for="tf"  style="display: inline;">From: </label>
                                <input class="form-control" name="timeRangeFrom" type="time" id="tf" style="display: inline;"/>
                                </div>
                               <div class="col-sm-4 col-sm-offset-1">
                              <label for="tt" style="display: inline;">To: </label>
                              <input class="form-control" name="timeRangeTo" type="time" id="tt" style="display: inline;"/>
                                      </div>
                                   <br/>
                                </div>
                               <br/>
                                 </div></div></div>
                                  <br/>
                              <button type="reset" class="btn btn-warning" style="margin-left: 35%;" ><b><span class="glyphicon glyphicon-repeat"></span></b>&nbsp; Reset</button>
                                  <div class="btn btn-info" style="margin-left: 8%;" id="setSchedule" onclick="setSched()"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Set Schedule</div>
                                    <div id="not" style="display: none;">' . $sets . '</div>
                                                                                                            <div id="count" style="display:none;"><h1>' . $maxcount . '</h1><h1>' . $teamA . '</h1><h1>' . $teamB . '</h1></div>
<div id="vcount" style="display:none;">'.$ven.'</div>
                                 </form>
                                 separate
                                '.$success.'
                                 ');
            }
        }
    }

    function viewSpecificTraining(Request $request){
        $sched = uaapgameschedule::where('t_id',$request->input('id'))->where('team_id',intval($request->input('team_id')))->whereNotNull('days')->get();
        $venueList = trainingvenue::get();
        $maxcount = athlete::where('team_id',intval($request->input('team_id')))->count();
        $teamA = athlete::where('team_type','Team A')->where('team_id',intval($request->input('team_id')))->count();
        $teamB = athlete::where('team_type','Team B')->where('team_id',intval($request->input('team_id')))->count();
        $venue = '';
        $sets ='';
        foreach(team::get() as $tt){
            if(count(uaapgameschedule::where('t_id',$request->input('id'))->where('team_id',$tt->id)->whereNotNull('days')->get()) > 0)
                $sets.= '<h1>Yes</h1>';
            else $sets.= '<h1>No</h1>';
        }
        $ven = '';
        foreach($venueList as $v)
           $ven .= '<h1>'.intval($v->playerLimit).'</h1>';
        if(count($sched) > 0) {
            foreach($venueList as $v){
                if($v->id == $sched[0]->venue_id)
                    $venue.='<option value="'.$v->id.'" selected>'.$v->venue_name.'</option>';
                else
                    $venue.='<option value="'.$v->id.'">'.$v->venue_name.'</option>';
            }
                $vv = trainingvenue::where('id',$sched[0]->id)->get();
                $teams = '';
            $dayss ="";
            if ($sched[0]->days == ' s  m  t  w  th  f  st ') {

                $dayss = "Everyday";
            }else{
                $dd = $sched[0]->days;
                $dd = str_replace('s ','Sunday, ',$dd);
                $dd = str_replace('m ','Monday, ',$dd);
                $dd = str_replace('t ','Tuesday, ',$dd);
                $dd = str_replace('w ','Wednesday, ',$dd);
                $dd = str_replace('th ','Thursday, ',$dd);
                $dd = str_replace('f ','Friday, ',$dd);
                $dd = str_replace('st ','Saturday, ',$dd);
                $dayss = $dd;

            }
            if($sched[0]->team_type == "both") $teams = '<option value="both" selected>Team A and B</option><option value="Team A">Team A</option><option value="Team B">Team B</option>';
            elseif($sched[0]->team_type == "Team A") $teams = '<option value="both">Team A and B</option><option value="Team A" selected>Team A</option><option value="Team B">Team B</option>';
            elseif($sched[0]->team_type == "Team B") $teams = '<option value="both">Team A and B</option><option value="Team A">Team A</option><option value="Team B" selected>Team B</option>';
            echo('
                     <center><h4><b><span class="glyphicon glyphicon-calendar"></span></b>&nbsp; T R A I N I N G &nbsp; S C H E D U L
                                        E&nbsp; <div class="btn btn-info" id="toggEdit"  onclick="togg()"><b><span class="glyphicon glyphicon-edit"></span></b>&nbsp;</div><div class="btn btn-info" id="toggView" onclick="togg()" style="display: none;" ><b><span class="glyphicon glyphicon-eye-open"></span></b>&nbsp;</div></h4></center>
                                         <hr style="border:2px solid white;box-shadow: 0 0 1px 1px rgba(0,0,0,0.1);"/>
                                                                                    <br/><br/>
                    <div class="row" id="trainDet">


                                                                                    <div class="row">

                                                                                       <div class="col-sm-6 col-sm-offset-1">
                                                                                           <h4><b>Venue:</b>&nbsp;<u>'.$vv[0]->venue_name.'</u></h4>
                                                                                           </div> <div class="col-sm-4 col-sm-offset-1">
                                                                                               <h4><b>Team Type:</b>&nbsp;<u>'.$sched[0]->team_type.'</u></h4>
                                                                                               </div><div class="col-sm-2"></div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                           <hr/>
                                                                                           <div class="col-sm-11 col-sm-offset-1"><h4><b>Days:</b> <u>&nbsp;'.$dayss.'</u></h4></div>
                                                                                            <br/>
                                                                                        <br/>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                            <hr />
                                                                                            <div class="col-sm-4 col-sm-offset-1">
                                                                                            <h4><label for="tf"  style="display: inline;">Start Time: </label><u>'.date_format(date_create($sched[0]->timeRangeFrom),'h:i A').'</h4></u>
                                </div>
                               <div class="col-sm-4 col-sm-offset-1">
                             <h4> <label for="tt" style="display: inline;">End Time: </label><u>'.date_format(date_create($sched[0]->timeRangeTo),'h:i A').'</u></h4>
                                   <br/>
                               <br/>
                                 </div></div></div>
<form class="form-group" action="" method="post" name="trainingSched" id="trainingSched" style="display:none;">

                                                                                    <div class="row">

                                                                                       <div class="col-sm-1 col-sm-offset-1">
                                                                                           <h5><b>Venue:</b></h5>
                                                                                           </div> <div class="col-sm-4"><select class="form-control" name="venue_id" id="venue" onchange="venueC()">' . $venue . '</select><a href="#" data-toggle="modal" data-target="#venues"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Add new Venue</a></div><div class="col-sm-2">
                                                                                               <h5><b>Team Type:</b></h5>
                                                                                               </div><div class="col-sm-3"><select class="form-control" name="team_type" id="team_type" onchange="change()" >'.$teams.'</select></div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div id="playerLimit" style="color:#828282;position:relative;display:inline;margin-left:25%;">'.$venueList[0]->playerLimit.'  available players</div>
                                                                                        <div id="playerSize" style="color:#828282;position:relative;display:inline;margin-left:25%;">'.$maxcount.'  players</div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                           <br/><br/><br/>
                                                                                        <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                        <div class="row">
                                          <center><h4><b><span class="glyphicon glyphicon-cloud" style="color: #3498db;"></span>&nbsp; Days of Effect</b></h4></center>
                                                                                           <hr/>
                                                                                           <center>
                                                                                           <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="s " id="sun" '.((strpos($sched[0]->days,'s '))? "checked":"").' name="days" />
                                        Sunday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" value="m " id="mon" '.((strpos($sched[0]->days,'m '))? "checked":"").' name="days" />
                                        Monday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="t " id="tue" '.((strpos($sched[0]->days,'t '))? "checked":"").' name="days" />
                                        Tuesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="w " id="wed" '.((strpos($sched[0]->days,'w '))? "checked":"").' name="days"/>
                                        Wednesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="th " id="thur" '.((strpos($sched[0]->days,'th '))? "checked":"").' name="days"/>
                                        Thursday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" value="f " id="fri" '.((strpos($sched[0]->days,'f '))? "checked":"").' name="days" />
                                        Friday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="st " id="sat" '.((strpos($sched[0]->days,'st '))? "checked":"").' name="days"/>
                                        Saturday</div>
                                                                                            </center>
                                                                                            <br/>
                                                                                        </div>
                                                                                        <br/>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                    <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                    <div class="row">
                                                                                        <center>
                                                                                            <h4><b><span class="glyphicon glyphicon-time" style="color:#3498db;"></span>&nbsp;Time Range</b></h4>
                                                                                            </center>
                                                                                            <hr />
                                                                                            <div class="col-sm-4">
                                                                                            <label for="tf"  style="display: inline;">From: </label>
                                <input class="form-control" name="timeRangeFrom" type="time" id="tf" style="display: inline;" value="'.$sched[0]->timeRangeFrom.'"/>
                                </div>
                               <div class="col-sm-4 col-sm-offset-1">
                              <label for="tt" style="display: inline;">To: </label>
                              <input class="form-control" name="timeRangeTo" type="time" id="tt" style="display: inline;" value="'.$sched[0]->timeRangeTo.'"/>
                                      </div>
                                   <br/>
                                </div>
                               <br/>
                                 </div></div></div>
                                  <br/>
                              <button class="btn btn-danger" style="margin-left: 35%;" id="deleteT"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete</button>
                                  <div class="btn btn-info" style="margin-left: 8%;" id="updateT" onclick="updateSched()"><b><span class="glyphicon glyphicon-send"></span></b>&nbsp; Update Schedule</div>
                                                                        <div id="not" style="display: none;">'.$sets.'</div>
                                                                        <div id="count" style="display:none;"><h1>'.$maxcount.'</h1><h1>'.$teamA.'</h1><h1>'.$teamB.'</h1></div>
                                                                        <div id="vcount" style="display:none;">'.$ven.'</div>
                                 </form>');
        }
        else {
            foreach ($venueList as $v) {
                $venue .= '<option value="' . $v->id . '">' . $v->venue_name . '</option>';
            }
            echo('       <form class="form-group" action="" method="post" name="trainingSched">


                                                                                <div class="row">
                                                                                    <center><h4><b><span class="glyphicon glyphicon-calendar"></span></b>&nbsp; T R A I N I N G &nbsp; S C H E D U L
                                        E</h4></center>
                                                                                    <hr style="border:2px solid white;box-shadow: 0 0 1px 1px rgba(0,0,0,0.1);"/>
                                                                                    <br/><br/>
                                                                                    <div class="row">

                                                                                       <div class="col-sm-1 col-sm-offset-1">
                                                                                           <h5><b>Venue:</b></h5>
                                                                                           </div> <div class="col-sm-4"><select class="form-control" name="venue_id" id="venue" onchange="venueC()">' . $venue . '</select><a href="#" data-toggle="modal" data-target="#venues"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Add new Venue</a></div><div class="col-sm-2">
                                                                                               <h5><b>Team Type:</b></h5>
                                                                                               </div><div class="col-sm-3"><select class="form-control" name="team_type" id="team_type" onchange="change()"><option value="both">Team A and B</option><option value="Team A">Team A</option><option value="Team B">Team B</option></select></div>
                                                                                    </div>
                                                                                     <div class="row">
                                                                                        <div id="playerLimit" style="color:#828282;position:relative;display:inline;margin-left:25%;">'.$venueList[0]->playerLimit.'  available players</div>
                                                                                        <div id="playerSize" style="color:#828282;position:relative;display:inline;margin-left:25%;">'.$maxcount.'  players</div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                           <br/><br/><br/>
                                                                                        <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                        <div class="row">
                                          <center><h4><b><span class="glyphicon glyphicon-cloud" style="color: #3498db;"></span>&nbsp; Days of Effect</b></h4></center>
                                                                                           <hr/>
                                                                                           <center>
                                                                                           <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" value="s " id="sun" name="days" />
                                        Sunday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" id="mon" value="m " name="days" />
                                        Monday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" id="tue" value="t " name="days" />
                                        Tuesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" id="wed" value="w " name="days"/>
                                        Wednesday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" id="thur" value="th " name="days"/>
                                        Thursday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input type="checkbox" id="fri" value="f " name="days" />
                                        Friday</div>
                                                                                            <div class="day" style="width: 10%;display: inline;"><input  type="checkbox" id="sat" value="st " name="days"/>
                                        Saturday</div>
                                                                                            </center>
                                                                                            <br/>
                                                                                        </div>
                                                                                        <br/>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                    <div class="col-sm-10 col-sm-offset-1 panel">
                                                                                    <div class="row">
                                                                                        <center>
                                                                                            <h4><b><span class="glyphicon glyphicon-time" style="color:#3498db;"></span>&nbsp;Time Range</b></h4>
                                                                                            </center>
                                                                                            <hr />
                                                                                            <div class="col-sm-4">
                                                                                            <label for="tf"  style="display: inline;">From: </label>
                                <input class="form-control" name="timeRangeFrom" type="time" id="tf" style="display: inline;"/>
                                </div>
                               <div class="col-sm-4 col-sm-offset-1">
                              <label for="tt" style="display: inline;">To: </label>
                              <input class="form-control" name="timeRangeTo" type="time" id="tt" style="display: inline;"/>
                                      </div>
                                   <br/>
                                </div>
                               <br/>
                                 </div></div></div>
                                  <br/>
                              <button type="reset" class="btn btn-warning" style="margin-left: 35%;" ><b><span class="glyphicon glyphicon-repeat"></span></b>&nbsp; Reset</button>
                                  <div class="btn btn-info" style="margin-left: 8%;" id="setSchedule" onclick="setSched()"><b><span class="glyphicon glyphicon-plus-sign"></span></b>&nbsp; Set Schedule</div>
                                    <div id="not" style="display: none;">' . $sets . '</div>
                                                                                                            <div id="count" style="display:none;"><h1>'.$maxcount.'</h1><h1>'.$teamA.'</h1><h1>'.$teamB.'</h1></div>
                                                                                                            <div id="vcount" style="display:none;">'.$ven.'</div>
                                 </form> ');
        }
    }

    function intersectsSchedulePlan($data){
        $schedule = uaapgameschedule::where('id',$data['t_id'])->where('venue_id',$data['venue_id'])->where('team_id','<>',$data['team_id'])->get();
        $venue = trainingvenue::where('id',$data['venue_id'])->get();
        $val = true;
        $message = $venue[0]->venue_name.' has been set in the same time range by other teams :';
        $t='';
        $dd='';
        $days = 's ,m ,t ,w ,th ,f ,st ';
        $dayDet ='Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday';
        foreach($schedule as $s) {
            $x = 0;
            $valss = false;
            foreach (explode(',', $days) as $d) {
                if (strpos($s->days, $d) && strpos($data['days'], $d)) {
                    if ((date_create($s->timeRangeFrom) <= date_create($data['timeRangeFrom']) && date_create($s->timeRangeTo) > date_create($data['timeRangeFrom'])) || (date_create($s->timeRangeFrom) <= date_create($data['timeRangeTo']) && date_create($s->timeRangeTo) > date_create($data['timeRangeTo']))) {
                        $val = false;
                        $valss = true;
                    }
                }
                $x++;
            }
            if ($valss) {
                $tt = team::where('id', $s->team_id)->get();
                $t .= $tt[0]->team_name . '(';
                $ds = '';
                $nn = 0;
                foreach (explode(',', $days) as $d) {
                    if (strpos($s->days, $d)) {
                        $ds .= explode(',', $dayDet)[$nn].' ';
                    }
                    $nn++;
                }
                if($ds == "Sunday Monday Tuesday Wednesday Thursday Friday Saturday ");
                    $ds = "Everyday";
                $t .= $ds . ') ';
            }
        }
            return ($val)? "ok":($message .$t);
    }

    function addSchedulePlan(Request $request){
        trainingschedule::insert([$request->all(),'created_at'=>date('Y-m-d')]);
        $teamList =team::get();
        foreach($teamList as $team)
            uaapgameschedule::insert(['t_id'=>trainingschedule::count(),'team_id'=>$team->id,'created_at'=>date('Y-m-d')]);
        Session::flash('success','Successfully added '.$request->input('season').' '.$request->input('semester').' in the schedule plan list');
        return redirect()->back();
    }

    function deleteTraining(Request $request){
        Session::flash('success','Sucessfully deleted '.$request->input('venue_name').' to the venue list');
        trainingvenue::where('id',$request->input('id'))->delete();
        return redirect()->back();
    }

    function viewSpecificAthlete(Request $request){
            $athlete = athlete::where('id',intval($request->input('id')))->get();
        $athlete = $athlete[0];
        $out = '<img src="/sys_files/img/profile_pic/athlete/'.$athlete->profile_pic.'" width="180" height="170" class="img-rounded" style="margin-left: 20px;box-shadow: 0 0 3px 3px rgba(0,0,0,0.3);">
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
                           <h4 id="athleteStats"><b>UAAP Statistics:</b></h4>';
        if((sanctionathletes::where('athlete_id',$request->input('id'))->count())>0)
            $out.='<h4><a style="color:red;cursor:pointer;" href="/OAMS/admin/sanction/'.$request->input('id').'"><b><span class="glyphicon glyphicon-eye-open">&nbsp;View Athlete\'s sanction(s)</b></a></h4>';
            echo($out);
    }

    function viewSanction($id){
        $messagecount = $this->navData();
        $sanctionList = sanctionathletes::where('athlete_id',$id)->get();
        $athlete = athlete::where('id',$id)->get();
        if(count($athlete)>0)
        $athlete = $athlete[0];
        for ($x=0;$x<count($sanctionList);$x++) {
            if($sanctionList[$x]->coach_id != null) {
                $coachProfile = coach::where('id', $sanctionList[$x]->coach_id)->get();
                $sanctionList[$x]['coachName'] = $coachProfile[0]->firstname . ' ' . $coachProfile[0]->surname;
                $sanctionList[$x]['resolved'] = ($sanctionList[$x]['resolved'] == 0) ? "NO" : "YES";
            }
        }
        return view('adminSanction',compact('sanctionList','athlete','messagecount'));
    }

    function navData(){
        if(!isset($_SESSION)) session_start();
        return message::where('toU',$_SESSION['id'])->where('viewed',0)->count();
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
        $messagecount = $this->navData();
        Session::put('addAthlete',$request->except('profile_pic','MAX_FILE_SIZE'));
        $request->file('profile_pic')->move('sys_files/img/profile_pic/tempAthlete',(intval(athlete::orderBy('id','desc')->get(['id'])[0]->id)+1).'.jpg');
        $usernameList = user::get();
        return view('adminAthleteUserCredential',compact('usernameList','messagecount'));
    }


    function addAthleteForReal(Request $request){
        $validate = Validator::make($request->all(),$this->athleteCredentialRules);
        if($validate->fails()){
            $errors = $validate->errors()->all();
            return redirect()->back()->withInput($request->all())->with('errors',$errors);
        }
        $athleteData = Session::get('addAthlete');
       Storage::move('\\img\\profile_pic\\tempAthlete\\'.(intval(athlete::orderBy('id','desc')->get(['id'])[0]->id)+1).'.jpg','\\img\\profile_pic\\athlete\\'.(intval(athlete::orderBy('id','desc')->get(['id'])[0]->id)+1).'.jpg');
        $athleteData['profile_pic'] = (intval(athlete::orderBy('id','desc')->get(['id'])[0]->id)+1).'.jpg';
        $athleteData['team_id'] = $this->determineTeam($athleteData['sport'],$athleteData['gender']);
        $athleteData['created_at'] = date('Y-m-d');
        $athleteCred = $request->except(['Mac']);
        $athleteCred['type'] = 'athlete';
        users::insert($athleteCred);
        $athleteData['user_id'] = count(user::get());
        athlete::insert($athleteData);


        Session::flash('add',$athleteData['given_name'].' '.$athleteData['last_name'].' has been successfully added as athlete!');
        Session::forget('addAthlete');
        return redirect()->route('adminviewAthlete');
    }

    function determineTeam($sport,$gender){
        $sport=sport::where('sport_name',$sport)->get(['id']);
        $id = team::where('sport_id',$sport[0]->id)->where('gender',$gender)->get(['id']);
        return $id[0]->id;
    }

    function viewAddAthlete(){
        $messagecount = $this->navData();
        if(count(Storage::allFiles('\\img\\profile_pic\\tempAthlete\\'))>0)
        Storage::delete('\\img\\profile_pic\\tempAthlete\\'.(intval(athlete::orderBy('id','desc')->get(['id'])[0]->id)+1).'jpg');
        Session::forget('addAthlete');
        $ListOfSport = sport::get();
        return view('adminAddAthlete',compact('ListOfSport','messagecount'));
    }

    function sendMessage(Request $request){
        $receiver = explode(' ',trim($request->input('toU')));
        foreach($receiver as $to){
            $messageData = $request->all();
            $messageData['toU'] = intval($to);
            $messageData['created_at'] = date('Y-m-d');
            $messageData['viewed'] = 0;
            message::insert($messageData);
        }
        Session::flash('success','Message successfully sended!');
        return redirect()->back();
    }

    function printAthlete($id){
        $athleteData = athlete::where('id',$id)->get();
        if($exists = (count($athleteData)>0)) {
            $athleteData = $athleteData[0];
            $team = (team::where('id', $athleteData->team_id)->get());
            $athleteData['teamName'] = $team[0]->team_name;
        }
        $messagecount = $this->navData();
        return view('adminAthleteProfilePrint',compact('athleteData','exists','messagecount'));
    }

    function viewSpecificsAthlete($id){
        $athleteData = athlete::where('id',$id)->get();
        if($exists = (count($athleteData)>0)) {
            $athleteData = $athleteData[0];
            $team = (team::where('id', $athleteData->team_id)->get());
            $athleteData['teamName'] = $team[0]->team_name;
        }
        $messagecount = $this->navData();
        $ListOfSport = sport::get();
        return view('staffViewAthleteProfile',compact('athleteData','ListOfSport','exists','messagecount'));
    }

    function viewMessage(){
            if(!isset($_SESSION)) session_start();
            $messageIn = message::where('toU',intval($_SESSION['id']))->get();
            $messageOut = message::where('fromU',intval($_SESSION['id']))->get();
            $user = users::get();
            for($x=0;$x<count($user);$x++) {
                for($y=0;$y<count($messageIn);$y++) {
                    if ($user[$x]->id != intval($_SESSION['id'])) {
                        if ($user[$x]->type == 'staff' && $messageIn[$y]->fromU == $user[$x]->id) {
                            $staff = staff::where('user_id', $user[$x]->id)->get();
                            $name = $staff[0]->firstname . ' ' . $staff[0]->middlename . ' ' . $staff[0]->lastname;
                            if ($messageIn[$y]->fromU == $user[$x]->id)
                                $messageIn[$y]['name'] = $name;
                            $messageIn[$y]['img'] = '/sys_files/img/profile_pic/staff/'.$staff[0]->profile_pic;
                            $messageIn[$y]['type'] ='staff';
                            $user[$x]['userName'] = $name;

                        } else if ($user[$x]->type == 'athlete' && $messageIn[$y]->fromU == $user[$x]->id) {
                            $athlete = athlete::where('user_id', $user[$x]->id)->get();
                            if (count($athlete) > 0) {
                                $name = $athlete[0]->firstname . ' ' . $athlete[0]->middlename . ' ' . $athlete[0]->lastname;
                                $user[$x]['userName'] = $name;
                                if ($messageIn[$y]->fromU == $user[$x]->id)
                                    $messageIn[$y]['name'] = $name;
                                $messageIn[$y]['img'] = '/sys_files/img/profile_pic/athlete/'.$athlete[0]->profile_pic;
                                $messageIn[$y]['type'] ='athlete';
                            }
                        } else if ($user[$x]->type == 'coach' && $messageIn[$y]->fromU == $user[$x]->id) {
                            $coach = coach::where('user_id', $user[$x]->id)->get();
                            $name = $coach[0]->firstname . ' ' . $coach[0]->middlename . ' ' . $coach[0]->lastname;
                            $user[$x]['userName'] = $name;
                            if ($messageIn[$y]->fromU == $user[$x]->id)
                                $messageIn[$y]['name'] = $name;
                            $messageIn[$y]['img'] = '/sys_files/img/profile_pic/coach/'.$coach[0]->profile_pic;
                            $messageIn[$y]['type'] ='coach';
                        }

                    }
                }
                    for($y=0;$y<count($messageOut);$y++) {
                        if ($user[$x]->id != intval($_SESSION['id'])) {
                            if ($user[$x]->type == 'staff' && $messageOut[$y]->toU == $user[$x]->id) {
                                $staff = staff::where('user_id', $user[$x]->id)->get();
                                $name = $staff[0]->firstname . ' ' . $staff[0]->middlename . ' ' . $staff[0]->lastname;
                                if ($messageOut[$y]->toU == $user[$x]->id)
                                    $messageOut[$y]['name'] = $name;
                                $messageOut[$y]['img'] = '/sys_files/img/profile_pic/staff/'.$staff[0]->profile_pic;
                                $messageOut[$y]['type'] ='staff';
                                $user[$x]['userName'] = $name;
                            } else if ($user[$x]->type == 'athlete' && $messageOut[$y]->toU == $user[$x]->id) {
                                $athlete = athlete::where('user_id', $user[$x]->id)->get();
                                if (count($athlete) > 0) {
                                    $name = $athlete[0]->firstname . ' ' . $athlete[0]->middlename . ' ' . $athlete[0]->lastname;
                                    $user[$x]['userName'] = $name;
                                    if ($messageOut[$y]->toU == $user[$x]->id)
                                        $messageOut[$y]['name'] = $name;
                                    $messageOut[$y]['img'] = '/sys_files/img/profile_pic/athlete/'.$athlete[0]->profile_pic;
                                    $messageOut[$y]['type'] ='athlete';
                                }
                            } else if ($user[$x]->type == 'coach' && $messageOut[$y]->toU == $user[$x]->id) {
                                $coach = coach::where('user_id', $user[$x]->id)->get();
                                if(count($coach) > 0) {
                                    $name = $coach[0]->firstname . ' ' . $coach[0]->middlename . ' ' . $coach[0]->surname;
                                    $user[$x]['userName'] = $name;
                                    if ($messageOut[$y]->toU == $user[$x]->id)
                                        $messageOut[$y]['name'] = $name;
                                    $messageOut[$y]['img'] = '/sys_files/img/profile_pic/coach/' . $coach[0]->profile_pic;
                                    $messageOut[$y]['type'] = 'coach';
                                }
                            }

                        }
                    }
                    if ($user[$x]->id != intval($_SESSION['id'])) {
                        if ($user[$x]->type == 'staff') {
                            $staff = staff::where('user_id', $user[$x]->id)->get();
                            $name = $staff[0]->firstname . ' ' . $staff[0]->middlename . ' ' . $staff[0]->lastname;
                            $user[$x]['userName'] = $name;
                        } else if ($user[$x]->type == 'athlete') {
                            $athlete = athlete::where('user_id', $user[$x]->id)->get();
                            if (count($athlete) > 0) {
                                $name = $athlete[0]->firstname . ' ' . $athlete[0]->middlename . ' ' . $athlete[0]->lastname;
                                $user[$x]['userName'] = $name;
                            }
                        } else if ($user[$x]->type == 'coach') {
                            $coach = coach::where('user_id', $user[$x]->id)->get();
                            if(count($coach) > 0)
                            $name = $coach[0]->firstname . ' ' . $coach[0]->middlename . ' ' . $coach[0]->lastname;
                            $user[$x]['userName'] = $name;
                        }

                    }
                }
        $messagecount = $this->navData();
        return view('adminMessage',compact('messageIn','messageOut','user','messagecount'));
    }

    function printAthleteList(){
        $athleteData = athlete::orderBy('last_name','desc')->get();
        $sportList = sport::orderBy('sport_name','asc')->get();
        return view('adminprintAthleteList',compact('athleteData','sportList'));
    }

    function updateAthlete(Request $request){
        Session::flash('success','Successfully updated '.$request->input('given_name').' '.$request->input('last_name').'\'s profile');
        athlete::where('id',$request->input('id'))->update($request->except('MAX_FILE_SIZE'));
        return redirect()->back();
    }

    function addAthlete2(){
        $messagecount = $this->navData();
        return view('adminAthleteUserCredentials',compact('messagecount'));
    }

    function sendSanction(Request $request){
        $data = $request->all();
        $data['created_at'] = date('Y-m-d');
        if(!isset($_SESSION)) session_start();
            $data['id'] = $_SESSION['user_info']->id;
        sanctionathletes::insert($data);
        $athlete = athlete::where('id',$request->input('athlete_id'))->get();
        Session::flash('success','Sanction has been send to '.$athlete[0]->given_name.' '.$athlete[0]->last_name);
        event(new EventExecuted($_SESSION['user_info']->id,$request->input('athlete_id'),'sanctionathletes','sends a sanction to'.$athlete[0]->given_name.' '.$athlete[0]->last_name));
        return redirect()->back();
    }

    function viewSchedule(){
        $messagecount = $this->navData();
        return view('adminSchedule',compact('messagecount'));
    }

    function getTrainingSchedule(){
        return trainingschedule::where('id',trainingschedule::count())->get();
    }

    function viewGameSchedule(){
        $teamList = team::get();
        $gameVenue = gamevenue::get();
        $messagecount =$this->navData();
        $gameschedule = gameschedule::orderBy('dateOfGame')->orderBy('timeOfGame')->get();
        for($x=0; $x < count($gameschedule); $x++){
            if(date('Y-m-d') < $gameschedule[$x]->dateOfGame)
                $gameschedule[$x]['upcoming'] = 'Yes';
            else
                $gameschedule[$x]['upcoming'] = 'No';
            $team = team::where('id',$gameschedule[$x]->team_id)->get();
            $venue = gamevenue::where('id',$gameschedule[$x]->venue_id)->get();
            $gameschedule[$x]['venueName'] = $venue[0]->venue_name;
            $gameschedule[$x]['teamName'] = $team[0]->team_name;
        }
        return view('adminGameSchedule',compact('gameschedule','messagecount','teamList','gameVenue'));
    }

    function addGameSchedule(Request $request){
        gameschedule::insert(array_add($request->all(),'created_at',date('Y-m-d')));
        Session::flash('success','Successfully added to the game schedule');
        return redirect()->back();
    }

    function updateGameSchedule(Request $request){
        gameschedule::where('id',$request->input('id'))->update($request->all());
        Session::flash('success','Successfully updated the game schedule');
        return redirect()->back();
    }

    function deleteGameSchedule(Request $request){
        gameschedule::where('id',$request->input('id'))->delete();
        Session::flash('success','Successfully deleted game schedule');
        return redirect()->back();
    }

    function viewGameVenue(){
        $gameVenue = gamevenue::get();
        $messagecount = $this->navData();
        return view('adminGameVenue',compact('gameVenue','messagecount'));
    }

    function addGameVenue(Request $request){
        $imgName = (gamevenue::count()).'.jpg';
        $data = $request->except(['img','MAX_FILE_SIZE','id']);
        $data['img'] = $imgName;
        $data['created_at'] = date('Y-m-d');
        gamevenue::insert($data);
        $request->file('img')->move('sys_files/img/gamevenue',$imgName);
        Session::flash('success','Game venue named'.$request->input('venue_name').' successfully added!');
        return redirect()->back();
    }

    function deleteGameVenue(Request $request){
        $game = gamevenue::where('id',$request->input('id'))->get();
        gamevenue::where('id',$request->input('id'))->delete();
        Storage::delete('img/gamevenue/'.$game[0]->img);
        Session::flash('success','Successfully deleted '.$game[0]->venue_name.' to the venue list');
        return redirect()->back();
    }

    function updateGameVenue(Request $request){
        $game = gamevenue::where('id',$request->input('id'))->get();
        gamevenue::where('id',$request->input('id'))->update($request->except(['img','MAX_FILE_SIZE']));
        Storage::delete('img/gamevenue/'.$game[0]->img);
        $request->file('img')->move('sys_files/img/gamevenue',$game[0]->img);
        Session::flash('success','Successfully updated '.$game[0]->venue_name.' to the venue list');
        return redirect()->back();
    }

    function printGameSchedule(){
        $gameScheduleList =gameschedule::get();
        $teamList = team::get();
        for($x=0;$x<count($gameScheduleList);$x++){
            $venue =trainingvenue::where('id',$gameScheduleList[$x]->venue_id)->get();
            $gameScheduleList[$x]['venueName'] = $venue[0]->venue_name;
        }

        for($x=0;$x<count($teamList);$x++){

            $sport = sport::where('id',$teamList[$x]->sport_id)->get();

            $teamList[$x]['sport_name'] = $sport[0]->sport_name;}
        return view('adminPrintUpcomingSchedule',compact('gameScheduleList','teamList'));
    }

    function viewCoach(){
        $coachList = coach::whereNull('deleted_at')->get();
        $messagecount = $this->navData();
        $sportList = sport::get();
        for($x = 0; $x < count($coachList); $x++){
            $team = team::where('id',$coachList[$x]->team_id)->get();
            $sport = sport::where('id',$team[0]->sport_id)->get();
            $coachList[$x]['sport_name'] = $sport[0]->sport_name;
            $coachList[$x]['team_name'] = $team[0]->team_name;
        }
        return view('adminViewCoach',compact('coachList','messagecount','sportList'));
    }

    function viewSCoach(Request $request){
        $coach = coach::where('id',$request->input('id'))->get();
        $team = team::where('id',$coach[0]->team_id)->get();
        $teamCount = athlete::where('team_id',$coach[0]->team_id)->count();
        echo('<div class="col-sm-12">
<div class="row">
<br/>
                                                    <img src="/sys_files/img'.(($coach[0]->profile_pic == '')? 'user.jpg':'/profile_pic/coach/'.$coach[0]->profile_pic).'" alt="" height="120" width="120" class="img-rounded" style="margin-left:5%;"/>

                                                </div>
                                                       <br/>
                                                       <hr>
                                                       <div class="row ">
                                                       <input type="hidden" id="id" value="'.$coach[0]->id.'">
                            <div class="col-sm-2"><b>Firstname: </b></div><div class="col-sm-8">'.$coach[0]->firstname.'</div>
                            <br/> <br/>
                            <div class="col-sm-2"><b>Middlename: </b></div><div class="col-sm-8">'.$coach[0]->middlename.'</div>
                            <br/><br/>
                            <div class="col-sm-2"><b>Lastname: </b></div><div class="col-sm-8">'.$coach[0]->surname.'</div>
                            <br/><br/>
                            <div class="col-sm-2"><b>Gender: </b></div><div class="col-sm-8">'.strtoupper($coach[0]->gender).'</div>
                            <br/><br/>
                            <div class="col-sm-2"><b>Age: </b></div><div class="col-sm-8">'.(date_diff(date_create(strval(date('Y-m-d'))),date_create(strval($coach[0]->birth_day)))->y).' yrs old</div>
                            <br/><br/>
                            <div class="col-sm-2"><b>Team: </b></div><div class="col-sm-8">'.$team[0]->team_name.'</div>
                            <br/><br/>
                            <div class="col-sm-4"><b>Team population: </b></div><div class="col-sm-8">'.$teamCount.' players</div>
                            </div></div>');
    }

    function deleteCoach(Request $request){
        $coach = coach::where('id',$request->input('id'))->get();
        coach::where('id',$request->input('id'))->update(['deleted_at'=>date('Y-m-d')]);
        Session::flash('success','Success deleted coach '.$coach[0]->firstname.' from the list');
        return redirect()->back();
    }
    function viewAddCoach(){
        $messagecount = $this->navData();
        $userList = users::get();
        $teamList = team::get();
        return view('adminAddCoach',compact('messagecount','teamList','userList'));
    }

    function addCoach(Request $request){
        users::insert(['username'=>$request->input('username'),'password'=>$request->input('password'),'type'=>'coach']);
        coach::insert($request->except(['MAX_FILE_SIZE','username','profile_pic','password']));
        $coach =coach::orderBy('id','desc')->take(1)->get();
        coach::where('id',$coach[0]->id)->update(['profile_pic'=>$coach[0]->id.'.jpg']);
        $request->file('profile_pic')->move('sys_files/img/profile_pic/coach',$coach[0]->id.'.jpg');
        Session::flash('success','Successfully added '.$request->input('firstname').' '.$request->input('surname').' to the coaches list');
        return redirect()->back();
    }

    function viewCMS(){
        $messagecount = $this->navData();
        $pageViews = hsvcount::take(1)->get();
        $pageViews = $pageViews[0]->view_count;
        $contactMessage = contactmessage::orderBy('created_at','desc')->get();
        $postList = blog::orderBy('created_at','desc')->get();
        for($x=0; $x < count($postList); $x++){
            $user = users::where('id',$postList[$x]->user_id)->get();
            if($user[0]->type == 'coach'){
                $coach = coach::where('user_id',$user[0]->id)->get();
                $postList[$x]['author'] = $coach[0]->firstname.' '.$coach[0]->surname.'<div class="label label-success">coach</div>';
            }
            else if($user[0]->type == 'staff'){
                $coach = staff::where('user_id',$user[0]->id)->get();
                $postList[$x]['author'] = $coach[0]->firstname.' '.$coach[0]->surname.'<div class="label label-primary">coach</div>';
            }

        }
        $faqList = faq::get();
        return view('adminCMS',compact('messagecount','contactMessage','postList','faqList','pageViews'));
    }

    function addFAQ(Request $request){
        faq::insert(array_add($request->except(['id']),'created_at',date('Y-m-d')));
        Session::flash('success','Successfully added FAQ');
        return redirect()->back();
    }

    function deleteFAQ(Request $request){
        faq::where('id',$request->input('id'))->delete();
        Session::flash('success','Successfully deleted FAQ');
        return redirect()->back();
    }

    function updateFAQ(Request $request){
        if(!isset($_SESSION)) session_start();
        $faq = faq::where('id',$request->input('id'))->get();
        event(new EventExecuted($_SESSION['id'],0,'FAQ','Updated FAQ from question=\''.$faq[0]->question.'\' message=\''.$faq[0]->answer.'\' to question=\''.$request->input('question').'\' answer=\''.$request->input('answer').'\''));
        faq::where('id',$request->input('id'))->update($request->except('id'));
        Session::flash('success','Successfully updated FAQ');

        return redirect()->back();
    }

    function viewApplicants(){
        $messagecount = $this->navData();
        $applicantList = applicant::get();
        $sportList = sport::get();
        return view('adminApplicant',compact('messagecount','applicantList','sportList'));
    }

    function viewSApplicant(Request $request){
        $applicant = applicant::where('id',$request->input('id'))->get();
        $applicant = $applicant[0];
        echo('<div class="container-fluid">
                            <div class="row well">
                           <div class="row">
                                <div class="col-sm-5 col-sm-offset-1"><img class="img-rounded" src="/sys_files/img/profile_pic/applicant/'.$applicant->profile_pic.'" alt="" height="180" width="180"/></div>

                           </div><br/><br/>
                            <hr/>
                           <br/><br/>
                                     <div class="col-sm-4"><b>Firstname: </b>'.$applicant->given_name.'</div><div class="col-sm-4"><b>Middlename: </b>'.$applicant->middle_name.'</div><div class="col-sm-4"><b>Lastname: </b>'.$applicant->last_name.'</div><br/>
<br/>
                                <br><div class="col-sm-3"><b>Birthdate: </b>'.$applicant->bday.'</div><div class="col-sm-3"><b>Gender: </b>'.$applicant->gender.'</div><div class="col-sm-3"><b>Age: </b>'.date_diff(date_create(strval(date('Y-m-d'))),date_create(strval($applicant->bday)))->y.' yrs old</div><div class="col-sm-3"><b>Civil Status:</b>'.$applicant->civil_status.'</div>
                               <br> <br/><br/><div class="col-sm-7"><b>Address: </b>'.$applicant->home_address.'</div><div class="col-sm-5"><b>Birthplace:</b>'.$applicant->birthplace.'</div>
                                <br/><br/><br>
                                 <div class="col-sm-3"><b>Nationality: </b>'.$applicant->nationality.'</div><div class="col-sm-3"><b>Blood Type:</b>'.$applicant->blood_type.'</div><div class="col-sm-3"><b>Height: </b>'.$applicant->height.'</div><div class="col-sm-3"><b>Weight: </b><'.$applicant->weight.'/div>
                                   <br/><br/><br>
                                   <div class="col-sm-4"><b>Mother\'s Firstname: </b>'.$applicant->mother_given_name.'</div><div class="col-sm-4"><b>Mother\'s Middlename:</b>'.$applicant->mother_middle_name.'</div><div class="col-sm-4"><b>Mother\'s Lastname: </b>'.$applicant->mother_last_name.'</div><br/>
                                  <br> <br/><div class="col-sm-4"><b>Father\'s Firstname: </b>'.$applicant->father_given_name.'</div><div class="col-sm-4"><b>Father\'s Middlename:</b>'.$applicant->father_middle_name.'</div><div class="col-sm-4"><b>Father\'s Lastname: </b>'.$applicant->father_last_name.'</div>
                                    <br/><br/><br>
                                    <div class="col-sm-4"><b>Sport: </b>'.$applicant->sport.'</div><div class="col-sm-4"><b>Playing pos: </b>'.$applicant->playing_pos.'</div>
                                    <br/><br/><br>
                                    <div class="col-sm-5"><b>Email: </b>'.$applicant->email.'</div><div class="col-sm-5"><b>Youtube Link: </b>'.$applicant->ytlink.'</div>
                                    <br/><br/><br>
                            </div>
                        </div>');
    }

    function printApplicant($id){
        $applicant = applicant::where('id',$id)->get();
        return view('adminPrintApplicantProfile',compact('applicant'));

    }

    function viewActivityLog(){
        if(!isset($_SESSION)) session_start();
        $logreportList = logreport::where('user_id',$_SESSION['id'])->get();
        $messagecount = $this->navData();
        return view('adminActivityLog',compact('logreportList','messagecount'));
    }
}