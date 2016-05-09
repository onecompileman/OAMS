<?php

namespace App\Http\Controllers;
use App\Events\EventExecuted;
use Illuminate\Support\Facades\Session;
use App\rosterforbasketball;
use App\playerstatsbasketball;
use App\athlete;
use App\blog;
use App\mac;
use Illuminate\Http\Request;
use App\Http\Requests\AddStoreRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\users;
use App\schedule;
use App\sport;
use App\team;
use App\applicant;
use Mockery\CountValidator\Exception;
use App\sanctionathletes;

class coach extends Controller
{
    public $blogRule=[
      'title'=>'required|min:4',
        'article'=>'required|min:10',
        'figure'=>'required'
    ];
    public $coachProf=[
        'username'=>'required|min:5',
        'password'=>'required|min:5',
        'profile_pic'=>'required',
        'Mac'=>'required'
    ];
  public $rulesAthlete=[
        'given_name'=> 'alpha|required|min:3',
       /* 'last_name'=> 'alpha|required|min:2',
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
        'mother_nickname' => 'alpha|required|min:2',*/

    ];
    public $rulesSchedule=[
      'date_of'=>'required',
      'time_of'=>'required',
        'title'=>'required|alpha_num|min:4',
        'venue'=>'required|alpha_num|min:2'
    ];
    function editProfile(Request $request){
        if(!isset($_SESSION)) session_start();
        $user= new users();
        $mac = new mac();
      $profile=$user->where('id',$_SESSION['user_info']->user_id)->get();
            $val=Validator::make($request->all(),$this->coachProf);
            $Error=$val->errors()->all();
            if($val->passes()&&$request->hasFile('profile_pic')){
                     unlink("C:/Users/Stephen/Desktop/Online Athelete Management(DBMS2)/AthleteManagement/public/sys_files/img/profile_pic/user/".$_SESSION['user_info']->user_id.'.jpg');
                $user->where('id',$_SESSION['user_info']->user_id)->update($request->except(['profile_pic','MAX_FILE_SIZE']));
                $request->file('profile_pic')->move('sys_files/img/profile_pic/user/',$_SESSION['user_info']->user_id.'.jpg');
                $Macs = explode(',',$request->input('Mac'));

                $mac->where('user_id',$_SESSION['user_info']->user_id)->delete();
                foreach ($Macs as $m) {
                    $mac->insert(['user_id'=>$_SESSION['user_info']->user_id,'mac_name'=>$m]);
                }
                return view('editCoachProfile',compact('profile'))->with('Added','Profile Updated Successfully');
            }
        else
            return view('editCoachProfile',compact('Error','profile'));
    }
    function updateApplicant(Request $request){
            $applicant = new applicant();
            $applicant->where('id',$request->input('aID'))->update(['pending'=>'false']);

            return $this->viewApplicant($request->input('page'));
    }
    function viewEditModalApplicant(Request $request){

        $applicant= new applicant();
        $applicantProfile= $applicant->where('id',$request->input('id'))->get();
            $out='<img src="/sys_files/img/profile_pic/applicant/'.$applicantProfile[0]->profile_pic.'" width="200" height="200"><br>';
            $applicantProfile=$applicantProfile[0]->toArray();
            foreach($applicantProfile as $key => $value){
                $out.="<h5><b>$key: </b>$value</h5><br>";
        }
        return $out;

    }
    function sendPic(Request $request){
    echo $request->input('profile_pic');
    }
    function viewApplicant($page){
            $applicant = new applicant();
            $no=count($applicant->where('pending',true)->get());
            if(($page-1)>($no/8))
                abort('404');
            $listOfApplicant= $applicant->where('pending',true)->skip($page-1)->take(8)->get();
        return view('viewApplicant',compact('listOfApplicant','no','page'));

    }
    function viewEditProfile(){
        $user= new users();
        $profile=$user->where('id',$_SESSION['user_info']->user_id)->get();
        return view('editCoachProfile',compact('profile'));
    }
    function viewUpdateBlog(Request $request){
        $blog = new blog();
        $specificBlog= $blog->where('id', $request->input('id'))->get(['title','v_link','link','article','type']);
        $sBlog =$specificBlog[0]->toArray();
        foreach($sBlog as $b) echo $b.'<br>';
    }
    function addBlog(Request $request){
        $blog = new blog();
        $validator= Validator::make($request->all(),$this->blogRule);
        $Err=$validator->errors()->all();
        $session = $request->input('typeOfR');
    if(!isset($_SESSION)) session_start();
        if(count($Err)==0) {
            if($request->input('submit')=='add') {
                $count = $blog->count();
                $insert=$request->except('ID','submit','typeOfR','figure','MAX_FILE_SIZE');
                $insert['figure']='/sys_files/img/homescreen/blog/' . ($count + 1) . '.jpg';
                $insert['user_id']=$_SESSION['user_info']->user_id;
                $insert['created_at']=date('Y-m-d');
                $request->file('figure')->move('sys_files/img/homescreen/blog', ($count+1) . '.jpg');
                $blog->insert([$insert]);
                Session::flash('Added',['Blog entitled "'.$request->input('title').'" Added Successfully']);
               return $this->viewBlog(1);
            } else {
                $blog->where('id',$request->input('ID'))->update($request->except('ID','submit','typeOfR','figure','MAX_FILE_SIZE'));
                    @unlink(public_path() . '\sys_files\img\homescreen\blog\\' . $request->input('ID') . '.jpg');
                $request->file('figure')->move('sys_files/img/homescreen/blog',$request->input('ID').'.jpg');
                Session::flash('Added',['Blog entitled "'.$request->input('title').'" Updated Successfully']);
                return $this->viewBlog(1);
            }
        }
        else{
          Session::flash('Error',[$Err,$session]);
            return redirect()->back();
        }

    }
    function scrapContents(){
        echo "haha<br>";
        $playerData = new playerStatsScrap(new WebScrap("http://stats.humblebola.com/uaap/teams/16-NU-Bulldogs"));
        dd($playerData->getPerPlayerData());
    }
    function viewPlayerStats($page){
        /*$playerData = new playerStatsScrap(new WebScrap("http://stats.humblebola.com/uaap/teams/16-NU-Bulldogs"));
        dd($playerData->getPerPlayerData());*/

        $playerStats = new playerstatsbasketball();
        $haha ='haha';
        $count = $playerStats->count();
        if((($page-1)*8)>$count)
            abort('404');
        $playerStatsList= $playerStats->skip((($page-1)*8))->limit(8)->get();
        return view('coachPlayerStatistics',compact('playerStatsList','count','page','haha'));
    }
    function viewBlog($page){
        if(!isset($_SESSION)) session_start();
        $blog = new blog();
        $count= count($blog->get());
        if(($page-1*8)<=$count) $blogList=$blog->where('user_id',$_SESSION['user_info']->user_id)->skip(($page-1)*8)->take(8)->get();
        else abort('404');
        return view('viewBlog',compact('blogList','count','page'));
    }
    function resetRoster(Request $request){
        if(($request->input('submit'))=="")
                (new rosterforbasketball())->whereBetween('id',[1,15])->update(['player_id'=>0]);
        else
            return redirect()->back();
        return redirect()->route('roster');
    }
    function addSchedule(Request $request){
        $schedule = new schedule();
        if($request->input('submit')=="add") {
            $validator = Validator::make($request->all(), $this->rulesSchedule);
            $Error = $validator->errors()->all();

            if ($validator->passes()) {
                $schedule->insert($request->except('submit'));
                return view('addSchedule')->with('Added', ['Schedule Successfully Added']);
            } else {
                return view('addSchedule',compact('Error'));
            }
        }
        elseif($request->input('submit')=="back") return view('schedule');
        elseif($request->input('submit')=='update'){
                $schedule->where('id',$request->input('sID'))->update($request->except(['sID','submit']));
            return view('addSchedule')->with('Added', ['Schedule Successfully Updated']);
        }
        elseif($request->input('submit')=='delete'){
            $schedule->where('id',$request->input('sID'))->delete();
            return view('addSchedule')->with('Added', ['Schedule Successfully Deleted']);
        }
    }
    function viewAddSchedule(){

        return view('addSchedule');
    }


    function viewRoster(){
        $athleteData=[];
        $ros = new rosterforbasketball();
        foreach($ros->get(['id']) as $roster)
            $athleteData[]=rosterforbasketball::find($roster->id)->athlete()->get();
        return view('rosterCreation',compact('athleteData'));
    }
    function viewListSchedule($page){
        $schedule = new schedule();
        $listOfSchedule = $schedule->skip(($page-1)*8)->take(8)->get();
        $noOfUpcoming = count($schedule->where('date_of','>',date('Y-m-d'))->get());
        $pageCount=count($schedule->get());
        $view='list';
        if(($page-1*8)<=$pageCount)
            return view('schedule',compact('listOfSchedule','pageCount','page','noOfUpcoming','view'));
        else
            abort('404');
    }
    function viewCalendarSchedule(){
        $schedule = new schedule();
        $listOfSchedule = $schedule->get();
        $view='calendar';
        return view('schedule',compact('listOfSchedule','view'));
    }
    function assignTeamID($sport,$gender){
        $team = new team();
        $sports= new sport();
        $sportId=$sports->where('sport_name','=',$sport)->get(['id']);
        $id=$team->where('sport_id',$sportId[0]->id)->where('gender',$gender)->get(['id']);
        return $id[0]['id'];
    }
    function searchAthlete(Request $request){
        $athleteList = (new athlete())->get();
        $out='<tr><th>Profile Picture</th><th>Student ID</th>
             <th>Name <span id="sort" style="cursor: pointer;" class="glyphicon glyphicon-arrow-down"></span> </th>
             <th>Address</th><th>Contact Number</th><th>Update</th><th>Delete</th></tr>';
        foreach($athleteList as $athlete){
            if(strpos($athlete->given_name,$request->input('search'))>-1 || strpos($athlete->last_name,$request->input('search'))>-1 || strpos($athlete->middle_name,$request->input('search'))>-1) {
                $out .= '<tr><td><center><img src="/sys_files/img/profile_pic/user/'.$athlete->profile_pic.'" width="50px" height="50px"></center></td>
    <td>'.$athlete->student_id.'</td>
    <td>'.$athlete->given_name.' '.$athlete->middle_name.' '.$athlete->last_name.' </td>
    <td>'.$athlete->home_address.'</td>
    <td>'.$athlete->contact_number.'</td>
    <td><input class="btn btn-success" type="submit" name="Update'.$athlete->id.'" value="Update"></td>
    <td><input class="btn btn-warning delete" type="submit" name="Delete'.$athlete->id.'" value="Delete"></td><tr>';
                    }
        }
        echo($out);
    }
    function athleteView(Request $request){

       // echo($request->input('id'));
        //echo($request->input('id'));
        $athleteInfo=(new athlete())->where('id',$request->input('id'))->get(['profile_pic','given_name','last_name','middle_name','home_address','birth_day','playing_status','team_type','created_at','team_a_since']);
        $isBasketball=(count((new athlete())->where('id',$request->input('id'))->where('team_id',1)->get())==0);
        $playerStats=count((new playerstatsbasketball())->where('id',$request->input('id'))->get());
        $stats=($isBasketball)? (($playerStats>0)? 'Has Stats':'Has no stats yet'):'Not a Basketball player';

        //print((new \DateTime('2016-03-29'))->diff((new \DateTime('2015-03-29')))->y);
       // echo(date_format(date_create(strval($athleteInfo[0]->created_at)),'M d, Y'));
       $out=$athleteInfo[0]->profile_pic.'-'.$athleteInfo[0]->given_name.' '.$athleteInfo[0]->middle_name." ".$athleteInfo[0]->last_name."-".$athleteInfo[0]->home_address.'-'.date_diff(date_create(strval($athleteInfo[0]->birth_day)),date_create(strval(date('Y-m-d'))))->y.'-'.$athleteInfo[0]->playing_status.'-'.$athleteInfo[0]->team_type.'-'.date_format(date_create(strval($athleteInfo[0]->created_at)),'M d, Y').'-'.(5-intval(date_diff(date_create(strval($athleteInfo[0]->team_a_since)),date_create(strval(date('Y-m-d'))))->y)).'-'.$stats;
       echo($out);
    }
    function sendSanction(Request $request){
        if(!isset($_SESSION)) session_start();
        $a = new sanctionathletes();
        $a->insert(collect($request->all())->merge(collect(['created_at'=>date('Y-m-d'),'coach_id'=>$_SESSION['user_info']->id]))->toArray());
        $athlete=(new athlete())->find($request->input('athlete_id'))->get(['given_name','last_name']);
        event(new EventExecuted($_SESSION['user_info']->id,$request->input('athlete_id'),'sanctionathletes','sends a sanction to'.$athlete[0]->given_name));
        Session::flash('message','Sanction for '.$athlete[0]->given_name.' '.$athlete[0]->last_name.' Sent Successfully');
        return redirect()->back();
    }
    function athleteList(){
        $rosterList=(new rosterforbasketball())->get(['player_id']);
        $athleteListBasketball=(new athlete())->where('team_id','1')->where('team_type','Team A')->get(['id']);
        $athletesID=$rosterList->intersect($athleteListBasketball);

        //foreach($athletesID->all() as $aID)
    }
    //This function handles viewing of Athletes profile, and displays first 5 profile
    function viewAthlete(){
        if(!isset($_SESSION)) session_start();
        $team = new team();
        $teamName= $team->where('id',$_SESSION['user_info']->team_id)->get();
        $athletes= new athlete();
        $pageCount=count($athletes->where('team_id',$_SESSION['user_info']->team_id)->get());
        $athletesInCoach=$athletes->where('team_id',$_SESSION['user_info']->team_id)->get();
        return view('viewAthlete',compact('athletesInCoach','teamName'));
    }
    function updateSchedule($id){
        $schedule = new schedule();
        $sID=$schedule->where('id',$id)->get();
        if(count($sID)==0) abort('404');
        if(!isset($_SESSION)) session_start();
        $editable=($sID[0]->user_id==$_SESSION['user_info']->user_id);
        $sID=$sID[0];
        return view('addSchedule',compact('editable','sID'));
    }

    function viewAddAthlete(){
        $sport = new sport();
        $ListOfSport = $sport->get();
        return view('addAthlete',compact('ListOfSport'));
    }
    function deleteAthlete(Request $request){
        event(new EventExecuted($_SESSION['user_info']->user_id,$request->input('id'),'athlete','Deleted'));
           $athlete = new athlete();
           $user = new users();
            $bool=true;
           $user_id=$athlete->where('id',$request->input('id'))->get(['user_id']);
        $athletename = $athlete->where('id',$request->input('id'))->get(['given_name']);
              $athlete->where('id',$request->input('id'))->delete();
            $user->where('id',$user_id[0]->user_id)->delete();
            Session::flash('message',$athletename[0]->given_name.'Successfully deleted');
            return redirect()->back();
    }
    function addAthlete(Request $request){

        $user=new users();
        $sport = new sport();
        $ListOfSport = $sport->get();
        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['addedAthlete'])){
            $athlete = new athlete();
            $add=$request->only('username','password','Mac');
            $add['type']='athlete';
            $user->insert($add);
            $co = count($user->get());
            $mac = new mac();
            $Macs = explode(',',$request->input('Mac'));
            foreach ($Macs as $m) {
                $mac->insert(['user_id'=>$co,'mac_name'=>trim($m)]);
            }
            $id=$athlete->orderBy('id','desc')->limit(1)->get(['id']);
            $name=$athlete->orderBy('id','desc')->limit(1)->get(['given_name']);

            $athlete->where('id',$id[0]['id'])->update(['user_id'=>count($user->get())]);
            unset($_SESSION['addedAthlete']);
            return view('addAthlete')->with(['Added'=>'Successfully Added','Name'=>$name[0]['given_name'],'ListOfSport'=>$ListOfSport]);
        }
        else {
            $validator = (Validator::make($request->all(), $this->rulesAthlete));
            $Error = $validator->errors()->all();
            if ($validator->passes()) {
                $athlete = new athlete();
                $in = $request->except('_token', 'MAX_FILE_SIZE');
                $in['team_id']=$this->assignTeamID($request->input('sport'),$request->input('gender'));
                $in['profile_pic']=count($athlete->get()).".jpg";
                $athlete->insert($in);
                $request->file('profile_pic')->move("sys_files/img/profile_pic/user/",count($user->get()).".jpg");
               $_SESSION['addedAthlete'] = true;
                event(new EventExecuted($_SESSION['user_info']->user_id,count($athlete->get()),'athlete','Added'));
                return view('addAthlete')->with(['name'=> $request->input('given_name'),'ListOfSport'=>$ListOfSport]);
            } else
                return view('addAthlete', compact('Error','ListOfSport'));
        }

    }
}
