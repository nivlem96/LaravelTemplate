<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Execute an action on the controller.
     *
     * @param  string  $method
     * @param  array  $parameters
     *
     * @return Response
     */
    public function callAction($method, $parameters)
    {
        $sessionLocale = session('app.locale');
        if ($sessionLocale !== null && app()->getLocale() !== $sessionLocale) {
            app()->setLocale($sessionLocale);
        }

        return $this->{$method}(...array_values($parameters));
    }
}
