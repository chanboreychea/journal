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

    public function index()
    {
        $revenues = Revenue::all();
        return view('admin.revenue.index', compact('revenues'));
    }

    public function create()
    {
        $regulators = Regulator::REGULATOR;
        return view('admin.revenue.create', compact('regulators'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'rate' => 'required|numeric',
            'noFsa' => 'required',
            'regulatorName.*' => 'required',
            'fileReference' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:25480',
        ], [
            'date.required' => 'សូមបញ្ចូលនូវកាលបរិច្ឆេទ',
            'rate.required' => 'សូមបញ្ចូលនូវភាគរយ',
            'rate.numeric' => 'សូមបញ្ចូលភាគរយជាលេខចំនួនគត់ ឬទសភាគ',
            'noFsa.required' => 'សូមបញ្ចូលនូវលេខលិខិត អ.ស.ហ',
            'orderReference.required' => 'សូមបញ្ចូលនូវ ល.រ ដីកាអម',
            'date.required' => 'សូមបញ្ចូលនូវកាលបរិច្ឆេទ',
            'amountDolla.*.numeric' => 'សូមបញ្ចូលអោយបានត្រឹមត្រូវ',
            'amountRiel.*.numeric' => 'សូមបញ្ចូលអោយបានត្រឹមត្រូវ',
            'fileReference.mimes' => 'សូមបញ្ចូលឯកសារជាប្រភេទ pdf, doc, docx, xls, xlsx'
        ]);

        $rate = $request->input('rate');
        $regulatorName = $request->input('regulatorName');
        $amountDolla = $request->input('amountDolla');
        $amountRiel = $request->input('amountRiel');

        if ($request->hasfile('fileReference')) {
            $file = $request->file('fileReference');
            $extenstion = $file->getClientOriginalExtension();
            $originalFileName = $file->getClientOriginalName();
            $pathInfo = pathinfo($originalFileName);
            $filename = $pathInfo['filename'] . Str::random(10) . '.' . strval($extenstion);
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
                'rate' => $rate,
                'dateOfBankIncomeCard' => $request->input('dateOfBankIncomeCard'),
                'bank' => $request->input('bank'),
                'file' => $filename
            ]);

            $totalAmount = 0;
            $oneDolla = 4000;
            foreach ($regulatorName as $key => $item) {

                $totalAmountWithRate = (($amountDolla[$key] * $oneDolla) + $amountRiel[$key]) * $rate / 100;
                $revenues[] = [
                    'revenueId' => $revenue->id,
                    'regulatorName' => $item,
                    'amountDolla' => $amountDolla[$key],
                    'amountRiel' => $amountRiel[$key],
                    'totalAmountWithRate' => $totalAmountWithRate,
                    'created_at' => Carbon::now(),
                ];

                $totalAmount += $totalAmountWithRate;
            }

            Revenue::where('id', $revenue->id)->update([
                'totalAmount' => $totalAmount,
            ]);

            //insert to revenue detail
            RevenueDetail::insert($revenues);

            DB::commit();
            return redirect('/revenues')->with('message', 'ការបញ្ចូលបានជោគជ័យ​ សូមអរគុណ។');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/revenues')->with('message', 'សូមព្យាយាមម្ដងទៀត សូមអរគុណ។' . "$e");
        }
    }

    public function show(Revenue $revenue)
    {
        $revenueDetail = RevenueDetail::where('revenueId', $revenue->id)->get();
        $regulators = Regulator::REGULATOR;
        return view('admin.revenue.show', compact('revenue', 'revenueDetail', 'regulators'));
    }

    public function edit(Revenue $revenue)
    {
        $regulators = Regulator::REGULATOR;
        $revenueDetail = RevenueDetail::where('revenueId', $revenue->id)->get();
        return view('admin.revenue.edit', compact('revenue', 'regulators', 'revenueDetail'));
    }

    public function update(Request $request, Revenue $revenue)
    {

        $request->validate([
            'date' => 'required',
            'rate' => 'required|numeric',
            'noFsa' => 'required',
            'fileReference' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:25480',
        ], [
            'date.required' => 'សូមបញ្ចូលនូវកាលបរិច្ឆេទ',
            'rate.required' => 'សូមបញ្ចូលនូវភាគរយ',
            'rate.numeric' => 'សូមបញ្ចូលភាគរយជាលេខចំនួនគត់ ឬទសភាគ',
            'noFsa.required' => 'សូមបញ្ចូលនូវលេខលិខិត អ.ស.ហ',
            'orderReference.required' => 'សូមបញ្ចូលនូវ ល.រ ដីកាអម',
            'date.required' => 'សូមបញ្ចូលនូវកាលបរិច្ឆេទ',
            'amountDolla.*.numeric' => 'សូមបញ្ចូលអោយបានត្រឹមត្រូវ',
            'amountRiel.*.numeric' => 'សូមបញ្ចូលអោយបានត្រឹមត្រូវ',
            'fileReference.mimes' => 'សូមបញ្ចូលឯកសារជាប្រភេទ pdf, doc, docx, xls, xlsx'
        ]);

        $updateRevenueDetailId = $request->input('updateRevenueDetailId');
        $updateRegulatorName = $request->input('updateRegulatorName');
        $updateAmountDolla = $request->input('updateAmountDolla');
        $updateAmountRiel = $request->input('updateAmountRiel');


        $rate = $request->input('rate') ? $request->input('rate') : $revenue->rate;


        if ($request->hasFile('fileReference')) {

            if ($revenue->file) {
                //find iamge file in public/images directory
                if (file_exists(public_path('files/' . $revenue->file)))
                    unlink('files/' . $revenue->file);
            }

            $file = $request->file('fileReference');
            $extenstion = $file->getClientOriginalExtension();
            $originalFileName = $file->getClientOriginalName();
            $pathInfo = pathinfo($originalFileName);
            $filename = $pathInfo['filename'] . Str::random(10) . '.' . strval($extenstion);
            $file->move('files/', $filename);
            // 'upload image and delete old image'
            // $revenue->file = $filename;
        } else {
            $filename = $revenue->file;
        }

        DB::beginTransaction();
        try {
            //update revenue
            $revenue->update([
                'date' => $request->input('date'),
                'noFsa' => $request->input('noFsa'),
                'rate' => $rate,
                'dateOfBankIncomeCard' => $request->input('dateOfBankIncomeCard'),
                'bank' => $request->input('bank'),
                'file' => $filename
            ]);

            $totalAmount = 0;
            $oneDolla = 4000;
            //update revenue detail
            foreach ($updateRegulatorName as $key => $item) {
                $updateTotalAmountWithRate = (($updateAmountDolla[$key] * $oneDolla) + $updateAmountRiel[$key]) * $rate / 100;
                RevenueDetail::where('id', $updateRevenueDetailId[$key])
                    ->update([
                        'regulatorName' => $item,
                        'amountDolla' => $updateAmountDolla[$key],
                        'amountRiel' => $updateAmountRiel[$key],
                        'totalAmountWithRate' => $updateTotalAmountWithRate,
                        'updated_at' => Carbon::now(),
                    ]);

                $totalAmount += $updateTotalAmountWithRate;
            }

            //insert new revenue detail belong to revenue
            if ($request->input('regulatorName')) {

                $revenueDetail = [];
                $regulatorName = $request->input('regulatorName');
                $currencyAmountDolla = $request->input('amountDolla');
                $currencyAmountRiel = $request->input('amountRiel');

                foreach ($regulatorName as $key => $item) {
                    $totalAmountWithRate = (($currencyAmountDolla[$key] * $oneDolla) + $currencyAmountRiel[$key]) * $rate / 100;
                    $revenueDetail[] = [
                        'revenueId' => $revenue->id,
                        'regulatorName' => $item,
                        'amountDolla' => $currencyAmountDolla[$key],
                        'amountRiel' => $currencyAmountRiel[$key],
                        'totalAmountWithRate' => $totalAmountWithRate,
                        'created_at' => Carbon::now(),
                    ];

                    $totalAmount += $totalAmountWithRate;
                }

                RevenueDetail::insert($revenueDetail);
            }

            //update revenue amount of currency
            $revenue->update([
                'totalAmount' => $totalAmount,
            ]);

            DB::commit();
            return redirect('/revenues')->with('message', 'ការធ្វើបច្ចុប្បន្នភាពបានជោគជ័យ​ សូមអរគុណ។');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/revenues')->with('message', 'សូមព្យាយាមម្ដងទៀត សូមអរគុណ។' . "$e");
        }
    }

    public function destroy(Revenue $revenue)
    {

        if ($revenue->file) {
            //find iamge file in public/images directory
            if (file_exists(public_path('files/' . $revenue->file)))
                unlink('files/' . $revenue->file);
        }

        $revenue->delete();

        RevenueDetail::where('revenueId', $revenue->id)->delete();

        return redirect('/revenues')->with('message', 'លុបទទួលបានជោគជ័យ​ សូមអរគុណ។');
    }

    public function destroyRevenueDetailById(Request $request, string $rdID)
    {
        $revenueDetail = RevenueDetail::where('id', $rdID)->first();
        $revenue = Revenue::where('id', $revenueDetail->revenueId)->first();

        $totalAmount = $revenueDetail->totalAmountWithRate ? $revenue->totalAmount - $revenueDetail->totalAmountWithRate : $revenue->totalAmount;

        $revenue->update([
            'totalAmount' => $totalAmount,
        ]);

        $revenueDetail->delete();

        return redirect()->back()->with('message', 'ការលុបទទួលបានជោគជ័យ​ សូមអរគុណ។');
    }
}
