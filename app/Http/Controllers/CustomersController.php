<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::query();
        if ($request->filled('country')) {
            $customers = $customers->where('country_code', $request->country);
        }
        if ($request->filled('state')) {
            $customers = $customers->where('state', $request->state);
        }
        $customers = $customers->paginate(5);
        if ($request->ajax()) {
            return view('customers', ['customers' => $customers])->render();
        }
        return view('welcome')->with(['customers' => $customers, 'countries' => Country::select('code', 'name')->get()]);
    }
}
