<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Full Color Illustration - PIKUPA</title>
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
                        <a class="dropdown-item" href="/portofolios/index/illustration"
                            style="background-color:#f7f7f7; color:#424242">Illustration</a>
                        <a class="dropdown-item" href="/portofolios/index/custom_design"
                            style="background-color:#f7f7f7; color:#424242">Custom
                            Design</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle px-4 mx-2" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown">
                        ORDER <span class="sr-only">(current)</span>
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
                <a class="nav-link px-2" role="button" href="/profile/index">Halo, <?= $nama; ?>!</a>
                <a class="nav-link px-2" role="button" href="/Config/logout">LOGOUT</a>
            </div>
        </div>
    </nav>
</head>

<body style="background-color:#f7f7f7; font-family: Montserrat; font-style: normal; color: #424242;">
    <div class="container my-5 py-2 text-center">
        <div class="row">
            <div class="col pt-3 px-lg-5">
                <h3 style="font-weight: bold; font-size: 28px; color: #FEB724;">
                    Pilih Jenisnya Yuk!</h3>
            </div>
        </div>
        <div class="row">
            <div class="col pt-3 px-lg-5">
                <a href="/portofolios/index/illustration"><small class="text-secondary"
                        style="font-weight: normal; font-size: 16px; line-height: 29px; color: #424242; text-decoration-line: underline;">Lihat
                        Portofolio Kami Disini</small>
                </a>
            </div>
        </div>
        <form action="/Config/order_full_color" method="post">
            <div class="row justify-content-center pt-3 px-lg-5">
                <nav aria-label="Size navigation">
                    <ul class="pagination">
                        <li class="page-item">
                            <input type="hidden" name="fcHead" id="fcHead" value="head"></input>
                            <label for="fcHead" type="button" class="btn" id="fcH" onclick="fcHead()"
                                style="background-color: #FEB724; box-sizing: border-box; color:#424242">Head
                            </label>
                        </li>
                        <li class="page-item">
                            <input type="hidden" name="fcHalfBody" id="fcHalfBody"></input>
                            <label for="fcHalfBody" type="button" class="btn" id="fcHB" onclick="fcHalfBody()"
                                style="background-color: rgba(225, 225, 225, 0.5); box-sizing: border-box; color:#424242">Half
                                Body
                            </label>
                        </li>
                        <li class="page-item">
                            <input type="hidden" name="fcFullBody" id="fcFullBody"></input>
                            <label for="fcFullBody" type="button" class="btn" id="fcFB" onclick="fcFullBody()"
                                style="background-color: rgba(225, 225, 225, 0.5); box-sizing: border-box; color:#424242">Full
                                Body
                            </label>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="container my-5" id="size" style="background-color: #424242; height: 300px; width: 300px">
                <div class="row-md">

                </div>
            </div>
            <button type="submit" class="btn"
                style="background-color: #DAA520; color:white; border-radius: 20px">ORDER</button>
        </form>
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
    <script>
    function fcHead() {
        document.getElementById("size").style.width = '300px';
        document.getElementById('fcH').style.backgroundColor = '#FEB724';
        document.getElementById('fcHB').style.backgroundColor = 'rgba(225, 225, 225, 0.5)';
        document.getElementById('fcFB').style.backgroundColor = 'rgba(225, 225, 225, 0.5)';
        document.getElementById('fcHead').value = 'head';
        document.getElementById('fcHalfBody').value = '';
        document.getElementById('fcFullBody').value = '';
    }

    function fcHalfBody() {
        document.getElementById("size").style.width = '400px';
        document.getElementById('fcH').style.backgroundColor = 'rgba(225, 225, 225, 0.5)';
        document.getElementById('fcHB').style.backgroundColor = '#FEB724';
        document.getElementById('fcFB').style.backgroundColor = 'rgba(225, 225, 225, 0.5)';
        document.getElementById('fcHead').value = '';
        document.getElementById('fcHalfBody').value = 'half_body';
        document.getElementById('fcFullBody').value = '';
    }

    function fcFullBody() {
        document.getElementById("size").style.width = '500px';
        document.getElementById('fcH').style.backgroundColor = 'rgba(225, 225, 225, 0.5)';
        document.getElementById('fcHB').style.backgroundColor = 'rgba(225, 225, 225, 0.5)';
        document.getElementById('fcFB').style.backgroundColor = '#FEB724';
        document.getElementById('fcHead').value = '';
        document.getElementById('fcHalfBody').value = '';
        document.getElementById('fcFullBody').value = 'full_body';
    }
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