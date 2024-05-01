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
                    <form method="POST" action="/revenues/{{ $revenue->id }}" id="formAuthentication"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="frist_name">កាលបរិច្ឆេទ</label>
                                <input id="frist_name" type="date" value="{{ $revenue->date }}" class="form-control"
                                    name="date" required>
                                {{-- @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>
                            <div class="form-group col-4">
                                <label for="last_name">លេខលិខិត អ.ស.ហ</label>
                                <input id="last_name" type="text" class="form-control" name="noFsa"
                                    value="{{ $revenue->noFsa }}" autofocus required>
                                {{-- @error('noFsa')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="form-group col-4">
                                <label for="last_name">ឯកសារយោង</label>
                                <div class="custom-file">
                                    <input type="file" name="fileReference" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                {{-- <input type="file" name="fileReference"> --}}
                                {{-- @error('fileReference')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="last_name">ល.រ ដីកាអម</label>
                                <input id="last_name" type="text" class="form-control" name="orderReference"
                                    value="{{ $revenue->orderReference }}" required>
                                {{-- @error('orderReference')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>
                            <div class="form-group col-4">
                                <label for="frist_name">កាលបរិច្ឆេទ ប័ណ្ណចំណូលនៅធនាគារ<span
                                        class="text-danger"><b>*</b></span></label>
                                <input id="frist_name" type="date" class="form-control" name="dateOfBankIncomeCard"
                                    value="{{ $revenue->dateOfBankIncomeCard }}">
                            </div>
                            <div class="form-group col-4">
                                <label for="bank">ABA<span class="text-danger"><b>*</b></span></label>
                                <input id="bank" type="text" class="form-control" name="bank"
                                    value="{{ $revenue->bank }}" placeholder="ABA">
                                @error('bank')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @foreach ($revenueDetail as $index => $rd)
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>ឈ្មោះនិយ័តករ</label>
                                    <select name="regulatorName[]" class="form-control regulatorName">
                                        <option value="{{ $rd->regulatorName }}">{{ $rd->regulatorName }}</option>

                                    </select>
                                </div>
                                <div class="form-group col-6 d-flex justify-content-between">
                                    <div class="w-100 mr-2">
                                        <label>ប្រាក់ដុល្លា</label>
                                        <input type="text" value="{{ $rd->amountDolla }}"
                                            class="form-control amountDolla" name="amountDolla[]"
                                            placeholder="ចំនួនទឹកប្រាក់" pattern="[0-9]+(\.[0-9]+)?">
                                        @error('amountDolla')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-100">
                                        <label>ប្រាក់រៀល</label>
                                        <input type="text" value="{{ $rd->amountRiel }}" class="form-control amountRiel"
                                            name="amountRiel[]" placeholder="ចំនួនទឹកប្រាក់" pattern="[0-9]+(\.[0-9]+)?">
                                        @error('amountRiel')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <div id="container"></div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                ធ្វើបច្ចុប្បន្នភាព
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
