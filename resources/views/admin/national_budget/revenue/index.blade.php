@extends('template.master')

@section('title', 'ចំណូលថវិកាជាតិ')

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
                        <a href="/national/budget/revenues/create" class="btn btn-success">កត់ចំណូលថវិកាជាតិ
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
                                    <th style="text-align: center">ឆ្នាំអនុវត្ត</th>
                                    <th style="text-align: center">លេខអង្គភាព</th>
                                    <th style="text-align: center">ប្រភេទ</th>
                                    <th style="text-align: center">ចង្កោមសកម្មភាព</th>
                                    <th style="text-align: center">អនុគណនី</th>
                                    <th style="text-align: center">ទឹកប្រាក់</th>
                                    <th style="text-align: center">ឯកសារយោង</th>
                                    <th style="text-align: center">ពិនិត្យ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nationalBudgetRevenue as $index => $item)
                                    <tr>
                                        <td style="text-align: center">{{ $index + 1 }}</td>
                                        <td style="text-align: center">{{ $item->year }}</td>
                                        <td style="text-align: center">{{ $item->enity }}</td>
                                        <td style="text-align: center">
                                            @foreach ($expenditureType as $key => $type)
                                                @if ($item->expenditureType == $key)
                                                    {{ $type }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td style="text-align: center">{{ $item->clusterAct }}</td>
                                        <td style="text-align: center">{{ $item->subAccount }}</td>
                                        <td style="text-align: center">{{ $item->cash }} ៛</td>
                                        <td style="text-align: center">
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
                                            <a href="/national/budget/revenues/{{ $item->id }}/edit"
                                                class="btn btn-sm btn-primary"><i class='bx bx-edit-alt'></i></a>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $item->id }}"><i class='bx bx-trash'></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" tabindex="-1" role="dialog"
                                                id="delete{{ $item->id }}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">តើអ្នកយល់ព្រមលុបទេ?</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group d-flex flex-column align-items-start">
                                                                <label for="note">បរិយាយ</label>
                                                                <textarea disabled class="form-control" id="note" cols="30" rows="10">{{ $item->note }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-whitesmoke br">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">ទេ</button>
                                                            <form action="/national/budget/revenues/{{ $item->id }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit"
                                                                    class="btn btn-primary">យល់ព្រម</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
