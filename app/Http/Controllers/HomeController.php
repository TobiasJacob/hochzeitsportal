<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\Category;
use Mapper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::orderBy('searchScore', 'desc')->get();
        
        return view('home', ['vendors' => $vendors, 'categories' => Category::all()]);
    }

    /**
     * Show one single vendor
     */
    public function show($link)
    {
        $vendor = Vendor::where('link', $link)->firstOrFail();

        Mapper::map($vendor->latitude, $vendor->longitude);
        return view('vendor', ['vendor' => $vendor, 'pageTitle' => $vendor->name]);
    }

    /**
     * Impressum
     */
    public function impressum()
    {
        return view('impressum');
    }

    /**
     * Impressum
     */
    public function datenschutz()
    {
        return view('datenschutz');
    }

    /**
     * Impressum
     */
    public function kontakt()
    {
        return view('kontakt');
    }
}
