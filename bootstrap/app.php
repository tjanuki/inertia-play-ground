<?php

use App\Listeners\HandleFailedLogin;
use Illuminate\Auth\Events\Failed;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        //
    })
       ->withEvents(discover: [
        __DIR__.'/../app/Listeners/HandleFailedLogin',
    ])->withExceptions(function (Exceptions $exceptions) {

        $exceptions->respond(function (Response $response, Throwable $exception, Request $request) {
            if (!app()->environment(['local', 'testing']) && in_array($response->getStatusCode(),
                    [500, 503, 404, 403])) {
                return Inertia::render('Error', ['status' => $response->getStatusCode()])
                    ->toResponse($request)
                    ->setStatusCode($response->getStatusCode());
            } elseif ($response->getStatusCode() === 419) {
                if ($request->expectsJson()) {
                    session()->flash('message', 'Your session has expired. Please try again.');
                    return response()->json(['message' => 'Your session has expired.'], 419);
                }
                return redirect()->back()->with('message', 'Your session has expired. Please try again.');
            }

            return $response;
        });
    })->create();
