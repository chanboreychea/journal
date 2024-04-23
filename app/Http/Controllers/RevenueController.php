<?php

namespace App\Http\Controllers;

use App\enum\Regulator;
use App\Models\Revenue;
use App\Models\RevenueDetail;
use Carbon\Carbon;
use Illuminate\Support\Str;
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
            'fileReference' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:25480',
        ], [
            'date.required' => 'សូមបញ្ចូលនូវកាលបរិច្ឆេទ',
            'noFsa.required' => 'សូមបញ្ចូលនូវលេខលិខិត អ.ស.ហ',
            'orderReference.required' => 'សូមបញ្ចូលនូវ ល.រ ដីកាអម',
            'date.required' => 'សូមបញ្ចូលនូវកាលបរិច្ឆេទ',
            'amountDolla.*.numeric' => 'សូមបញ្ចូលអោយបានត្រឹមត្រូវ',
            'amountRiel.*.numeric' => 'សូមបញ្ចូលអោយបានត្រឹមត្រូវ',
            'fileReference.mimes' => 'សូមបញ្ចូលឯកសារជាប្រភេទ pdf, doc, docx, xls, xlsx'
        ]);

        $regulatorName = $request->input('regulatorName');
        $currencyAmountDolla = $request->input('amountDolla');
        $currencyAmountRiel = $request->input('amountRiel');

        if ($request->hasfile('fileReference')) {
            $file = $request->file('fileReference');
            $extenstion = $file->getClientOriginalExtension();
            $filename = Str::random(30) . '.' . strval($extenstion);
            $file->move('files/', $filename);
        } else {
            $filename = null;
        }

        $revenues = [];

        DB::beginTransaction();
        try {

            //create to revenues
            $revenue = Revenue::create([
                'date' => $request->input('date'),
                'noFsa' => $request->input('noFsa'),
                'orderReference' => $request->input('orderReference'),
                'dateOfBankIncomeCard' => $request->input('dateOfBankIncomeCard'),
                'bank' => $request->input('bank'),
                'file' => $filename
            ]);

            foreach ($regulatorName as $key => $item) {
                $revenues[] = [
                    'revenueId' => $revenue->id,
                    'regulatorName' => $item,
                    'amountDolla' => $currencyAmountDolla[$key],
                    'amountRiel' => $currencyAmountRiel[$key],
                    'created_at' => Carbon::now(),
                ];
            }
            //insert to revenue detail
            RevenueDetail::insert($revenues);

            DB::commit();
            return redirect('/journals')->with('message', 'ការបញ្ចូលបានជោគជ័យ​ សូមអរគុណ។');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/journals')->with('message', 'សូមព្យាយាមម្ដងទៀត សូមអរគុណ។' . "$e");
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


        if ($request->hasFile('img')) {

            if ($revenue->image) {
                //find iamge file in public/images directory
                if (file_exists(public_path('images/' . $revenue->image)))
                    unlink('images/' . $revenue->image);
            }

            $file = $request->file('img');
            $extenstion = $file->getClientOriginalExtension();
            $filename = Str::random(30) . '.' . strval($extenstion);
            $file->move('images/', $filename);
            // 'upload image and delete old image'
            $revenue->image = $filename;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revenue $revenue)
    {
        //
    }
}
