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
                        <a href="/national/budget/revenues" class="btn btn-primary">
                            <i class="fas fa-chevron-left"></i>ចាកចេញ
                        </a>
                    </div>
                </div>
                <div class="card-body pe-5">
                    <form method="POST" action="/national/budget/revenues/{{ $revenue->id }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <div class="row">
                            <div class="form-group col-lg-2 col-sm-4">
                                <label for="year">ឆ្នាំអនុវត្ត</label>
                                <input id="year" type="number" min="0"
                                    value="{{ $y = $revenue->year ? $revenue->year : date('Y') }}" class="form-control"
                                    name="year">
                            </div>
                            <div class="form-group col-lg-2 col-sm-4">
                                <label for="enity">លេខអង្គភាព</label>
                                <input id="enity" type="number" min="0" class="form-control" name="enity"
                                    value="{{ $revenue->enity }}">
                            </div>

                            <div class="form-group col-lg-2 col-sm-6">
                                <label for="subAccount">អនុគណនី</label>
                                <input id="subAccount" type="number" min="0" class="form-control" name="subAccount"
                                    value="{{ $revenue->subAccount }}">
                            </div>
                            <div class="form-group col-lg-2 col-sm-6">
                                <label for="clusterAct">ចង្កោមសកម្មភាព</label>
                                <input id="clusterAct" type="number" min="0" pattern="[0-9]*" class="form-control"
                                    name="clusterAct" value="{{ $revenue->clusterAct }}">
                            </div>
                            <div class="form-group col-lg-4 col-sm-4">
                                <label for="cash">ទឹកប្រាក់រៀល</label>
                                <input id="cash" name="cash" type="text" min="0"
                                    class="form-control formatted-currency" value="{{ $revenue->cash }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-3 col-sm-6">
                                <label for="expenditureType">ប្រភេទ</label>
                                <select id="expenditureType" type="text" class="form-control" name="expenditureType">
                                    <option value="">--ជ្រើសរើស--</option>
                                    @foreach ($expenditureType as $i => $item)
                                        @if ($revenue->expenditureType == $i)
                                            <option value="{{ $i }}" selected>{{ $item }}</option>
                                        @else
                                            <option value="{{ $i }}">{{ $item }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-sm-6">
                                <label for="customFile">ឯកសារយោង</label>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="note">បរិយាយ</label>
                                <textarea name="note" class="form-control" id="note" cols="30" rows="10">{{ $revenue->note }}</textarea>
                            </div>

                        </div>

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

    <script>
        $(document).ready(function() {
            formatAmount('cash');
        });

        function formatAmount(inputName) {
            var amountInput = $(`input[name="${ inputName }"]`);
            var currentVal = amountInput.val();
            console.log(currentVal);
            var cleanedInput = currentVal.replace(/[^\d.-]/g, '');
            let formattedInput = formatCurrency(cleanedInput);
            amountInput.val(formattedInput);
        }
    </script>

@endsection
