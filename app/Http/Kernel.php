<?php

namespace App\Http;

use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\LoginMiddleware;


class Kernel extends HttpKernel
{
    /**
     * Middleware toàn cục.
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Nhóm middleware theo route.
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middleware riêng lẻ.
     */
    protected $routeMiddleware = [
        'login' => LoginMiddleware::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'staff' => \App\Http\Middleware\StaffMiddleware::class,
    ];

}
