<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ldRrvjbXTxlhVhRP',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JjMd0qffkihBQ3JN',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9p1uXdzlkl2gClPP',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::X06Lf6XXXr2VmAym',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mCZ9z2Fc9NrHYDhf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::e0okX3c6uORbK3kc',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/home' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/submit_new_patient_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'submit_new_patient_form',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/store_new_patient_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'store_new_patient_form',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_patient_search_from' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_patient_search_from',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/run_patient_search_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'run_patient_search_form',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/store_patient_time_appointment_table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'store_patient_time_appointment_table',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_form_of_appointments_on_specific_date' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_form_of_appointments_on_specific_date',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/run_show_form_of_appointments_on_specific_date' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'run_show_form_of_appointments_on_specific_date',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_financial_management_main_page' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_financial_management_main_page',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_submit_financial_transaction_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_submit_financial_transaction_form',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/store_show_submit_financial_transaction_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'store_show_submit_financial_transaction_form',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_financial_transaction_reporting_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_financial_transaction_reporting_form',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/run_financial_transaction_reporting_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'run_financial_transaction_reporting_form',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_change_password_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_change_password_form',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/run_change_password_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'run_change_password_form',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_financial_settings_receiving_money_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_financial_settings_receiving_money_form',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/store_financial_settings_receiving_money_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'store_financial_settings_receiving_money_form',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_main_settings_of_software_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_main_settings_of_software_form',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/update_show_main_settings_of_software_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_show_main_settings_of_software_form',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/password/reset/([^/]++)(*:31)|/update_this_patient/([0-9]+)(*:67)|/edit_patient_form/([0-9]+)(*:101)|/s(?|how_(?|patient(?|_time_appointment_table/([0-9--]+)/([0-9]+)(*:174)|s_ehr_document_page/([0-9]+)(?:/([0-9]+)(?:/([0-z--- ]+))?)?(*:242))|new_saved_ehr/([0-9]+)(*:273))|tore_patients_ehr_document_page/([0-9]+)(*:322))|/run_show_form_of_appointments_on_specific_date_by_get_method/([0-9--]+)(*:403)|/delete_this_(?|appointment_by_this_id/([0-9]+)/([0-9--]+)(*:469)|financial_transaction/([0-9]+)(*:507)))/?$}sDu',
    ),
    3 => 
    array (
      31 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      67 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_this_patient',
          ),
          1 => 
          array (
            0 => 'update_this_patient_id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      101 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'edit_patient_form',
          ),
          1 => 
          array (
            0 => 'edit_this_patient_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      174 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_patient_time_appointment_table',
          ),
          1 => 
          array (
            0 => 'choose_time_for_this_date',
            1 => 'choose_time_for_this_patient_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      242 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_patients_ehr_document_page',
            'related_appointment_id' => NULL,
            'child_dr_related_name' => NULL,
          ),
          1 => 
          array (
            0 => 'patient_id',
            1 => 'related_appointment_id',
            2 => 'child_dr_related_name',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      273 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_new_saved_ehr',
          ),
          1 => 
          array (
            0 => 'EHR_document_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      322 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'store_patients_ehr_document_page',
          ),
          1 => 
          array (
            0 => 'patient_id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      403 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'run_show_form_of_appointments_on_specific_date_by_get_method',
          ),
          1 => 
          array (
            0 => 'show_all_appointments_this_date',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      469 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'delete_this_appointment_by_this_id',
          ),
          1 => 
          array (
            0 => 'appointment_id',
            1 => 'show_all_appointments_this_date',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      507 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'delete_this_financial_transaction',
          ),
          1 => 
          array (
            0 => 'financial_transaction_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::ldRrvjbXTxlhVhRP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'generated::ldRrvjbXTxlhVhRP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JjMd0qffkihBQ3JN' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:297:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:79:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000202b9e6d0000000042b45f06";}";s:4:"hash";s:44:"srL5ZNQplRwwX2nUZ2uS1FnVQZ2efuvanUir45zSLZk=";}}',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::JjMd0qffkihBQ3JN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9p1uXdzlkl2gClPP' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::9p1uXdzlkl2gClPP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::X06Lf6XXXr2VmAym' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::X06Lf6XXXr2VmAym',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mCZ9z2Fc9NrHYDhf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::mCZ9z2Fc9NrHYDhf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::e0okX3c6uORbK3kc' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:267:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:49:"function () {
    return \\view(\'auth.login\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000202b9e630000000042b45f06";}";s:4:"hash";s:44:"ZJiANPgCDSd8OOFSkAgTR8McezOZnuYNqifyFzqN294=";}}',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::e0okX3c6uORbK3kc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'home',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\HomeController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'update_this_patient' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'update_this_patient/{update_this_patient_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsGeneralInfoController@update',
        'controller' => 'App\\Http\\Controllers\\PatientsGeneralInfoController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'update_this_patient',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'update_this_patient_id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'edit_patient_form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'edit_patient_form/{edit_this_patient_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsGeneralInfoController@edit',
        'controller' => 'App\\Http\\Controllers\\PatientsGeneralInfoController@edit',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'edit_patient_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'edit_this_patient_id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'submit_new_patient_form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'submit_new_patient_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsGeneralInfoController@create',
        'controller' => 'App\\Http\\Controllers\\PatientsGeneralInfoController@create',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'submit_new_patient_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'store_new_patient_form' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'store_new_patient_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsGeneralInfoController@store',
        'controller' => 'App\\Http\\Controllers\\PatientsGeneralInfoController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'store_new_patient_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'show_patient_search_from' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'show_patient_search_from',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsGeneralInfoController@show_patient_search_from',
        'controller' => 'App\\Http\\Controllers\\PatientsGeneralInfoController@show_patient_search_from',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'show_patient_search_from',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'run_patient_search_form' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'run_patient_search_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsGeneralInfoController@run_patient_search_form',
        'controller' => 'App\\Http\\Controllers\\PatientsGeneralInfoController@run_patient_search_form',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'run_patient_search_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'show_patient_time_appointment_table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'show_patient_time_appointment_table/{choose_time_for_this_date}/{choose_time_for_this_patient_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsAppointmentController@show_patient_time_appointment_table',
        'controller' => 'App\\Http\\Controllers\\PatientsAppointmentController@show_patient_time_appointment_table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'show_patient_time_appointment_table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'choose_time_for_this_date' => '[0-9--]+',
        'choose_time_for_this_patient_id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'store_patient_time_appointment_table' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'store_patient_time_appointment_table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsAppointmentController@store_patient_time_appointment_table',
        'controller' => 'App\\Http\\Controllers\\PatientsAppointmentController@store_patient_time_appointment_table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'store_patient_time_appointment_table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'show_form_of_appointments_on_specific_date' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'show_form_of_appointments_on_specific_date',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsAppointmentController@show_form_of_appointments_on_specific_date',
        'controller' => 'App\\Http\\Controllers\\PatientsAppointmentController@show_form_of_appointments_on_specific_date',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'show_form_of_appointments_on_specific_date',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'run_show_form_of_appointments_on_specific_date' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'run_show_form_of_appointments_on_specific_date',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsAppointmentController@show',
        'controller' => 'App\\Http\\Controllers\\PatientsAppointmentController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'run_show_form_of_appointments_on_specific_date',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'run_show_form_of_appointments_on_specific_date_by_get_method' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'run_show_form_of_appointments_on_specific_date_by_get_method/{show_all_appointments_this_date}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsAppointmentController@show',
        'controller' => 'App\\Http\\Controllers\\PatientsAppointmentController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'run_show_form_of_appointments_on_specific_date_by_get_method',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'show_all_appointments_this_date' => '[0-9--]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'delete_this_appointment_by_this_id' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'delete_this_appointment_by_this_id/{appointment_id}/{show_all_appointments_this_date}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsAppointmentController@destroy',
        'controller' => 'App\\Http\\Controllers\\PatientsAppointmentController@destroy',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'delete_this_appointment_by_this_id',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'appointment_id' => '[0-9]+',
        'show_all_appointments_this_date' => '[0-9--]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'show_financial_management_main_page' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'show_financial_management_main_page',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\FinancialTransactionController@show_financial_management_main_page',
        'controller' => 'App\\Http\\Controllers\\FinancialTransactionController@show_financial_management_main_page',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'show_financial_management_main_page',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'show_submit_financial_transaction_form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'show_submit_financial_transaction_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\FinancialTransactionController@show_submit_financial_transaction_form',
        'controller' => 'App\\Http\\Controllers\\FinancialTransactionController@show_submit_financial_transaction_form',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'show_submit_financial_transaction_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'store_show_submit_financial_transaction_form' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'store_show_submit_financial_transaction_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\FinancialTransactionController@store_show_submit_financial_transaction_form',
        'controller' => 'App\\Http\\Controllers\\FinancialTransactionController@store_show_submit_financial_transaction_form',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'store_show_submit_financial_transaction_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'show_financial_transaction_reporting_form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'show_financial_transaction_reporting_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\FinancialTransactionController@show_financial_transaction_reporting_form',
        'controller' => 'App\\Http\\Controllers\\FinancialTransactionController@show_financial_transaction_reporting_form',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'show_financial_transaction_reporting_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'run_financial_transaction_reporting_form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'run_financial_transaction_reporting_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\FinancialTransactionController@run_financial_transaction_reporting_form',
        'controller' => 'App\\Http\\Controllers\\FinancialTransactionController@run_financial_transaction_reporting_form',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'run_financial_transaction_reporting_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'delete_this_financial_transaction' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'delete_this_financial_transaction/{financial_transaction_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\FinancialTransactionController@destroy',
        'controller' => 'App\\Http\\Controllers\\FinancialTransactionController@destroy',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'delete_this_financial_transaction',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'financial_transaction_id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'show_change_password_form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'show_change_password_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@show_change_password_form',
        'controller' => 'App\\Http\\Controllers\\UserController@show_change_password_form',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'show_change_password_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'run_change_password_form' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'run_change_password_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_user_and_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@run_change_password_form',
        'controller' => 'App\\Http\\Controllers\\UserController@run_change_password_form',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'run_change_password_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'show_financial_settings_receiving_money_form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'show_financial_settings_receiving_money_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\FinancialTransactionController@show_financial_settings_receiving_money_form',
        'controller' => 'App\\Http\\Controllers\\FinancialTransactionController@show_financial_settings_receiving_money_form',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'show_financial_settings_receiving_money_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'store_financial_settings_receiving_money_form' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'store_financial_settings_receiving_money_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\FinancialTransactionController@store_financial_settings_receiving_money_form',
        'controller' => 'App\\Http\\Controllers\\FinancialTransactionController@store_financial_settings_receiving_money_form',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'store_financial_settings_receiving_money_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'show_main_settings_of_software_form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'show_main_settings_of_software_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@show_main_settings_of_software_form',
        'controller' => 'App\\Http\\Controllers\\UserController@show_main_settings_of_software_form',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'show_main_settings_of_software_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'update_show_main_settings_of_software_form' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update_show_main_settings_of_software_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@update_show_main_settings_of_software_form',
        'controller' => 'App\\Http\\Controllers\\UserController@update_show_main_settings_of_software_form',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'update_show_main_settings_of_software_form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'show_patients_ehr_document_page' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'show_patients_ehr_document_page/{patient_id}/{related_appointment_id?}/{child_dr_related_name?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsEHRDocumentController@show_patients_ehr_document_page',
        'controller' => 'App\\Http\\Controllers\\PatientsEHRDocumentController@show_patients_ehr_document_page',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'show_patients_ehr_document_page',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'patient_id' => '[0-9]+',
        'related_appointment_id' => '[0-9]+',
        'child_dr_related_name' => '[0-z--- ]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'store_patients_ehr_document_page' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'store_patients_ehr_document_page/{patient_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsEHRDocumentController@store_patients_ehr_document_page',
        'controller' => 'App\\Http\\Controllers\\PatientsEHRDocumentController@store_patients_ehr_document_page',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'store_patients_ehr_document_page',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'patient_id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'show_new_saved_ehr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'show_new_saved_ehr/{EHR_document_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'protected_page_accessible_for_admin',
        ),
        'uses' => 'App\\Http\\Controllers\\PatientsEHRDocumentController@show_new_saved_ehr',
        'controller' => 'App\\Http\\Controllers\\PatientsEHRDocumentController@show_new_saved_ehr',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'show_new_saved_ehr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'EHR_document_id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
