<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url() ?>/pikupa_favicon.png" type="image/gif">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Login - PIKUPA</title>
</head>

<body style="background-color:#f7f7f7; font-family: Montserrat; font-style: normal; color: #424242;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 px-5">
                <div class="row mt-4 mb-3">
                    <p>Belum punya akun?</p>
                    <a href="/register" class="mx-2" style="color: #feb724;">Sign Up
                        Disini</a>
                    </p>
                </div>
            </div>
            <div class="col-md-7 my-2 px-5">
                <div class="card px-2 shadow p-3 mb-5 bg-white">
                    <form action="/login/config" method="post">
                        <div class="card-body">
                            <div class="form-group row px-3">
                                <h3>Welcome back!</h3>
                            </div>
                            <?php if (isset($_SESSION['verified'])) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?= $_SESSION['verified']; ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['wrong_password'])) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?= $_SESSION['wrong_password']; ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['not_found'])) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?= $_SESSION['not_found']; ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['forget'])) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Yay! </strong><?= $_SESSION['forget']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['update'])) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Yay! </strong><?= $_SESSION['update']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>
                            <div class="form-group row px-3">
                                <div class="col-md-12 py-2">
                                    <label style="font-weight: normal;" for="email">Email</label>
                                    <input type="email" class="form-control"
                                        style="border-radius: 10px; background-color: C4C4C4; opacity: 0.8" id="email"
                                        name="email" placeholder="ex: ironman@marvel.com" value="<?= old('email'); ?>"
                                        required autofocus>
                                </div>
                                <div class="col-md-12 pt-2">
                                    <label style="font-weight: normal;" for="password">Password</label>
                                    <input type="password" class="form-control"
                                        style="border-radius: 10px; background-color: C4C4C4; opacity: 0.8"
                                        id="password" name="password" placeholder="ex: ironmanaliastonystark" required>
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <a href="" class="px-3 text-center" data-toggle="modal" data-target="#ModalCenter"
                                style="color: red; border-radius: 10px;">Lupa Password?</a>
                            <div class="form-group row px-3 pt-4 justify-content-center">
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-block"
                                        style="font-weight: bold; background-color: #FEB724; border-radius: 20px">Login
                                        Me
                                        Up</button>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <a href="<?= $googleLogin ?>" class="btn mx-2 mb-3" role="button"
                                    style="font-weight: bold; width: 250px; background-color: #fafafa; border-radius: 20px; border-color:gray"><img
                                        class="mx-2" src="/logo/google_login.png" style="width:10%">Login With
                                    Google</a>
                            </div>
                            <div class="row justify-content-center">
                                <a href="/login/LoginWithTwitter" class="btn mx-2 mb-3" role="button"
                                    style="font-weight: bold; width: 250px; background-color: #fafafa; border-radius: 20px; border-color:gray"><img
                                        class="mx-2" src="/logo/twitter_login.png" style="width:10%">Login With
                                    Twitter</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLongTitle">Lupa Password?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/Config/forget_pass" method="post">
                                <div class="modal-body">
                                    <p class="text-center"><strong>Tenang saja!</strong> Kami akan
                                        mengirimkan link verifikasi
                                        melalui email kamu, agar kamu
                                        dapat mengubah
                                        password.</p>
                                    <div class="form-group row mx-1">
                                        <label for="email" class="col-md-2 col-form-label">Email</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="email" id="email"
                                                placeholder="ex: ironman@marvel.com" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn"
                                        style="background-color: #B5F3AB; border-radius: 10px;">Kirim Link
                                        Email</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</body>

</html>