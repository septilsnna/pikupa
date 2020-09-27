<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard Admin PIKUPA</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="/css/dashboard.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <img class="rounded" src="/logo/logos.png" style="width: 90%;">
                <h5 class="text-center mt-3 mb-0" style="color: #424242;">Halo Admin PIKUPA</h5>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="/Admin/dashboard">Home</a>
                </li>
                <li>
                    <a href="/Admin/orders">Orders</a>
                </li>
                <li>
                    <a href="/Admin/manage_product">Products</a>
                </li>
                <li>
                    <a href="/Admin/promotions">Promotions</a>
                </li>
                <li>
                    <a href="/Admin/manage_user">Manage User</a>
                </li>
                <li>
                    <a href="../Config/logout">Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <button type="button" id="sidebarCollapse" class="btn" style="background-color: #febb31; color: #f7f7f7">
                <i class="fas fa-align-left"></i>
                <span>MENU</span>
            </button>
            <div class="container">
                <div class="row my-3">
                    <h2>Dashboard Admin PIKUPA</h2>
                </div>
                <div class="row my-3">
                    <h5 style="color:gray">Pemesanan Produk di Website PIKUPA</h5>
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <div class="card bg-light mb-3 shadow"
                            style="border-left-color: #FFCE67; border-width: 0px 0px 0px 10px;">
                            <div class="card-header py-4" style="font-size: large;">
                                <h2><?= $review; ?></h2> ON REVIEW
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light mb-3 shadow"
                            style="border-left-color: #C4C4C4; border-width: 0px 0px 0px 10px;">
                            <div class="card-header py-4" style="font-size: large;">
                                <h2><?= $process; ?></h2> PROCESS
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light mb-3 shadow"
                            style="border-left-color: #B5F3AB; border-width: 0px 0px 0px 10px;">
                            <div class="card-header py-4" style="font-size: large;">
                                <h2><?= $finish; ?></h2> FINISH
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light mb-3 shadow"
                            style="border-left-color: #FF6767; border-width: 0px 0px 0px 10px;">
                            <div class="card-header py-4" style="font-size: large;">
                                <h2><?= $reject; ?></h2> REJECT
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <h5 style="color:gray">Pemasukan PIKUPA</h5>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="card bg-light mb-3 shadow"
                            style="border-left-color: #424242; border-width: 0px 0px 0px 10px;">
                            <div class="card-header py-4" style="font-size: large;">
                                <h2>Rp<?= $pendapatan; ?></h2> MELALUI WEBSITE
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light mb-3 shadow"
                            style="border-left-color: #424242; border-width: 0px 0px 0px 10px;">
                            <div class="card-header py-4" style="font-size: large;">
                                <h2>Rp<?= $promosi; ?></h2> MELALUI IKLAN PROMOSI
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <h5 style="color:gray">TOTAL</h5>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="card bg-light mb-3 shadow"
                            style="border-left-color: #424242; border-width: 0px 0px 0px 10px;">
                            <div class="card-header py-4" style="font-size: large;">
                                <h2><?= $user; ?></h2> AKUN PENGGUNA
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light mb-3 shadow"
                            style="border-left-color: #424242; border-width: 0px 0px 0px 10px;">
                            <div class="card-header py-4" style="font-size: large;">
                                <h2><?= $finish; ?></h2> PRODUK TERJUAL
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light mb-3 shadow"
                            style="border-left-color: #424242; border-width: 0px 0px 0px 10px;">
                            <div class="card-header py-4" style="font-size: large;">
                                <h2>Rp<?= $pendapatan + $promosi; ?></h2> PENDAPATAN
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light mb-3 shadow"
                            style="border-left-color: #424242; border-width: 0px 0px 0px 10px;">
                            <div class="card-header py-4" style="font-size: large;">
                                <h2><?= $p_promosi; ?></h2> PRODUK PROMOSI
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
    </script>
</body>

</html>