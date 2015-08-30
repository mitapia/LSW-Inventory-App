<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Responds to requests to GET /dashboard
     */
    public function getIndex()
    {
        // find open invoices
        $open_invoices = App\Invoice::open()->get();
        $vendors	= App\Vendor::has('size_matrix')->get();

        return view('dashboard', [ 'invoices' => $open_invoices, 'vendors' => $vendors ]);
    }
}
