<?php

namespace App\Enum;

enum AccountType
{
    const  ACCOUNT_TYPE = [
        'Assets' => array(
            'accountName' => array(
                'Cash',
                'Office Supplies or other prepaid expenses',
                'Accounts Receivable',
                'Prepaid Rent',
                'Inventory',
                'Equipment',
                'Building',
                'Land'
            ),
            'no' => array(1)
        ),
        'Liabilities' => array(
            'accountName' => array(
                'Accounts Payable',
                'Interest Payable',
                'Wages Payable',
                'Sales Tax Payable',
                'Wages Payable',
                'Payroll Taxes Payable',
                'Income Tax Payable',
                'Social Security Tax Payable',
                'Unearned Revenue',
                'Mortgage Payable',
                'Notes Payable'
            ),
            'no' => array(2)
        ),
        'Equity' => array(
            'accountName' => array(
                'Capital',
                'Withdrawal',
                'Common Stock',
                'Retained Earnings'
            ),
            'no' => array(3)
        ),
        'Revenues' => array(
            'accountName' => array(
                'Service Revenue',
                'Sales Revenue',
                'Interest Revenue'
            ),
            'no' => array(4)
        ),
        'Expenses' => array(
            'accountName' => array(
                'Cost of Goods Sold',
                'Utilities Expense',
                'Wages Expense',
                'Rent Expense',
                'Supplies Expense',
                'Insurance Expense',
                'Advertising Expense',
                'Bank Fees Expense',
                'Taxes Expense'
            ),
            'no' => array(5)
        )
    ];
}
