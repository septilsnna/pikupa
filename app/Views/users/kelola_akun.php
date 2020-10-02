<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Kelola Akun Saya - PIKUPA</title>
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
                        <a class="dropdown-item disabled" href="/portofolios/index/instagram_feeds">Instagram
                            Feeds</a>
                        <a class="dropdown-item disabled" href="/portofolios/index/custom_design">Custom
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
                        <a class="dropdown-item disabled" href="/order/index/instagram_feeds">Instagram Feeds</a>
                        <a class="dropdown-item" href="/order/index/custom_design"
                            style="background-color:#f7f7f7; color:#424242">Custom Design</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <div class="navbar-nav">
                <a class="nav-link btn px-2 active" role="button" href="/profile/index">Halo, <?= $nama; ?>! <span
                        class="sr-only">(current)</span></a>
                <a class="nav-link btn px-2" role="button" href="/Config/logout">LOGOUT</a>
            </div>
        </div>
    </nav>
</head>

<body style="background-color:#f7f7f7; font-family: Montserrat; font-style: normal; color: #424242;">
    <div class="container mt-5 py-2">
        <div class="row">
            <div class="col mt-3">
                <h3 style="font-weight: bold; font-size: 28px; color: #FEB724;">
                    Pengaturan Akun</h3>
            </div>
        </div>
        <div class="row px-3">
            <div class="col-md-4 my-4">
                <a href="/profile/edit_profile" class="btn btn-block py-4 my-0"
                    style="background-color: #FEB724; border-radius: 0px; font-weight: bold; border-color: #424242; border-bottom-color: transparent;">KELOLA
                    AKUN</a>
                <a href="/profile/connection" class="btn btn-block py-4 my-0"
                    style="border-radius: 0px; font-weight: bold; border-color: #424242">AKUN
                    TERTAUT</a>
            </div>
            <div class="col-md-8 my-4">
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #DFDFDF">
                            <th class="px-5 py-3" scope="col">Ganti Kata Sandi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="px-5 py-3" scope="row">
                                <form action="/Config/password_update" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <div class="col-md-9 py-2">
                                            <label style="font-weight: normal;" for="password">Masukkan Kata Sandi
                                                Baru</label>
                                            <input type="password" class="form-control"
                                                style="border-radius: 10px; background-color: rgba(196, 196, 196, 0.3)"
                                                id="password" name="password" placeholder="kata sandi baru disini"
                                                required>
                                        </div>
                                        <div class="col-md-9 py-2">
                                            <label style="font-weight: normal;" for="password2">Konfirmasi Kata
                                                Sandi</label>
                                            <input type="password" class="form-control"
                                                style="border-radius: 10px; background-color: rgba(196, 196, 196, 0.3)"
                                                id="password2" name="password2"
                                                placeholder="konfirmasikan kata sandi barumu" required>
                                        </div>
                                        <div class="col-md-5 py-2">
                                            <button type="submit" class="btn btn-block"
                                                style="font-weight: bold; background-color: #FEB724; border-radius: 20px">Ganti
                                                Kata
                                                Sandi</button>
                                        </div>
                                    </div>
                                </form>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr style="background-color: #DFDFDF">
                            <th class="px-5 py-3" scope="col">Perbarui Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="px-5 py-3" scope="row">
                                <form action="/Config/email_update" method="post">
                                    <?= csrf_field(); ?>
                                    <?php if ($user[0]['email'] == null) : ?>
                                    <div class="form-group row">
                                        <div class="col-md-9 py-2">
                                            <label style="font-weight: normal;" for="email">Ups! kamu belum mendaftarkan
                                                email kamu nih, yuk daftarkan emailnya
                                                agar akun kamu semakin aman!</label>
                                            <input type="email" class="form-control"
                                                style="border-radius: 10px; background-color: rgba(196, 196, 196, 0.3)"
                                                id="email" name="email" placeholder="ex: pikuupa@gmail.com" required>
                                        </div>
                                        <div class="col-md-5 py-2">
                                            <button type="submit" class="btn btn-block"
                                                style="font-weight: bold; background-color: #FEB724; border-radius: 20px">Tambahkan
                                                Email</button>
                                        </div>
                                    </div>
                                    <?php else : ?>
                                    <div class="form-group row">
                                        <div class="col-md-9 py-2">
                                            <label style="font-weight: normal;" for="email">Masukkan Email
                                                Baru</label>
                                            <input type="email" class="form-control"
                                                style="border-radius: 10px; background-color: rgba(196, 196, 196, 0.3)"
                                                id="email" name="email" placeholder="email baru disini" required>
                                        </div>
                                        <div class="col-md-5 py-2">
                                            <button type="submit" class="btn btn-block"
                                                style="font-weight: bold; background-color: #FEB724; border-radius: 20px">Perbarui
                                                Email</button>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </form>
                            </th>
                        </tr>
                    </tbody>
                </table>
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