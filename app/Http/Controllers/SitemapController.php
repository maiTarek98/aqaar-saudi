<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\SitemapGenerator;

class SitmapController extends Controller
{
    public function __invoke()
    {
        // Clear various caches
        session()->flash('success', trans('messages.fileAddedSuccessfully'));
        \File::delete(public_path('sitemap.xml'));
        SitemapGenerator::create(url('/'))
            ->writeToFile(public_path('sitemap.xml'));
        return redirect()->back();
    }
}
