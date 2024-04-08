@extends('template.master')

@section('title', 'ចំណាយ')

@section('contents')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-header-action">
                        <a href="/expenses/create" class="btn btn-danger">ចំណាយ
                            {{-- <i class="fas fa-chevron-right"></i> --}}
                        </a>
                    </div>
                    <div class="div">
                        <form action="" class="d-flex justify-content-evenly">
                            <input type="date" class="form-control" name="" id=""
                                placeholder="កាលបរិច្ឆេទ">
                            <button class="btn btn-primary">Search</button>
                        </form>
                    </div>
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
                            <tr>
                                <td><a href="#">INV-87239</a></td>
                                <td class="font-weight-600">Kusnadi</td>
                                <td>
                                    <div class="badge badge-warning">Unpaid</div>
                                </td>
                                <td>July 19, 2018</td>
                                <td>
                                    <a href="#" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="#">INV-48574</a></td>
                                <td class="font-weight-600">Hasan Basri</td>
                                <td>
                                    <div class="badge badge-success">Paid</div>
                                </td>
                                <td>July 21, 2018</td>
                                <td>
                                    <a href="#" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
