<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageHomeController extends Controller
{
    public function __invoke()
    {
        return view('pages.index')->with('page', Page::findOrFail('index'));
    }
}
