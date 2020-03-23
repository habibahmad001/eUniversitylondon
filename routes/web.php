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
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset_password', 'Auth\ForgotPasswordController@reset_password');
Route::get('/checkUsername', 'Rules@checkUsername');
Route::get('/checkUserEmail', 'Rules@checkUserEmail');
Route::get('/administrator', 'Auth\LoginController@showAdminLoginForm')->name('administrator');
Route::get('/instructor', 'Auth\LoginController@showInstructorLoginForm')->name('instructor');




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

    Route::post('/admin/users_add', 'UserController@create_user');
    Route::resource('/admin/users', 'UserController');
    Route::get('/admin/students/{cid}', 'UserController@User_enrolled_in_course');
    Route::get('/admin/user-create', 'UserController@user_create');
    Route::get('/admin/getusers/{id}', 'UserController@getusers');
    Route::get('/email-exist', 'UserController@isEmailExist');
    Route::delete('/admin/user/{id}', 'UserController@destroy');
    Route::post('/admin/users_add', 'UserController@create_user');
    Route::get('/user-edit/{squirrel}', 'UserController@edit_user');
    Route::post('/admin/update-user', 'UserController@update_user');
    Route::get('/admin/user-delete/{squirrel}', 'UserController@delete_user');
    Route::get('/admin/my-account', 'UserController@my_account');
    Route::get('/admin/instructor', 'UserController@instructor');
    Route::get('/admin/learner', 'UserController@learner');


    /*************** Categories Starts ***************/
    Route::resource('/admin/categories', 'Category');
    Route::get('/admin/category', 'Category@index');
    Route::get('/admin/childitem/{id}', 'Category@ChildItem');
    Route::post('/admin/category_add', 'Category@CategoryAdd');
    Route::get('/admin/getcategories/{cat_id}', 'Category@GetCategories');
    Route::post('/admin/update-category', 'Category@UpdateCategory');
    /*************** Categories Ends ***************/

    /*************** CMS Starts ***************/
    Route::resource('/admin/cms', 'cmsc');
    Route::get('/admin/cms', 'cmsc@index');
    Route::post('/admin/cms_add', 'cmsc@CMSAdd');
    Route::get('/admin/getcms/{cms_id}', 'cmsc@GetCMS');
    Route::post('/admin/update-cms', 'cmsc@UpdateCMS');
    /*************** CMS Ends ***************/

    /*************** CurriCulums Starts ***************/
    Route::resource('/admin/coursecurriculum', 'CurriCulums');
    Route::get('/admin/curriculum', 'CurriCulums@index');
    Route::post('/admin/curriculum_add', 'CurriCulums@CurriCulumAdd');
    Route::get('/admin/getcurriculum/{cc_id}', 'CurriCulums@GetCurriCulum');
    Route::post('/admin/update-curriculum', 'CurriCulums@UpdateCurriCulum');
    /*************** CurriCulums Ends ***************/

    /*************** Exam Starts ***************/
    Route::resource('/admin/exam', 'Exams');
    Route::get('/admin/exam', 'Exams@index');
    Route::post('/admin/exam_add', 'Exams@ExamsAdd');
    Route::get('/admin/getexam/{exm_id}', 'Exams@GetExams');
    Route::post('/admin/update-exam', 'Exams@UpdateExams');
    /*************** Exam Ends ***************/

    /*************** MockExam Starts ***************/
    Route::resource('/admin/mockexam', 'MexamController');
    Route::get('/admin/mexam', 'MexamController@index');
    Route::post('/admin/mexam_add', 'MexamController@MexamsAdd');
    Route::get('/admin/getmexam/{exm_id}', 'MexamController@GetMexams');
    Route::post('/admin/update-mexam', 'MexamController@UpdateMexams');
    /*************** MockExam Ends ***************/

    /*************** Term And Services Starts ***************/
    Route::resource('/admin/termandservices', 'TermAndServicesController');
    Route::get('/admin/termservices', 'TermAndServicesController@index');
    Route::post('/admin/termservices_add', 'TermAndServicesController@TermAndServicesAdd');
    Route::get('/admin/gettermservices/{tns_id}', 'TermAndServicesController@GetTermAndServices');
    Route::post('/admin/update-cmstermservices', 'TermAndServicesController@UpdateTermAndServices');
    /*************** Term And Services Ends ***************/


    /*************** Courses Starts ***************/
    Route::resource('/admin/course', 'CoursesController');
    Route::get('/admin/course', 'CoursesController@index');
    Route::post('/admin/course_add', 'CoursesController@CourseAdd');
    Route::get('/admin/getcourse/{cou_id}', 'CoursesController@GetCourse');
    Route::post('/admin/update-course', 'CoursesController@UpdateCourse');
    /*************** Courses Ends ***************/

    Route::resource('facker', 'FakerController');

    Route::get('/admin/home', 'DashboardController@index');

    Route::get('/admin/dashboard', 'DashboardController@index');

    Route::get('/admin/orders', function () {
        $data['sub_heading']  = 'Order Page';
        $data['page_title']   = 'Orders';
        $data['msg']   = 'Order admin functionality will be implemented soon!';

        return view('home', $data);
    });

});

Route::middleware(['instructor'])->group(function () {


    Route::post('/instructor/users_add', 'UserController@create_user');
    Route::get('/instructor/students/{cid}', 'UserController@User_enrolled_in_course');
    Route::get('/instructor/user-create', 'UserController@user_create');
    Route::get('/instructor/getusers/{id}', 'UserController@getusers');
    Route::delete('/instructor/user/{id}', 'UserController@destroy');
    Route::post('/instructor/users_add', 'UserController@create_user');
    Route::post('/instructor/update-user', 'UserController@update_user');
    Route::get('/instructor/user-delete/{squirrel}', 'UserController@delete_user');
    Route::get('/instructor/my-account', 'UserController@my_account');



    /*************** CurriCulums Starts ***************/
    Route::resource('/instructor/coursecurriculum', 'CurriCulums');
    Route::get('/instructor/curriculum', 'CurriCulums@index');
    Route::post('/instructor/curriculum_add', 'CurriCulums@CurriCulumAdd');
    Route::get('/instructor/getcurriculum/{cc_id}', 'CurriCulums@GetCurriCulum');
    Route::post('/instructor/update-curriculum', 'CurriCulums@UpdateCurriCulum');
    /*************** CurriCulums Ends ***************/

    /*************** Exam Starts ***************/
    Route::resource('/instructor/exam', 'Exams');
    Route::get('/instructor/exam', 'Exams@index');
    Route::post('/instructor/exam_add', 'Exams@ExamsAdd');
    Route::get('/instructor/getexam/{exm_id}', 'Exams@GetExams');
    Route::post('/instructor/update-exam', 'Exams@UpdateExams');
    /*************** Exam Ends ***************/

    /*************** MockExam Starts ***************/
    Route::resource('/instructor/mockexam', 'MexamController');
    Route::get('/instructor/mexam', 'MexamController@index');
    Route::post('/instructor/mexam_add', 'MexamController@MexamsAdd');
    Route::get('/instructor/getmexam/{exm_id}', 'MexamController@GetMexams');
    Route::post('/instructor/update-mexam', 'MexamController@UpdateMexams');
    /*************** MockExam Ends ***************/


    /*************** Courses Starts ***************/
    Route::resource('/instructor/course', 'CoursesController');
    Route::get('/instructor/course', 'CoursesController@index');
    Route::post('/instructor/course_add', 'CoursesController@CourseAdd');
    Route::get('/instructor/getcourse/{cou_id}', 'CoursesController@GetCourse');
    Route::post('/instructor/update-course', 'CoursesController@UpdateCourse');
    /*************** Courses Ends ***************/

    Route::get('/instructor/home', 'DashboardController@InstructorDashboard');

    Route::get('/instructor/dashboard', 'DashboardController@InstructorDashboard');
});

Route::middleware(['learner'])->group(function () {
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
