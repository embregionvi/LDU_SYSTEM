<?php

namespace Config;

use Config\Services;

$routes = Services::routes();

/*
|--------------------------------------------------------------------------
| Router Setup
|--------------------------------------------------------------------------
*/
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
$routes->get('/', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/dashboard', 'Dashboard::index');
$routes->post('/logout', 'Auth::logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
$routes->post('/dashboard/store-calendar-event', 'Dashboard::storeCalendarEvent');
$routes->post('/dashboard/store-report', 'Dashboard::storeReport');

/*
|--------------------------------------------------------------------------
| NOTIFICATIONS
|--------------------------------------------------------------------------
*/
$routes->get('/dashboard/notifications', 'Dashboard::notificationsList');
$routes->post('/dashboard/notifications/read/(:num)', 'Dashboard::markNotificationRead/$1');
$routes->post('/dashboard/notifications/read-all', 'Dashboard::markAllNotificationsRead');

/*
|--------------------------------------------------------------------------
| CALENDAR
|--------------------------------------------------------------------------
*/
$routes->get('/calendar', 'Calendar::index');
$routes->post('/calendar/store', 'Calendar::store');
$routes->post('/calendar/update/(:num)', 'Calendar::update/$1');
$routes->post('/calendar/delete/(:num)', 'Calendar::delete/$1');

/*
|--------------------------------------------------------------------------
| EMPLOYEES
|--------------------------------------------------------------------------
*/
$routes->get('/employees', 'Employees::index');
$routes->get('/employees/create', 'Employees::create');
$routes->post('/employees/store', 'Employees::store');
$routes->get('/employees/edit/(:num)', 'Employees::edit/$1');
$routes->post('/employees/update/(:num)', 'Employees::update/$1');
$routes->get('/employees/delete/(:num)', 'Employees::delete/$1');
$routes->get('/employees/(:num)/trainings', 'Employees::trainings/$1');

/*
|--------------------------------------------------------------------------
| TRAININGS
|--------------------------------------------------------------------------
*/
$routes->get('/trainings', 'Trainings::index');
$routes->get('/trainings/create', 'Trainings::create');
$routes->post('/trainings/store', 'Trainings::store');
$routes->get('/trainings/edit/(:num)', 'Trainings::edit/$1');
$routes->post('/trainings/update/(:num)', 'Trainings::update/$1');
$routes->get('/trainings/delete/(:num)', 'Trainings::delete/$1');
$routes->get('/trainings/export', 'Trainings::export');
$routes->get('/trainings/report', 'Trainings::report');
$routes->get('/trainings/cos-database', 'Trainings::cosDatabase');
$routes->post('/trainings/save-ilr', 'Trainings::saveIlr');
$routes->post('/participants/save', 'Trainings::saveParticipant');

/*
|--------------------------------------------------------------------------
| EVENTS
|--------------------------------------------------------------------------
*/
$routes->get('/events', 'Events::index');
$routes->get('/events/create', 'Events::create');
$routes->post('/events/store', 'Events::store');
$routes->get('/events/edit/(:num)', 'Events::edit/$1');
$routes->post('/events/update/(:num)', 'Events::update/$1');
$routes->get('/events/delete/(:num)', 'Events::delete/$1');

/*
|--------------------------------------------------------------------------
| LEARNING EVENTS ATTENDED
|--------------------------------------------------------------------------
*/
$routes->get('/learning-events', 'LearningEvents::index');
$routes->get('/learning-events/create', 'LearningEvents::create');
$routes->post('/learning-events/store', 'LearningEvents::store');
$routes->get('/learning-events/edit/(:num)', 'LearningEvents::edit/$1');
$routes->post('/learning-events/update/(:num)', 'LearningEvents::update/$1');
$routes->post('/learning-events/delete/(:num)', 'LearningEvents::delete/$1');
$routes->get('/learning-events/export', 'LearningEvents::export');

/*
|--------------------------------------------------------------------------
| LEARNING EVENTS CONDUCTED
|--------------------------------------------------------------------------
*/
$routes->get('/learning-events-conducted', 'LearningEventsConducted::index');
$routes->get('/learning-events-conducted/create', 'LearningEventsConducted::create');
$routes->post('/learning-events-conducted/store', 'LearningEventsConducted::store');
$routes->get('/learning-events-conducted/edit/(:num)', 'LearningEventsConducted::edit/$1');
$routes->post('/learning-events-conducted/update/(:num)', 'LearningEventsConducted::update/$1');
$routes->get('/learning-events-conducted/delete/(:num)', 'LearningEventsConducted::delete/$1');

/*
|--------------------------------------------------------------------------
| DOCUMENTS
|--------------------------------------------------------------------------
*/
$routes->get('/documents', 'Documents::index');
$routes->get('/documents/create', 'Documents::create');
$routes->post('/documents/store', 'Documents::store');
$routes->get('/documents/edit/(:num)', 'Documents::edit/$1');
$routes->post('/documents/update/(:num)', 'Documents::update/$1');
$routes->get('/documents/delete/(:num)', 'Documents::delete/$1');