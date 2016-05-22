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
    Route::post('OAMS/admin/sendSanction',['as'=>'adminSendSanction','uses'=>'admin@sendSanction']);
    Route::get('OAMS/admin/sanction/{id}',['as'=>'adminviewSanction','uses'=>'admin@viewSanction']);
    Route::get('OAMS/admin/athlete/{id}',['as'=>'adminviewSpecificAthlete','uses'=>'admin@viewSpecificsAthlete']);
    Route::get('OAMS/admin/printAthlete/{id}',['as'=>'adminPrintAthleteProfile','uses'=>'admin@printAthlete']);
    Route::post('OAMS/admin/updateAthlete/',['as'=>'adminUpdateAthlete','uses'=>'admin@updateAthlete']);
    Route::get('OAMS/admin/message',['as'=>'adminMessage','uses'=>'admin@viewMessage']);
    Route::post('OAMS/admin/sendMessage',['as'=>'adminSendMessage','uses'=>'admin@sendMessage']);
    Route::get('OAMS/admin/printAthleteList',['as'=>'adminPrintAthleteList','uses'=>'admin@printAthleteList']);
    Route::get('OAMS/admin/schedule',['as'=>'adminSchedule','uses'=>'admin@viewSchedule']);
    Route::get('OAMS/admin/trainingVenue',['as'=>'adminVenue','uses'=>'admin@viewTraining']);
    Route::get('OAMS/admin/trainingSchedule',['as'=>'adminTrainingSchedule','uses'=>'admin@viewTrainingSchedule']);
    Route::post('OAMS/admin/addVenue',['as'=>'adminAddVenue','uses'=>'admin@addTraining']);
    Route::post('OAMS/admin/addAjaxVenue',['as'=>'adminAAddVenue','uses'=>'admin@ajaxAddTraining']);
    Route::post('OAMS/admin/deleteVenue',['as'=>'adminDeleteVenue','uses'=>'admin@deleteTraining']);
    Route::post('OAMS/admin/updateVenue',['as'=>'adminUpdateVenue','uses'=>'admin@updateTraining']);
    Route::post('OAMS/admin/addSchedule',['as'=>'adminAddSchedule','uses'=>'admin@addSchedulePlan']);
    Route::post('OAMS/admin/viewSpecificTraining',['as'=>'adminViewSTraining','uses'=>'admin@viewSpecificTraining']);
    Route::post('OAMS/admin/addSpecificTraining',['as'=>'adminAddSTraining','uses'=>'admin@addTrainingSchedule']);
    Route::post('OAMS/admin/updateSpecificTraining',['as'=>'adminUpdateSTraining','uses'=>'admin@updateTrainingSchedule']);
    Route::get('OAMS/admin/printSchedule/{id}',['as'=>'adminPrintSchedule','uses'=>'admin@printSchedule']);
    Route::get('OAMS/admin/viewScheduleTimetable/{id}',['as'=>'adminViewTimeTable','uses'=>'admin@viewTimeTable']);
    Route::post('OAMS/admin/getScheduleDet',['as'=>'adminGetSchedule','uses'=>'admin@getSchedule']);
    Route::post('OAMS/admin/publishSchedule',['as'=>'adminPublishSchedule','uses'=>'admin@addDatePlan']);
    Route::get('OAMS/admin/gameSchedule',['as'=>'adminViewGameSchedule','uses'=>'admin@viewGameSchedule']);
    Route::post('OAMS/admin/addGameSchedule',['as'=>'adminAddGameSchedule','uses'=>'admin@addGameSchedule']);
    Route::post('OAMS/admin/updateGameSchedule',['as'=>'adminUpdateGameSchedule','uses'=>'admin@updateGameSchedule']);
    Route::post('OAMS/admin/deleteGameSchedule',['as'=>'adminDeleteGameSchedule','uses'=>'admin@deleteGameSchedule']);
    Route::get('OAMS/admin/viewGameVenue',['as'=>'adminGameVenue','uses'=>'admin@viewGameVenue']);
    Route::post('OAMS/admin/addGameVenue',['as'=>'adminAddGameVenue','uses'=>'admin@addGameVenue']);
    Route::post('OAMS/admin/updateGameVenue',['as'=>'adminUpdateGameVenue','uses'=>'admin@updateGameVenue']);
    Route::post('OAMS/admin/deleteGameVenue',['as'=>'adminDeleteGameVenue','uses'=>'admin@deleteGameVenue']);
    Route::get('OAMS/admin/printGameSchedule',['as'=>'adminPrintGameSchedule','uses'=>'admin@printGameSchedule']);
    Route::get('OAMS/admin/viewCoach',['as'=>'adminViewCoach','uses'=>'admin@viewCoach']);
    Route::post('OAMS/admin/viewCoach',['as'=>'adminViewSCoach','uses'=>'admin@viewSCoach']);
    Route::post('OAMS/admin/deleteCoach',['as'=>'adminDeleteCoach','uses'=>'admin@deleteCoach']);
    Route::get('OAMS/admin/addCoach',['as'=>'adminAddCoachV','uses'=>'admin@viewAddCoach']);
    Route::post('OAMS/admin/addCoach',['as'=>'adminAddCoach','uses'=>'admin@addCoach']);
    Route::get('OAMS/admin/cms',['as'=>'adminCMS','uses'=>'admin@viewCMS']);
    Route::post('OAMS/admin/cms/addFAQ',['as'=>'adminAddFaq','uses'=>'admin@addFAQ']);
    Route::post('OAMS/admin/cms/updateFAQ',['as'=>'adminUpdateFaq','uses'=>'admin@updateFAQ']);
    Route::post('OAMS/admin/cms/deleteFAQ',['as'=>'adminDeleteFaq','uses'=>'admin@deleteFAQ']);
    Route::get('OAMS/admin/applicant',['as'=>'adminViewApplicants','uses'=>'admin@viewApplicants']);
    Route::post('OAMS/admin/applicant',['as'=>'adminViewSApplicant','uses'=>'admin@viewSApplicant']);
    Route::get('OAMS/admin/printApplicant/{id}',['as'=>'adminPrintApplicant','uses'=>'admin@printApplicant']);
    Route::get('OAMS/admin/activityLog',['as'=>'adminActivity','uses'=>'admin@viewActivityLog']);
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
