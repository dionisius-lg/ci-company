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
 */
$route['admin'] = 'admin/dashboard/index';

/**
 * UsersController
 */
$route['admin/users/get-list'] = 'admin/users/getList';
$route['admin/users/change-password/(:any)'] = 'admin/users/changePassword/$1';
$route['admin/users/reset-password/(:any)'] = 'admin/users/resetPassword/$1';

/**
 * RequestUsersController
 */
$route['admin/user-requests'] = 'admin/UserRequests';
$route['admin/user-requests/detail/(:any)'] = 'admin/UserRequests/detail/$1';
$route['admin/user-requests/update/(:any)'] = 'admin/UserRequests/update/$1';

/**
 * EmployeesController
 */
$route['admin/employees/get-list'] = 'admin/employees/getList';
$route['admin/employees/upload-photo/(:any)'] = 'admin/employees/uploadPhoto/$1';

/**
 * CompanyAdvantagesController
 */
$route['admin/company-advantages'] = 'admin/companyAdvantages';
$route['admin/company-advantages/create'] = 'admin/companyAdvantages/create';
$route['admin/company-advantages/detail/(:any)'] = 'admin/companyAdvantages/detail/$1';
$route['admin/company-advantages/update/(:any)'] = 'admin/companyAdvantages/update/$1';
$route['admin/company-advantages/delete/(:any)'] = 'admin/companyAdvantages/delete/$1';

/**
 * RemoteController
 */
$route['remote/get-cities'] = 'remote/getCities';
$route['remote/get-users-list'] = 'remote/getUsersDatatable';
$route['remote/get-employees-list'] = 'remote/getEmployeesDatatable';
$route['remote/get-company-advantages-list'] = 'remote/getCompanyAdvantagesDatatable';
$route['remote/get-sliders-list'] = 'remote/getSlidersDatatable';
$route['remote/get-users'] = 'remote/getUsers';
$route['remote/get-employees'] = 'remote/getEmployees';

/**
 * LanguageController
 */
$route['lang/(:any)'] = 'Language/change/$1';
