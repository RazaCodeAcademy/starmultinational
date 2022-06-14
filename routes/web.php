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


Route::get('/conversation', function(){
    return view('frontend.pages.conversation.index');
});

Route::middleware(['middleware' => 'auth:web'])
    ->group(function () {
         // conversation routes here.
        Route::namespace('API')->prefix('conversation')->name('api.')->group(function () {
            Route::post('/search-user', 'ConversationController@searchUser')->name('searchUser');
            Route::post('/send-message', 'ConversationController@sendMessage')->name('sendMessage');
            Route::get('/list', 'ConversationController@getConversationList')->name('getConversationList');
            Route::get('/get-chat', 'ConversationController@getConversationChat')->name('getConversationChat');
        }); 
    });


/////////////////////// Frontend ////////////////////////

/////////////////////////////////////////////////////////


Route::resource('transaction', 'Frontend\TransactionController');
Route::resource('withdraw', 'Frontend\WithdrawController');
Route::resource('referal', 'Frontend\ReferalController');

Route::get('/', 'Frontend\UserController@login')->name('login');
Route::post('/user-login', 'Frontend\UserController@loginuser')->name('user-login');
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
    // Route::get('/', function(){
    //     return redirect()->route('adminLogin');
    // })->name('welcome');
    // Profile Details
    Route::get('/dashboard', 'Frontend\DashboardController@index')->name('dashboard');
    Route::match(['get','post'],'update-employee-details-page','Frontend\DashboardController@updateEmployeeDetailsPage')->name('update-employee-details-page');
    // Ajax Check Current Password
    Route::get('/settings','Frontend\DashboardController@settings')->name('settings');
    Route::post('/check_current','Frontend\DashboardController@chkCurrentpassword')->name('check-current-pwd');
    Route::Post('update-current-password','Frontend\DashboardController@updatepassword')->name('update-current-password');
    Route::get('/notifications','Frontend\DashboardController@notifications')->name('notifications');
    // saved employed jobs
    Route::get('saved-job', 'Frontend\DashboardController@savedjob')->name('saved-job');
    // other pages 
    Route::get('/job-details/{slug}', 'Frontend\DashboardController@job_details')->name('jobDetails');
    Route::get('/job-search', 'Frontend\DashboardController@job_search')->name('job_search');
    Route::get('/{slug}/category', 'Frontend\DashboardController@category')->name('category-job');
    Route::get('/category-job-search', 'Frontend\DashboardController@category_job_search')->name('category-job-search');
    Route::post('save-job/{job_id}', 'Frontend\DashboardController@savejob')->name('save-job');
    Route::post('tending-filter', 'Frontend\DashboardController@trending_filter')->name('tending-filter');
    Route::post('/apply_job/{job_id}/', 'Frontend\DashboardController@apply_job')->name('apply-job');
    Route::post('cat-tending-filter', 'Frontend\DashboardController@category_job_search')->name('cat-tending-filter');
    // Footer Routes
    Route::get('/about-us', 'Frontend\AboutController@about_us')->name('about_us');
    Route::get('/contact_us', 'Frontend\ContactController@contact_us')->name('contact_us');
    Route::post('/contact',    'Frontend\ContactController@ContactUsForm')->name('contact.store');
    Route::get('/site_map', 'Frontend\SiteMapController@site_map')->name('site_map');
    Route::get('/career', 'Frontend\CareerController@carrer')->name('career');
    // old route
    // Route::post('/loginUser', 'Frontend\AuthenticationController@login')->name('userLogin');
    // Route::get('/job-details/{slug}', 'Frontend\IndexController@job_details')->name('jobDetails');
    // Route::get('/job-search', 'Frontend\IndexController@job_search')->name('job_search');
    Route::get('/country-jobs/{id}', 'Frontend\IndexController@countryJobs')->name('countryJobs');
    // Route::get('/category-jobs/{id}', 'Frontend\IndexController@categoryJobs')->name('categoryJobs');
    Route::get('add-language', 'Frontend\IndexController@addLanguage')->name('addLanguage');
    Route::get('remove-language', 'Frontend\IndexController@removeLanguage')->name('removeLanguage');
    Route::get('/candidate-registeration', 'Register\CandidateRegistrationController@registerView')->name('candidate-register');
    Route::get('/employer-registeration', 'Register\EmployerRegistrationController@registerView')->name('employer-register');
});

/////////////////////// Super Admin //////////////////////

/////////////////////////////////////////////////////////

Route::prefix('admin')->namespace('Backend')->group(function (){

    Route::middleware(['admin'])->group(function () {

        Route::resource('manage-account-types', 'AccountTypeController');
        Route::resource('manage-payment-methods', 'PaymentMethodController');
        Route::resource('manage-withdraw', 'WithdrawController');
        Route::resource('manage-transaction', 'TransactionController');

        Route::get('dashboard', 'DashboardController@dashboard')->name('adminDashboard');
        Route::post('filterCountry', 'DashboardController@filterCountry')->name('filterCountryDashboard');
        Route::post('profile-update', 'AuthController@adminUpdateProfile')->name('adminUpdateProfile');

        Route::group(['prefix' => 'countries'], function () {
            Route::get('/', 'CountryController@listCountries')->name('listCountries');
            Route::get('/create', 'CountryController@createCountry')->name('createCountry');
            Route::post('/store', 'CountryController@storeCountry')->name('storeCountry');
            Route::get('/edit/{id}', 'CountryController@editCountry')->name('editCountry');
            Route::post('/update/{id}', 'CountryController@updateCountry')->name('updateCountry');
            Route::post('/delete/{id}', 'CountryController@deleteCountry')->name('deleteCountry');
        });
        Route::group(['prefix' => 'states'], function () {
            Route::get('/', 'StateController@listStates')->name('liststates');
            Route::get('/create', 'StateController@createState')->name('createState');
            Route::post('/store', 'StateController@storeState')->name('storeState');
            Route::get('/edit/{id}', 'StateController@editState')->name('editState');
            Route::post('/update/{id}', 'StateController@updateState')->name('updateState');
            Route::post('/delete/{id}', 'StateController@deleteState')->name('deleteState');
        });

        Route::group(['prefix' => 'cities'], function () {
            Route::get('/', 'CityController@listCities')->name('listCities');
            Route::get('/create', 'CityController@createCity')->name('createCity');
            Route::post('/store', 'CityController@storeCity')->name('storeCity');
            Route::get('/edit/{id}', 'CityController@editCity')->name('editCity');
            Route::post('/update/{id}', 'CityController@updateCity')->name('updateCity');
            Route::post('/delete/{id}', 'CityController@deleteCity')->name('deleteCity');
        });

        Route::group(['prefix' => 'employee'], function () {
            Route::get('/', 'EmployeeController@list')->name('listCandidate');
        });

        Route::group(['prefix' => 'statistics'], function () {
            Route::get('/', 'StatisticController@list')->name('listStatistics');
            Route::post('filterCountry', 'StatisticController@filterCountry')->name('filterCountry');
            Route::post('statistics-filters', 'StatisticController@statisticsFilters')->name('statisticsFilters');
        });

        Route::group(['prefix' => 'employee-business-categories'], function () {
            Route::get('/', 'EmployeeBusinessCategoryController@listCategories')->name('listCategories');
            Route::get('/create', 'EmployeeBusinessCategoryController@createCategory')->name('createCategory');
            Route::post('/store', 'EmployeeBusinessCategoryController@storeCategory')->name('storeCategory');
            Route::get('/edit/{id}', 'EmployeeBusinessCategoryController@editCategory')->name('editCategory');
            Route::post('/update/{id}', 'EmployeeBusinessCategoryController@updateCategory')->name('updateCategory');
            Route::post('/delete/{id}', 'EmployeeBusinessCategoryController@deleteCategory')->name('deleteCategory');
        });

        Route::group(['prefix' => 'candidate-job-locations'], function () {
            Route::get('/', 'JobCandidateLocationController@listLocations')->name('listLocations');
            Route::get('/create', 'JobCandidateLocationController@createLocation')->name('createLocation');
            Route::post('/store', 'JobCandidateLocationController@storeLocation')->name('storeLocation');
            Route::get('/edit/{id}', 'JobCandidateLocationController@editLocation')->name('editLocation');
            Route::post('/update', 'JobCandidateLocationController@updateLocation')->name('updateLocation');
            Route::post('/delete', 'JobCandidateLocationController@deleteLocation')->name('deleteLocation');
        });

        Route::group(['prefix' => 'job-career-levels'], function () {
            Route::get('/', 'JobCareerLevelController@listCareerLevels')->name('listCareerLevels');
            Route::get('/create', 'JobCareerLevelController@createCareerLevel')->name('createCareerLevel');
            Route::post('/store', 'JobCareerLevelController@storeCareerLevel')->name('storeCareerLevel');
            Route::get('/edit/{id}', 'JobCareerLevelController@editCareerLevel')->name('editCareerLevel');
            Route::post('/update/{id}', 'JobCareerLevelController@updateCareerLevel')->name('updateCareerLevel');
            Route::post('/delete/{id}', 'JobCareerLevelController@deleteCareerLevel')->name('deleteCareerLevel');
        });

        Route::group(['prefix' => 'job-qualifications'], function () {
            Route::get('/', 'JobQualificationController@listQualifications')->name('listQualifications');
            Route::get('/create', 'JobQualificationController@createQualification')->name('createQualification');
            Route::post('/store', 'JobQualificationController@storeQualification')->name('storeQualification');
            Route::get('/edit/{id}', 'JobQualificationController@editQualification')->name('editQualification');
            Route::post('/update/{id}', 'JobQualificationController@updateQualification')->name('updateQualification');
            Route::post('/delete/{id}', 'JobQualificationController@deleteQualification')->name('deleteQualification');
        });

        Route::group(['prefix' => 'job-salary-ranges'], function () {
            Route::get('/', 'JobSalaryRangeController@listSalaryRanges')->name('listSalaryRanges');
            Route::get('/create', 'JobSalaryRangeController@createSalaryRange')->name('createSalaryRange');
            Route::post('/store', 'JobSalaryRangeController@storeSalaryRange')->name('storeSalaryRange');
            Route::get('/edit/{id}', 'JobSalaryRangeController@editSalaryRange')->name('editSalaryRange');
            Route::post('/update/{id}', 'JobSalaryRangeController@updateSalaryRange')->name('updateSalaryRange');
            Route::post('/delete/{id}', 'JobSalaryRangeController@deleteSalaryRange')->name('deleteSalaryRange');
        });

        Route::group(['prefix' => 'job-types'], function () {
            Route::get('/', 'JobTypeController@listJobTypes')->name('listJobTypes');
            Route::get('/create', 'JobTypeController@createJobType')->name('createJobType');
            Route::post('/store', 'JobTypeController@storeJobType')->name('storeJobType');
            Route::get('/edit/{id}', 'JobTypeController@editJobType')->name('editJobType');
            Route::post('/update', 'JobTypeController@updateJobType')->name('updateJobType');
            Route::post('/delete', 'JobTypeController@deleteJobType')->name('deleteJobType');
        });

        Route::group(['prefix' => 'languages'], function () {
            Route::get('/', 'LanguageController@listLanguages')->name('listLanguages');
            Route::get('/create', 'LanguageController@createLanguage')->name('createLanguage');
            Route::post('/store', 'LanguageController@storeLanguage')->name('storeLanguage');
            Route::get('/edit/{id}', 'LanguageController@editLanguage')->name('editLanguage');
            Route::post('/update', 'LanguageController@updateLanguage')->name('updateLanguage');
            Route::post('/delete', 'LanguageController@deleteLanguage')->name('deleteLanguage');
        });

        Route::group(['prefix' => 'nationalities'], function () {
            Route::get('/', 'NationalityController@listNationalities')->name('listNationalities');
            Route::get('/create', 'NationalityController@createNationality')->name('createNationality');
            Route::post('/store', 'NationalityController@storeNationality')->name('storeNationality');
            Route::get('/edit/{id}', 'NationalityController@editNationality')->name('editNationality');
            Route::post('/update', 'NationalityController@updateNationality')->name('updateNationality');
            Route::post('/delete', 'NationalityController@deleteNationality')->name('deleteNationality');
        });

        Route::group(['prefix' => 'job-skills'], function () {
            Route::get('/', 'SkillController@listJobSkills')->name('listJobSkills');
            Route::get('/create', 'SkillController@createJobSkill')->name('createJobSkill');
            Route::post('/store', 'SkillController@storeJobSkill')->name('storeJobSkill');
            Route::get('/edit/{id}', 'SkillController@editJobSkill')->name('editJobSkill');
            Route::post('/update', 'SkillController@updateJobSkill')->name('updateJobSkill');
            Route::post('/delete', 'SkillController@deleteJobSkill')->name('deleteJobSkill');
        });

        Route::group(['prefix' => 'manage-users'], function () {
            Route::get('/', 'UserController@listAdmins')->name('listAdmins');
            Route::get('/employers-list', 'UserController@listEmployers')->name('listEmployers');
            Route::get('/create', 'UserController@createUser')->name('createUser');
            Route::post('/store', 'UserController@storeUser')->name('storeUser');
            Route::get('/edit/{id}', 'UserController@editUser')->name('editUser');
            Route::get('/view/{id}', 'UserController@viewUser')->name('viewUser');
            Route::post('/update/{id}', 'UserController@updateUser')->name('updateUser');
            Route::post('/delete', 'UserController@deleteUser')->name('deleteUser');
        });

        Route::group(['prefix' => 'manage-packages'], function () {
            Route::get('/', 'PackageController@list')->name('listPackages');
            Route::get('/create', 'PackageController@create')->name('createPackage');
            Route::post('/store', 'PackageController@store')->name('storePackage');
            Route::get('/edit/{id}', 'PackageController@edit')->name('editPackage');
            Route::get('/view/{id}', 'PackageController@view')->name('viewPackage');
            Route::post('/update/{id}', 'PackageController@update')->name('updatePackage');
            Route::post('/delete', 'PackageController@delete')->name('deletePackage');
        });

        Route::group(['prefix' => 'manage-advertisement'], function () {
            Route::get('/', 'AdvertiseController@list')->name('listAdvertise');
            Route::get('/create', 'AdvertiseController@create')->name('createAdvertise');
            Route::post('/store', 'AdvertiseController@store')->name('storeAdvertise');
            Route::get('/edit/{id}', 'AdvertiseController@edit')->name('editAdvertise');
            Route::get('/view/{id}', 'AdvertiseController@view')->name('viewAdvertise');
            Route::post('/update/{id}', 'AdvertiseController@update')->name('updateAdvertise');
            Route::post('/delete', 'AdvertiseController@delete')->name('deleteAdvertise');
            Route::post('/delete/image', 'AdvertiseController@deleteImage')->name('deleteAdvertiseImage');
            Route::post('/status', 'AdvertiseController@status')->name('statusAdvertise');
        });

        Route::group(['prefix' => 'manage-job-approval'], function () {
            Route::get('/list', 'JobApprovalController@list')->name('listJobApproval');
            Route::post('/job/status/{id}', 'JobApprovalController@status')->name('jobStatus');
            Route::get('/job-detail/{id}', 'JobApprovalController@job_details')->name('employerJobDetail');
        });

        Route::group(['prefix' => 'financial'], function () {
            Route::get('/list', 'FinancialController@list')->name('listFinancial');
            // Route::post('/job/status', 'FinancialController@status')->name('jobStatus');
            Route::post('filterCountry', 'FinancialController@filterCountry')->name('filterCountryFinancial');
        });

        Route::group(['prefix' => 'contact'], function () {
        //contact form routes
        Route::get('/Contactlist', 'ContactController@index')->name('Contactlist');
        Route::post('/deleteContact', 'ContactController@deletecontact')->name('deleteContact');

        });

    });
});

/////////////////////// Sub Admin ///////////////////////

/////////////////////////////////////////////////////////

Route::prefix('sub-admin')->group(function (){

    Route::middleware(['subAdmin'])->group(function () {
        Route::get('dashboard', 'Backend\SubAdminController@dashboard')->name('subAdminDashboard');
        Route::post('profile-update', 'Backend\AuthController@subAdminUpdateProfile')->name('subAdminUpdateProfile');

        Route::group(['prefix' => 'manage-users'], function () {
            Route::get('/', 'Backend\SubAdminController@listUsers')->name('subAdminListUsers');
            Route::get('/create', 'Backend\SubAdminController@createUser')->name('subAdminCreateUser');
            Route::post('/store', 'Backend\SubAdminController@storeUser')->name('subAdminStoreUser');
            Route::get('/edit/{id}', 'Backend\SubAdminController@editUser')->name('subAdminEditUser');
            Route::get('/view/{id}', 'Backend\SubAdminController@viewUser')->name('subAdminViewUser');
            Route::post('/update', 'Backend\SubAdminController@updateUser')->name('subAdminUpdateUser');
            Route::post('/delete', 'Backend\SubAdminController@deleteUser')->name('subAdminDeleteUser');
        });

        Route::group(['prefix' => 'candidates'], function () {
            Route::get('/', 'Backend\SubAdminController@candidateList')->name('subAdminListCandidate');
        });

        Route::group(['prefix' => 'manage-job-approval'], function () {
            Route::get('/list', 'Backend\SubAdminController@jobApprovalList')->name('subAdminListJobApproval');
            Route::post('/job/status', 'Backend\SubAdminController@jobApprovalStatus')->name('subAdminJobStatus');
            Route::get('/job-details/{id}', 'Backend\SubAdminController@job_details')->name('employerJobDetailSubAdmin');
        });

        Route::group(['prefix' => 'financial'], function () {
            Route::get('/list', 'Backend\SubAdminController@financialList')->name('subAdminListFinancial');
            // Route::post('/job/status', 'Backend\SubAdminController@financialStatus')->name('subAdminJobStatus');
        });

        Route::group(['prefix' => 'statistics'], function () {
            Route::get('/', 'Backend\SubAdminController@statisticsList')->name('subAdminListStatistics');
            // Route::post('filterCountry', 'Backend\SubAdminController@filterCountry')->name('filterCountry');
        });

        Route::group(['prefix' => 'manage-advertisement'], function () {
            Route::get('/', 'Backend\SubAdminController@advertiseList')->name('subAdminListAdvertise');
            Route::get('/create', 'Backend\SubAdminController@advertiseCreate')->name('subAdminCreateAdvertise');
            Route::post('/store', 'Backend\SubAdminController@advertiseStore')->name('subAdminStoreAdvertise');
            Route::get('/edit/{id}', 'Backend\SubAdminController@advertiseEdit')->name('subAdminEditAdvertise');
            Route::get('/view/{id}', 'Backend\SubAdminController@advertiseView')->name('subAdminViewAdvertise');
            Route::post('/update/{id}', 'Backend\SubAdminController@advertiseUpdate')->name('subAdminUpdateAdvertise');
            Route::post('/delete', 'Backend\SubAdminController@advertiseDelete')->name('subAdminDeleteAdvertise');
            Route::post('/delete/image', 'Backend\SubAdminController@advertiseDeleteImage')->name('subAdminDeleteAdvertiseImage');
            Route::post('/status', 'Backend\SubAdminController@adevertiseStatus')->name('subAdminStatusAdvertise');
        });

    });

});

/////////////////////// Employer ////////////////////////

/////////////////////////////////////////////////////////

Route::prefix('employer')->group(function (){
    Route::post('/register', 'Register\EmployerRegistrationController@register')->name('employerRegister');
    Route::post('/company-check', 'Register\EmployerRegistrationController@companyCheck')->name('employerCompanyCheck');
    Route::post('/employer-data', 'Register\EmployerRegistrationController@employerData')->name('employerData');
    Route::post('/register-post', 'Register\EmployerRegistrationController@store')->name('employerRegisteration');
    Route::post('/employer-login', 'Employer\AuthController@loginPost')->name('employerLoginPost');

    Route::middleware(['employer'])->group(function () {
        Route::get('dashboard', 'Employer\DashboardController@dashboard')->name('employerDashboard');
        Route::get('profile', 'Employer\ProfileController@profile')->name('employerProfile');
        Route::post('profile', 'Employer\ProfileController@saveProfile');
        Route::post('profile-update', 'Employer\AuthController@employerUpdateProfile')->name('employerUpdateProfile');  // profile updated from right-side bar
        Route::get('manage-job', 'Employer\JobController@manageJob')->name('manageJobs');
        Route::get('manage-candidate/{id}', 'Employer\JobController@manageCandidate')->name('manageCandidates');
        Route::get('manage-match-candidate/{id}', 'Employer\JobController@manageMatchedCandidates')->name('manageMatchedCandidates');
        Route::post('popup-note-update', 'Employer\JobController@employerUpdateNoteCandidate')->name('employerUpdateNoteCandidate');
        Route::post('job-feedback', 'Employer\JobController@jobFeedback')->name('jobFeedback');
        Route::post('job-get-cities', 'Employer\JobController@getcountryCities')->name('getcountryCities');
        Route::get('candidate-cv/{id}', 'Employer\JobController@CV')->name('candidateCV');
        Route::get('create-job', 'Employer\JobController@create')->name('createJob');
        Route::post('create-job', 'Employer\JobController@saveJob');
        Route::get('update-job/{id}', 'Employer\JobController@edit')->name('editJob');
        Route::post('update-job/{id}', 'Employer\JobController@update');
        Route::get('view-job/{id}', 'Employer\JobController@viewJob')->name('viewJob');
        Route::post('delete-job', 'Employer\JobController@delete')->name('deleteJob');
        Route::get('purchase', 'Employer\JobController@purchase')->name('purchase');
        Route::get('package-detail/{id}', 'Employer\JobController@packageDetail')->name('packageDetail');
        Route::get('purchase-history', 'Employer\JobController@purchaseHistory')->name('purchaseHistory');
        Route::get('payment-history', 'Employer\JobController@paymentHistory')->name('paymentHistory');
        Route::get('invoice/{id}', 'Employer\JobController@invoice')->name('invoice');
        Route::post('payment/{id}', 'Employer\JobController@payment')->name('payment');
        Route::get('/payment-success', 'Employer\JobController@paymentSuccess')->name('paymentSuccessful');
        Route::post('job-status', 'Employer\JobController@jobStatus')->name('employerJobStatus');
        Route::get('/saveCvPdf/{id}', 'Employer\JobController@saveCvPdf')->name('saveCvPdf');
    });
});

/////////////////////// Candidate ///////////////////////

/////////////////////////////////////////////////////////

Route::prefix('candidate')->group(function (){
    Route::post('/register', 'Register\CandidateRegistrationController@register')->name('candidateRegister');
    Route::post('/candidate-data', 'Register\CandidateRegistrationController@candidateData')->name('candidateData');
    Route::post('/register-post', 'Register\CandidateRegistrationController@store')->name('candidateRegisteration');
    Route::post('/candidate-login', 'Candidate\AuthController@loginPost')->name('candidateLoginPost');
    Route::post('/candidate-register', 'Candidate\AuthController@registerPost')->name('candidateRegisterPost');

    Route::middleware(['candidate'])->group(function () {
        Route::get('dashboard', 'Candidate\DashboardController@dashboard')->name('candidateDashboard');
        Route::get('profile', 'Candidate\ProfileController@profile')->name('candidateProfile');
        Route::post('profile', 'Candidate\ProfileController@saveProfile');
        Route::post('profile-update', 'Candidate\AuthController@candidateUpdateProfile')->name('candidateUpdateProfile');  // profile updated from right-side bar
        Route::get('resume', 'Candidate\ResumeController@create')->name('resume');
        Route::post('resume', 'Candidate\ResumeController@store');
        Route::get('search-jobs', 'Candidate\SearchController@search')->name('searchJobs');
        Route::get('jobs', 'Candidate\SearchController@jobs')->name('jobs');
        Route::get('timeline', 'Candidate\TimelineController@timeline')->name('timeline');
        Route::get('apply-job/{id}/{user_id}', 'Candidate\TimelineController@applyjob')->name('jobApply');
        Route::post('unapply-job', 'Candidate\TimelineController@unapplyJob')->name('unapplyJob');
        Route::get('job-detail/{slug}', 'Candidate\TimelineController@job_details')->name('jobDetail');
        Route::get('employer-profile/{id}', 'Candidate\TimelineController@employer_profile')->name('employerProfileView');
    });

});