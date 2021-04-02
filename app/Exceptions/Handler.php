<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    private $statusCodesWithMessages = [
        503 => 'Sorry, we are doing some maintenance. Please check back soon.',
        500 => 'Whoops, something went wrong on our servers.',
        404 => 'Sorry, the page you are looking for could not be found.',
        403 => 'Sorry, you are forbidden from accessing this page.'
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        $response = parent::render($request, $e);;
        if (!app()->environment('local')) {
            if (in_array($response->getStatusCode(), array_keys($this->statusCodesWithMessages))) {
                if ($request->segment(1) == 'dashboard') {
                    $response = Inertia::render('ErrorPage', [
                        'statusCode' => $response->getStatusCode(),
                        'message'    => $this->statusCodesWithMessages[$response->getStatusCode()],
                    ])->toResponse($request)->setStatusCode($response->getStatusCode());
                }
            }
        }
        return $response;
    }
}
