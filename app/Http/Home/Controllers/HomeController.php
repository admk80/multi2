<?php

namespace CreatyDev\Http\Home\Controllers;
use CreatyDev\Domain\ProductsModel;
use Illuminate\Http\Request;
use CreatyDev\App\Controllers\Controller;
use Sarfraznawaz2005\VisitLog\Facades\VisitLog;
use CreatyDev\Domain\Subscriptions\Models\Plan;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Log the visitor
       // VisitLog::save();
        // Get Plans to show on the landing page
        //$plans =  Plan::take('3')->get();
        //return view('home.index', compact('plans'));

        $products = DB::table('products')
            ->limit(18)
            ->get();

        return view('home.index')->with('products',$products);
    }
    public function show($slug)
    {

    }
}
