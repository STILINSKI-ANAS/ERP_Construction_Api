<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>INVO - Invoice HTML5 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="../../../public/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../../fonts/font-awesome.min.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" >

    <!-- Google fonts -->
{{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">--}}

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<!-- Invoice 10 start -->
<div class="invoice-10 invoice-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-inner">
                    <div class="invoice-info" id="invoice_wrapper">
                        <div class="invoice-headar">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="invoice-name">
                                        <!-- logo started -->
                                        <div class="logo">
                                            <img class="logo" src="assets/img/logo.png" alt="logo">
                                        </div>
                                        <!-- logo ended -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="invoice">
                                        <h1 class="text-end inv-header-1">Invoice: #943249</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-top">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="invoice-number">
                                        <h4 class="inv-title-1">Invoice To</h4>
                                        <p class="invo-addr-1">
                                            Theme Vessel <br/>
                                            info@themevessel.com <br/>
                                            21-12 Green Street, Meherpur, Bangladesh <br/>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="invoice-number text-end">
                                        <h4 class="inv-title-1">Bill To</h4>
                                        <p class="invo-addr-1">
                                            Apexo Inc  <br/>
                                            billing@apexo.com <br/>
                                            169 Teroghoria, Bangladesh <br/>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-6">
                                    <h4 class="inv-title-1">Date</h4>
                                    <p class="inv-from-1">Due Date:21/09/2021</p>
                                </div>
                                <div class="col-sm-6 text-end">
                                    <h4 class="inv-title-1">Payment Method</h4>
                                    <p class="inv-from-1">Credit Card</p>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-center">
                            <div class="table-responsive">
                                <table class="table table-striped invoice-table">
                                    <thead class="bg-active">
                                    <tr>
                                        <th>Item Item</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="item-desc-1">
                                                <span>BS-200</span>
                                                <small>Customize web application</small>
                                            </div>
                                        </td>
                                        <td class="text-center">$10.99</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">$10.99</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="item-desc-1">
                                                <span>BS-201</span>
                                                <small>Website development and customization for themevessel</small>
                                            </div>
                                        </td>
                                        <td class="text-center">$20.00</td>
                                        <td class="text-center">3</td>
                                        <td class="text-right">$60.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="item-desc-1">
                                                <span>BS-233</span>
                                                <small>Website SEO improvement of themevessel.com Website development and customization for themevessel</small>
                                            </div>
                                        </td>
                                        <td class="text-center">$640.00</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">$640.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">SubTotal</td>
                                        <td class="text-right">$710.99</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">Tax</td>
                                        <td class="text-right">$85.99</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end f-w-600">Grand Total</td>
                                        <td class="text-right f-w-600">$795.99</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="invoice-bottom">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <h3 class="inv-title-1">Important Note</h3>
                                        <ul class="important-notes-list-1">
                                            <li>Once order done, money can't refund</li>
                                            <li>Delivery might delay due to some external dependency</li>
                                            <li>This is computer generated invoice and physical signature does not require.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-offsite">
                                    <div class="text-end">
                                        <h3 class="inv-title-1">Payment Info</h3>
                                        <p class="mb-0 text-13">This payment made by BRAC BANK master card without any problem</p>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="invoice-contact">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-12">--}}
{{--                                    <div class="social-list d-print-none">--}}
{{--                                        <span>Follow Us</span>--}}
{{--                                        <a href="#" class="facebook-bg">--}}
{{--                                            <i class="fa fa-facebook"></i>--}}
{{--                                        </a>--}}
{{--                                        <a href="#" class="twitter-bg">--}}
{{--                                            <i class="fa fa-twitter"></i>--}}
{{--                                        </a>--}}
{{--                                        <a href="#" class="google-bg">--}}
{{--                                            <i class="fa fa-google"></i>--}}
{{--                                        </a>--}}
{{--                                        <a href="#" class="linkedin-bg">--}}
{{--                                            <i class="fa fa-linkedin"></i>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Invoice 10 end -->

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jspdf.min.js"></script>
<script src="assets/js/html2canvas.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
