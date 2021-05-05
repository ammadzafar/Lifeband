<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {

                           /*===========  User Data  =========== */
    Route::get('individual/user/data','Api\UserAccountController@show');
    Route::post('individual/user','Api\UserAccountController@store');


                           /*===========  User Profile Update  =========== */
//    Route::get('individual/user/edit','Api\UserAccountController@edit');
//    Route::put('individual/user/update','Api\UserAccountController@update');


                           /*===========  User Heart Rate  =========== */
    Route::get('individual/user/heart-rate/show','Api\UserHeartRateController@showHeartRate');
    Route::post('individual/user/heart-rate/store','Api\UserHeartRateController@storeHeartRate');
                          /*===========  User Blood Oxygen  =========== */
    Route::get('individual/user/blood-oxygen/show','Api\UserBloodOxygenController@showBloodOxygen');
    Route::post('individual/user/blood-oxygen/store','Api\UserBloodOxygenController@storeBloodOxygen');
                           /*===========  User Body Temperature  =========== */
    Route::get('individual/user/body-temperature/show','Api\BodyTemperatureController@show');
    Route::post('individual/user/body-temperature/store','Api\BodyTemperatureController@store');
                           /*===========  User Fatigue  =========== */
    Route::get('individual/user/fatigue/show','Api\FatigueController@show');
    Route::post('individual/user/fatigue/store','Api\FatigueController@store');
                          /*===========  User Blood Pressure  =========== */
    Route::get('individual/user/blood-pressure/show','Api\BloodPressureController@show');
    Route::post('individual/user/blood-pressure/store','Api\BloodPressureController@store');
                          /*===========  User Pedometer  =========== */
    Route::get('individual/user/pedometer/show','Api\PedometerController@show');
    Route::post('individual/user/pedometer/store','Api\PedometerController@store');
                           /*===========  User Sleep  =========== */
    Route::get('individual/user/sleep/show','Api\SleepController@show');
    Route::post('individual/user/sleep/store','Api\SleepController@store');
                          /*===========  User Corona Alert  =========== */
    Route::get('individual/user/corona-alert/show','Api\CoronaAlertController@show');
    Route::post('individual/user/corona-alert/store','Api\CoronaAlertController@store');
                          /*===========  User Measure  =========== */
    Route::get('individual/user/measure/show','Api\MeasureController@show');
    Route::post('individual/user/measure/store','Api\MeasureController@store');
                        /*===========  Data Sharing Permission  =========== */
    Route::post('data/sharing/permission','Api\PermissionController@permission');
                        /*===========  Reset Data  =========== */
    Route::Delete('reset/data','Api\ResetDataController@resetData');
                        /*===========  Excercise  =========== */
    Route::get('excercise/data','Api\ExcerciseController@show');
    Route::post('excercise/data/store','Api\ExcerciseController@store');
                        /*===========  Running  =========== */
    Route::get('running/data','Api\RunningController@show');
    Route::post('running/data/store','Api\RunningController@store');
                        /*===========  Weekly Report  =========== */
    Route::get('weekly/report','Api\HealthWeeklyController@show');
                        /*===========  User Feedback  =========== */
    Route::post('feedback','Api\FeedbackController@store');
                        /*===========  User Questionnaire  =========== */
    Route::get('questionnaire','Admin\QuestionnaireController@show');
    Route::post('answers','Admin\QuestionnaireController@storeUserAnswers');
                        /*===========  Running History  =========== */
    Route::get('history','Api\HistoryController@show');
                       /*===========  Change Password  =========== */
    Route::post('change-password','Api\ChangePasswordController@show');
                       /*===========  Find Excercise,Running and Measure record  =========== */
    Route::get('multiple-record','Api\MultipleRecordController@show');
                       /*===========  Band Address  =========== */
    Route::post('band-address','Api\BandAddressController@store');

});



                         /*===========  User Register/Login  =========== */
Route::post('/register','Api\AuthController@register');
Route::post('/login','Api\AuthController@login');
                        /*===========  Social Login Facebook & Google =========== */
Route::post('/social-login','Api\AuthController@socialLogin');

                        /*=========== User Forgot Password  =========== */
Route::post('password/send/email','Api\ForgotPasswordController@sendResetEmail');
//Route::post('password/find','Api\ForgotPasswordController@findToken');
Route::post('password/reset','Api\ForgotPasswordController@resetPassword');

                        /*=========== User Email Verification  =========== */
Route::post('send/email','Api\VerificationController@sendEmail');
Route::get('email/verify/{email}','Api\VerificationController@verify');
