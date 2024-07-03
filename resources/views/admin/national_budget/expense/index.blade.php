@extends('template.master')

@section('title', 'ចំណាយថវិកាជាតិ')

@section('message')
    @if ($message = Session::get('message'))
        <div class="toast show success-alert" style="position: absolute;top:0x;right:0px;z-index:9999" id="success-alert">
            <div class="toast-header">
                <strong class="me-auto">ការជូនដំណឹង</strong>
            </div>
            <div class="toast-body text-success">
                <b>{{ $message }}</b>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="toast show success-alert" style="position: absolute;top:0x;right:0px;z-index:9999" id="success-alert">
            <div class="toast-header">
                <strong class="me-auto">ការជូនដំណឹង</strong>
            </div>
            <div class="toast-body text-success">
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </div>
        </div>
    @endif

@endsection

@section('contents')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-header-action">
                        <a href="/national/budget/expenses/create" class="btn btn-success">កត់ចំណាយថវិកាជាតិ
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                    {{-- <div class="d-flex justify-content-evenly align-items-center">
                        <form action="/journals">
                            <label for="fromdate" class="form-label mr-2">From</label>
                            <input type="date" class="form-control mr-2" name="" id="fromdate"
                                placeholder="កាលបរិច្ឆេទ">
                            <label for="todate" class="form-label mr-2">To</label>
                            <input type="date" class="form-control mr-2" name="" id="todate"
                                placeholder="កាលបរិច្ឆេទ">
                            <input class="btn btn-primary" type="submit" value="Search">
                        </form>
                    </div> --}}
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-sm table-bordered">
                            <thead class="bg-secondary">
                                <tr>
                                    <th class="text-center">ល.រ</th>
                                    <th class="text-center">ឆ្នាំអនុវត្ត</th>
                                    <th class="text-center">លេខអង្គភាព</th>
                                    <th class="text-center">ប្រភេទ</th>
                                    <th class="text-center">អនុគណនី</th>
                                    <th class="text-center">ចង្កោមសកម្មភាព</th>
                                    <th class="text-center">ទឹកប្រាក់ធានា</th>
                                    <th class="text-center">ទឹកប្រាក់អាណត្តិ</th>
                                    <th class="text-center">ទឹកប្រាក់បានបើក</th>
                                    <th class="text-center">ឯកសារយោង</th>
                                    <th class="text-center">ពិនិត្យ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nationalBudgetExpenses as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $item->year }}</td>
                                        <td class="text-center">{{ $item->enity }}</td>
                                        <td class="text-center">
                                            @foreach ($expenditureType as $i => $type)
                                                @if ($item->expenditureType == $i)
                                                    {{ $type }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">{{ $item->subAccount }}</td>
                                        <td class="text-center">{{ $item->clusterAct }}</td>
                                        <td class="text-left currency-riel">{{ $item->amountAdv }}</td>
                                        <td class="text-left currency-riel">{{ $item->amountMand }}</td>
                                        <td class="text-left currency-riel">{{ $item->amountMandCash }}</td>
                                        <td class="text-center">
                                            @if ($item->file)
                                                <a href="{{ asset('files/') }}/{{ $item->file }}">
                                                    <i class="fa fa-file-text-o" style="font-size:20px;color:red"></i>
                                                </a>
                                            @else
                                                <i class="fa fa-file-text-o disabled-hover"
                                                    style="font-size:20px;color:rgb(0, 0, 0)"></i>
                                            @endif

                                        </td>
                                        <td style="text-align: center">
                                            <a href="/national/budget/expenses/{{ $item->id }}/edit"
                                                class="btn btn-sm btn-primary"><i class='bx bx-edit-alt'></i></a>
                                            <a href="/national/budget/expenses/{{ $item->id }}"
                                                class="btn btn-sm btn-danger"><i class='bx bx-show'></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
