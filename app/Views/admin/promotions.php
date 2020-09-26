<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Kelola Promosi di PIKUPA</title>

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
                <li>
                    <a href="/Admin/dashboard">Home</a>
                </li>
                <li>
                    <a href="/Admin/orders">Orders</a>
                </li>
                <li>
                    <a href="/Admin/manage_product">Products</a>
                </li>
                <li class="active">
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
                    <h2>Kelola Promosi di PIKUPA</h2>
                </div>
                <div class="row my-3">
                    <h5 style="color:gray">Promosi Aktif</h5>
                </div>
                <div class="row my-3">
                    <?php foreach ($active as $d) : ?>
                    <div class="jumbotron">
                        <img src="/img/<?= $d['file'] ?>" style="width: 100%">
                        <hr class="my-4">
                        <h5><?= $d['title']; ?></h5>
                        <a class="btn" href="#" role="button" style="background-color: #FF6767; color: #f7f7f7;">Masa
                            Waktu Habis</a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="row my-3">
                    <h5 style="color:gray">Riwayat Promosi</h5>
                </div>
                <div class="row my-3">
                    <?php foreach ($history as $d) : ?>
                    <div class="jumbotron">
                        <img src="/img/<?= $d['file'] ?>" style="width: 100%">
                        <hr class="my-4">
                        <h5><?= $d['title']; ?></h5>
                        <h6>Status : <?= $d['status']; ?></h6>
                    </div>
                    <?php endforeach; ?>
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