<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;

class MyController extends Controller
{
    #[Get('my-route')]
    public function index(): string
    {
        return 'index';
    }
}
