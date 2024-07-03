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

                    <div class="row">
                        <div class="form-group col-2">
                            <label for="year">ឆ្នាំអនុវត្ត</label>
                            <input id="year" type="number" value="{{ $expense->year }}" class="form-control"
                                name="year" required>
                        </div>
                        <div class="form-group col-2">
                            <label for="enity">លេខអង្គភាព</label>
                            <input id="enity" type="number" class="form-control" name="enity"
                                value="{{ $expense->enity }}" required>
                        </div>
                        <div class="form-group col-2">
                            <label for="subAccount">អនុគណនី</label>
                            <input id="subAccount" type="number" class="form-control" name="subAccount"
                                value="{{ $expense->subAccount }}">
                        </div>
                        <div class="form-group col-3">
                            <label for="expenditureType">ប្រភេទ</label>
                            <div id="expenditureType" type="text" class="form-control" name="expenditureType">
                                @foreach ($expenditureType as $i => $item)
                                    @if ($i == $expense->expenditureType)
                                        <option value="{{ $i }}" selected>{{ $item }}</option>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label for="clusterAct">ចង្កោមសកម្មភាព</label>
                            <input id="clusterAct" type="number" pattern="[0-9]*" class="form-control" name="clusterAct"
                                value="{{ $expense->clusterAct }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-3">
                            <label for="expenseGuaranteeNum">លេខធានាចំណាយ</label>
                            <input id="expenseGuaranteeNum" type="number" class="form-control" name="expenseGuaranteeNum"
                                value="{{ $expense->expenseGuaranteeNum }}">
                        </div>
                        <div class="form-group col-3">
                            <label for="dateAdv">កាលបរិច្ឆេទធានា</label>
                            <input id="dateAdv" type="date" class="form-control" name="dateAdv"
                                value="{{ $expense->dateAdv }}">
                        </div>
                        <div class="form-group col-3">
                            <label for="amountAdv">ទឹកប្រាក់ធានា</label>
                            <div class="form-control currency-riel">{{ $expense->amountAdv }}</div>
                        </div>
                        <div class="form-group col-3">
                            <label for="remainingBal">ឥណទាននៅសល់</label>
                            <div class="form-control currency-riel">{{ $expense->remainingBal }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-3">
                            <label for="manDate">លេខអាណត្តិ</label>
                            <input id="manDate" type="number" class="form-control" name="manDate"
                                value="{{ $expense->manDate }}">
                        </div>
                        <div class="form-group col-3">
                            <label for="dateManDate">កាលបរិច្ឆេទអាណត្តិ</label>
                            <input id="dateManDate" type="date" class="form-control" name="dateManDate"
                                value="{{ $expense->dateManDate }}">
                        </div>
                        <div class="form-group col-3">
                            <label for="amountMand">ទឹកប្រាក់អាណត្តិ</label>
                            <div class="form-control currency-riel">{{ $expense->amountMand }}</div>
                        </div>
                        <div class="form-group col-3">
                            <label for="remainingBudget">ឥណទាននៅសល់</label>
                            <div class="form-control currency-riel">{{ $expense->remainingBudget }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-3">
                            <label for="manDateCash">លេខអាណត្តិបើកសាច់ប្រាក់</label>
                            <input id="manDateCash" type="number" class="form-control" name="manDateCash"
                                value="{{ $expense->manDateCash }}">
                        </div>
                        <div class="form-group col-3">
                            <label for="dateManDateCash">កាលបរិច្ឆេទបើកសាច់ប្រាក់</label>
                            <input id="dateManDateCash" type="date" class="form-control" name="dateManDateCash"
                                value="{{ $expense->dateManDateCash }}">
                        </div>
                        <div class="form-group col-3">
                            <label for="amountMandCash">ទឹកប្រាក់បានបើក</label>
                            <div class="form-control currency-riel">{{ $expense->amountMandCash }}</div>
                        </div>
                        <div class="form-group col-3">
                            <label for="remainingBudgetCash">ឥណទាននៅសល់</label>
                            <div class="form-control currency-riel">{{ $expense->remainingBudgetCash }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-3">
                            <label for="arrear">សាច់ប្រាក់មិនទាន់បើកពីរតនាជាតិ</label>
                            <div class="form-control currency-riel">{{ $expense->arrear }}</div>
                        </div>

                        <div class="form-group col-9">
                            <label for="description">បរិយាយ</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $expense->description }}</textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <button class="btn btn-danger btn-lg btn-block" data-toggle="modal"
                            data-target="#delete{{ $expense->id }}">លុប</button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="delete{{ $expense->id }}">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">តើអ្នកយល់ព្រមលុបទេ?</h5>
                                </div>
                                <div class="modal-footer bg-whitesmoke br">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ទេ</button>
                                    <form action="/national/budget/expenses/{{ $expense->id }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-primary">យល់ព្រម</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
