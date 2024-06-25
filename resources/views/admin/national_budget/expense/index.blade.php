@extends('template.master')

@section('title', 'ចំណាយ')

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
                        <a href="/national/budget/expenses/create" class="btn btn-success">កត់ចំណាយ
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
                            <thead>
                                <tr>
                                    <th style="text-align: center">ល.រ</th>
                                    <th style="text-align: center">ឆ្នាំអនុវត្ត</th>
                                    <th style="text-align: center">លេខអង្គភាព</th>
                                    <th style="text-align: center">ប្រភេទ</th>
                                    <th style="text-align: center">អនុគណនី</th>
                                    <th style="text-align: center">ចង្កោមសកម្មភាព</th>
                                    <th style="text-align: center">ឯកសារយោង</th>
                                    <th style="text-align: center">ពិនិត្យ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nationalBudgetExpenses as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $item->year }}</td>
                                        <td class="text-center">{{ $item->enity }}</td>
                                        <td class="text-center">{{ $item->expenditureType }}</td>
                                        <td class="text-center">{{ $item->subAccount }}</td>
                                        <td class="text-center">{{ $item->clusterAct }}</td>
                                        <td>{{ $item->file }}</td>
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
