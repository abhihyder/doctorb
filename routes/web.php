<?php

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::group(['middleware' => 'auth'], function () {

    Route::get('home', 'HomeController@index');

    // Chamber
    Route::resource('chamber', 'ChamberController');
    Route::get('chamber/create', 'ChamberController@create');
    Route::post('chamber/get-list', 'ChamberController@getData');
    Route::post('chamber/update', 'ChamberController@update');
    Route::get('chamber/edit/{id}', 'ChamberController@edit');
    Route::get('chamber/view/{id}', 'ChamberController@details');
    Route::get('chamber/delete/{delId}', 'ChamberController@delete');
    Route::get('chamber/destroy/{id}', 'ChamberController@destroy');

    // common file
    Route::get('getDistrict', 'AreaController@getDistrict');
    Route::get('getThana', 'AreaController@getThana');
    Route::get('getOrganization', 'OrganizationController@getOrganization');
    Route::get('getChamber', 'ChamberController@getChamber');
    Route::get('getDoctor', 'DoctorAssistantController@getDoctor');

    // agent
    Route::resource('agent', 'AgentController');
    Route::get('agent/create', 'AgentController@create');
    Route::post('agent/get-list', 'AgentController@getData');
    Route::post('agent/update', 'AgentController@update');
    Route::get('agent/edit/{id}', 'AgentController@edit');
    Route::get('agent/delete/{id}', 'AgentController@delete');
    Route::get('agent/destroy/{id}', 'AgentController@destroy');

    // organigation
    Route::resource('organization', 'OrganizationController');
    Route::get('organization/create', 'OrganizationController@create');
    Route::post('organization/get-list', 'OrganizationController@getData');
    Route::post('organization/update', 'OrganizationController@update');
    Route::get('organization/edit/{id}', 'OrganizationController@edit');
    Route::get('organization/delete/{id}', 'OrganizationController@delete');
    Route::get('organization/destroy/{id}', 'OrganizationController@destroy');


    // doctor
    Route::resource('doctor', 'DoctorController');
    Route::get('doctor/create', 'DoctorController@create');
    Route::post('doctor/get-list', 'DoctorController@getData');
    Route::post('doctor/update', 'DoctorController@update');
    Route::get('doctor/edit/{id}', 'DoctorController@edit');
    Route::get('doctor/delete/{id}', 'DoctorController@delete');
    Route::get('doctor/destroy/{id}', 'DoctorController@destroy');



	// for doctor panel
	Route::get('/doctor-patient','DoctorController@patientListByDoctor');
	Route::post('/doctor-panel/get-patient-list','DoctorController@getPatientList');
	Route::get('/doctor-panel/view-patient-details/{booking_id}','DoctorController@viewPatientDetails');
	// Route::get('/doctor-panel/view-patient-details/{booking_id}','DoctorController@viewPatientDetails'); // double route
	Route::get('operation-schedule', 'DoctorController@operationSchedule');
	Route::post('doctor-panel/get-operation-schedule-list', 'DoctorController@operationScheduleList');
	Route::post('doctor-panel/operation-schedule-store', 'DoctorController@operationScheduleStore');
	Route::post('doctor-panel/operation-schedule-edit', 'DoctorController@operationScheduleEdit');
	Route::post('doctor-panel/operation-schedule-update', 'DoctorController@operationScheduleUpdate');

	Route::get('doctor-coins', 'DoctorController@doctorCoins');
	Route::post('doctor/coin-assign', 'DoctorController@doctorCoinAssign');



    //doctor_assistant
    Route::resource('doctor_assistant', 'DoctorAssistantController');
    Route::get('doctor_assistant/create', 'DoctorAssistantController@create');
    Route::post('doctor_assistant/get-list', 'DoctorAssistantController@getData');
    Route::post('doctor_assistant/update', 'DoctorAssistantController@update');
    Route::get('doctor_assistant/edit/{id}', 'DoctorAssistantController@edit');
    Route::get('doctor_assistant/delete/{id}', 'DoctorAssistantController@delete');
    Route::get('doctor_assistant/destroy/{id}', 'DoctorAssistantController@destroy');


    //doctor_assistant
    Route::resource('booking', 'BookingController');
    Route::get('booking/create', 'BookingController@create');
    Route::post('booking/get-list', 'BookingController@getData');
    Route::post('booking/update', 'BookingController@update');
    Route::get('booking/edit/{id}', 'BookingController@edit');
    Route::get('booking/delete/{id}', 'BookingController@delete');
    Route::get('booking/destroy/{id}', 'BookingController@destroy');

    //Prescription
    Route::get('prescription/index','PrescriptionController@index');
    Route::get('prescription/getPationsName/{id}','PrescriptionController@getPationsName');
    Route::post('prescription/store','PrescriptionController@store');

    // For Chamber panel
	Route::get('chamber-panel/index','ChamberPanelController@index');
	Route::get('chamber-panel/getChamber','ChamberPanelController@getChamber');
	Route::post('chamber-panel/get-list','ChamberPanelController@getData');
	Route::get('chamber-panel/view_data/{id}','ChamberPanelController@view_data');


    Route::resource('patient', 'PatientController');
    Route::resource('organizationBranch', 'OrgBranchController');

    Route::resource('operation', 'OperationController');


    Route::resource('user','UserController');
    Route::post('user/get-list','UserController@getList');

    Route::resource('user', 'UserController');


});

Route::get('get-area-info', 'AreaInfoController@getAreaInfo');
Route::get('search/agent/{field}/{query}', 'AgentController@search');
