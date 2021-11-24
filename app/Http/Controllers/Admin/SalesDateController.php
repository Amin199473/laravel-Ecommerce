<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\SalesDate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesDateController extends Controller
{
    public function index()
    {
        $salesDate = SalesDate::first();
        if ($salesDate) {
            $timerSales = Carbon::parse($salesDate->sale_date)->format('Y/m/d h:m:s');
        } else {
            $timerSales = Carbon::now()->format('Y/m/d h:m:s');
        }
        return view('admin.salesDate.index', compact('salesDate', 'timerSales'));
    }

    public function store(Request $request)
    {
        $salesDate = SalesDate::first();
        if (!$salesDate) {
            SalesDate::create([
                'status' => $request->status,
                'sale_date' => $request->sale_date
            ]);
            return redirect()->back()->with('success', 'Timer sales created Successfully!');
        } else {
            $salesDate->update(
                [
                    'status' => $request->status,
                    'sale_date' => $request->sale_date
                ]
            );
            return redirect()->back()->with('success', 'Timer sales updated Successfully!');
        }


        return redirect()->back()->with('success', 'Timer sales updated Successfully!');
    }
}
