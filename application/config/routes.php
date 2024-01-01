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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'MainController/regions';
// User routes
$route['user/register'] = 'UserController/register';
$route['user/login'] = 'UserController/login';
$route['user/logout'] = 'UserController/logout';

//Admin Routes
$route['regions'] = 'MainController/regions';
$route['assign'] = 'MainController/assign';
$route['view_workers'] = 'MainController/view_workers';
$route['view_vaccination_records'] = 'MainController/view_vaccination_records';
$route['add_vaccination_record'] = 'MainController/add_vaccine';

//Unit Routes

// division routes
$route['add_division'] = 'UnitController/add_division';
$route['add_division/(:num)'] = 'UnitController/add_division/$1';
$route['delete_division/(:num)'] = 'UnitController/delete_division/$1';
$route['add_division_record'] = 'UnitController/add_division_record';
$route['division_listing'] = 'UnitController/division_listing';

// district routes
$route['add_district'] = 'UnitController/add_district';
$route['add_district/(:num)'] = 'UnitController/add_district/$1';
$route['delete_district/(:num)'] = 'UnitController/delete_district/$1';
$route['add_district_record'] = 'UnitController/add_district_record';
$route['district_listing'] = 'UnitController/district_listing';

// tehsil routes
$route['add_tehsil'] = 'UnitController/add_tehsil';
$route['add_tehsil/(:num)'] = 'UnitController/add_tehsil/$1';
$route['delete_tehsil/(:num)'] = 'UnitController/delete_tehsil/$1';
$route['add_tehsil_record'] = 'UnitController/add_tehsil_record';
$route['tehsil_listing'] = 'UnitController/tehsil_listing';

// union council routes
$route['add_unioncouncil'] = 'UnitController/add_unioncouncil';
$route['add_unioncouncil/(:num)'] = 'UnitController/add_unioncouncil/$1';
$route['delete_unioncouncil/(:num)'] = 'UnitController/delete_unioncouncil/$1';
$route['add_unioncouncil_record'] = 'UnitController/add_unioncouncil_record';
$route['unioncouncil_listing'] = 'UnitController/unioncouncil_listing';

// Households routes
$route['add_household'] = 'UnitController/add_household';
$route['add_household/(:num)'] = 'UnitController/add_household/$1';
$route['delete_household/(:num)'] = 'UnitController/delete_household/$1';
$route['add_household_record'] = 'UnitController/add_household_record';
$route['household_listing'] = 'UnitController/household_listing';

// Household members routes
$route['add_householdmember'] = 'UnitController/add_householdmember';
$route['add_householdmember/(:num)'] = 'UnitController/add_householdmember/$1';
$route['delete_household_member/(:num)'] = 'UnitController/delete_household_member/$1';
$route['add_householdmember_record'] = 'UnitController/add_householdmember_record';
$route['householdmember_listing'] = 'UnitController/householdmember_listing';

//Polio worker Routes
$route['vaccination_record'] = 'WorkerController/vaccination_record';
$route['add_vaccination_record'] = 'WorkerController/add_vaccination_record';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
