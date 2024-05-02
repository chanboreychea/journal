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
            $filename = Str::random(15) . '.' . strval($extenstion);
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

            $totalAmountDolla = 0;
            $totalAmountRiel = 0;
            foreach ($regulatorName as $key => $item) {
                $revenues[] = [
                    'revenueId' => $revenue->id,
                    'regulatorName' => $item,
                    'amountDolla' => $currencyAmountDolla[$key],
                    'amountRiel' => $currencyAmountRiel[$key],
                    'created_at' => Carbon::now(),
                ];
                $totalAmountDolla += $currencyAmountDolla[$key];
                $totalAmountRiel += $currencyAmountRiel[$key];
            }

            Revenue::where('id', $revenue->id)->update([
                'totalAmountDolla' => $totalAmountDolla,
                'totalAmountRiel' => $totalAmountRiel,
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
        return view('admin.revenue.show', compact('revenue', 'revenueDetail'));
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
            'noFsa' => 'required',
            'orderReference' => 'required',
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

        $updateRevenueDetailId = $request->input('updateRevenueDetailId');
        $updateRegulatorName = $request->input('updateRegulatorName');
        $updateAmountDolla = $request->input('updateAmountDolla');
        $updateAmountRiel = $request->input('updateAmountRiel');


        if ($request->hasFile('fileReference')) {

            if ($revenue->file) {
                //find iamge file in public/images directory
                if (file_exists(public_path('files/' . $revenue->file)))
                    unlink('files/' . $revenue->file);
            }

            $file = $request->file('fileReference');
            $extenstion = $file->getClientOriginalExtension();
            $filename = Str::random(15) . '.' . strval($extenstion);
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
                'orderReference' => $request->input('orderReference'),
                'dateOfBankIncomeCard' => $request->input('dateOfBankIncomeCard'),
                'bank' => $request->input('bank'),
                'file' => $filename
            ]);

            $totalAmountDolla = 0;
            $totalAmountRiel = 0;

            //update revenue detail
            foreach ($updateRegulatorName as $key => $item) {

                RevenueDetail::where('id', $updateRevenueDetailId[$key])
                    ->update([
                        'regulatorName' => $item,
                        'amountDolla' => $updateAmountDolla[$key],
                        'amountRiel' => $updateAmountRiel[$key],
                        'updated_at' => Carbon::now(),
                    ]);

                $totalAmountDolla += $updateAmountDolla[$key];
                $totalAmountRiel += $updateAmountRiel[$key];
            }

            //insert new revenue detail belong to revenue
            if ($request->input('regulatorName')) {
                $revenueDetail = [];
                $regulatorName = $request->input('regulatorName');
                $currencyAmountDolla = $request->input('amountDolla');
                $currencyAmountRiel = $request->input('amountRiel');

                foreach ($regulatorName as $key => $item) {
                    $revenueDetail[] = [
                        'revenueId' => $revenue->id,
                        'regulatorName' => $item,
                        'amountDolla' => $currencyAmountDolla[$key],
                        'amountRiel' => $currencyAmountRiel[$key],
                        'created_at' => Carbon::now(),
                    ];
                    $totalAmountDolla += $currencyAmountDolla[$key];
                    $totalAmountRiel += $currencyAmountRiel[$key];
                }
                RevenueDetail::insert($revenueDetail);
            }

            //update revenue amount of currency
            $revenue->update([
                'totalAmountDolla' => $totalAmountDolla,
                'totalAmountRiel' => $totalAmountRiel,
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
}
