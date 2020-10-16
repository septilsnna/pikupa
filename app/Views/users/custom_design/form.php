<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url() ?>/pikupa_favicon.png" type="image/gif">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Form Order Custom Design - PIKUPA</title>
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
                <a class="nav-link active px-4 mx-2" style="text-align: center;" href="/home/index">HOME <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 mx-2" style="text-align: center;" href="/about/index">ABOUT</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-4 mx-2" style="text-align: center;" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown">
                        PORTOFOLIOS
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"
                        style="border: none; padding:15px">
                        <a class="dropdown-item" href="/portofolios/index/twitter_profile_needs/11"
                            style="background-color:#f7f7f7; text-align: center; color:#424242">Twitter Profile
                            Needs</a>
                        <a class="dropdown-item" href="/portofolios/index/illustration/full_color"
                            style="background-color:#f7f7f7;text-align: center; color:#424242">Illustration</a>
                        <a class="dropdown-item" href="/portofolios/index/custom_design/0"
                            style="background-color:#f7f7f7; text-align: center; color:#424242">Custom
                            Design</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-4 mx-2" style="text-align: center;" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown">
                        ORDER
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"
                        style="border: none; padding:15px;text-align: center;">
                        <a class="dropdown-item" href="/order/index/twitter_profile_needs"
                            style="background-color:#f7f7f7; color:#424242;text-align: center;">Twitter Profile Needs</a>
                        <a class="dropdown-item" href="/order/index/illustration"
                            style="background-color:#f7f7f7; color:#424242;text-align: center;">Illustration</a>
                        <a class="dropdown-item" href="/order/index/custom_design"
                            style="background-color:#f7f7f7; color:#424242; text-align: center;">Custom Design</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <div class="navbar-nav">
                <a class="nav-link px-2" role="button" href="/profile/index" style="text-align: center ; font-weight: 700">Halo, <?= $nama; ?>!</a>
                <a class="nav-link px-2" role="button" href="/Config/logout" style="text-align: center; ">LOGOUT</a>
            </div>
        </div>
    </nav>
</head>

<body style="background-color:#f7f7f7; font-family: Montserrat; font-style: normal; color: #424242;">
    <div class="container mt-5 py-2 text-center">
        <h2 style="font-weight: bold; font-size: 28px; color: #FEB724;">Halo Kak <?= $nama; ?>!</h2>
        <p style="font-size: 16px; color: #424242;">Tolong lengkapi formulir di bawah ini ya kak~</p>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <form action="/order/ordering_cd/<?= $_SESSION['sub_category'] ?>/<?= $_SESSION['product_id'] ?>"
                    method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="card text-center py-2 my-2">
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td scope="col" style="text-align: left">Nama pemesan</td>
                                    <td style="text-align: right; font-weight: bold"><?= $user[0]['name']; ?></td>
                                </tr>
                                <tr>
                                    <td scope="col" style="text-align: left">Produk</td>
                                    <td style="text-align: right; font-weight: bold">
                                        <?= $product[0]['sub_category_name']; ?></td>
                                </tr>
                                <tr>
                                    <td scope="col" style="text-align: left">Detail</td>
                                    <td style="text-align: right; font-weight: bold">
                                        <?= $detail; ?></td>
                                </tr>
                                <tr>
                                    <td scope="col" style="text-align: left">Harga</td>
                                    <td style="text-align: right; font-weight: bold">Rp<?= $price; ?></td>
                                </tr>
                                <tr>
                                    <td scope="col" style="text-align: left">Biaya Admin</td>
                                    <td style="text-align: right; font-weight: bold">Rp<?= $admin; ?></td>
                                </tr>
                                <tr style="border-bottom-style: solid;">
                                    <td scope="col" style="text-align: left">Diskon</td>
                                    <td style="text-align: right; font-weight: bold">Rp<?= $diskon; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="col" style="text-align: left">Total Pembayaran Awal</td>
                                    <td style="text-align: right; font-weight: bold">Rp<?= $total; ?></td>
                                </tr>
                            </table>
                            <div class="form-group row text-justify my-5 mx-2">
                                <label for="payment_method" class="row-md-4 row-form-label"
                                    style="font-weight: bold;">Bayar Yuk!</label>
                                <p>Scan QR code di bawah menggunakan OVO / GOPAY / DANA / ShopeePay / M-banking BCA /
                                    Jenius atau
                                    mobile banking lainnya. Masukkan nominal
                                    sesuai yang di atas ya :)</p>
                                <div class="row text-center">
                                <div class="col" href="#" id="pop">
                                    
                                    <img id="imageresource" src="/img/qris.jpeg" style="width: 60%">


<!-- Creates the bootstrap modal where the image will appear -->
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="text-align: center;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel" style="text-align: center;">Scan Me</h4>
</div>
<div class="modal-body">
<img src="" id="imagepreview" style="width: 100%; height: 100%" >
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" style="text-align: center;">Close</button>
</div>
</div>
</div>
</div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="invoice">Upload bukti pembayaran kamu disini</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input <?= ($validation->hasError('invoice')) ? 'is-invalid' : ''; ?>"
                                                id="invoice" name="invoice" onchange="previewInvoice()">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('invoice'); ?>
                                            </div>
                                            <label class="custom-file-label label1" for="invoice"
                                                aria-describedby="inputGroupFileAddon02">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row text-justify my-5 mx-2">
                                <label for="contact" class="row-md-4 row-form-label" style="font-weight: bold;">Mau
                                    dihubungi lewat mana?</label>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="contact" id="contact1"
                                                value="Twitter" checked>
                                            <label class="form-check-label" for="contact1">
                                                Twitter
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="contact" id="contact1"
                                                value="Instagram">
                                            <label class="form-check-label" for="contact1">
                                                Instagram
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="contact" id="contact1"
                                                value="Email">
                                            <label class="form-check-label" for="contact1">
                                                Email
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="contactin">Cantumkan username/email kamu disini</label>
                                        <input type="text"
                                            class="form-control <?= ($validation->hasError('contactin')) ? 'is-invalid' : ''; ?>"
                                            id="contactin" name="contactin" placeholder="ex: @pikuupa"
                                            value="<?= old('contactin'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('contactin'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row text-justify my-5 mx-2">
                                <label for="id_card" class="row-md-4 row-form-label" style="font-weight: bold;">Tanda
                                    bukti bahwa kamu pelajar (Kartu Pelajar/KTM)</label>
                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input <?= ($validation->hasError('id_card')) ? 'is-invalid' : ''; ?>"
                                        id="id_card" name="id_card" onchange="previewid_card()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('id_card'); ?>
                                    </div>
                                    <label class="custom-file-label label2" for="id_card"
                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group row text-justify my-5 mx-2">
                                <label for="deadline" class="row-md-4 row-form-label"
                                    style="font-weight: bold;">Deadline
                                    pengumpulan</label>
                                <input class="form-control" type="date" name="deadline" id="deadline"
                                    value="<?= old('deadline'); ?>">
                            </div>

                        </div>
                    </div>
                    <div class="form-group row justify-content-center my-5">
                        <div class="col">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter"
                                style="background-color: #DAA520; color:white; border-radius:20px">KIRIM
                                FORM</button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Pesanan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h3 style="font-style: bold;">Yakin data kamu<br>sudah benar?</h3>
                                            <p>Kami tidak bertanggung jawab jika username/email yang kamu berikan salah.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn"
                                                style="background-color: #FEB724; border-radius:20px">YAKIN
                                                BANGET!</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
    <script>
    function previewInvoice() {
        const invoice = document.querySelector('#invoice');
        const invoiceLabel = document.querySelector('.label1');
        invoiceLabel.textContent = invoice.files[0].name;
    }

    function previewid_card() {
        const id_card = document.querySelector('#id_card');
        const id_cardLabel = document.querySelector('.label2');
        id_cardLabel.textContent = id_card.files[0].name;
    }
    </script>

<script>
    $("#pop").on("click", function() {
   $('#imagepreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});</script>
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