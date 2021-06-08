<?php


Route::get('/', 'HomeController@index')->name('home');

Route::get('/admins', 'UserController@admins')->name('users.admins');
Route::get('users/block/{user}', 'UserController@block')->name('users.block');
Route::get('users/unblock/{user}', 'UserController@unBlock')->name('users.unblock');
Route::get('users/create-user', 'UserController@createUser')->name('users.create-user');
Route::get('users/edit-user/{user}', 'UserController@editUser')->name('users.edit-user');
Route::get('/change_language', 'HomeController@change_language')->name('change.language');
Route::get('/delete-all', 'HomeController@deleteAll')->name('users.deleteAll');
Route::resource('users', 'UserController');

Route::resource('projects', 'ProjectController');
// Links
Route::get('links/download/files/{link}', 'LinkController@downloadFiles')->name('links.download.files');
Route::get('document/download/{document}', 'LinkController@downloadFile')->name('document.download');
Route::resource('links', 'LinkController');
Route::post('step/update/note', 'StepController@updateNote')->name('note.update');
Route::get('step/makeAsWorking/{projectStep}', 'StepController@makeAsWorking')->name('step.makeAsWorking');
Route::get('step/makeAsNotStarted/{projectStep}', 'StepController@makeAsNotStarted')->name('step.makeAsNotStarted');
Route::get('step/makeAsDone/{projectStep}', 'StepController@makeAsDone')->name('step.makeAsDone');
Route::resource('steps', 'StepController');
Route::resource('options', 'OptionController');
Route::post('installment/store', 'StepController@addInstallment')->name('installments.store');
Route::get('installment/makeAsPaid/{installment}', 'InstallmentController@makeAsPaid')->name('installments.makeAsPaid');
Route::get('installment/makeAsUnPaid/{installment}', 'InstallmentController@makeAsUnPaid')->name('installments.makeAsUnPaid');
Route::resource('installments', 'InstallmentController');
// Route::resource('installments', 'InstallmentController');

// Messages
Route::get('message/sms', 'MessageController@sms')->name('message.sms');
Route::get('message/email', 'MessageController@email')->name('message.email');
Route::get('message/{message}', 'MessageController@show')->name('message.show');
Route::get('messages/sms/send', 'MessageController@sendSMSForm')->name('message.sms.form');
Route::get('messages/email/send', 'MessageController@sendEmailForm')->name('message.email.form');

Route::post('message/sendSMS', 'MessageController@sendSMS')->name('message.sendSMS');
Route::post('message/sendEmail', 'MessageController@sendEmail')->name('message.sendEmail');

// Conversation
// Route::get('message/system/{user_id?}', 'MessageController@system')->name('message.system');
Route::get('system/{user_id?}', 'MessageController@system')->name('message.system');

// Route::get('/transactions', 'TransactionController@index')->name('transactions.index');
// Setting
Route::get('settings', 'SettingController@setting')->name('settings.show');
Route::get('settings/general', 'SettingController@general')->name('settings.general');
Route::get('settings/social', 'SettingController@social')->name('settings.social');
Route::get('settings/api', 'SettingController@api')->name('settings.api');
// Route::get('settings/phones', 'SettingController@phones')->name('settings.phones');
Route::put('settings/Site', 'SettingController@update')->name('settings.update');
Route::get('settings/smtp/page', 'SettingController@smtpPage')->name('settings.smtp_page');
Route::put('settings/smtp', 'SettingController@SMTP')->name('settings.smtp');
// Phones
Route::resource('phones', 'PhoneController');
// Notifications
Route::get('notifications', 'HomeController@notifications')->name('notifications');

