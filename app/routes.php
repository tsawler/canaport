<?php

/**
 * Home Page
 */
Route::any('/','PageController@showHome');
Route::any('/home','PageController@showHome');

//Route::any('/fixnews', 'FixNewsController@fix');

Route::get('/redheadcleanup', function(){
    return View::make('redhead-register');
});

Route::post('/redheadcleanup', function(){

    // build email
    $user = array(
        'email'=>Input::get('email'),
        'name'=>Input::get('name')
    );

    // the data that will be passed into the mail view blade template
    $data = array(
        'users_name'  => $user['name'],
        'the_message'=>Input::get('message'),
        'email'=>Input::get('email')
    );

    // use Mail::send function to send email passing the data and using the $user variable in the closure
    Mail::later(5,'emails.cleanup_email', $data, function($message) use ($user) {
        $message->from('donotreply@canaportlng.com', 'Do not reply');
        $message->to(Config::get('app.contact_email'))->subject('Redhead Cleanup Registration');
        //$message->to('trevor.sawler@gmail.com')->subject('Redhead Cleanup Registration');
    });

    return Redirect::to('/registration+confirmed');
});

/*
 * Email consent routes
 */
Route::get('/emailconsent','EmailConsentController@getShowform');
Route::post('/emailconsent','EmailConsentController@postShowform');

/**
 *
 * Mailing list routes
 */
Route::get('/Signup+For+Updates','MailRecipientController@getJoinList');
Route::post('/Signup+For+Updates','MailRecipientController@postJoinList');


/**
 * TWitter feed Routes
 */
Route::get('/twitter', function()
{
    return Twitter::getUserTimeline(array('screen_name' => 'canaportlng', 'count' => 20, 'format' => 'json'));
});



/**
 *
 * Proces routes
 */
Route::get('/process', function()
{
    return View::make('pages.process');
});


/**
 * Contact Us
 */
Route::get('/Contact+Us', 'ContactController@getContact');
Route::post('/Contact+Us', 'ContactController@postContact');


/**
 *
 * Minutes routes
 */
Route::get('/minutes','MinutesController@showMinutes');


/**
 *
 * newsletter routes
 */
Route::get('/connections','NewsletterController@getNewsletters');



/**
 * Calendar
 */
Route::get('/calendar','CalendarEventController@showEvents');
Route::get('/calendar/addevent','CalendarEventController@showAddEvent');
Route::post('/calendar/addevent','CalendarEventController@handleAddEvent');
Route::get('/calendar/allevents','CalendarEventController@allEvents');
Route::post('/calendar/allevents','CalendarEventController@postAllEvents');
Route::get('/calendar/delete/{eventid}','CalendarEventController@handleDelete');
Route::get('/calendar/editevent/{eventid}','CalendarEventController@editEvent');
Route::post('/calendar/editevent/{eventid}','CalendarEventController@handleEditEvent');


/**
 * Search site
 */
Route::get('/search','SearchController@showSearchPage');
Route::post('/search','SearchController@performSearch');


/**
 * Community Involvement
 */
Route::get('/Community+Involvement','InvolvementController@showPage');
Route::post('/involvement/edit','InvolvementController@editInvolvement');

/**
 * FAQs
 */
Route::get('/faq','FaqController@showFaqPage');
Route::post('/faq/edit','FaqController@editFaq');


/**
 * Misconceptions
 */
Route::get('/misconceptions','MisconceptionsController@showMisconceptionsPage');
Route::post('/misconceptions/edit','MisconceptionsController@editFaq');


/**
 * Gallery
 */
Route::get('/gallery', 'GalleryController@showFeed');


/**
 * Blog (news) Routes
 */
Route::controller('/post', 'BlogController');
Route::post('/searchnews','SearchController@performBlogSearch');
Route::get('/news/{year?}/{month?}', 'PostsController@index')->where(array('year' => '\d{4}', 'month' => '\d{2}'));
Route::get('/news/{slug}', 'PostsController@view');
Route::get('/news.rss', 'PostsController@rss');



/**
 * User/account routes
 */
Route::controller('/users', 'UserController');
Route::get('/verifyaccount','UsersPendingController@validateUser');
Route::controller('/password', 'RemindersController');



/**
 *
 * Ajax routes
 */
Route::controller('/ajax','AjaxController');


/**
 * Menu Routes
 */
Route::controller('/menu', 'MenuController');


/**
 * Admin Routes
 */
Route::controller('/admin','AdminController');


/**
 * Page Routes
 */
Route::get('/Apply+For+Sponsorship','PageController@getApplyforsponorship');
Route::post('/Apply+For+Sponsorship','PageController@postApplyforsponorship');
Route::get('{pagename?}','PageController@showPage');
Route::post('/page/edit','PageController@editPage');

