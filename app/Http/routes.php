<?php
//both
Route::get('/','HomeController@index');//->middleware('auth');
Route::auth();
//employees
Route::get('/home', 'HomeController@index')->middleware('auth');
Route::get('/settings','EmployeeController@settings')->middleware('employee');
Route::post('/employee/update/','EmployeeController@update');
//Search
Route::get('/search', 'searchController@index')->middleware('auth');
Route::get('/search/data', 'searchController@getAlumniData')->middleware('auth');
Route::get('/graphs','searchController@graphs')->middleware('auth');
Route::get('/statistics/{dataType}','StatisticsController@getDataPer')->middleware('auth');
Route::post('/mail', 'AlumniController@getEmail')->middleware('auth');
Route::post('/sendmail', 'AlumniController@send')->middleware('auth');

//Educations
Route::get('/educations', 'CollectionController@index');
Route::post('/education/create', 'CollectionController@create');
//stats
Route::get('/statistics/{dataType}','StatisticsController@getDataPer')->middleware('auth');
Route::get('/statistics/{dataType}/percentage','StatisticsController@getPercentagesDataPer')->middleware('auth');
Route::get('/statistics/{dataType}/percentageTotal','StatisticsController@getTotalPercentagesDataPer')->middleware('auth');
Route::get('/statistics/{dataType}/percentageAll','StatisticsController@getAllPercentagesDataPer')->middleware('auth');
Route::get('/directie/map','StatisticsController@maps')->middleware('directie');
Route::post('/mail', 'AlumniController@getEmail')->middleware('auth');
Route::post('/sendmail', 'AlumniController@send')->middleware('auth');
//Employees
Route::get('/employees','EmployeeController@index')->middleware('admin');
//Group
Route::get('/groups','GroupController@index')->middleware('employee');
Route::post('/group/create','GroupController@create')->middleware('employee');
Route::post('/group/add','GroupController@addToGroup');
Route::get('/group/select/{groupID}','GroupController@groupMembers')->middleware('employee');
Route::get('/groups/test','GroupController@test')->middleware('employee');
//Alumni
Route::get('/alumnus', 'AlumniController@profile')->middleware('alumnus');
Route::get('/alumnus/create', 'AlumniController@create');
Route::post('/alumnus/create/new', 'AlumniController@store');
Route::get('/alumnus/edit', 'AlumniController@edit')->middleware('alumnus');
Route::post('/alumnus/edit{id}', 'AlumniController@save')->middleware('alumnus');
//custom authentication alumnus
Route::get('/alumnus/login','AlumnusAuthController@login');
Route::post('/alumnus/login','AlumnusAuthController@postLogin');
Route::get('/alumnus/confirm/{token}','AlumnusAuthController@authenticate');
Route::get('/alumnus/home','AlumnusAuthController@index');
Route::get('/alumnus/logout','AlumnusAuthController@logout');
Route::get('/alumnus/{id}', 'AlumniController@alumnusByIdView');
Route::get('/alumnusProfile/{id}', 'AlumniController@alumnusByIdView');
// sending email yearly
Route::get('email/sendyearly','MailController@send');
Route::get('/email/check/{email}','AlumniController@showData');
// changing role employee
Route::post('/role/change','EmployeeController@changeRole');

// TESTING PAGE FOR DIRECTIE.
// testing if you can only visit this page once you are admin/superadmin
// Using home Controller. Should be an other controller once pushing to dev
Route::get('/directie','HomeController@directie')->middleware('directie');
Route::get('/directie/maps', 'StatisticsController@maps')->middleware('directie');

// admin
Route::get('/employee/create','EmployeeController@create')->middleware('admin');
Route::post('/employee/create','EmployeeController@store')->middleware('admin');


// This route implies for docent and admin
Route::get('/special/settings','EmployeeController@specialSettings')->middleware('settings');
Route::post('/specialsettings/update','EmployeeController@settingsUpdate');

Route::get('/testing','HomeController@testing');