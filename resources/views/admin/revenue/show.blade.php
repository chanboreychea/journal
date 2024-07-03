@extends('template.master')

@section('title', 'ចំណូល')

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
                        <a href="/revenues" class="btn btn-primary">
                            <i class="fas fa-chevron-left"></i>ចាកចេញ
                        </a>
                    </div>
                </div>
                <div class="card-body pe-5">

                    <div class="row">
                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                            <label for="frist_name">កាលបរិច្ឆេទ</label>
                            <input id="frist_name" type="date" value="{{ $revenue->date }}" class="form-control"
                                name="date" disabled>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                            <label for="last_name">លេខលិខិត អ.ស.ហ</label>
                            <input id="last_name" type="text" class="form-control" name="noFsa"
                                value="{{ $revenue->noFsa }}" disabled>

                        </div>
                        <div class="form-group col-lg-4 col-md-12 col-sm-12">
                            <label for="frist_name">ភាគរយ</label>
                            <input id="frist_name" type="number" value="{{ $revenue->rate }}" class="form-control"
                                name="rate" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6 col-sm-12">
                            <label for="frist_name">កាលបរិច្ឆេទ ប័ណ្ណចំណូលនៅធនាគារ</label>
                            <input id="frist_name" type="date" class="form-control" name="dateOfBankIncomeCard"
                                value="{{ $revenue->dateOfBankIncomeCard }}" disabled>
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <label for="bank">ABA</label>
                            <input id="bank" type="text" class="form-control" name="bank"
                                value="{{ $revenue->bank }}" placeholder="ABA" disabled>
                        </div>
                    </div>

                    @foreach ($revenueDetail as $index => $rd)
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label>ឈ្មោះនិយ័តករ</label>
                                @foreach ($regulators as $key => $item)
                                    @if ($key == $rd->regulatorName)
                                        <div class="form-control">{{ $item }}</div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="form-group col-lg-3">
                                <label>ប្រាក់សរុប</label>
                                <div class="form-control currency-riel">{{ $rd->totalAmountWithRate }}</div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>ប្រាក់ដុល្លា</label>
                                <div class="form-control currency-dolla">{{ $rd->amountDolla }}</div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>ប្រាក់រៀល</label>
                                <div class="form-control currency-riel">{{ $rd->amountRiel }}</div>
                            </div>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <button class="btn btn-danger btn-lg btn-block" data-toggle="modal"
                            data-target="#delete{{ $revenue->id }}">លុប</button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="delete{{ $revenue->id }}">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">តើអ្នកយល់ព្រមលុបទេ?</h5>
                                </div>
                                <div class="modal-footer bg-whitesmoke br">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ទេ</button>
                                    <form action="/revenues/{{ $revenue->id }}" method="POST">
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
