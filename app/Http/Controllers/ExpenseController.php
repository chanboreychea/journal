<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\enum\ExpenditureType;

class ExpenseController extends Controller
{

    public function index()
    {
        return view('admin.expense.index');
    }

    public function create()
    {
        $expenditureType = ExpenditureType::EXPENDITURE_TYPE;
        return view('admin.expense.create', compact('expenditureType'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric|regex:/^[0-9]{4}$/',
            'enity' => 'required|numeric',
            'expenditureType' => 'required|regex:/[1-4]{1}/',
            'subAccount' => 'required',
            'clusterAct' => 'required',
            'file' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:25480',
            'discription' => 'bail|max:1000|min:2'
        ], [
            'year.required' => 'សូមបញ្ចូលនូវឆ្នាំបច្ចុប្បន្ន',
            'year.numeric' => 'សូមបញ្ចូលនូវឆ្នាំជាលេខ',
            'year.regex' => 'សូមបញ្ចូលនូវឆ្នាំជាលេខ ៤ខ្ទង់',
            'enity.required' => 'សូមបញ្ចូលនូវលេខអង្គភាព',
            'enity.numeric' => 'សូមបញ្ចូលនូវលេខអង្គភាពជាលេខ',
            'expenditureType.required' => 'សូមបញ្ចូលនូវប្រភេទ',
            'subAccount.required' => 'សូមបញ្ចូលនូវលេខអនុគណនី',
            'clusterAct.required' => 'សូមបញ្ចូលនូវលេខចង្កោមសកម្ម',

        ]);

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

        $year = $request->input('year');
        $enity = $request->input('enity');
        $expenditureType = $request->input('expenditureType');
        $subAccount = $request->input('subAccount');
        $clusterAct = $request->input('clusterAct');

        $expenseGuaranteeNum = $request->input('expenseGuaranteeNum');
        $dateAdv = $request->input('dateAdv');
        $amountAdv = $request->input('amountAdv');
        $remainingBal = $request->input('remainingBal');

        $manDate = $request->input('manDate');
        $dateManDate = $request->input('dateManDate');
        $amountMand = $request->input('amountMand');
        $ramainingBudget = $request->input('ramainingBudget');

        $manDateCash = $request->input('manDateCash');
        $dateManDateCash = $request->input('dateManDateCash');
        $amountMandCash = $request->input('amountMandCash');
        $remainingBudgetCash = $request->input('remainingBudgetCash');

        $arrear = $request->input('arrear');
        $description = $request->input('description');

        
    }

    public function show(Expense $expense)
    {
        //
    }

    public function edit(Expense $expense)
    {
        $expenditureType = ExpenditureType::EXPENDITURE_TYPE;
        return view('admin.expense.edit', compact('expense', 'expenditureType'));
    }

    public function update(Request $request, Expense $expense)
    {
        //
    }

    public function destroy(Expense $expense)
    {
        //
    }
}
