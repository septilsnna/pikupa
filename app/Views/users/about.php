<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" />
    <title>PIKUPA</title>
    <nav class="navbar sticky-top navbar-expand-md navbar-light bg-light" style="color:#424242;">
        <a class="navbar-brand px-4 mx-5 justify-content-end" href="/Home/index"><img src="/logo/logo.png" height="30"
                alt="Logo Pikupa"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link px-4 mx-2" href="/Home/index">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active px-4 mx-2" href="/Home/about">ABOUT <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-4 mx-2" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown">
                        PORTOFOLIOS
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"
                        style="border: none; padding:15px">
                        <a class="dropdown-item" href="/Home/portfolio/twitter_profile_needs/11"
                            style="background-color:#f7f7f7; color:#424242">Twitter Profile
                            Needs</a>
                        <a class="dropdown-item disabled" href="/Home/portfolio/instagram_feeds">Instagram
                            Feeds</a>
                        <a class="dropdown-item disabled" href="/Home/portfolio/custom_design">Custom
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
                        <a class="dropdown-item" href="/Home/order/twitter_profile_needs"
                            style="background-color:#f7f7f7; color:#424242">Twitter Profile Needs</a>
                        <a class="dropdown-item disabled" href="/Home/order/instagram_feeds">Instagram Feeds</a>
                        <a class="dropdown-item" href="/Home/order/custom_design"
                            style="background-color:#f7f7f7; color:#424242">Custom Design</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <div class="navbar-nav">
                <a class="nav-link btn px-2" role="button" href="/Home/profile">Halo, <?= $nama; ?>!</a>
                <a class="nav-link btn px-2" role="button" href="/Config/logout">LOGOUT</a>
            </div>
        </div>
    </nav>
</head>

<body style="background-color:#f7f7f7; font-family: Montserrat; font-style: normal; color: #424242;">
    <div class="container my-4 py-5">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-7">
                    <h2>Kamu Ada Ide Desain?<br>Kita Coba Buat Realisasikan!<br>Selamat Datang Kakak~</h2>
                    <h5><small class="text-secondary">Kami Menyediakan Jasa Desain Grafis Harga Kaki Lima<br>Kualitas
                            Bintang Lima! Kakak Bisa Memesan
                            Sesuai Dengan<br>Tema Yang Telah Kami Sediakan Maupun Sesuai Dengan Permintaan.</small>
                    </h5>
                </div>
                <div class="col-5">
                    <img src="/logo/logos.png" style="max-width: 100%;" alt="">
                </div>
            </div>
        </div>
    </div>

    <!--Cara Pesan-->
    <div class="container my-5 py-2 text-center">
        <div class="row">
            <div class="col pt-3 px-lg-5">
                <h3 style="font-weight: bold; font-size: 28px; color: #FEB724;">
                    Cara Pesan</h3>
            </div>
        </div>
        <hr class="divider" style="width: 110px; border: 0.5px solid #424242;">
        <div class="row">
            <div class="col pt-3 px-lg-5">
                <h5><small class="text-secondary"
                        style="font-weight: normal; font-size: 16px; line-height: 29px; color: #424242;">Begini Cara
                        Memesan Di Website Pikupa:</small>
                </h5>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm pt-4">
                <img src="/img/create.png" class="card-img-top"
                    style="margin-left: auto; margin-right: auto; width:50%;">
                <h5 class="card-title pt-3">CREATE ACCOUNT</h5>
                <p class="card-text">Tenang aja, data kamu tidak akan disalahgunakan kok</p>
            </div>
            <div class="col-sm-1 pt-4">
                <img src="/img/next.png" class="img-fluid" style="width:20px;">
            </div>
            <div class="col-sm pt-4">
                <img src="/img/fill.png" class="card-img-top" style="margin-left: auto; margin-right: auto; width:50%;">
                <h5 class="card-title pt-3">FILL THE FORM</h5>
                <p class="card-text">Jangan lupa bayar DP juga ya, jika ada tambahan biaya akan
                    diinformasikan di akhir</p>
            </div>
            <div class="col-sm-1 pt-4">
                <img src="/img/next.png" class="img-fluid" style="width:20px;">
            </div>
            <div class="col-sm pt-4">
                <img src="/img/consult.png" class="card-img-top"
                    style="margin-left: auto; margin-right: auto; width:50%;">
                <h5 class="card-title pt-3">CONSULTATION & REVISION</h5>
                <p class="card-text">Selama proses pembuatan, kamu diperbolehkan untuk meminta revisi</p>
            </div>
            <div class="col-sm-1 pt-4">
                <img src="/img/next.png" class="img-fluid" style="width:20px;">
            </div>
            <div class="col-sm pt-4">
                <img src="/img/finishing.png" class="card-img-top"
                    style="margin-left: auto; margin-right: auto; width:50%;">
                <h5 class="card-title pt-3">FINISHING</h5>
                <p class="card-text">Jika sudah selesai, file akan dikirimkan melalui gdrive maupun DM
                    twitter</p>
            </div>
        </div>
    </div>

    <!--Produk Jasa Desain-->
    <div class="container my-5 py-5 text-center">
        <div class="row">
            <div class="col pt-3 px-lg-5">
                <h3 style="font-weight: bold; font-size: 28px; color: #FEB724;">
                    Produk Jasa Desain</h3>
            </div>
        </div>
        <hr class="divider" style="width: 170px; border: 0.5px solid #424242;">
        <div class="row">
            <div class="col py-3 px-lg-5">
                <h5><small class="text-secondary"
                        style="font-weight: normal; font-size: 16px; line-height: 29px; text-transform: capitalize; color: #424242;">Kami
                        Menawarkan Jasa Desain Grafis Sebagai Berikut:</small>
                </h5>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md pt-4">
                <div class="card text-center">
                    <div class="card-body py-3 px-3">
                        <h5 class="card-title">Twitter Profile Needs</h5>
                        <p class="card-text">Kami menyediakan jasa desain Untuk membuat akun kamu makin terlihat cantik
                            dan menyegarkan.</p>
                        <?php if ($jtpn >= 0) : ?>
                        <?php if ($jtpn > 0) : ?>
                        <p>Slot tersedia: <?= $jtpn; ?></p>
                        <a href="/Home/order/twitter_profile_needs" class="btn"
                            style="background-color: #DAA520; color:white; border-radius: 20px">ORDER HERE</a>
                        <?php else : ?>
                        <p>Slot tersedia: <?= $jtpn; ?></p>
                        <button type="button" class="btn"
                            style="background-color: #DAA520; color:white; border-radius: 20px" disabled>OUT
                            OF
                            STOCK</button>
                        <?php endif; ?>
                        <?php else : ?>
                        <button type="button" class="btn"
                            style="background-color: #DAA520; color:white; border-radius: 20px" disabled>COMING
                            SOON</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md pt-4">
                <div class="card text-center">
                    <div class="card-body py-3 px-3">
                        <h5 class="card-title">Instagram Feeds</h5>
                        <p class="card-text">Kami menyediakan jasa desain Untuk membuat feeds instagram.</p>
                        <?php if ($jif == null) : ?>
                        <button type="button" class="btn"
                            style="background-color: #DAA520; color:white; border-radius: 20px" disabled>COMING
                            SOON</button>
                        <?php else : ?>
                        <?php if ($jif == 0) : ?>
                        <p>Slot tersedia: <?= $jif; ?></p>
                        <button type="button" class="btn"
                            style="background-color: #DAA520; color:white; border-radius: 20px" disabled>OUT
                            OF
                            STOCK</button>
                        <?php else : ?>
                        <p>Slot tersedia: <?= $jif; ?></p>
                        <a href="/Home/order/instagram_feeds" class="btn"
                            style="background-color: #DAA520; color:white; border-radius: 20px">ORDER HERE</a>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md pt-4">
                <div class="card text-center">
                    <div class="card-body py-3 px-3">
                        <h5 class="card-title">Custom Design</h5>
                        <p class="card-text">Kami juga menyediakan jasa desain custom sesuai dengan kebutuhan.</p>
                        <?php if ($jcd == null) : ?>
                        <button type="button" class="btn"
                            style="background-color: #DAA520; color:white; border-radius: 20px" disabled>COMING
                            SOON</button>
                        <?php else : ?>
                        <?php if ($jcd == 0) : ?>
                        <p>Slot tersedia: <?= $jcd; ?></p>
                        <button type="button" class="btn"
                            style="background-color: #DAA520; color:white; border-radius: 20px" disabled>OUT
                            OF
                            STOCK</button>
                        <?php else : ?>
                        <p>Slot tersedia: <?= $jcd; ?></p>
                        <a href="/Home/order/custom_design" class="btn"
                            style="background-color: #DAA520; color:white; border-radius: 20px">ORDER HERE</a>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
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
            <div class="row py-5 align-items-center">
                <div class="col-md-9 px-5">
                    <div class="row" style="font-weight: bold; font-size: 18px">
                        <h4>Mau Konsultasi Dulu?<br>Boleh Banget~</h4>
                    </div>
                </div>
                <div class="col-sm-3 px-5">
                    <div class="row">
                        <a class="btn btn-sm text-left" href="http://twitter.com/pikuupa" role="button">
                            <img src="/img/twitter-black-shape.png" class="img" style="width:20px;" alt="testi-1">
                            @pikuupa
                        </a>
                    </div>
                    <div class="row">
                        <a class="btn btn-sm text-left" href="mailto:pikuupa@gmail.com" role="button">
                            <img src="/img/email.png" class="img" style="width:20px;" alt="testi-1">
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