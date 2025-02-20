<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    return view('email_form');
});

Route::post('/send-mail', [MailController::class, 'sendMail'])->name('send.mail');
