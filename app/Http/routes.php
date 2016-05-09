<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//-----------------------------------HOME SCREEN ROUTES-----------------------------------------------------//
Route::get('/',['as'=>'Home','uses'=>'home@view']);
Route::get('/blog/{id}',['as'=>'viewBlog','uses'=>'home@specificBlog']);
Route::get('/apply',['as'=>'apply','uses'=>'home@viewApply']);
Route::post('/apply',['as'=>'addApplicant','uses'=>'home@addApplicant']);
Route::get('/OAMS',['as'=>'loginAs','uses'=>'walaAkoMaisip@lipat']);
Route::get('/OAMS/logout',['as'=>'logOut','uses'=>'walaAkoMaisip@logout']);
Route::get('/contact',['as'=>'contact','uses'=>'home@contact']);
Route::get('/about',['as'=>'about','uses'=>'home@about']);
Route::post('/sendMessage',['as'=>'sendContact','uses'=>'home@sendMessage']);
//------------------------------------------------------------------------------------------------------------//
//----------------------------COACH ROUTES---------------------------------------------------------------------//
Route::post('/OAMS/coach/profilepic',['middleware'=>'coachcheck','as'=>'profilepic','uses'=>'coach@sendPic']);
Route::post('/OAMS/coach/searchAthlete',['middleware'=>'coachcheck','as'=>'athleteSearch','uses'=>'coach@searchAthlete']);
Route::post('/OAMS/coach/addAthlete',['middleware' => 'coachcheck','as'=>'addingAthlete','uses'=>'coach@addAthlete']);
Route::get('/OAMS/coach/addAthlete',['middleware' => 'coachcheck','as'=>'addAthlete','uses'=>'coach@viewAddAthlete']);
Route::get('/OAMS/coach/Athlete',['middleware' => 'coachcheck','as'=>'viewAthlete','uses'=>'coach@viewAthlete']);
Route::get('/OAMS/coach/Schedule/list/{page}',['middleware' => 'coachcheck','as'=>'viewListSchedule','uses'=>'coach@viewListSchedule']);
Route::get('/OAMS/coach/Schedule/calendar',['middleware' => 'coachcheck','as'=>'viewCalendarSchedule','uses'=>'coach@viewCalendarSchedule']);
Route::get('/OAMS/coach/Athlete/',['middleware' => 'coachcheck','as'=>'viewAthlete','uses'=>'coach@viewAthlete']);
Route::get('/OAMS/coach/addSchedule/',['middleware' => 'coachcheck','as'=>'viewAddSchedule','uses'=>'coach@viewAddSchedule']);
Route::post('/OAMS/coach/addSchedule/',['middleware' => 'coachcheck','as'=>'addSchedule','uses'=>'coach@addSchedule']);
Route::get('/OAMS/coach/UpdateSchedule/{id}',['middleware' => 'coachcheck','as'=>'updateSchedule','uses'=>'coach@updateSchedule']);
Route::post('/OAMS/coach/Athlete/',['middleware' => 'coachcheck','as'=>'deleteAthlete','uses'=>'coach@deleteAthlete']);
Route::get('/OAMS/coach/editProfile',['middleware'=>'coachcheck','as'=>'viewEditProfile','uses'=>'coach@viewEditProfile']);
Route::post('/OAMS/coach/editProfile',['middleware'=>'coachcheck','as'=>'editProfile','uses'=>'coach@editProfile']);
Route::get('/OAMS/coach/Applicant/{page}',['middleware'=>'coachcheck','as'=>'viewApplicant','uses'=>'coach@viewApplicant']);
Route::post('/OAMS/coach/Applicant/update',['middleware'=>'coachcheck','as'=>'updateApplicant','uses'=>'coach@updateApplicant']);
Route::post('/OAMS/coach/Applicant/{page}',['middleware'=>'coachcheck','as'=>'acceptApplicant','uses'=>'coach@viewEditModalApplicant']);
Route::get('/OAMS/coach/Blog/{page}',['middleware'=>'coachcheck','as'=>'viewBlog','uses'=>'coach@viewBlog']);
Route::post('/OAMS/coach/Blogs',['middleware'=>'coachcheck','as'=>'addBlog','uses'=>'coach@addBlog']);
Route::post('/OAMS/coach/ViewUpdateBlog',['middleware'=>'coachcheck','as'=>'viewUpdateBlog','uses'=>'coach@viewUpdateBlog']);
Route::get('/OAMS/coach/playerStatistics/{page}',['middleware'=>'coachcheck','as'=>'viewPlayerStats','uses'=>'coach@viewPlayerStats']);
Route::post('/OAMS/coach/playerStatisticsScrap',['middleware'=>'coachcheck','as'=>'playerStatsScrap','uses'=>'coach@scrapContents']);
Route::get('/OAMS/coach/rosterCreation',['middleware'=>'coachcheck','as'=>'roster','uses'=>'coach@viewRoster']);
Route::post('/OAMS/coach/resetRoster',['middleware'=>'coachcheck','as'=>'resetRoster','uses'=>'coach@resetRoster']);
Route::post('/OAMS/coach/roster/athletes',['middleware'=>'coachcheck','as'=>'athletesList','uses'=>'coach@athletesList']);
Route::post('/OAMS/coach/viewAthlete',['middleware'=>'coachcheck','as'=>'athleteView','uses'=>'coach@athleteView']);
Route::post('/OAMS/coach/athlete/sanction',['middleware'=>'coachcheck','as'=>'sendSanction','uses'=>'coach@sendSanction']);
//---------------------------------------------------------------------------------------------------------------------------//


//-------------------------------------------------------Athlete-----------------------------------------------------------//
Route::get('/OAMS/athlete/calendar',['middleware'=>'athletecheck','as'=>'athleteSchedule','uses'=>'athletes@viewCalendarSchedule']);
Route::get('/OAMS/athlete/list/{page}',['middleware'=>'athletecheck','as'=>'athleteListSchedule','uses'=>'athletes@viewListSchedule']);
Route::get('/OAMS/athlete/profile',['middleware'=>'athletecheck','as'=>'athleteProfile','uses'=>'athletes@athleteProfile']);
Route::post('/OAMS/athlete/profile',['middleware'=>'athletecheck','as'=>'updateAthleteProfile','uses'=>'athletes@updateAthleteProfile']);


//-------------------------------------------Admin------------------------------------------------------------------//
Route::group(['middleware'=>'admincheck'],function(){
    Route::get('OAMS/admin/',['as'=>'adminHome','uses'=>'admin@home']);
    Route::get('OAMS/admin/athlete',['as'=>'adminviewAthlete','uses'=>'admin@viewAthlete']);
    Route::post('OAMS/admin/specificathlete',['as'=>'adminviewSAthlete','uses'=>'admin@viewSpecificAthlete']);
    Route::get('OAMS/admin/deleteAthlete/{id}',['as'=>'admindeleteAthlete','uses'=>'admin@deleteAthlete']);
    Route::get('OAMS/admin/addAthlete',['as'=>'adminAddAthlete','uses'=>'admin@viewAddAthlete']);
    Route::get('OAMS/admin/addAthlete/step2',['as'=>'adminAddAthlete2','admin@addAthlete2']);
    Route::post('OAMS/admin/addAthlete',['as'=>'adminAddAthletes','uses'=>'admin@addAthlete']);
    Route::post('OAMS/admin/addAthleteForReal',['as'=>'adminAddAthleteForReal','uses'=>'admin@addAthleteForReal']);
    });
//--------------------------------------------------------------------------------------------------
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/login',['as'=>'login','uses'=>'login@validateMac']);
    Route::post('/login',['as'=>'loginInto','uses'=>'login@validateCredentials']);
});
