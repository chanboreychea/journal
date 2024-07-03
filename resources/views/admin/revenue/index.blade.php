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
                        <a href="/revenues/create" class="btn btn-success">កត់ចំណូល
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
                            <thead class="bg-secondary">
                                <tr>
                                    <th class="text-center">ល.រ</th>
                                    <th class="text-center">កាលបរិច្ឆេទ</th>
                                    <th class="text-center">លេខលិខិត អ.ស.ហ.</th>
                                    <th class="text-center">ប្រាក់សរុប</th>
                                    <th class="text-center">ឯកសារយោង</th>
                                    <th class="text-center">សកម្មភាព</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($revenues as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $item->date }}</td>
                                        <td class="text-center">{{ $item->noFsa }}</td>
                                        <td class="text-center currency-riel">{{ $item->totalAmount }}</td>
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
                                        <td class="text-center">
                                            <a href="/revenues/{{ $item->id }}/edit" class="btn btn-sm btn-primary"><i
                                                    class='bx bx-edit-alt'></i></a>
                                            <a href="/revenues/{{ $item->id }}" class="btn btn-sm btn-danger"><i
                                                    class='bx bx-show'></i></a>
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
