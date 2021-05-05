<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/landing', function () {
        return view('user.landing-page');
})->name('user.landing.page');






                 /*===========  Main Routes  =========== */

Route::get('/','Auth\LoginController@lifeBand')->name('lifeband');

                /*===========  Super Admin  =========== */
Route::group(['middleware'=>['admin','auth'],'prefix'=>'superadmin'],function (){
    Route::get('/home','Admin\AdminController@index')->name('home.index');

                 /*===========  Organizations  =========== */
    Route::group(['prefix'=>'organization'],function (){
        Route::get('/home','Admin\OrganizationController@organizationIndex')->name('organization.home');
        Route::get('/dashboard/{id}','Admin\OrganizationController@organizationDashboard')->name('organization.dashboard');
        Route::post('/status','Admin\OrganizationController@status')->name('organization.account.status');

        Route::get('/social-distance/{id}','Admin\OrganizationController@socialDistance')->name('organization.social.distance');
                 /*=========== Storing Organizations  =========== */
        Route::post('/store','Admin\OrganizationController@organizationStore')->name('organization.store');
        Route::get('/edit/{id}','Admin\OrganizationController@organizationEdit')->name('organization.edit');
        Route::put('/update/{id}','Admin\OrganizationController@organizationUpdate')->name('organization.update');
        Route::delete('/delete/{id}','Admin\OrganizationController@organizationDelete')->name('organization.delete');
                    /*=========== Organizations Users  =========== */
        Route::get('/users/{id}','Admin\OrganizationController@userIndex')->name('organization.users');
        Route::post('/user/filter','Admin\OrganizationController@filter')->name('organization.user.filters');
        Route::get('/employ/tracing','Admin\OrganizationController@employTracing')->name('organization.employ.tracing');
        Route::get('/distance/violation','Admin\OrganizationController@distanceViolation')->name('organization.distance.violation');
//        Route::get('/organization/user/detail/{id}','Admin\OrganizationController@userInfo')->name('organization.user.detail');
//        Route::post('/assign/questionnaire','Admin\OrganizationController@assignQuestionnaire')->name('organization.assign.questionnaire');
    });
                    /*=========== Users Groups  =========== */
    Route::group(['prefix'=>'group','namespace'=>'Admin'],function (){
        Route::get('/create/{id}','GroupController@create')->name('users.group.create');
        Route::post('/store','GroupController@store')->name('users.group.store');
//        Route::get('/edit/{id}','GroupController@edit')->name('users.group.edit');
//        Route::put('/update/{id}','GroupController@update')->name('users.group.update');
//        Route::delete('/delete/{id}','GroupController@delete')->name('users.group.delete');
    });
                    /*===========  Questionnaire  =========== */
    Route::group(['prefix'=>'questionnaire','namespace'=>'Admin'],function (){
        Route::get('/create/{id}','QuestionnaireController@create')->name('create.questionnaire');
                    /*===========  Authentic User Questionnaire  =========== */
        Route::get('/user/{id}','QuestionnaireController@userQuestionnaire')->name('user.questionnaire');
                    /*======================================== */
        Route::post('/store','QuestionnaireController@store')->name('store.questionnaire');
        Route::post('/delete','QuestionnaireController@delete')->name('delete.questionnaire');
        Route::post('/options/store','OptionController@store')->name('store.options');
        Route::post('/options/update','OptionController@update')->name('update.option');
        Route::post('/options/delete','OptionController@delete')->name('delete.option');
                    /*===========  Questionnaire History =========== */
        Route::get('/history/{id}','QuestionnaireController@history')->name('history.questionnaire');
                    /*===========  Authentic Questionnaire History =========== */
        Route::get('/admin/history/{id}','QuestionnaireController@adminHistory')->name('admin.questionnaire.history');
                    /*======================================== */
    });
//                    /*=========== Invite Users =========== */
//    Route::group(['prefix'=>'user-accounts','namespace'=>'Admin'],function (){
//        Route::post('store/email','MailController@store')->name('user.store.email');
//        Route::get('/invite/{email}','UsersAccountController@create')->name('user.invite.mail');
//        Route::post('/store','UsersAccountController@store')->name('store.invited.users');
//    });
                      /*=========== Family Accounts =========== */
    Route::group(['prefix'=>'family-accounts','namespace'=>'Admin'],function (){
        Route::get('/dashboard/{id}','FamilyController@dashboard')->name('family.accounts.dashboard');
        Route::post('/status','FamilyController@status')->name('family.account.status');
        Route::get('/social-distance/{id}','FamilyController@socialDistance')->name('family.social.distance');
                /*=========== Storing Family Account  =========== */
        Route::get('/home','FamilyController@index')->name('family.accounts.home');
        Route::post('/store','FamilyController@store')->name('family.accounts.store');
        Route::get('/edit/{id}','FamilyController@edit')->name('family.accounts.edit');
        Route::put('/update/{id}','FamilyController@update')->name('family.accounts.update');
        Route::delete('/delete/{id}','FamilyController@delete')->name('family.accounts.delete');
               /*=========== Family Account Users  =========== */
        Route::get('/users/{id}','FamilyController@userIndex')->name('family.accounts.users');
        Route::post('/user/filter','FamilyController@filter')->name('family.user.filters');
        Route::get('/employ/tracing','FamilyController@employTracing')->name('family.employ.tracing');
        Route::get('/distance/violation','FamilyController@distanceViolation')->name('family.distance.violation');
    });
                /*=========== Individual Accounts =========== */
    Route::group(['prefix'=>'individual-account','namespace'=>'Admin'],function (){
       Route::get('/dashboard','IndividualController@dashboard')->name('individual.account.dashboard');
       Route::post('/status','IndividualController@status')->name('individual.account.status');
       Route::get('/social-distance','IndividualController@socialDistance')->name('individual.account.social.distance');
       Route::get('/users','IndividualController@usersIndex')->name('individual.account.users');
       Route::get('/user/detail/{id}','IndividualController@userInfo')->name('individual.user.detail');
       Route::post('/user/filter','IndividualController@filter')->name('individual.user.filters');
       Route::post('/user/assign/questionnaire','IndividualController@assignQuestionnaire')->name('individual.assign.questionnaire');
       Route::get('/employ/tracing','IndividualController@employTracing')->name('individual.employ.tracing');
       Route::get('/distance/violation','IndividualController@distanceViolation')->name('individual.distance.violation');
    });

    Route::group(['prefix'=>'response','namespace'=>'Admin'],function (){
        Route::get('/questionnaire/{id}','IndividualController@responseQuestionnaire')->name('questionnaire.response');
        Route::get('/questionnaire/detail/{id}','IndividualController@questionnaireDetail')->name('questionnaire.response.detail');
    });
});
                                                       /*===================================================================================================================== */



                    /*=========== Settings =========== */
Route::group(['prefix'=>'profile','namespace'=>'Admin'],function (){
    Route::get('/create/{id}','AdminController@create')->name('admin.settings.create');
    Route::get('/change-password/{id}','AdminController@changePassword')->name('admin.settings.change.password');
    Route::post('/change-password','AdminController@changePasswordUpdate')->name('admin.change.password');
    Route::get('/edit/{id}','AdminController@editProfile')->name('admin.settings.edit');
    Route::put('/update/{id}','AdminController@profileUpdate')->name('admin.settings.update');
});
                /*=========== Organizations Users  =========== */
Route::get('/organization/user/detail/{id}','Admin\OrganizationController@userInfo')->name('organization.user.detail');
Route::post('/assign/questionnaire','Admin\OrganizationController@assignQuestionnaire')->name('organization.assign.questionnaire');
                /*=========== Invite Users =========== */
Route::group(['prefix'=>'user-accounts','namespace'=>'Admin'],function (){
    Route::post('store/email','MailController@store')->name('user.store.email');
    Route::get('/invite/{email}','UsersAccountController@create')->name('user.invite.mail');
    Route::post('/store','UsersAccountController@store')->name('store.invited.users');
});
                /*=========== User Group  =========== */
Route::group(['prefix'=>'group','namespace'=>'Admin'],function (){
    Route::get('/edit/{id}','GroupController@edit')->name('users.group.edit');
    Route::put('/update/{id}','GroupController@update')->name('users.group.update');
    Route::delete('/delete/{id}','GroupController@delete')->name('users.group.delete');
});
                /*=========== Organization Admin Invite =========== */
Route::group(['prefix'=>'organization','namespace'=>'Admin'],function (){
    Route::post('store/email','MailController@store')->name('organization.user.store.email');
    Route::get('/admin-invite/{email}','UsersAccountController@adminInvite')->name('organization.admin.invite.email');
    Route::post('/store','UsersAccountController@orgAdmin')->name('store.invited.admin');
});


                                                        /*===================================================================================================================== */


                /*===========  Organization Admin  =========== */

Route::group(['middleware'=>['organization','auth'],'prefix'=>'admin'],function (){
    Route::get('/organization/home','Organization\OrganizationController@index')->name('organization.index');
    Route::get('/organization/home','Admin\OrganizationController@organizationIndex')->name('organization.admin.home');
    Route::get('/organization/dashboard/{id}','Admin\OrganizationController@organizationDashboard')->name('organization.admin.dashboard');
    Route::get('/organization/social-distance/{id}','Admin\OrganizationController@socialDistance')->name('organization.admin.social.distance');
                /*=========== Organizations Users  =========== */
    Route::get('/organization/users/{id}','Admin\OrganizationController@userIndex')->name('admin.organization.users');
                /*=========== Organizations Users Group  =========== */
    Route::group(['prefix'=>'group','namespace'=>'Admin'],function (){
        Route::get('/create/{id}','GroupController@create')->name('organization.admin.users.group.create');
        Route::post('/store','GroupController@store')->name('organization.admin.users.group.store');
    });

});



                 /*===========  Family Admin  =========== */

Route::group(['middleware'=>['family','auth'],'prefix'=>'family'],function (){
    Route::get('/account/home','Admin\FamilyController@index')->name('family.admin.home');
    Route::get('/account/dashboard/{id}','Admin\FamilyController@dashboard')->name('family.admin.dashboard');
    Route::get('/account/social-distance/{id}','Admin\FamilyController@socialDistance')->name('family.admin.social.distance');
                                /*=========== Family Account Users  =========== */
    Route::get('/account/users/{id}','Admin\FamilyController@userIndex')->name('family.admin.users');
                                /*===========  Family Account Users Group  =========== */
    Route::group(['prefix'=>'group','namespace'=>'Admin'],function (){
        Route::get('/create/{id}','GroupController@create')->name('family.admin.users.group.create');
        Route::post('/store','GroupController@store')->name('family.admin.users.group.store');
    });
});
                 /*============================================== */


                /*=========== Family Admin Invite =========== */
Route::group(['prefix'=>'family-admin','namespace'=>'admin'],function (){
    Route::get('/invite/{email}','UsersAccountController@familyAdminInvite')->name('family.admin.invite.email');
    Route::post('/store','UsersAccountController@familyAdmin')->name('store.family.invited.admin');
});
                /*=========== Family Users Detail/Assign Questionnaire =========== */
Route::get('/family/user/detail/{id}','Admin\FamilyController@userInfo')->name('family.user.detail');
Route::post('/family/user/assign/questionnaire','Admin\FamilyController@assignQuestionnaire')->name('family.assign.questionnaire');
















Route::group(['middleware'=>['individual','auth'],'prefix'=>'individual'],function (){
    Route::get('/home','Individual\IndividualController@index')->name('individual.index');
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');



//Route::get('/home', 'PayOrderController@store');


//Route::get('/home', 'HomeController@index')->name('home');
