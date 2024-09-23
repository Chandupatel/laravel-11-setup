<?php

namespace App\Http\Controllers;

use App\Traits\FileHandlerTrait;
use App\Traits\HandlesResourceActionsTrait;
use App\Traits\SendEmailTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, FileHandlerTrait, SendEmailTrait,HandlesResourceActionsTrait;

}
