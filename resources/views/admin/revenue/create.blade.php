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
                        <a href="/journals" class="btn btn-danger">
                            <i class="fas fa-chevron-left"></i>ទិនានុប្បវត្តិ
                        </a>
                        <button type="button" id="addInput" class="btn btn-primary"
                            onclick="addInput()">ប្រភពចំណូល</button>
                    </div>
                </div>
                <div class="card-body pe-5">
                    <form method="POST" action="/revenues" id="formAuthentication">
                        @csrf

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="frist_name">កាលបរិច្ឆេទ</label>
                                <input id="frist_name" type="date" class="form-control" name="date" required>
                                {{-- @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>
                            <div class="form-group col-4">
                                <label for="last_name">លេខលិខិត អ.ស.ហ</label>
                                <input id="last_name" type="text" class="form-control" name="noFsa" autofocus required>
                                {{-- @error('noFsa')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="form-group col-4">
                                <label for="last_name">ឯកសារយោង</label>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>


                                {{-- @error('noFsa')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="last_name">ល.រ ដីកាអម</label>
                                <input id="last_name" type="text" class="form-control" name="orderReference" required>
                                {{-- @error('orderReference')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>
                            <div class="form-group col-4">
                                <label for="frist_name">កាលបរិច្ឆេទ ប័ណ្ណចំណូលនៅធនាគារ<span
                                        class="text-danger"><b>*</b></span></label>
                                <input id="frist_name" type="date" class="form-control" name="dateOfBankIncomeCard">
                            </div>
                            <div class="form-group col-4">
                                <label for="bank">ABA<span class="text-danger"><b>*</b></span></label>
                                <input id="bank" type="text" class="form-control" name="bank" placeholder="ABA">
                                @error('bank')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>ឈ្មោះនិយ័តករ</label>
                                <select name="regulatorName[]" class="form-control regulatorName">
                                    @foreach ($regulators as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6 d-flex justify-content-between">
                                <div class="w-100 mr-2">
                                    <label>ប្រាក់ដុល្លា</label>
                                    <input type="text" class="form-control amountDolla" name="amountDolla[]"
                                        placeholder="ចំនួនទឹកប្រាក់" pattern="[0-9]+(\.[0-9]+)?">
                                    @error('amountDolla')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-100">
                                    <label>ប្រាក់រៀល</label>
                                    <input type="text" class="form-control amountRiel" name="amountRiel[]"
                                        placeholder="ចំនួនទឹកប្រាក់" pattern="[0-9]+(\.[0-9]+)?">
                                    @error('amountRiel')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <div id="regulator"></div>
                            </div>
                            <div class="form-group col-6 d-flex justify-content-between">
                                <div id="amountDolla" class="w-100 mr-2"></div>
                                <div id="amountRiel" class="w-100"></div>
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
    <script>
        var regulators = {!! json_encode($regulators) !!};
        console.log(regulators.length)
        var btnAddInput = document.getElementById("addInput");

        function addInput() {

            var amount = document.createElement("input");
            amount.type = "text";
            amount.classList.add("form-control");
            amount.classList.add("amountDolla");
            amount.name = "amountDolla[]"; // You can set the name dynamically if needed
            amount.placeholder = "ចំនួនទឹកប្រាក់";
            amount.pattern = "[0-9]+(\.[0-9]+)?";
            // amount.required = true;

            var label = document.createElement("label");
            label.innerHTML = "ប្រាក់ដុល្លា";

            var amountriel = document.createElement("input");
            amountriel.type = "text";
            amountriel.classList.add("form-control");
            amountriel.classList.add("amountRiel");
            amountriel.name = "amountRiel[]"; // You can set the name dynamically if needed
            amountriel.placeholder = "ចំនួនទឹកប្រាក់";
            amountriel.pattern = "[0-9]+(\.[0-9]+)?";
            // amountriel.required = true;

            var labelr = document.createElement("label");
            labelr.innerHTML = "ប្រាក់រៀល";

            var selectInput = document.createElement("select");
            selectInput.name = "regulatorName[]";
            selectInput.classList.add("form-control");
            selectInput.classList.add("regulatorName");

            regulators.forEach(function(regulators) {
                var option = document.createElement("option");
                option.text = regulators;
                option.value = regulators;
                selectInput.add(option);
            });

            var labelSelectInput = document.createElement("label");
            labelSelectInput.innerHTML = "ឈ្មោះនិយ័តករ";

            var currencyAmountR = document.getElementById("amountRiel");
            currencyAmountR.appendChild(labelr);
            currencyAmountR.appendChild(amountriel);
            currencyAmountR.appendChild(document.createElement("br"));

            var currencyAmount = document.getElementById("amountDolla");
            currencyAmount.appendChild(label);
            currencyAmount.appendChild(amount);
            currencyAmount.appendChild(document.createElement("br"));

            var regulator = document.getElementById("regulator");
            regulator.appendChild(labelSelectInput);
            regulator.appendChild(selectInput);
            regulator.appendChild(document.createElement("br"));
        }

        // $(document).ready(function() {
        //     $('#myForm').submit(function(event) {
        //         // Prevent the default form submission
        //         event.preventDefault();

        //         // Get the form data
        //         var formData = $(this).serialize();

        //         // Send the AJAX request
        //         $.ajax({
        //             url: '/revenues', // Replace with your Laravel route
        //             type: 'POST',
        //             data: formData,
        //             success: function(response) {
        //                 // Handle the response
        //                 console.log(response);
        //             },
        //             error: function(xhr, status, error) {
        //                 // Handle errors
        //                 var er = xhr.responseText;
        //                 console.error(er);
        //             }
        //         });
        //     });
        // });
    </script>
@endsection
