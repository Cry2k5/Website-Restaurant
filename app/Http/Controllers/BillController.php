<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->query('keyword');

        // Query the bills based on the keyword if provided
        $bills = Bill::when($keyword, function ($query, $keyword) {
            $query->where('bill_id', 'like', "%$keyword%")
                ->orWhere('reservation_id', 'like', "%$keyword%")
                ->orWhere('table_id', 'like', "%$keyword%")
                ->orWhereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                });
        })->paginate(10);

        // Return the view with the filtered bills
        return view('admin.bills', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('bills.index')->with('success', 'Bill deleted successfully.');
    }
}
