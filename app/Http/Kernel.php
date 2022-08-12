<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\MiddlewarePreventXss::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'protected_page_accessible_for_user_and_admin_and_super_admin' =>
        [
            \App\Http\Middleware\Authenticate::class,
            \App\Http\Middleware\PreventingBannedUsers::class ,
            \App\Http\Middleware\CheckPageAccessibilityForUserLevel::class,
            \App\Http\Middleware\ProvideHeaderData::class,
        ],

        'protected_page_accessible_for_admin_and_super_admin' =>
        [
            \App\Http\Middleware\Authenticate::class,
            \App\Http\Middleware\PreventingBannedUsers::class ,
            \App\Http\Middleware\CheckPageAccessibilityForAdminLevel::class,
            \App\Http\Middleware\ProvideHeaderData::class,
        ],

        'protected_page_accessible_for_super_admin' =>
        [
            \App\Http\Middleware\Authenticate::class,
            \App\Http\Middleware\PreventingBannedUsers::class ,
            \App\Http\Middleware\CheckPageAccessibilityForSuperAdminLevel::class,
            \App\Http\Middleware\ProvideHeaderData::class,
        ],

    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'          => \App\Http\Middleware\Authenticate::class,
        'auth.basic'    => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can'           => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'         => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed'        => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle'      => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified'      => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        'TransactionOnDatabaseToRollbackWhenExceptionsHappen' => \App\Http\Middleware\TransactionOnDatabaseToRollbackWhenExceptionsHappen::class,

        'ValidatorStorepatients_general_infoRequest' => \App\Http\Middleware\ValidatorStorepatients_general_infoRequest::class,
        'ValidatorUpdatepatients_general_infoRequest' => \App\Http\Middleware\ValidatorUpdatepatients_general_infoRequest::class,

        'CheckValidityOfPatientID'                    => \AppEHR\Http\Middleware\CheckValidityOfPatientID::class,

        'CheckValidityOfEHRID'                        => \AppEHR\Http\Middleware\CheckValidityOfEHRID::class,
        'ValidatorStorepatients_EHR_documentRequest'  => \AppEHR\Http\Middleware\ValidatorStorepatients_EHR_documentRequest::class,
        'ValidatorUpdatepatients_EHR_documentRequest' => \AppEHR\Http\Middleware\ValidatorUpdatepatients_EHR_documentRequest::class,

    ];
}
