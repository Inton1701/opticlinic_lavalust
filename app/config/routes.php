<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/
//==== AUTH ====//
$router->get('/', 'Auth::login');
$router->get('/auth/verify', 'Auth::verify');
$router->post('/auth/verify', 'Auth::verify');
$router->get('/auth/login', 'Auth::login');
$router->get('/auth/register', 'Auth::register');
$router->post('/auth/register', 'Auth::register');
$router->get('/auth/password-reset', 'Auth::password_reset');
$router->post('/auth/password-reset', 'Auth::password_reset');
$router->get('/auth/set-new-password', 'Auth::set_new_password');
$router->post('/auth/set-new-password', 'Auth::set_new_password');
$router->get('/optical-clinic/logout', 'HomeController::logout');

//==== HOME ====//
$router->get('/home', 'HomeAuth::index');

//==== HOMEPAGE ====//
$router->get('/optical-clinic', 'HomeController::index');
$router->get('/optical-clinic/get-all', 'HomeController::get_all');
$router->get('/optical-clinic/frames', 'HomeController::frames');
$router->get('/optical-clinic/profile', 'HomeController::profile');

//=== APPOINTMENTS ===//
$router->get('/optical-clinic/appointments', 'AppointmentController::appointments');
$router->post('/optical-clinic/appointments/create', 'AppointmentController::create_appointment');
$router->get('/optical-clinic/appointments/edit/{id}', 'AppointmentController::edit_appointment');
$router->post('/optical-clinic/appointments/update', 'AppointmentController::update_appointment');
$router->get('/optical-clinic/appointments/delete/{id}', 'AppointmentController::delete_appointment');
$router->post('/optical-clinic/appointments/delete', 'AppointmentController::delete_appointment');

//=== PRESCRIPTIONS ===//
$router->get('/optical-clinic/prescriptions', 'PrescriptionController::prescriptions');
$router->post('/optical-clinic/prescriptions/create', 'PrescriptionController::create_prescription');
$router->get('/optical-clinic/prescriptions/create', 'PrescriptionController::create_form');
$router->get('/optical-clinic/prescriptions/edit/{id}', 'PrescriptionController::edit_prescription');
$router->post('/optical-clinic/prescriptions/update/{id}', 'PrescriptionController::update_prescription');
$router->get('/optical-clinic/prescriptions/delete/{id}', 'PrescriptionController::delete_prescription');

//=== PATIENT ===//
$router->get('/optical-clinic/patient', 'PatientC::patient');
$router->post('/optical-clinic/patient/create', 'PatientC::create_patient');
$router->get('/optical-clinic/patient/edit/{id}', 'PatientC::edit_patient');
$router->post('/optical-clinic/patient/update', 'PatientC::update_patient');
$router->get('/optical-clinic/patient/delete/{id}', 'patientC::delete_patient');
$router->post('/optical-clinic/patient/delete', 'PatientC::delete_patient');


//==CLIENT==//
$router->get('/client/appointment', 'Client::appointment');
$router->get('/client/newClient', 'Client::displayNewClientForm');
$router->post('/client/update-credential', 'Client::updatePersonalData');