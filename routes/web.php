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
Route::get('/email-exist', 'Front\UserFrontController@isEmailExist');
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

    /************* Pages Starts ***************/
    Route::get('/contact-us', 'Front\HomeController@ContactUS')->name('contact');
    Route::get('/about-us', 'Front\HomeController@AboutUS')->name('about');
    Route::post('/cfrmcontact', 'Front\HomeController@PostForm');
    /************* Pages Ends ***************/

    /************* Categories Starts ***************/
    Route::get('category/{page_slug}', 'Front\CategoryController@GetCategories');
    Route::get('allcategories', 'Front\CategoryController@index');
    /************* Categories Ends ***************/

    /************* Cart Starts ***************/
    Route::resource('/cart', 'Front\CartController');
    Route::post('/promo', 'Front\CartController@promoCode');
    Route::post('/addcart', 'Front\CartController@AddCart');
    Route::post('/retakecart', 'Front\CartController@RetakeCart');
    Route::post('/updatecart', 'Front\CartController@UpdateCart');
    Route::post('/cartremoveitem', 'Front\CartController@RemoveItem');
    Route::get('/undocart', 'Front\CartController@UndoItem');
    Route::get('/reviewcart', 'Front\CartController@ReviewCart');
    Route::post('/card_auth', 'Front\CartController@CardAuth');
    Route::get('/retake_exam/{cid}', 'Front\CartController@RetakeExam');
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
    /************* Paypal Ends ***************/

    /************* Comment & Like Starts ***************/
    Route::get('/likepost/{cid}', 'Front\CourseController@LikeThis');
    /************* Comment & Like Starts ***************/

    /************* Course Starts ***************/
    Route::get('/course_detail/{course_title}', 'Front\CourseController@Detail');
    Route::get('/startcourse/{id}', 'Front\CartController@StartCourse');
    Route::get('/getcppdf/{cpid}', 'Front\CourseController@GetCPPDF');
    Route::get('/user/mock_exam/{mcid}', 'Front\CourseController@MockExam');
    Route::get('/user/exam/{cid}', 'Front\CourseController@Exam');
    Route::get('/finish_course/{cid}', 'Front\CourseController@FinishCourse');
    Route::get('/quizstart/{cid}', 'Front\CourseController@ExamStart');
    Route::get('/reviews/{cid}', 'Front\CourseController@ReviewsPage');
    Route::get('/mquizstart/{cid}', 'Front\CourseController@MockExamStart');
    Route::get('/courseresult/{type}/{cid}/{eid}', 'Front\CourseController@CourseResult');
    Route::get('/finishquiz/{status}', 'Front\CourseController@FinishQuiz');
    Route::get('/user/newsubscription/{cid}', 'Front\CourseController@NewSubscription');
    Route::post('/saveresult', 'Front\CourseController@SaveResult');
//    Route::post('/saveratings', 'Front\CourseController@SaveRatings');
    Route::post('/saveratings', 'Front\CourseController@SaveReviews');
    Route::post('/storecomments', 'Front\CourseController@StoreComments');
    /************* Course Ends ***************/

    /************* Front User Starts ***************/
    Route::resource('/dashboard', 'Front\UserFrontController');
    Route::get('/orders', 'Front\UserFrontController@Orders');
    Route::get('/accountdetail', 'Front\UserFrontController@AccountDetail');
    Route::get('/vieworder/{id}', 'Front\UserFrontController@ViewOrder');
    Route::get('/orderagain/{id}', 'Front\UserFrontController@OrderAgain');
    Route::get('/orderagainsuccess', 'Front\UserFrontController@OGSuccess');
    Route::post('/updateuser', 'Front\UserFrontController@UpdateUser');
    Route::get('/examresult/{cid}', 'Front\CourseController@ExamResult');
    /************* Front User Ends ***************/

    /************* Front Search Starts ***************/
    Route::post('/search', 'Front\HomeController@Search');
    Route::get('/searchtype/{term}', 'Front\HomeController@SearchType');
    Route::get('/searchcourse', 'Front\CategoryController@SearchCourse');
    /************* Front Search Ends ***************/

    /*************** CMS Starts ***************/
    Route::get('/getcms/{id}', 'Front\CMSController@GetCMS');
    Route::get('/cmsupdate/{id}', 'Front\CMSController@CMSUpdate');
    Route::get('/cmsreload/{name}', 'Front\CMSController@PageReload');
    /*************** CMS Ends ***************/

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
Route::get('/qetanswer/{eid}/{type}/{qid}', 'QandAController@GetAnswer');
Route::get('/qaonid/{id}', 'QandAController@QAonID');
/********** Gernal Q&A Functions *********/

/********** Gernal Exam Functions *********/
Route::get('/questioncount/{eid}/{table_name}', 'QandAController@QuestionCount');
Route::get('/examdata/{qid}/{table_name}', 'QandAController@ExamData');
Route::get('/questiondata/{qid}', 'QandAController@QuestionData');
Route::get('/getquizresult/{exam_id}', 'CourseController@GetQuizResult');
Route::get('/examcount/{cid}', 'CoursesController@ExamCount');
/********** Gernal Exam Functions *********/

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
Route::get('/productcount', 'Front\CartController@GetProductCount');
Route::get('/cartitemsglobal', 'Front\CourseController@CartItemsGlobal');
/********** Gernal Cart Functions *********/

/********** Gernal Course Functions *********/
Route::get('/getcourseonid/{id}', 'Front\UserFrontController@GetCourseOnID');
Route::get('/examincourse', 'CoursesController@ExamInCourse');
Route::get('/studentcount/{cid}', 'Front\CourseController@StudentCount');
Route::get('/curriculumcount/{cid}', 'CoursesController@CurriculumCount');
Route::get('/offerapplied/{id}', 'CoursesController@OfferApplied');
/********** Gernal Course Functions *********/

/********** Gernal CMS Functions *********/
Route::get('/cmsbtn/{cid}/{pid}', 'Front\CMSController@cmsBTN');
/********** Gernal CMS Functions *********/

/********** Gernal Course Program Functions *********/
Route::get('/getcpid/{cpid}', 'CourseProgramController@GetCPONID');
Route::get('/ratingoncourse/{cpid}', 'CourseProgramController@TotalRatingOnCourse');
/********** Gernal Course Program Functions *********/

/********** Gernal User Functions *********/
Route::get('/getuseronid/{id}', 'OrderController@GetUserOnID');
/********** Gernal User Functions *********/

/********** Gernal Ratings Functions *********/
Route::get('/getstars/{cid}', 'Front\CourseController@GetStars');
/********** Gernal Ratings Functions *********/

/********** Gernal Comment Functions *********/
Route::get('/getcomments/{cid}', 'Front\CourseController@GetSubComment');
/********** Gernal Comment Functions *********/


// Route::get('admin_area', ['middleware' => 'admin', function () {
Route::middleware(['admin'])->group(function () {	

    Route::post('/admin/users_add', 'UserController@create_user');
    Route::resource('/admin/users', 'UserController');
    Route::get('/admin/students/{cid}', 'UserController@User_enrolled_in_course');
    Route::get('/admin/user-create', 'UserController@user_create');
    Route::get('/admin/getusers/{id}', 'UserController@getusers');
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
    Route::get('/admin/questionlist/{eid}/{table_name}', 'QandAController@index');
    Route::get('/admin/questionandanswer', 'QandAController@index');
    Route::get('/admin/childqa/{id}', 'QandAController@ChildItem');
    Route::post('/admin/questionandanswer_add', 'QandAController@qandaAdd');
    Route::get('/admin/getquestionandanswer/{cat_id}', 'QandAController@Getqanda');
    Route::get('/admin/getqaexam/{tab_name}', 'QandAController@GeQAExam');
    Route::post('/admin/update-questionandanswer', 'QandAController@Updateqanda');
    Route::get('/admin/updateansstatus/{id}', 'QandAController@UpdateANSStatus');
    /*************** Question & Answer Ends ***************/

    /*************** CMS Starts ***************/
    Route::resource('/admin/cms', 'cmsc');
    Route::get('/admin/cms', 'cmsc@index');
    Route::post('/admin/cms_add', 'cmsc@CMSAdd');
    Route::get('/admin/getcms/{cms_id}', 'cmsc@GetCMS');
    Route::post('/admin/savecms', 'Front\CMSController@SaveCMS');
    Route::post('/admin/update-cms', 'cmsc@UpdateCMS');
    Route::get('/admin/cmstpage/{cms_pid}', 'cmsc@SelectPage');
    /*************** CMS Ends ***************/

    /*************** CurriCulums Starts ***************/
    Route::resource('/admin/coursecurriculum', 'CurriCulums');
    Route::get('/admin/curriculum', 'CurriCulums@index');
    Route::post('/admin/curriculum_add', 'CurriCulums@CurriCulumAdd');
    Route::get('/admin/getcurriculum/{cc_id}', 'CurriCulums@GetCurriCulum');
    Route::post('/admin/update-curriculum', 'CurriCulums@UpdateCurriCulum');
    /*************** CurriCulums Ends ***************/

    /*************** Comment Starts ***************/
    Route::resource('/admin/comment', 'CommentController');
    Route::get('/admin/comment', 'CommentController@index');
    Route::post('/admin/comment_add', 'CommentController@CommentAdd');
    Route::get('/admin/getcomment/{id}', 'CommentController@GetComment');
    Route::post('/admin/update-comment', 'CommentController@UpdateComment');
    Route::get('/admin/comments_blocked/{id}', 'CommentController@CommentsBlocked');
    /*************** Comment Ends ***************/

    /*************** Coupan Starts ***************/
    Route::resource('/admin/coupan', 'CoupanController');
    Route::get('/admin/coupan', 'CoupanController@index');
    Route::post('/admin/coupan_add', 'CoupanController@CoupanAdd');
    Route::get('/admin/getcoupan/{id}', 'CoupanController@GetCoupan');
    Route::post('/admin/update-coupan', 'CoupanController@UpdateCoupan');
    /*************** Coupan Ends ***************/

    /*************** Course Program Starts ***************/
    Route::resource('/admin/courseprogram', 'CourseProgramController');
    Route::get('/admin/courseprogram', 'CourseProgramController@index');
    Route::post('/admin/courseprogram_add', 'CourseProgramController@CourseProgramAdd');
    Route::get('/admin/getcourseprogram/{cp_id}', 'CourseProgramController@GetCourseProgram');
    Route::post('/admin/update-courseprogram', 'CourseProgramController@UpdateCourseProgram');
    Route::post('/admin/update-unit', 'CourseProgramController@UpdateUnits');
    Route::get('/admin/cplisting/{cid}', 'CourseProgramController@CPListing');
    Route::get('/admin/cpunits/{cid}', 'CourseProgramController@Units');
    /*************** Course Program Ends ***************/

    /*************** Exam Starts ***************/
    Route::resource('/admin/exam', 'Exams');
    Route::get('/admin/exam', 'Exams@index');
    Route::get('/admin/examlisting/{cid}', 'Exams@ExamListing');
    Route::post('/admin/exam_add', 'Exams@ExamsAdd');
    Route::post('/admin/selected_exam_add', 'Exams@AddSelectedExam');
    Route::get('/admin/getexam/{exm_id}', 'Exams@GetExams');
    Route::post('/admin/update-exam', 'Exams@UpdateExams');
    Route::post('/admin/update-selected-exam', 'Exams@UpdateSelectedExams');
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

    /*************** Teams Starts ***************/
    Route::resource('/admin/teams', 'TeamsController');
    Route::get('/admin/teams', 'TeamsController@index');
    Route::post('/admin/teams_add', 'TeamsController@TeamsAdd');
    Route::get('/admin/getteams/{t_id}', 'TeamsController@GetTeams');
    Route::post('/admin/update-teams', 'TeamsController@UpdateTeams');
    /*************** Teams Ends ***************/

    /*************** Clients Starts ***************/
    Route::resource('/admin/client', 'ClientController');
    Route::get('/admin/client', 'ClientController@index');
    Route::post('/admin/client_add', 'ClientController@ClientAdd');
    Route::get('/admin/getclient/{c_id}', 'ClientController@GetClient');
    Route::post('/admin/update-client', 'ClientController@UpdateClient');
    /*************** Clients Ends ***************/

    /*************** Topics Starts ***************/
    Route::resource('/admin/topics', 'TopicsController');
    Route::get('/admin/topics', 'TopicsController@index');
    Route::post('/admin/topics_add', 'TopicsController@TopicsAdd');
    Route::get('/admin/gettopics/{tns_id}', 'TopicsController@GetTopics');
    Route::post('/admin/update-cmstopics', 'TopicsController@UpdateTopics');
    /*************** Topics Ends ***************/


    /*************** Courses Starts ***************/
    Route::resource('/admin/course', 'CoursesController');
    Route::get('/admin/course', 'CoursesController@index');
    Route::post('/admin/course_add', 'CoursesController@CourseAdd');
    Route::get('/admin/getcourse/{cou_id}', 'CoursesController@GetCourse');
    Route::post('/admin/updatestatus', 'CoursesController@UpdateCourseStatus');
    Route::post('/admin/update-course', 'CoursesController@UpdateCourse');
    Route::post('/admin/setproduct', 'CoursesController@SetProduct');
    Route::post('/admin/applyoffer', 'CoursesController@ApplyOffer');
    /*************** Courses Ends ***************/

    /*************** Assignment Starts ***************/
    Route::resource('/admin/assignment', 'AssignmentController');
    Route::get('/admin/assignment', 'AssignmentController@index');
    Route::post('/admin/assignment_add', 'AssignmentController@AssignmentAdd');
    Route::get('/admin/getassignment/{a_id}', 'AssignmentController@GetAssignment');
    Route::post('/admin/update-assignment', 'AssignmentController@UpdateAssignment');
    Route::get('/admin/getassignmentexam/{tab_name}', 'AssignmentController@GetAssignmentExam');
    /*************** Assignment Ends ***************/

    /*************** Order Starts ***************/
    Route::resource('/admin/Order', 'OrderController');
    Route::get('/admin/orders', 'OrderController@index');
    Route::get('/admin/vieworder/{id}', 'OrderController@ViewOrder');
    /*************** Order Ends ***************/

    /*************** Reports Starts ***************/
    Route::resource('/admin/areports', 'ReportsController');
    Route::get('/admin/areports', 'ReportsController@index');
    Route::get('/admin/ireports', 'ReportsController@InstructorRreports');
    /*************** Reports Ends ***************/

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
    Route::get('/instructor/examlisting/{cid}', 'Exams@ExamListing');
    Route::post('/instructor/exam_add', 'Exams@ExamsAdd');
    Route::get('/instructor/getexam/{exm_id}', 'Exams@GetExams');
    Route::post('/instructor/update-exam', 'Exams@UpdateExams');
    Route::post('/instructor/selected_exam_add', 'Exams@AddSelectedExam');
    Route::post('/instructor/update-selected-exam', 'Exams@UpdateSelectedExams');
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

    /*************** Assignment Starts ***************/
    Route::resource('/instructor/assignment', 'AssignmentController');
    Route::get('/instructor/assignment', 'AssignmentController@index');
    Route::post('/instructor/assignment_add', 'AssignmentController@AssignmentAdd');
    Route::get('/instructor/getassignment/{a_id}', 'AssignmentController@GetAssignment');
    Route::post('/instructor/update-assignment', 'AssignmentController@UpdateAssignment');
    Route::get('/instructor/getassignmentexam/{tab_name}', 'AssignmentController@GetAssignmentExam');
    /*************** Assignment Ends ***************/


    /*************** Question & Answer Starts ***************/
    Route::resource('/instructor/questionandanswer', 'QandAController');
    Route::delete('/instructor/childqa/questionandanswer/{id}', 'QandAController@destroy');
    Route::get('/instructor/questionlist/{eid}/{table_name}', 'QandAController@index');
    Route::get('/instructor/questionandanswer', 'QandAController@index');
    Route::get('/instructor/childqa/{id}', 'QandAController@ChildItem');
    Route::post('/instructor/questionandanswer_add', 'QandAController@qandaAdd');
    Route::get('/instructor/getquestionandanswer/{cat_id}', 'QandAController@Getqanda');
    Route::get('/instructor/getqaexam/{tab_name}', 'QandAController@GeQAExam');
    Route::post('/instructor/update-questionandanswer', 'QandAController@Updateqanda');
    Route::get('/instructor/updateansstatus/{id}', 'QandAController@UpdateANSStatus');
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

Route::get('/sendmail', 'TopicsController@sendmail');


Route::get('/get-started', function () {
    return view('demo');
});

Route::get('/404', function () {
    return view('frontend.404');
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Route::get('/checkout', 'AuthorizeController@index');
Route::post('/checkout', 'AuthorizeController@chargeCreditCard');
