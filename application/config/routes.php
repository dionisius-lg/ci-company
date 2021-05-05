<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/**
 * AuthController
 */
$route['auth'] = 'auth/login';

/**
 * DashboardController
 * Additional routes for administrator
 */
$route['admin'] = 'admin/Dashboard/index';

/**
 * UserRequestsController
 * Additional routes for administrator
 */
$route['admin/user-requests'] = 'admin/UserRequests';
$route['admin/user-requests/detail/(:any)'] = 'admin/UserRequests/detail/$1';
$route['admin/user-requests/update/(:any)'] = 'admin/UserRequests/update/$1';

/**
 * UsersController
 * Additional routes for administrator
 */
$route['admin/users/get-list'] = 'admin/Users/getList';
$route['admin/users/change-password/(:any)'] = 'admin/Users/changePassword/$1';
$route['admin/users/reset-password/(:any)'] = 'admin/Users/resetPassword/$1';

/**
 * WorkersController
 * Additional routes for administrator
 */
$route['admin/workers/get-list'] = 'admin/Workers/getList';
$route['admin/workers/upload-photo/(:any)'] = 'admin/Workers/uploadPhoto/$1';
$route['admin/workers/upload-attachment/(:any)'] = 'admin/Workers/uploadAttachment/$1';
$route['admin/workers/delete-attachment/(:any)'] = 'admin/Workers/deleteAttachment/$1';
$route['admin/workers/approve-booking/(:any)'] = 'admin/Workers/approveBooking/$1';

/**
 * BookingRequestsController
 * Additional routes for administrator
 */
$route['admin/booking-requests'] = 'admin/BookingRequests';
$route['admin/booking-requests/detail/(:any)'] = 'admin/BookingRequests/detail/$1';
$route['admin/booking-requests/update/(:any)'] = 'admin/BookingRequests/update/$1';

/**
 * AgencyLocationsController
 * Additional routes for administrator
 */
$route['admin/agency-locations'] = 'admin/AgencyLocations';
// $route['admin/agency-locations/(:any)'] = 'admin/AgencyLocations';
$route['admin/agency-locations/detail/(:num)'] = 'admin/AgencyLocations/detail/$1';
$route['admin/agency-locations/create'] = 'admin/AgencyLocations/create';
$route['admin/agency-locations/update/(:num)'] = 'admin/AgencyLocations/update/$1';
$route['admin/agency-locations/delete/(:num)'] = 'admin/AgencyLocations/delete/$1';

/**
 * RemoteController
 * Additional routes for global
 */
$route['remote/get-cities'] = 'Remote/getCities';
$route['remote/get-users-list'] = 'Remote/getUsersDatatable';
$route['remote/get-employees-list'] = 'Remote/getEmployeesDatatable';
$route['remote/get-company-advantages-list'] = 'Remote/getCompanyAdvantagesDatatable';
$route['remote/get-sliders-list'] = 'Remote/getSlidersDatatable';
$route['remote/get-users'] = 'Remote/getUsers';
$route['remote/get-employees'] = 'Remote/getEmployees';
$route['remote/get-worker-attachments-datatable'] = 'Remote/getWorkerAttachmentsDatatable';
$route['remote/get-worker-attachments-datatable/(:any)'] = 'Remote/getWorkerAttachmentsDatatable/$1';

/**
 * WorkerController
 * Additional routes for front
 */
$route['worker/download-attachment'] = 'Worker/downloadAttachment';
$route['worker/download-profile'] = 'Worker/downloadProfile';

/**
 * LanguageController
 * Additional routes for front/main
 */
$route['lang/(:any)'] = 'Language/change/$1';
