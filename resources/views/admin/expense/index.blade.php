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
                        <a href="/expenses/create" class="btn btn-success">កត់ចំណាយ
                            <i class="fas fa-chevron-right"></i>
                        </a>

                    </div>
                    {{-- <div class="div">
                        <form action="/journals" class="d-flex justify-content-evenly align-items-center">
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
                                    <th style="text-align: center">កាលបរិច្ឆេទ</th>
                                    <th style="text-align: center">លេខលិខិត អ.ស.ហ</th>
                                    <th style="text-align: center">ល.រ ដីកាអម</th>
                                    <th style="text-align: center">ប្រាក់ដុល្លា</th>
                                    <th style="text-align: center">ប្រាក់រៀល</th>
                                    <th style="text-align: center">ឯកសារយោង</th>
                                    <th style="text-align: center">ពិនិត្យ</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($revenues as $index => $item)
                                    <tr>
                                        <td style="text-align: center">{{ $index + 1 }}</td>
                                        <td style="text-align: center">{{ $item->date }}</td>
                                        <td style="text-align: center">{{ $item->noFsa }}</td>
                                        <td style="text-align: center">{{ $item->orderReference }}</td>
                                        <td style="text-align: center">{{ $item->totalAmountDolla }} $</td>
                                        <td style="text-align: center">{{ $item->totalAmountRiel }} ៛</td>
                                        <td style="text-align: center">
                                            <a href="{{ asset('files/') }}/{{ $item->file }}">
                                                <i class="fa fa-file-text-o" style="font-size:20px;color:red"></i>
                                            </a>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="/revenues/{{ $item->id }}/edit"
                                                class="btn btn-sm btn-primary">កែប្រែ</a>
                                            <a href="/revenues/{{ $item->id }}"
                                                class="btn btn-sm btn-danger">លម្អិត</a>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
