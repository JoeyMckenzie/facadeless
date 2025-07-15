<?php

declare(strict_types=1);

namespace App\Http\Controllers\Facades;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

final class WithArtisanController extends Controller
{
    public function index(): void
    {
        Artisan::call('foo');
    }
}
