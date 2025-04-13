<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class ClearCacheController extends Controller
{
    public function __invoke()
    {
        // Clear various caches
        session()->flash('success', trans('messages.AddSuccessfully'));
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('clear-compiled');
        // Redirect with success message
        return redirect()->back();
    }
}
