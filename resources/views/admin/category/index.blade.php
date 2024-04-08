@extends('template.master')

@section('title', 'ប្រភេទ')

@section('contents')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-header-action">
                        <a href="/categories/create" class="btn btn-success">បន្ថែមប្រភេទ
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-1">
                    <div class="table-responsive table-invoice">
                        <table class="table table-sm table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>ល.រ</th>
                                    <th>ឈ្មោះ</th>
                                    <th>មតិ</th>
                                    <th>សកម្មភាព</th>
                                    <th>ពិនិត្យ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>

                                        @if ($item->isActive == 1)
                                            <td class="text-success">សកម្ម</td>
                                        @elseif ($item->isActive == 2)
                                            <td class="text-danger">អសកម្ម</td>
                                        @else
                                            <td class="text-primary">រងចាំ</td>
                                        @endif

                                        <td class="d-flex">

                                            <button class="btn btn-primary mr-2" data-toggle="modal"
                                                data-target="#edit{{ $item->id }}">កែប្រែ</button>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#delete{{ $item->id }}">លុប</button>

                                            <!-- Modal -->
                                            <div class="modal fade" tabindex="-1" role="dialog"
                                                id="delete{{ $item->id }}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">តើអ្នកយល់ព្រមលុបទេ?</h5>
                                                        </div>
                                                        <div class="modal-footer bg-whitesmoke br">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">ទេ</button>
                                                            <form action="/categories/{{ $item->id }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit"
                                                                    class="btn btn-primary">យល់ព្រម</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" tabindex="-1" role="dialog"
                                                id="edit{{ $item->id }}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">ធ្វើបច្ចុប្បន្នភាព</h5>
                                                        </div>
                                                        <form method="POST" action="/categories/{{ $item->id }}">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PUT">
                                                                <div class="row">
                                                                    <div class="form-group col-6">
                                                                        <label for="frist_name">ឈ្មោះប្រភេទ</label>
                                                                        <input id="frist_name" type="text"
                                                                            class="form-control" value="{{ $item->name }}"
                                                                            name="categoryName" placeholder="ឈ្មោះ"
                                                                            autofocus>
                                                                    </div>
                                                                    <div class="form-group col-6">
                                                                        <label for="last_name">សកម្មភាព</label>
                                                                        <select name="isActive" class="form-control"
                                                                            id="last_name">
                                                                            @if ($item->isActive == 1)
                                                                                <option value="1" selected>សកម្ម
                                                                                </option>
                                                                            @elseif ($item->isActive == 2)
                                                                                <option value="2" selected>អសកម្ម
                                                                                </option>
                                                                            @else
                                                                                <option value="3">រងចាំ</option>
                                                                            @endif
                                                                            <option value="1">សកម្ម</option>
                                                                            <option value="2">អសកម្ម</option>
                                                                            <option value="3">រងចាំ</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-12">
                                                                        <label for="last_name">មតិ<span
                                                                                class="text-danger"><b>*</b></span></label>
                                                                        <input id="last_name" type="text"
                                                                            value="{{ $item->description }}"
                                                                            class="form-control" name="description">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-whitesmoke br">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">ទេ</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">យល់ព្រម</button>
                                                            </div>
                                                        </form>
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
