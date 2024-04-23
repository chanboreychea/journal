@extends('template.master')

@section('title', 'ទិនានុប្បវត្តិ')

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
                        <a href="/revenues/create" class="btn btn-success">ចំណូល
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <a href="/expenses/create" class="btn btn-danger">ចំណាយ
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
                            <tr>
                                <th>ល.រ</th>
                                <th>កាលបរិច្ឆេទ</th>
                                <th>ប្រភេទ</th>
                                <th>ចំនួន</th>
                                <th>Action</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
