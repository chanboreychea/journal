<?php

namespace App\Http\Controllers;

use App\enum\Regulator;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regulators = Regulator::REGULATOR;
        return view('admin.revenue.create', compact('regulators'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'noFsa' => 'required',
            'orderReference' => 'required',
            'regulatorName.*' => 'required',
        ], [
            'date.required' => 'សូមបញ្ចូលនូវកាលបរិច្ឆេទ',
            'noFsa.required' => 'សូមបញ្ចូលនូវលេខលិខិត អ.ស.ហ',
            'orderReference.required' => 'សូមបញ្ចូលនូវ ល.រ ដីកាអម',
            'date.required' => 'សូមបញ្ចូលនូវកាលបរិច្ឆេទ',
            'amountDolla.*.numeric' => 'សូមបញ្ចូលអោយបានត្រឹមត្រូវ',
            'amountRiel.*.numeric' => 'សូមបញ្ចូលអោយបានត្រឹមត្រូវ'
        ]);

        $regulatorName = $request->input('regulatorName');
        $currencyAmountDolla = $request->input('amountDolla');
        $currencyAmountRiel = $request->input('amountRiel');

        $revenues = [];


        DB::beginTransaction();
        try {

            //create to revenues


            foreach ($regulatorName as $key => $item) {
                $revenues[] = [
                    'regulatorName' => $item,
                    'amonutDolla' => $currencyAmountDolla[$key],
                    'amonutRiel' => $currencyAmountRiel[$key]
                ];
            }
            //insert to revenue detail

            DB::commit();
            return redirect('/journals')->with('message', 'Booking Successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/journals')->with('message', 'Please try again!!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Revenue $revenue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Revenue $revenue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Revenue $revenue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revenue $revenue)
    {
        //
    }
}
