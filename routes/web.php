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


/*__________________Gust Routs______________________________*/
Route::get('/laravelhome', 'Auth\LoginController@showLoginForm')->name('login');
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
Route::get('/learner', 'Auth\LoginController@showLearnerLoginForm')->name('learner');
/*__________________Gust Routs______________________________*/


//Route::middleware(['guest'])->group(function () {

    /************* Home Starts ***************/
    Route::get('/', 'Front\HomeController@index')->name('home');
    Route::post('/homelogin', 'Auth\LoginController@homelogin');
    Route::post('/homesignup', 'Auth\RegisterController@create_user');
    Route::get('/forgotpassword', 'Front\HomeController@ForgotPassword');
    Route::post('/resetemail', 'Front\HomeController@ResetEmail');
    Route::get('/updatepass/{id}', 'Front\HomeController@UpdatePassword');
    Route::post('/updatepass', 'Front\HomeController@ResetPassword');
    /************* Home Ends ***************/

    /************* Categories Starts ***************/
    Route::get('category/{page_slug}', 'Front\CategoryController@GetCategories');
    Route::get('allcategories', 'Front\CategoryController@index');
    /************* Categories Ends ***************/

    /************* Cart Starts ***************/
    Route::resource('/cart', 'Front\CartController');
    Route::post('/addcart', 'Front\CartController@AddCart');
    Route::post('/updatecart', 'Front\CartController@UpdateCart');
    Route::post('/cartremoveitem', 'Front\CartController@RemoveItem');
    Route::get('/undocart', 'Front\CartController@UndoItem');
    Route::get('/reviewcart', 'Front\CartController@ReviewCart');
    /************* Cart Ends ***************/

    /************* Order Detail Starts ***************/
    Route::resource('/orderdetail', 'Front\OrderDetailController');
    Route::post('/learnerlogin', 'Auth\LoginController@LearnerLogin');
    Route::get('/getcountries', 'Front\CartController@GetCountries');
    Route::get('/insertdatacountries', 'Front\CartController@InsertDataCountries');
    Route::get('/addressinfo', 'Front\CartController@AddressInfo');
    Route::get('/selectstate/{id}', 'Front\CartController@SelectState');
    Route::post('/saveaddress', 'Front\CartController@SaveAddress');
    /************* Order Detail Ends ***************/

    /************* Paypal Starts ***************/
    Route::get('/paypal', 'Front\CartController@Paypal');
    Route::get('/paypalsuccess', 'Front\CartController@PayPalSuccess');
    Route::get('/startcourse/{id}', 'Front\CartController@StartCourse');
    /************* Paypal Ends ***************/

    /************* Course Starts ***************/
    Route::get('/course_detail/{id}', 'Front\CourseController@Detail');
    /************* Course Ends ***************/

    /************* Front User Starts ***************/
    Route::resource('/dashboard', 'Front\UserFrontController');
    Route::get('/orders', 'Front\UserFrontController@Orders');
    Route::get('/accountdetail', 'Front\UserFrontController@AccountDetail');
    Route::get('/vieworder/{id}', 'Front\UserFrontController@ViewOrder');
    Route::get('/orderagain/{id}', 'Front\UserFrontController@OrderAgain');
    Route::get('/orderagainsuccess', 'Front\UserFrontController@OGSuccess');
    Route::post('/updateuser', 'Front\UserFrontController@UpdateUser');
    /************* Front User Ends ***************/

    /************* Front Search Starts ***************/
    Route::post('/search', 'Front\HomeController@Search');
    Route::get('/searchtype/{term}', 'Front\HomeController@SearchType');
    Route::get('/searchcourse', 'Front\CategoryController@SearchCourse');
    /************* Front Search Ends ***************/

//});

Route::middleware(['user','verified'])->group(function () {
	/*__________________Front Routs______________________________*/
	Route::get('userquestion', 'QuestionUserController@index');
	Route::get('score', 'QuestionUserController@score');
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


/********** Gernal Q&A Functions *********/
Route::get('/HasItems/{id}', 'QandAController@HasItems');
Route::get('/AnswerCount/{id}', 'QandAController@AnswerCount');
/********** Gernal Q&A Functions *********/

/********** Gernal Login User Functions *********/
Route::get('/user_msg', 'LoginController@UserMSG');
/********** Gernal Login User Functions *********/


/********** Gernal Category Functions *********/
Route::get('/CatChildCount/{id}', 'Category@ChildCount');
Route::get('/HasCat/{id}', 'Category@HasSubItem');
Route::get('/AllCat', 'Category@AllParentsCat');
Route::get('/GetCatID/{id}', 'Category@CatID');
/********** Gernal Category Functions *********/

/********** Gernal Get Country/State Name *********/
Route::get('/getcountryname/{id}', 'Front\CartController@GetCountryName');
Route::get('/getstatename/{id}', 'Front\CartController@GetStateName');
/********** Gernal Get Country/State Name *********/

/********** Gernal Cart Functions *********/
Route::get('/carttotal', 'Front\CartController@CartTotal');
/********** Gernal Cart Functions *********/

/********** Gernal Course Functions *********/
Route::get('/getcourseonid/{id}', 'Front\UserFrontController@GetCourseOnID');
/********** Gernal Course Functions *********/

/********** Gernal User Functions *********/
Route::get('/getuseronid/{id}', 'OrderController@GetUserOnID');
/********** Gernal User Functions *********/


// Route::get('admin_area', ['middleware' => 'admin', function () {
Route::middleware(['admin'])->group(function () {	

    Route::post('/admin/users_add', 'UserController@create_user');
    Route::resource('/admin/users', 'UserController');
    Route::get('/admin/students/{cid}', 'UserController@User_enrolled_in_course');
    Route::get('/admin/user-create', 'UserController@user_create');
    Route::get('/admin/getusers/{id}', 'UserController@getusers');
    Route::get('/email-exist', 'UserController@isEmailExist');
    Route::delete('/admin/user/{id}', 'UserController@destroy');
    Route::get('/user-edit/{squirrel}', 'UserController@edit_user');
    Route::post('/admin/update-user', 'UserController@update_user');
    Route::get('/admin/user-delete/{squirrel}', 'UserController@delete_user');
    Route::get('/admin/my-account', 'UserController@my_account');
    Route::get('/admin/instructor', 'UserController@instructor');
    Route::get('/admin/learner', 'UserController@learner');


    /*************** Categories Starts ***************/
    Route::resource('/admin/categories', 'Category');
    Route::delete('/admin/childitem/categories/{id}', 'Category@destroy');
    Route::get('/admin/category', 'Category@index');
    Route::get('/admin/childitem/{id}', 'Category@ChildItem');
    Route::post('/admin/category_add', 'Category@CategoryAdd');
    Route::get('/admin/getcategories/{cat_id}', 'Category@GetCategories');
    Route::post('/admin/update-category', 'Category@UpdateCategory');
    /*************** Categories Ends ***************/

    /*************** Question & Answer Starts ***************/
    Route::resource('/admin/questionandanswer', 'QandAController');
    Route::delete('/admin/childqa/questionandanswer/{id}', 'QandAController@destroy');
    Route::get('/admin/questionandanswer', 'QandAController@index');
    Route::get('/admin/childqa/{id}', 'QandAController@ChildItem');
    Route::post('/admin/questionandanswer_add', 'QandAController@qandaAdd');
    Route::get('/admin/getquestionandanswer/{cat_id}', 'QandAController@Getqanda');
    Route::get('/admin/getqaexam/{tab_name}', 'QandAController@GeQAExam');
    Route::post('/admin/update-questionandanswer', 'QandAController@Updateqanda');
    /*************** Question & Answer Ends ***************/

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

    /*************** Course Program Starts ***************/
    Route::resource('/admin/courseprogram', 'CourseProgramController');
    Route::get('/admin/courseprogram', 'CourseProgramController@index');
    Route::post('/admin/courseprogram_add', 'CourseProgramController@CourseProgramAdd');
    Route::get('/admin/getcourseprogram/{cp_id}', 'CourseProgramController@GetCourseProgram');
    Route::post('/admin/update-courseprogram', 'CourseProgramController@UpdateCourseProgram');
    /*************** Course Program Ends ***************/

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

    /*************** Testimonial Starts ***************/
    Route::resource('/admin/testimonial', 'TestimonialController');
    Route::get('/admin/testimonial', 'TestimonialController@index');
    Route::post('/admin/testimonial_add', 'TestimonialController@TestimonialAdd');
    Route::get('/admin/gettestimonial/{t_id}', 'TestimonialController@GetTestimonial');
    Route::post('/admin/update-testimonial', 'TestimonialController@UpdateTestimonial');
    /*************** Testimonial Ends ***************/

    /*************** Clients Starts ***************/
    Route::resource('/admin/client', 'ClientController');
    Route::get('/admin/client', 'ClientController@index');
    Route::post('/admin/client_add', 'ClientController@ClientAdd');
    Route::get('/admin/getclient/{c_id}', 'ClientController@GetClient');
    Route::post('/admin/update-client', 'ClientController@UpdateClient');
    /*************** Clients Ends ***************/

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
    Route::post('/admin/updatestatus', 'CoursesController@UpdateCourseStatus');
    Route::post('/admin/update-course', 'CoursesController@UpdateCourse');
    Route::post('/admin/setproduct', 'CoursesController@SetProduct');
    /*************** Courses Ends ***************/

    /*************** Order Starts ***************/
    Route::resource('/admin/Order', 'OrderController');
    Route::get('/admin/orders', 'OrderController@index');
    Route::get('/admin/vieworder/{id}', 'OrderController@ViewOrder');
    /*************** Order Ends ***************/

    Route::resource('facker', 'FakerController');

    Route::get('/admin/home', 'DashboardController@index');

    Route::get('/admin/dashboard', function () {
        return redirect('/' . collect(request()->segments())->first() . '/home');
    });
});

Route::middleware(['instructor'])->group(function () {

    Route::resource('/instructor/users', 'UserController');
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

    /*************** Course Program Starts ***************/
    Route::resource('/instructor/courseprogram', 'CourseProgramController');
    Route::get('/instructor/courseprogram', 'CourseProgramController@index');
    Route::post('/instructor/courseprogram_add', 'CourseProgramController@CourseProgramAdd');
    Route::get('/instructor/getcourseprogram/{cp_id}', 'CourseProgramController@GetCourseProgram');
    Route::post('/instructor/update-courseprogram', 'CourseProgramController@UpdateCourseProgram');
    /*************** Course Program Ends ***************/

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


    /*************** Question & Answer Starts ***************/
    Route::resource('/instructor/questionandanswer', 'QandAController');
    Route::delete('/instructor/childqa/questionandanswer/{id}', 'QandAController@destroy');
    Route::get('/instructor/questionandanswer', 'QandAController@index');
    Route::get('/instructor/childqa/{id}', 'QandAController@ChildItem');
    Route::post('/instructor/questionandanswer_add', 'QandAController@qandaAdd');
    Route::get('/instructor/getquestionandanswer/{cat_id}', 'QandAController@Getqanda');
    Route::get('/instructor/getqaexam/{tab_name}', 'QandAController@GeQAExam');
    Route::post('/instructor/update-questionandanswer', 'QandAController@Updateqanda');
    /*************** Question & Answer Ends ***************/

    Route::get('/instructor/home', 'DashboardController@InstructorDashboard');

    Route::get('/instructor/dashboard', function () {
        return redirect('/' . collect(request()->segments())->first() . '/home');
    });
});

Route::middleware(['learner'])->group(function () {

    Route::resource('/learner/users', 'UserController');
    Route::post('/learner/users_add', 'UserController@create_user');
    Route::get('/learner/students/{cid}', 'UserController@User_enrolled_in_course');
    Route::get('/learner/user-create', 'UserController@user_create');
    Route::get('/learner/getusers/{id}', 'UserController@getusers');
    Route::delete('/learner/user/{id}', 'UserController@destroy');
    Route::post('/learner/users_add', 'UserController@create_user');
    Route::post('/learner/update-user', 'UserController@update_user');
    Route::get('/learner/user-delete/{squirrel}', 'UserController@delete_user');
    Route::get('/learner/my-account', 'UserController@my_account');



    /*************** Assignment Starts ***************/
    Route::resource('/learner/assignment', 'AssignmentController');
    Route::get('/learner/assignment', 'AssignmentController@index');
    Route::post('/learner/assignment_add', 'AssignmentController@AssignmentAdd');
    Route::get('/learner/getassignment/{a_id}', 'AssignmentController@GetAssignment');
    Route::post('/learner/update-assignment', 'AssignmentController@UpdateAssignment');
    Route::get('/learner/getassignmentexam/{tab_name}', 'AssignmentController@GetAssignmentExam');
    /*************** Assignment Ends ***************/

    /*************** Exam Starts ***************/
    Route::resource('/learner/exam', 'Exams');
    Route::get('/learner/exam', 'Exams@index');
    Route::post('/learner/exam_add', 'Exams@ExamsAdd');
    Route::get('/learner/getexam/{exm_id}', 'Exams@GetExams');
    Route::post('/learner/update-exam', 'Exams@UpdateExams');
    /*************** Exam Ends ***************/

    /*************** MockExam Starts ***************/
    Route::resource('/learner/mockexam', 'MexamController');
    Route::get('/learner/mexam', 'MexamController@index');
    Route::post('/learner/mexam_add', 'MexamController@MexamsAdd');
    Route::get('/learner/getmexam/{exm_id}', 'MexamController@GetMexams');
    Route::post('/learner/update-mexam', 'MexamController@UpdateMexams');
    /*************** MockExam Ends ***************/


    /*************** Courses Starts ***************/
    Route::resource('/learner/course', 'CoursesController');
    Route::get('/learner/course', 'CoursesController@index');
    Route::post('/learner/course_add', 'CoursesController@CourseAdd');
    Route::get('/learner/getcourse/{cou_id}', 'CoursesController@GetCourse');
    Route::post('/learner/update-course', 'CoursesController@UpdateCourse');
    /*************** Courses Ends ***************/

    Route::get('/learner/home', 'DashboardController@LearnerDashboard');

    Route::get('/learner/dashboard', function () {
        return redirect('/' . collect(request()->segments())->first() . '/home');
    });
});

// Auth::routes();

Route::get('/sendmail', 'TermAndServicesController@sendmail');


Route::get('/get-started', function () {
    return view('demo');
});

Route::get('/404', function () {
    return view('frontend.404');
});

Route::get('/checkout', 'AuthorizeController@index');
Route::post('/checkout', 'AuthorizeController@chargeCreditCard');
