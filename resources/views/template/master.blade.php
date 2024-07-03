<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/prism/prism.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>

    <style>
        .toast {
            position: absolute;
            width: 350px;
            max-width: 100%;
            font-size: 0.875rem;
            pointer-events: auto;
            background-color: rgba(255, 255, 255, 0.85);
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.25rem;
        }

        .toast:not(.showing):not(.show) {
            opacity: 0;
        }

        .toast.hide {
            display: none;
        }

        .toast-container {
            width: -webkit-max-content;
            width: -moz-max-content;
            width: max-content;
            max-width: 100%;
            pointer-events: none;
        }

        .toast-container> :not(:last-child) {
            margin-bottom: 0.75rem;
        }

        .toast-header {
            display: flex;
            align-items: center;
            padding: 0.5rem 0.75rem;
            color: #6c757d;
            background-color: rgba(255, 255, 255, 0.85);
            background-clip: padding-box;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            border-top-left-radius: calc(0.25rem - 1px);
            border-top-right-radius: calc(0.25rem - 1px);
        }

        .toast-header .btn-close {
            margin-right: -0.375rem;
            margin-left: 0.75rem;
        }

        .toast-body {
            padding: 0.75rem;
            word-wrap: break-word;
        }

        .formatted-number {
            text-align: right;
        }
    </style>

</head>

<body>
    @yield('message')
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg">
            </div>

            <nav class="navbar navbar-expand-lg main-navbar">

                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>

                        {{-- <li class="d-none d-md-block d-sm-block ">
                            <ol class="breadcrumb">
                                <?php $segments = ''; ?>
                                <li class="breadcrumb-item">
                                    <a href="/" class="text-light">Home</a>
                                </li>
                                @foreach (Request::segments() as $segment)
                                    <?php $segments .= '/' . $segment; ?>
                                    <li class="breadcrumb-item">
                                        <a href="{{ $segments }}" class="text-light">{{ $segment }}</a>
                                    </li>
                                @endforeach
                            </ol>
                        </li> --}}
                    </ul>
                </div>

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown show">
                        <a href="/" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('assets/img/admin.jpg') }}" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">លោក​ ថៅ គីមរ៉ុង</div>
                        </a>
                    </li>
                </ul>

            </nav>

            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand p-3">
                        <a href="/">
                            <img alt="image" width="100%" src="{{ asset('assets/img/logo.png') }}">
                        </a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="/">GJ</a>
                    </div>
                    <ul class="sidebar-menu mt-5">
                        <li class="menu-header text-center">IAUOFFSA</li>
                        <li class="dropdown active">
                            <a href="/categories" class="nav-link">
                                <i class="fas fa-list-alt"></i>
                                <span>ប្រភេទ</span>
                            </a>
                        </li>
                        <li class="dropdown active">
                            <a href="#" class="nav-link has-dropdown"><i
                                    class="fas fa-fire"></i><span>មុខងារ</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/revenues">ចំណូលវិភាគទាន</a></li>
                                <li><a class="nav-link" href="/expenses">ចំណាយទូទៅ</a></li>
                                <li class="dropdown active">
                                    <a class="nav-link has-dropdown" href="#">ថវិកាជាតិ</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="nav-link" href="/national/budget/revenues">ចំណូល</a></li>
                                        <li><a class="nav-link" href="/national/budget/expenses">ចំណាយ</a></li>
                                    </ul>
                                </li>
                                <li><a class="nav-link" href="/journals">ទិនានុប្បវត្តិ</a></li>
                                <li><a class="nav-link" href="/ledgers">សៀវភៅកត់ត្រា</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                        <a href="/admins/logout" class="btn btn-primary btn-lg btn-block btn-icon-split text-danger">
                            <i class="fas fa-sign-out-alt"></i> <span class="text-light">ចាកចេញ</span>
                        </a>
                    </div>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">

                    @yield('contents')
                    {{-- <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Invoices</h4>
                                    <div class="card-header-action">
                                        <a href="#" class="btn btn-danger">View More <i
                                                class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive table-invoice">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Invoice ID</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th>Due Date</th>
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
                                            <tr>
                                                <td><a href="#">INV-76824</a></td>
                                                <td class="font-weight-600">Muhamad Nuruzzaki</td>
                                                <td>
                                                    <div class="badge badge-warning">Unpaid</div>
                                                </td>
                                                <td>July 22, 2018</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">INV-84990</a></td>
                                                <td class="font-weight-600">Agung Ardiansyah</td>
                                                <td>
                                                    <div class="badge badge-warning">Unpaid</div>
                                                </td>
                                                <td>July 22, 2018</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">INV-87320</a></td>
                                                <td class="font-weight-600">Ardian Rahardiansyah</td>
                                                <td>
                                                    <div class="badge badge-success">Paid</div>
                                                </td>
                                                <td>July 28, 2018</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-hero">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="far fa-question-circle"></i>
                                    </div>
                                    <h4>14</h4>
                                    <div class="card-description">Customers need help</div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="tickets-list">
                                        <a href="#" class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>My order hasn't arrived yet</h4>
                                            </div>
                                            <div class="ticket-info">
                                                <div>Laila Tazkiah</div>
                                                <div class="bullet"></div>
                                                <div class="text-primary">1 min ago</div>
                                            </div>
                                        </a>
                                        <a href="#" class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>Please cancel my order</h4>
                                            </div>
                                            <div class="ticket-info">
                                                <div>Rizal Fakhri</div>
                                                <div class="bullet"></div>
                                                <div>2 hours ago</div>
                                            </div>
                                        </a>
                                        <a href="#" class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>Do you see my mother?</h4>
                                            </div>
                                            <div class="ticket-info">
                                                <div>Syahdan Ubaidillah</div>
                                                <div class="bullet"></div>
                                                <div>6 hours ago</div>
                                            </div>
                                        </a>
                                        <a href="features-tickets.html" class="ticket-item ticket-more">
                                            View All <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </section>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2024 IAUOFFSA
                </div>
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/js/pages-auth.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <script src="{{ asset('assets/modules/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
    <script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <script src="{{ asset('assets/js/page/index.js') }}"></script>
    <script src="{{ asset('assets/modules/prism/prism.js') }}"></script>
    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>

    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/form') }}"></script>
    <script>
        $('#success-alert, #error-alert').fadeIn('slow');
        setTimeout(function() {
            $('#success-alert, #error-alert').fadeOut('slow');
        }, 8000);


        $(document).ready(function() {

            $('.formatted-currency').on('keyup', function() {

                let inputVal = $(this).val();
                let cleanedInput = inputVal.replace(/[^\d.-]/g, '');

                let formattedInput = formatCurrency(cleanedInput);
                $(this).val(formattedInput);

            });

            $('.currency-riel').each(function() {
                let text = $(this).text();
                let num = parseFloat(text);

                if (!isNaN(num)) {
                    let formattedNum = num.toLocaleString('km-KH', {
                        style: 'currency',
                        currency: 'KHR'
                    });
                    $(this).text(formattedNum);
                }
            });

            $('.currency-dolla').each(function() {
                let text = $(this).text();
                let num = parseFloat(text);

                if (!isNaN(num)) {
                    let formattedNum = num.toLocaleString('en-US', {
                        style: 'currency',
                        currency: 'USD'
                    });
                    $(this).text(formattedNum);
                }
            });

            formatAmount('amountAdv');
            formatAmount('amountMand');
            formatAmount('amountMandCash');

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

        function formatCurrency(value) {
            if (value === '') return '';

            // Split the value into integer and decimal parts
            let parts = value.split('.');
            let integerPart = parts[0];
            let decimalPart = parts.length > 1 ? '.' + parts[1] : '';

            // Add commas to the integer part using regex
            integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            return integerPart + decimalPart;
        }
    </script>
</body>

</html>
