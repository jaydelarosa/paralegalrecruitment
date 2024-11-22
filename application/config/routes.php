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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// $route['apply/(:any)'] = "apply/mentor/$1";
// $route['search/(:any)'] = "search/category/$1";
// $route['profile/(:any)'] = "profile/viewprofile/$1";
$route['recruitmentconsultantprofile/(:any)'] = "recruitmentconsultantprofile/profile/$1";
// $route['bookasession/(:any)'] = "bookasession/profile/$1";
// $route['bookacallmentor/(:any)'] = "bookacallmentor/recruitmentconsultantprofile/$1";
// $route['sessions/(:any)'] = "sessions/detail/$1";
// $route['downloadattachment/(:any)'] = "downloadattachment/file/$1";
// $route['info/(:any)/(:any)'] = "info/page/$1/$2";
// $route['checkout/(:any)'] = "checkout/checkoutamount/$1";
// $route['testimonials/(:any)'] = "testimonials/view/$1";
// $route['coursesdetails/(:any)'] = "coursesdetails/details/$1";
// $route['jobvacancies/(:any)'] = "jobvacancies/details/$1";
$route['traininglist/(:any)'] = "traininglist/view/$1";
$route['programs/(:any)'] = "programs/view/$1";


$route['apply/(:any)'] = "apply/jobs/$1";
$route['browsementor/(:any)'] = "browsementor/category/$1";
$route['profile/(:any)'] = "profile/viewprofile/$1";
$route['coachprofile/(:any)'] = "coachprofile/profile/$1";
$route['bookasession/(:any)'] = "bookasession/profile/$1";
$route['bookacallmentor/(:any)'] = "bookacallmentor/coachprofile/$1";
$route['sessions/(:any)'] = "sessions/detail/$1";
$route['downloadattachment/(:any)'] = "downloadattachment/file/$1";
$route['findamentor/(:any)'] = "findamentor/page/$1";
$route['checkout/(:any)'] = "checkout/checkoutamount/$1";
$route['info/(:any)/(:any)'] = "info/page/$1/$2";
$route['coursesdetails/(:any)'] = "coursesdetails/details/$1";
$route['c/(:any)'] = "c/page/$1";
$route['p/(:any)'] = "p/page/$1";
$route['w/(:any)'] = "w/page/$1";
$route['courses/(:any)'] = "courses/view/$1";
$route['learn/(:any)'] = "learn/view/$1";
$route['jobs/(:any)'] = "jobs/view/$1";

