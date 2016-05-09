<?php

namespace App\Http\Controllers;

use App\blog;
use Illuminate\Http\Request;
use App\sport;
use App\Http\Requests;
use App\applicant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\users;
use App\staff;
use App\coach;
use App\hsvcount;
use App\homescreencarousel;
use App\contactmessage;

class home extends Controller
{
    public $rulesContact = [
        'sender' => 'regex:/[a-zA-z\s]/|required|min:5',
        'email' => 'email|required',
        'contactno' => 'min:11|max:11|numeric',
        'message' => 'min:10|required'
    ];
    public $rulesApplicant=[
        'given_name'=> 'alpha|required|min:3',
        'email'=> 'email|required'
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
    function contact(){
        return view('contact');
    }
    function about(){
        return view('about');
    }
    function sendMessage(Request $request){
        $validate =  Validator::make($request->all(),$this->rulesContact);
        if($validate->fails()){
            $errormsg = $validate->errors()->all();
            Session::flash('errors',$errormsg);
            return redirect()->back()->withInput($request->all());
        }
        $insertVal = $request->all();
        $insertVal['created_at']=date('Y-m-d');
        contactmessage::insert([$insertVal]);
        Session::flash('success','Successfully send, please wait '.$request->input('sender').' our response to your email');
        return redirect()->back();
    }
    function view(){
        $carouselpics = homescreencarousel::get(['image']);

        $Blog = new blog();
        $viewCount = new hsvcount();
        $views= $viewCount->where('view_count',$viewCount->get(['view_count'])[0]->view_count)->update(['view_count'=>($viewCount->get(['view_count'])[0]->view_count+1)]);
        $blogCon= $Blog->take(4)->orderBy('created_at','desc')->get();
        return view('home',compact('blogCon','carouselpics'));
    }
    function addApplicant(Request $request){

        $sport = new sport();
        $ListOfSport= $sport->get();
        $applicant= new applicant();
            $valid=Validator::make($request->all(),$this->rulesApplicant);
        $Error = $valid->errors()->all();
            if($valid->passes()&&$request->hasFile('profile_pic')){
               $in = count($applicant->get())+1;
                   $t=$request->except(['MAX_FILE_SIZE']);
                $request->file('profile_pic')->move('sys_files/img/profile_pic/applicant/',$in.'.jpg');

                $t['profile_pic']=$in.'.jpg';
                $applicant->insert($t);
                return view('application',compact('ListOfSport'))->with('Added','Please check your email for notifications, thank you');

            }
        else return view('application',compact('ListOfSport'))->with('Error',$Error);
    }
    function viewApply(){
        $sport = new sport();
        $ListOfSport= $sport->get();
        return view('application',compact('ListOfSport'));
    }
    function specificBlog($id){
        $Blog = new blog();
        $user = new users();
        $coach = new coach();
        $staff = new staff();
        $blogCon= $Blog->where('id',$id)->get();
        $userType=($user->where('id',$blogCon[0]->user_id)->get(['type']));
        $uploaderInfo= ($userType[0]->type=='coach')? $coach->where('user_id',$blogCon[0]->user_id)->get(['firstname','surname','middlename','profile_pic']):$staff->where('user_id',$blogCon[0]->user_id)->get(['firstname','surname','middlename','profile_pic']);
        if(count($blogCon)==0) abort('404');
        return view('blog',compact('blogCon','uploaderInfo'));
    }
}
