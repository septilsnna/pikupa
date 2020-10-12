<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url() ?>/pikupa_favicon.png" type="image/gif">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Profile Saya - PIKUPA</title>
    <nav class="navbar sticky-top navbar-expand-md navbar-light bg-light" style="color:#424242;">
        <a class="navbar-brand px-4 mx-5 justify-content-end" href="/home/index"><img src="/logo/logo.png" height="30"
                alt="Logo Pikupa"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link px-4 mx-2" href="/home/index">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 mx-2" href="/about/index">ABOUT</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-4 mx-2" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown">
                        PORTOFOLIOS
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"
                        style="border: none; padding:15px">
                        <a class="dropdown-item" href="/portofolios/index/twitter_profile_needs/11"
                            style="background-color:#f7f7f7; color:#424242">Twitter Profile
                            Needs</a>
                        <a class="dropdown-item" href="/portofolios/index/illustration/full_color"
                            style="background-color:#f7f7f7; color:#424242">Illustration</a>
                        <a class="dropdown-item" href="/portofolios/index/custom_design/0"
                            style="background-color:#f7f7f7; color:#424242">Custom
                            Design</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-4 mx-2" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown">
                        ORDER
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"
                        style="border: none; padding:15px">
                        <a class="dropdown-item" href="/order/index/twitter_profile_needs"
                            style="background-color:#f7f7f7; color:#424242">Twitter Profile Needs</a>
                        <a class="dropdown-item" href="/order/index/illustration"
                            style="background-color:#f7f7f7; color:#424242">Illustration</a>
                        <a class="dropdown-item" href="/order/index/custom_design"
                            style="background-color:#f7f7f7; color:#424242">Custom Design</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <div class="navbar-nav">
                <a class="nav-link px-2 active" role="button" href="/profile/index">Halo, <?= $nama; ?>! <span
                        class="sr-only">(current)</span></a>
                <a class="nav-link px-2" role="button" href="/Config/logout">LOGOUT</a>
            </div>
        </div>
    </nav>
</head>

<body style="background-color:#f7f7f7; font-family: Montserrat; font-style: normal; color: #424242;">
    <div class="container mt-5 py-2">
        <div class="row">
            <div class="col mt-3">
                <h3 style="font-weight: bold; font-size: 28px; color: #FEB724;">
                    My Profile</h3>
            </div>
        </div>
        <div class="row my-4 px-3">
            <div class="col-md-1 py-2 px-2">
                <img src="/img/profile.png" alt="Profile" style="width: 80px">
            </div>
            <div class="col-md-7 py-2 px-2">
                <h4><?= $user[0]['name']; ?></h4>
                <h6>Bergabung Sejak: <?= $gabung; ?></h6>
                <h6>Jumlah Transaksi: <?= count($order); ?></h6>
            </div>
            <div class="col-md-3 py-2 px-2">
                <a href="/profile/edit_profile" class="btn px-4"
                    style="background-color: #FEB724; border-radius: 20px">UBAH DETAIL
                    PROFIL</a>
            </div>
        </div>
        <div class="row my-4 px-3">
            <div class="col-md-2 py-2">
                <h5 style="color: grey; font-size: 16px">User ID</h5>
                <h6><?= $user[0]['id']; ?></h6>
            </div>
            <div class="col-md-3 py-2">
                <h5 style="color: grey; font-size: 16px">Email</h5>
                <h6><?= $user[0]['email']; ?></h6>
            </div>
            <!-- <div class="col-md-3 py-2">
                <h5 style="color: grey; font-size: 16px">Twitter</h5>
                <h6>-</h6>
            </div> -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($_SESSION['update'])) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Yay! </strong><?= $_SESSION['update']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3">
                <h3 style="font-weight: bold; font-size: 28px; color: #FEB724;">Order List</h3>
            </div>
        </div>
        <div class="row py-3 pb-5">
            <table class="table table-borderless  table-hover ">
                <thead>
                    <tr style="font-size: 16px; color:gray">
                        <th class="text-center" scope="col">ID Pemesanan</th>
                        <th class="text-center" scope="col">Waktu Pemesanan</th>
                        <th class="text-center" scope="col">Kategori Produk</th>
                        <th class="text-center" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($order); $i++) : ?>
                    <tr>
                        <td class="text-center" scope="row"><?= $order[$i]['id']; ?></td>
                        <td class="text-center" scope="row"><?= $order[$i]['order_date']; ?></td>
                        <td class="text-center" scope="row"><?= $order[$i]['product_name']; ?></td>
                        <?php if ($order[$i]['status'] == "On Review") : ?>
                        <td class="text-center" scope="row">
                            <p class="d-inline-flex py-1 px-4" style="background-color: #FFCE67; border-radius: 10px;">
                                <?= $order[$i]['status']; ?>
                            </p>
                        </td>
                        <?php endif; ?>
                        <?php if ($order[$i]['status'] == "Rejected") : ?>
                        <td class="text-center" scope="row">
                            <p class="d-inline-flex py-1 px-4" style="background-color: #FF6767; border-radius: 10px;">
                                <?= $order[$i]['status']; ?>
                            </p>
                        </td>
                        <?php endif; ?>
                        <?php if ($order[$i]['status'] == "Accepted" | $order[$i]['status'] == "Process" | $order[$i]['status'] == "Finish") : ?>
                        <td class="text-center" scope="row">
                            <p class="d-inline-flex py-1 px-4" style="background-color: #B5F3AB; border-radius: 10px;">
                                <?= $order[$i]['status']; ?>
                            </p>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</body>

<footer>
    <div class="static-bottom"
        style="font-family: Montserrat; font-style: normal; color: #ffffff; background-color: rgba(254, 183, 36, 0.94);">
        <div class="container">
            <div class="row py-4 align-items-center">
                <div class="col-md-9 px-5">
                    <div class="row" style="font-weight: bold; font-size: 18px">
                        <h2>Mau Konsultasi Dulu?<br>Boleh Banget~</h2>
                    </div>
                </div>
                <div class="col-sm-3 px-5">
                    <div class="row">
                        <a class="btn btn-sm text-left" href="http://twitter.com/pikuupa" role="button"
                            style="font-size: 16px; font-weight: bold; color: #f7f7f7">
                            <!-- <img src="/img/twitter-black-shape.png" class="img" style="width:20px;" alt="testi-1"> -->
                            @pikuupa
                        </a>
                    </div>
                    <div class="row">
                        <a class="btn btn-sm text-left" href="mailto:pikuupa@gmail.com" role="button"
                            style="font-size: 16px; font-weight: bold; color: #f7f7f7">
                            <!-- <img src="/img/email.png" class="img" style="width:20px;" alt="testi-1"> -->
                            pikuupa@gmail.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="static-bottom"
        style="font-family: Montserrat; font-style: normal; color: #ffffff; background-color: #D0951B;">
        <div class="text-center py-2">
            <h6>copyright pikuupa 2020</h6>
        </div>
    </div>
</footer>

</html>