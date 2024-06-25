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
                        <a href="/national/budget/expenses" class="btn btn-primary">
                            <i class="fas fa-chevron-left"></i>ចាកចេញ
                        </a>
                    </div>
                </div>
                <div class="card-body pe-5">
                    <form method="POST" action="/national/budget/expenses" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="form-group col-2">
                                <label for="year">ឆ្នាំអនុវត្ត</label>
                                <input id="year" type="number" value="{{ $expense->year }}" class="form-control"
                                    name="year" required>
                            </div>
                            <div class="form-group col-2">
                                <label for="enity">លេខអង្គភាព</label>
                                <input id="enity" type="number" class="form-control" name="enity"
                                    value="{{ old('enity') }}" required>
                            </div>
                            <div class="form-group col-2">
                                <label for="subAccount">អនុគណនី</label>
                                <input id="subAccount" type="number" class="form-control" name="subAccount"
                                    value="{{ old('subAccount') }}">
                            </div>
                            <div class="form-group col-3">
                                <label for="expenditureType">ប្រភេទ</label>
                                <select id="expenditureType" type="text" class="form-control" name="expenditureType"
                                    value="{{ old('expenditureType') }}">
                                    @foreach ($expenditureType as $i => $item)
                                        <option value="{{ $i }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="clusterAct">ចង្កោមសកម្មភាព</label>
                                <input id="clusterAct" type="number" pattern="[0-9]*" class="form-control"
                                    name="clusterAct" value="{{ old('clusterAct') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-3">
                                <label for="expenseGuaranteeNum">លេខធានាចំណាយ</label>
                                <input id="expenseGuaranteeNum" type="number" class="form-control"
                                    name="expenseGuaranteeNum" value="{{ old('expenseGuaranteeNum') }}">
                            </div>
                            <div class="form-group col-3">
                                <label for="dateAdv">កាលបរិច្ឆេទធានា</label>
                                <input id="dateAdv" type="date" class="form-control" name="dateAdv"
                                    value="{{ old('dateAdv') }}">
                            </div>
                            <div class="form-group col-3">
                                <label for="amountAdv">ទឹកប្រាក់ធានា</label>
                                <input id="amountAdv" type="number" class="form-control" name="amountAdv"
                                    value="{{ old('amountAdv') }}">
                            </div>
                            <div class="form-group col-3">
                                <label for="remainingBal">ឥណទាននៅសល់</label>
                                <input id="remainingBal" type="number" class="form-control" name="remainingBal"
                                    value="{{ old('remainingBal') }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-3">
                                <label for="manDate">លេខអាណត្តិ</label>
                                <input id="manDate" type="number" class="form-control" name="manDate"
                                    value="{{ old('manDate') }}">
                            </div>
                            <div class="form-group col-3">
                                <label for="dateManDate">កាលបរិច្ឆេទអាណត្តិ</label>
                                <input id="dateManDate" type="date" class="form-control" name="dateManDate"
                                    value="{{ old('dateManDate') }}">
                            </div>
                            <div class="form-group col-3">
                                <label for="amountMand">ទឹកប្រាក់អាណត្តិ</label>
                                <input id="amountMand" type="number" class="form-control" name="amountMand"
                                    value="{{ old('amountMand') }}">
                            </div>
                            <div class="form-group col-3">
                                <label for="ramainingBudget">ឥណទាននៅសល់</label>
                                <input id="ramainingBudget" type="number" class="form-control" name="ramainingBudget"
                                    value="{{ old('ramainingBudget') }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-3">
                                <label for="manDateCash">លេខអាណត្តិបើកសាច់ប្រាក់</label>
                                <input id="manDateCash" type="number" class="form-control" name="manDateCash"
                                    value="{{ old('manDateCash') }}">
                            </div>
                            <div class="form-group col-3">
                                <label for="dateManDateCash">កាលបរិច្ឆេទបើកសាច់ប្រាក់</label>
                                <input id="dateManDateCash" type="date" class="form-control" name="dateManDateCash"
                                    value="{{ old('dateManDateCash') }}">
                            </div>
                            <div class="form-group col-3">
                                <label for="amountMandCash">ទឹកប្រាក់បានបើក</label>
                                <input id="amountMandCash" type="number" class="form-control" name="amountMandCash"
                                    value="{{ old('amountMandCash') }}">
                            </div>
                            <div class="form-group col-3">
                                <label for="remainingBudgetCash">ឥណទាននៅសល់</label>
                                <input id="remainingBudgetCash" type="number" class="form-control"
                                    name="remainingBudgetCash" value="{{ old('remainingBudgetCash') }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-3">
                                <label for="arrear">សាច់ប្រាក់មិនទាន់បើកពីរតនាជាតិ</label>
                                <input id="arrear" type="number" class="form-control" name="arrear"
                                    value="{{ old('arrear') }}">
                            </div>
                            <div class="form-group col-3">
                                <label for="last_name">ឯកសារយោង</label>
                                <div class="custom-file">
                                    <input type="file" name="fileReference" class="custom-file-input"
                                        id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="description">បរិយាយ</label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                រក្សាទុក
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
