@extends('template.master')

@section('title', 'ប្រភេទ')

@section('contents')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-header-action">
                        <a href="/categories" class="btn btn-danger">
                            <i class="fas fa-chevron-left"></i>ថយក្រោយ
                        </a>
                    </div>
                </div>
                <div class="card-body pe-5">
                    <form method="POST" action="/categories">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="frist_name">ឈ្មោះប្រភេទ</label>
                                <input id="frist_name" type="text" class="form-control" name="categoryName"
                                    placeholder="ឈ្មោះ" autofocus>
                                @error('categoryName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="last_name">មតិ <span class="text-danger"><b>*</b></span></label>
                                <input id="last_name" type="text" class="form-control" name="description">
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
@endsection
