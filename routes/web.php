<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
// Auth::routes();
Route::get('/clear', function(){
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return 'all cache has been removed and reset appliation succussfuly!';
});


/////////////////////// Frontend ////////////////////////

/////////////////////////////////////////////////////////

Route::get('/', 'Frontend\UserController@login')->name('login');
Route::post('/user-login', 'Frontend\UserController@loginuser')->name('user-login');
Route::get('/user/profile/{id}', 'Frontend\UserController@profile')->name('user-profile');
Route::get('/register', 'Frontend\UserController@create')->name('register');
Route::post('/user-register', 'Frontend\UserController@store')->name('user-register');
Route::get('login/{provider}', 'Frontend\SocialController@redirectToProvider');
Route::get('{provider}/callback', 'Frontend\SocialController@handleProviderCallback');
Route::get('logout','Frontend\UserController@logout')->name('logout');
// forget password routes
Route::get('forget-password', [ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
Route::post('forget-password', [ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
Route::post('reset-password', [ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');

Route::middleware(['frontend'])->group(function () {
    Route::get('/welcome', 'Frontend\IndexController@index')->name('welcome');
    
    Route::resource('transaction', 'Frontend\TransactionController');
    Route::resource('feedback', 'Frontend\FeedbackController');
    Route::resource('withdraw', 'Frontend\WithdrawController');
    Route::resource('referal', 'Frontend\ReferalController');
    Route::resource('wallet', 'Frontend\WalletController');
    Route::resource('membership', 'Frontend\MembershipController');
    Route::resource('search', 'Frontend\SearchController');
    Route::get('user_search', 'Frontend\SearchController@search')->name('search_sponser');
    Route::get('/account_update', 'Frontend\MembershipController@account_type')->name('userAccountupdate');
    // Route::get('/', function(){
    //     return redirect()->route('adminLogin');
    // })->name('welcome');
    // Profile Details
    Route::get('/dashboard', 'Frontend\DashboardController@index')->name('dashboard');
    Route::match(['get','post'],'update-employee-details-page','Frontend\DashboardController@updateEmployeeDetailsPage')->name('update-employee-details-page');
    // // Ajax Check Current Password
    // Route::get('/settings','Frontend\DashboardController@settings')->name('settings');
    // Route::post('/check_current','Frontend\DashboardController@chkCurrentpassword')->name('check-current-pwd');
    // Route::Post('update-current-password','Frontend\DashboardController@updatepassword')->name('update-current-password');
    // Route::get('/notifications','Frontend\DashboardController@notifications')->name('notifications');
   
 
   
});

/////////////////////// Admin //////////////////////

/////////////////////////////////////////////////////////

Route::prefix('admin')->namespace('Backend')->group(function (){

    Route::middleware(['admin'])->group(function () {

        Route::resource('manage-feedback', 'FeedbackController');
        Route::resource('manage-account-types', 'AccountTypeController');
        Route::resource('manage-payment-methods', 'PaymentMethodController');
        Route::resource('manage-withdraw', 'WithdrawController');

        Route::resource('manage-transaction', 'TransactionController');
        Route::resource('manage-request', 'RequestController');
        Route::get('/manage-withdraw_status/{id}', 'WithdrawController@status')->name('manage_withdraw_status');
        Route::get('dashboard', 'DashboardController@dashboard')->name('adminDashboard');
        Route::post('filterCountry', 'DashboardController@filterCountry')->name('filterCountryDashboard');
        Route::post('profile-update', 'AuthController@adminUpdateProfile')->name('adminUpdateProfile');
       
        Route::group(['prefix' => 'manage-users'], function () {
            Route::get('/', 'UserController@listAdmins')->name('listAdmins');
            Route::get('/account_type/{id}', 'UserController@account_type')->name('userAccounttype');
            Route::get('/employers-list', 'UserController@listEmployers')->name('listEmployers');
            Route::get('/create', 'UserController@createUser')->name('createUser');
            Route::post('/store', 'UserController@storeUser')->name('storeUser');
            Route::get('/edit/{id}', 'UserController@editUser')->name('editUser');
            Route::get('/view/{id}', 'UserController@viewUser')->name('viewUser');
            Route::post('/update/{id}', 'UserController@updateUser')->name('updateUser');
            Route::post('/delete', 'UserController@deleteUser')->name('deleteUser');
        });

     


       

    });
});