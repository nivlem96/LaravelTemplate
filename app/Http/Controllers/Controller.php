<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public ?User $authUser = null;

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
        $currentUser = auth()->user();
        if ($this->authUser === null || $this->authUser->id !== $currentUser->id ?? null) {
            $this->authUser = $currentUser;
        }

        return $this->{$method}(...array_values($parameters));
    }
}
