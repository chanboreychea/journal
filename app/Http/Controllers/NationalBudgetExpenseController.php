<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Enum\ExpenditureType;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\NationalBudgetExpense;
use App\Models\NationalBudgetRevenue;

class NationalBudgetExpenseController extends Controller
{

    public function index()
    {
        $nationalBudgetExpenses = NationalBudgetExpense::all();
        $expenditureType = ExpenditureType::EXPENDITURE_TYPE;
        return view('admin.national_budget.expense.index', compact('nationalBudgetExpenses', 'expenditureType'));
    }

    public function create()
    {
        $expenditureType = ExpenditureType::EXPENDITURE_TYPE;
        return view('admin.national_budget.expense.create', compact('expenditureType'));
    }

    public function store(Request $request)
    {
        $rules = [
            'year' => 'required|numeric|regex:/^[0-9]{4}$/',
            'enity' => ['required', 'numeric'],
            'expenditureType' => 'required|regex:/[1-4]{1}/',
            'clusterAct' => ['required', Rule::exists('national_budget_revenues', 'clusterAct')],
            'subAccount' => ['required', Rule::exists('national_budget_revenues', 'subAccount')->where('clusterAct', $request->input('clusterAct'))],
            'file' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:25480',
            'discription' => 'bail|max:1000|min:2'
        ];

        $messages = [
            'year.required' => 'សូមបញ្ចូលនូវឆ្នាំអនុវត្ត',
            'year.numeric' => 'សូមបញ្ចូលនូវឆ្នាំអនុវត្តជាលេខ ៤ ខ្ទង់',
            'year.regex' => 'សូមបញ្ចូលនូវឆ្នាំជាលេខ ៤ខ្ទង់',
            'enity.required' => 'សូមបញ្ចូលនូវលេខអង្គភាព',
            'enity.numeric' => 'សូមបញ្ចូលនូវលេខអង្គភាពជាលេខ',
            'expenditureType.required' => 'សូមបញ្ចូលនូវប្រភេទ',
            'clusterAct.required' => 'សូមបញ្ចូលនូវលេខចង្កោមសកម្ម',
            'clusterAct.exists' => 'លេខចង្កោមសកម្មមិនមានទេ',
            'subAccount.required' => 'សូមបញ្ចូលនូវលេខអនុគណនី',
            'subAccount.exists' => 'លេខអនុគណនីមិនមានទេ',

        ];

        $request->validate($rules, $messages);

        $year = $request->input('year');
        $enity = $request->input('enity');
        $expenditureType = $request->input('expenditureType');
        $subAccount = $request->input('subAccount');
        $clusterAct = $request->input('clusterAct');

        $nationalBudgetRevenue = NationalBudgetRevenue::where('subAccount', $subAccount)->where('clusterAct', $clusterAct)->first() ?? null;

        if (is_null($nationalBudgetRevenue)) return redirect('/national/budget/expenses')->with('message', "សូមបញ្ចូលនូវលេខអនុគណនី​ និងចង្កោមសកម្មភាពអោយបានត្រឹមត្រូវ");

        $amountInStock = $nationalBudgetRevenue->cash ?? null;

        $rules['amountAdv'] = ['required', function ($attribute, $value, $fail) use ($amountInStock) {
            if (str_replace(',', '', $value) > $amountInStock) {
                $fail('សមតុល្យសាច់ប្រាក់របស់អ្នកមិនគ្រប់គ្រាន់​ សូមអរគុណ។');
            }
        }];

        $request->validate($rules, $messages);

        $expenseGuaranteeNum = $request->input('expenseGuaranteeNum');
        $dateAdv = $request->input('dateAdv');
        $amountAdv = str_replace(',', '', $request->input('amountAdv'));


        $rules['amountMand'] = [function ($attribute, $value, $fail) use ($amountAdv) {
            if (str_replace(',', '', $value) > $amountAdv) {
                $fail('ទឹកប្រាក់អាណត្តិមិនអាចធំជាងទឹកប្រាក់ធានា​ សូមអរគុណ។');
            }
        }];

        $request->validate($rules, $messages);

        $manDate = $request->input('manDate');
        $dateManDate = $request->input('dateManDate');
        $amountMand = $request->input('amountMand') ? str_replace(',', '', $request->input('amountMand')) : null;

        $rules['amountMandCash'] = [function ($attribute, $value, $fail) use ($amountAdv) {
            if (str_replace(',', '', $value) > $amountAdv) {
                $fail('ទឹកប្រាក់បានបើកមិនអាចធំជាងទឹកប្រាក់អាណត្តិ​ សូមអរគុណ។');
            }
        }];

        $request->validate($rules, $messages);

        $manDateCash = $request->input('manDateCash');
        $dateManDateCash = $request->input('dateManDateCash');
        $amountMandCash = $request->input('amountMandCash') ? str_replace(',', '', $request->input('amountMandCash')) : null;

        $arrear = $request->input('arrear');
        $description = $request->input('description');
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extenstion = $file->getClientOriginalExtension();
            $originalFileName = $file->getClientOriginalName();
            $pathInfo = pathinfo($originalFileName);
            $filename = $pathInfo['filename'] . Str::random(10) . '.' . strval($extenstion);
            $file->move('files/', $filename);
        } else {
            $filename = null;
        }

        DB::beginTransaction();
        try {
            NationalBudgetExpense::create([
                'year' => $year,
                'enity' => $enity,
                'expenditureType' => $expenditureType,
                'subAccount' => $subAccount,
                'clusterAct' => $clusterAct,

                'expenseGuaranteeNum' => $expenseGuaranteeNum,
                'dateAdv' => $dateAdv,
                'amountAdv' => $amountAdv,
                // 'remainingBal' => $remainingBal,

                'manDate' => $manDate,
                'dateManDate' => $dateManDate,
                'amountMand' => $amountMand,
                // 'remainingBudget' => $remainingBudget,

                'manDateCash' => $manDateCash,
                'dateManDateCash' => $dateManDateCash,
                'amountMandCash' => $amountMandCash,
                // 'remainingBudgetCash' => $remainingBudgetCash,

                'arrear' => $arrear,
                'file' => $filename,
                'description' => $description

            ]);

            if ($amountAdv) {
                $nationalBudgetRevenue->update([
                    'cash' => $nationalBudgetRevenue->cash - $amountAdv
                ]);
            }

            DB::commit();

            return redirect('/national/budget/expenses')->with('message', "ការរក្សាទុកទទួលបានជោគជ័យ សូមអរគុណ។");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/national/budget/expenses')->with('message', 'សូមព្យាយាមម្ដងទៀត សូមអរគុណ។' . "$e");
        }
    }

    public function show(NationalBudgetExpense $expense)
    {
        $expenditureType = ExpenditureType::EXPENDITURE_TYPE;
        return view('admin.national_budget.expense.show', compact('expense', 'expenditureType'));
    }

    public function edit(NationalBudgetExpense $expense)
    {
        $expenditureType = ExpenditureType::EXPENDITURE_TYPE;
        return view('admin.national_budget.expense.edit', compact('expense', 'expenditureType'));
    }

    public function update(Request $request, NationalBudgetExpense $expense)
    {
        $rules = [
            'year' => 'required|numeric|regex:/^[0-9]{4}$/',
            'enity' => ['required', 'numeric'],
            'expenditureType' => 'required|regex:/[1-4]{1}/',
            'clusterAct' => ['required', Rule::exists('national_budget_revenues', 'clusterAct')],
            'subAccount' => ['required', Rule::exists('national_budget_revenues', 'subAccount')->where('clusterAct', $request->input('clusterAct'))],
            'file' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:25480',
            'discription' => 'bail|max:1000|min:2'
        ];

        $messages = [
            'year.required' => 'សូមបញ្ចូលនូវឆ្នាំអនុវត្ត',
            'year.numeric' => 'សូមបញ្ចូលនូវឆ្នាំអនុវត្តជាលេខ ៤ ខ្ទង់',
            'year.regex' => 'សូមបញ្ចូលនូវឆ្នាំជាលេខ ៤ខ្ទង់',
            'enity.required' => 'សូមបញ្ចូលនូវលេខអង្គភាព',
            'enity.numeric' => 'សូមបញ្ចូលនូវលេខអង្គភាពជាលេខ',
            'expenditureType.required' => 'សូមបញ្ចូលនូវប្រភេទ',
            'clusterAct.required' => 'សូមបញ្ចូលនូវលេខចង្កោមសកម្ម',
            'clusterAct.exists' => 'លេខចង្កោមសកម្មមិនមានទេ',
            'subAccount.required' => 'សូមបញ្ចូលនូវលេខអនុគណនី',
            'subAccount.exists' => 'លេខអនុគណនីមិនមានទេ',
        ];

        $request->validate($rules, $messages);

        $year = $request->input('year');
        $enity = $request->input('enity');
        $expenditureType = $request->input('expenditureType');
        $subAccount = $request->input('subAccount');
        $clusterAct = $request->input('clusterAct');

        $nationalBudgetRevenue = NationalBudgetRevenue::where('subAccount', $subAccount)->where('clusterAct', $clusterAct)->first() ?? null;

        if (is_null($nationalBudgetRevenue)) return redirect('/national/budget/expenses')->with('message', "សូមបញ្ចូលនូវលេខអនុគណនី​ និងចង្កោមសកម្មភាពអោយបានត្រឹមត្រូវ");

        $amountInStock = $nationalBudgetRevenue->cash ?? null;

        $rules['amountAdv'] = ['required', function ($attribute, $value, $fail) use ($amountInStock) {
            if (str_replace(',', '', $value) > $amountInStock) {
                $fail('សមតុល្យសាច់ប្រាក់របស់អ្នកមិនគ្រប់គ្រាន់​ សូមអរគុណ។');
            }
        }];

        $request->validate($rules, $messages);

        $expenseGuaranteeNum = $request->input('expenseGuaranteeNum');
        $dateAdv = $request->input('dateAdv');
        $amountAdv = str_replace(',', '', $request->input('amountAdv'));


        $rules['amountMand'] = [function ($attribute, $value, $fail) use ($amountAdv) {
            if (str_replace(',', '', $value) > $amountAdv) {
                $fail('ទឹកប្រាក់អាណត្តិមិនអាចធំជាងទឹកប្រាក់ធានា​ សូមអរគុណ។');
            }
        }];

        $request->validate($rules, $messages);

        $manDate = $request->input('manDate');
        $dateManDate = $request->input('dateManDate');
        $amountMand = $request->input('amountMand') ? str_replace(',', '', $request->input('amountMand')) : null;

        $rules['amountMandCash'] = [function ($attribute, $value, $fail) use ($amountAdv) {
            if (str_replace(',', '', $value) > $amountAdv) {
                $fail('ទឹកប្រាក់បានបើកមិនអាចធំជាងទឹកប្រាក់អាណត្តិ​ សូមអរគុណ។');
            }
        }];

        $request->validate($rules, $messages);

        $manDateCash = $request->input('manDateCash');
        $dateManDateCash = $request->input('dateManDateCash');
        $amountMandCash = $request->input('amountMandCash') ? str_replace(',', '', $request->input('amountMandCash')) : null;

        $arrear = $request->input('arrear');
        $description = $request->input('description');
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extenstion = $file->getClientOriginalExtension();
            $originalFileName = $file->getClientOriginalName();
            $pathInfo = pathinfo($originalFileName);
            $filename = $pathInfo['filename'] . Str::random(10) . '.' . strval($extenstion);
            $file->move('files/', $filename);
        } else {
            $filename = null;
        }

        // DB::beginTransaction();
        try {

            $expense->update([
                'year' => $year,
                'enity' => $enity,
                'expenditureType' => $expenditureType,
                'subAccount' => $subAccount,
                'clusterAct' => $clusterAct,

                'expenseGuaranteeNum' => $expenseGuaranteeNum,
                'dateAdv' => $dateAdv,
                'amountAdv' => $amountAdv,
                // 'remainingBal' => $remainingBal,

                'manDate' => $manDate,
                'dateManDate' => $dateManDate,
                'amountMand' => $amountMand,
                // 'remainingBudget' => $remainingBudget,

                'manDateCash' => $manDateCash,
                'dateManDateCash' => $dateManDateCash,
                'amountMandCash' => $amountMandCash,
                // 'remainingBudgetCash' => $remainingBudgetCash,

                'arrear' => $arrear,
                'file' => $filename,
                'description' => $description

            ]);



            // DB::commit();

            return redirect('/national/budget/expenses')->with('message', "ការរក្សាទុកទទួលបានជោគជ័យ សូមអរគុណ។");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/national/budget/expenses')->with('message', 'សូមព្យាយាមម្ដងទៀត សូមអរគុណ។' . "$e");
        }
    }

    public function destroy(NationalBudgetExpense $expense)
    {
        // $expense->delete();
        return redirect('/national/budget/expenses')->with('message', "ការរក្សាទុកទទួលបានជោគជ័យ សូមអរគុណ។");
    }
}
