<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $user;

    public function __construct() {
        $this->middleware(function($request, $next) {
           $this->user = \Auth::user();
           view()->share('u', $this->user);
           return $next($request);
        });
    }
}
