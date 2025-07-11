<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan halaman FAQ.
     */
    public function faq()
    {
        return view('pages.faq');
    }

    /**
     * Menampilkan halaman About Us.
     */
    public function about()
    {
        return view('pages.about');
    }
}
