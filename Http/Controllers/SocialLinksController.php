<?php

namespace Modules\SocialLinks\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SocialLinksController extends Controller
{

    public function index()
    {
        return view('sociallinks::index');
    }
}
