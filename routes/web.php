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


/*__________________Users Routs______________________________*/

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');
Route::get('verifyemail/{id}', 'Auth\RegisterController@verifyEmail');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('rules', 'Rules@index');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset_password', 'Auth\ForgotPasswordController@reset_password');
Route::get('/checkUsername', 'Rules@checkUsername');
Route::get('/checkUserEmail', 'Rules@checkUserEmail');
Route::get('/administrator', 'Auth\LoginController@showAdminLoginForm')->name('administrator');




Route::middleware(['user','verified'])->group(function () {
	/*__________________Front Routs______________________________*/
	Route::get('userquestion', 'QuestionUserController@index');
	Route::get('score', 'QuestionUserController@score');
	Route::get('dashboard', 'QuestionUserController@dashboard');
	Route::post('saveanswer', 'QuestionUserController@store');
	Route::get('usersearch/{id}', 'QuestionUserController@usersearch');
	Route::get('usersearchall/{id}', 'QuestionUserController@usersearchall');
	Route::get('profile', 'UserController@user_profile');
	Route::post('reset_password', 'UserController@reset_password');
	Route::get('ready-to-play', 'QuestionUserController@ready_quiz');
	Route::get('result', 'QuestionUserController@result');
	


});
// Registration Routes...
Route::get('/register', 'Auth\LoginController@showLoginForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
// Login user
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');


// Route::get('admin_area', ['middleware' => 'admin', function () {
Route::middleware(['admin'])->group(function () {	

    Route::post('/users_add', 'UserController@create_user');
    Route::resource('users', 'UserController');
    Route::get('/user-create', 'UserController@user_create');
    Route::get('/getusers/{id}', 'UserController@getusers');
    Route::get('/email-exist', 'UserController@isEmailExist');
    Route::delete('/user/{id}', 'UserController@destroy');
    Route::post('/users_add', 'UserController@create_user');
    Route::get('/user-edit/{squirrel}', 'UserController@edit_user');
    Route::post('/update-user', 'UserController@update_user');
    Route::get('/user-delete/{squirrel}', 'UserController@delete_user');
    Route::get('/my-account', 'UserController@my_account');
    Route::get('/instructor', 'UserController@instructor');
    Route::get('/learner', 'UserController@learner');
    Route::get('/category', 'Category@index');
    Route::resource('facker', 'FakerController');


    Route::get('/home', function () {
        $data['sub_heading']  = 'Dashboard Page';
        $data['page_title']   = 'Dashboard';
        $data['msg']   = 'You are logged in!';

        return view('home', $data);
    });

    Route::get('/cms', function () {
        $data['sub_heading']  = 'CMS Page';
        $data['page_title']   = 'CMS';
        $data['msg']   = 'You are on CMS page!';

        return view('home', $data);
    });

    Route::get('/course', function () {
        $data['sub_heading']  = 'Course Page';
        $data['page_title']   = 'Course';
        $data['msg']   = 'Course admin functionality will be implemented soon!';

        return view('home', $data);
    });

    Route::get('/orders', function () {
        $data['sub_heading']  = 'Order Page';
        $data['page_title']   = 'Orders';
        $data['msg']   = 'Order admin functionality will be implemented soon!';

        return view('home', $data);
    });

    Route::get('/views', function () {
        $data['sub_heading']  = 'View Page';
        $data['page_title']   = 'Views';
        $data['msg']   = 'View admin functionality will be implemented soon!';

        return view('home', $data);
    });

    Route::get('/termservices', function () {
        $data['sub_heading']  = 'Term & Service Page';
        $data['page_title']   = 'Term & Services';
        $data['msg']   = 'Term & Services admin functionality will be implemented soon!';

        return view('home', $data);
    });

    Route::get('/curriculum', function () {
        $data['sub_heading']  = 'Curriculum Page';
        $data['page_title']   = 'Curriculums';
        $data['msg']   = 'Curriculum admin functionality will be implemented soon!';

        return view('home', $data);
    });

    Route::get('/mexam', function () {
        $data['sub_heading']  = 'Mock Exam Page';
        $data['page_title']   = 'Mock Exams';
        $data['msg']   = 'Mock Exams admin functionality will be implemented soon!';

        return view('home', $data);
    });

    Route::get('/exam', function () {
        $data['sub_heading']  = 'Exam Page';
        $data['page_title']   = 'Exams';
        $data['msg']   = 'Exams admin functionality will be implemented soon!';

        return view('home', $data);
    });

});

Route::middleware(['employee'])->group(function () {
    Route::get('/employee', "JobsEmployee@index");
    Route::get('/employee_listing', "JobsEmployee@employee_listing");
});

Route::middleware(['employer'])->group(function () {
    Route::get('/employer', "JobsEmployer@index");
    Route::get('/employer_listing', "JobsEmployer@employer_listing");
    Route::get('/create_job', "JobsEmployer@create_job");
    Route::post('/emp_c_j', "JobsEmployer@emp_c_j");
});

/*___________________Public Routs______________________________*/
Route::get('/contactus', "JobsController@contact_us");
Route::post('/email_form', "JobsController@email_form");

Route::get('/jobs', "JobsController@index");
Route::get('/alljobs/{id}', "JobsController@catjobs");
Route::get('/jobdetail/{id}', "JobsController@jobdetail");
Route::get('/adminjobs', "Rules@joblisting");

Route::post('/search', "JobsController@search")->name('search');
/*___________________Public Routs______________________________*/




// Auth::routes();



Route::get('/get-started', function () {
    return view('demo');
});
