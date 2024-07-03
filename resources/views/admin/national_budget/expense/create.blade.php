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
                        <a href="/national/budget/expenses" class="btn btn-primary">
                            <i class="fas fa-chevron-left"></i>ចាកចេញ
                        </a>
                    </div>
                </div>
                <div class="card-body pe-5">
                    <form method="POST" action="/national/budget/expenses" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-lg-2 col-md-4 col-sm-12">
                                <label for="year">ឆ្នាំអនុវត្ត</label>
                                <input id="year" type="number" min="0"
                                    value="{{ $y = old('year') ? old('year') : date('Y') }}" class="form-control"
                                    name="year">
                            </div>
                            <div class="form-group col-lg-2 col-md-4 col-sm-12">
                                <label for="enity">លេខអង្គភាព</label>
                                <input id="enity" type="number" min="0" class="form-control" name="enity"
                                    value="{{ $enity = old('enity') ?? 201 }}" required>
                            </div>

                            <div class="form-group col-lg-2 col-md-4 col-sm-12">
                                <label for="expenditureType">ប្រភេទ</label>
                                <select id="expenditureType" type="text" class="form-control" name="expenditureType"
                                    value="{{ old('expenditureType') }}">
                                    @foreach ($expenditureType as $i => $item)
                                        <option value="{{ $i }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                <label for="subAccount">អនុគណនី</label>
                                <input id="subAccount" type="number" min="0" class="form-control" name="subAccount"
                                    value="{{ old('subAccount') }}" required autofocus>
                            </div>
                            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                <label for="clusterAct">ចង្កោមសកម្មភាព</label>
                                <input id="clusterAct" type="number" min="0" pattern="[0-9]*" class="form-control"
                                    name="clusterAct" value="{{ old('clusterAct') }}" required>
                            </div>
                        </div>

                        <div class="row" id="stepOne">
                            <div class="form-group col-lg-4 col-md-3 col-sm-12">
                                <label for="expenseGuaranteeNum">លេខធានាចំណាយ</label>
                                <input id="expenseGuaranteeNum" type="number" class="form-control"
                                    name="expenseGuaranteeNum" value="{{ old('expenseGuaranteeNum') }}" required>
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-12">
                                <label for="dateAdv">កាលបរិច្ឆេទធានា</label>
                                <input id="dateAdv" type="date" class="form-control" name="dateAdv"
                                    value="{{ old('dateAdv') }}" required>
                            </div>
                            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                <label for="amountAdv">ទឹកប្រាក់ធានា</label>
                                <input id="amountAdv" type="text" class="form-control formatted-currency"
                                    name="amountAdv" value="{{ old('amountAdv') }}" oninput="checkInput()" required>
                            </div>
                            {{-- <div class="form-group col-3">
                                <label for="remainingBal">ឥណទាននៅសល់</label>
                                <input id="remainingBal" type="number" class="form-control" name="remainingBal"
                                    value="{{ old('remainingBal') }}">
                            </div> --}}
                        </div>

                        <div class="row" id="stepTwo">
                            <div class="form-group col-lg-4 col-md-3 col-sm-12">
                                <label for="manDate">លេខអាណត្តិ</label>
                                <input id="manDate" type="number" class="form-control" name="manDate"
                                    value="{{ old('manDate') }}" disabled>
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-12">
                                <label for="dateManDate">កាលបរិច្ឆេទអាណត្តិ</label>
                                <input id="dateManDate" type="date" class="form-control" name="dateManDate"
                                    value="{{ old('dateManDate') }}" disabled>
                            </div>
                            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                <label for="amountMand">ទឹកប្រាក់អាណត្តិ</label>
                                <input id="amountMand" type="text" class="form-control formatted-currency"
                                    name="amountMand" value="{{ old('amountMand') }}" disabled oninput="checkInput()">
                            </div>
                            {{-- <div class="form-group col-3">
                                <label for="remainingBudget">ឥណទាននៅសល់</label>
                                <input id="remainingBudget" type="number" class="form-control" name="remainingBudget"
                                    value="{{ old('remainingBudget') }}" disabled>
                            </div> --}}
                        </div>

                        <div class="row" id="stepThree">
                            <div class="form-group col-lg-4 col-md-3 col-sm-12">
                                <label for="manDateCash">លេខអាណត្តិបើកសាច់ប្រាក់</label>
                                <input id="manDateCash" type="number" class="form-control" name="manDateCash"
                                    value="{{ old('manDateCash') }}" disabled>
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-12">
                                <label for="dateManDateCash">កាលបរិច្ឆេទបើកសាច់ប្រាក់</label>
                                <input id="dateManDateCash" type="date" class="form-control" name="dateManDateCash"
                                    value="{{ old('dateManDateCash') }}" disabled>
                            </div>
                            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                <label for="amountMandCash">ទឹកប្រាក់បានបើក</label>
                                <input id="amountMandCash" type="text" class="form-control formatted-currency"
                                    name="amountMandCash" value="{{ old('amountMandCash') }}" disabled>
                            </div>
                            {{-- <div class="form-group col-3">
                                <label for="remainingBudgetCash">ឥណទាននៅសល់</label>
                                <input id="remainingBudgetCash" type="number" class="form-control"
                                    name="remainingBudgetCash" value="{{ old('remainingBudgetCash') }}" disabled>
                            </div> --}}
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label for="arrear">សាច់ប្រាក់មិនទាន់បើកពីរតនាជាតិ</label>
                                <input id="arrear" type="number" class="form-control" name="arrear"
                                    value="{{ old('arrear') }}">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label for="last_name">ឯកសារយោង</label>
                                <div class="custom-file">
                                    <input type="file" name="fileReference" class="custom-file-input"
                                        id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-md-3 col-sm-12">
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
    <script>
        $(document).ready(function() {

            $('#amountAdv').keyup(function() {
                var value1 = $('#amountAdv').val();
                var value2 = $('#amountMand').val();

                value1 = value1.replace(/,/g, '');
                value2 = value2.replace(/,/g, '');

                if (parseFloat(value2) > parseFloat(value1)) {
                    $('#amountMand').val('');
                    $('#amountMandCash').val('');
                }
            });

            $('#amountMand').keyup(function() {
                var value1 = $('#amountAdv').val();
                var value2 = $('#amountMand').val();
                var value3 = $('#amountMandCash').val();

                value1 = value1.replace(/,/g, '');
                value2 = value2.replace(/,/g, '');
                value3 = value3.replace(/,/g, '');

                if (parseFloat(value2) > parseFloat(value1)) {
                    $('#amountMand').val(value2.slice(0, -1));
                }
                if (parseFloat(value3) > parseFloat(value2)) {
                    $('#amountMandCash').val('');
                }
            });

            $('#amountMandCash').keyup(function() {
                var value2 = $('#amountMand').val();
                var value3 = $('#amountMandCash').val();

                value2 = value2.replace(/,/g, '');
                value3 = value3.replace(/,/g, '');

                if (parseFloat(value3) > parseFloat(value2)) {
                    $('#amountMandCash').val(value3.slice(0, -1));
                }
            });

            // Call checkInput function when the DOM is ready
            checkInput();
        });

        function checkInput() {
            var inputOne = document.getElementById('amountAdv').value;
            var inputTwo = document.getElementById('amountMand').value;
            var stepTwo = document.getElementById('stepTwo');
            var stepThree = document.getElementById('stepThree');

            const inputsTwo = stepTwo.getElementsByTagName('input');
            for (let input of inputsTwo) {
                if (inputOne.trim() !== "") {
                    input.disabled = false;
                } else {
                    input.disabled = true;
                }
            }

            const inputsThree = stepThree.getElementsByTagName('input');
            for (let input of inputsThree) {
                if (inputTwo.trim() !== "") {
                    input.disabled = false;
                } else {
                    input.disabled = true;
                }
            }
        }
    </script>
@endsection
