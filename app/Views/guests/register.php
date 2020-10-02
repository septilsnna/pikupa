<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Register - PIKUPA</title>
</head>

<body style="background-color:#f7f7f7; font-family: Montserrat; font-style: normal; color: #424242;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 px-5">
                <div class="row mt-4 mb-3">
                    <p>Sudah punya akun?</p>
                    <a href="/login" class="mx-2" style="color: #feb724;">Login
                        Disini</a>
                    </p>
                </div>
            </div>
            <div class="col-md-7 my-2 px-5">
                <form action="/register/config" method="post">
                    <?= csrf_field(); ?>
                    <div class="card px-2 shadow p-3 mb-5 bg-white">
                        <div class="card-body">
                            <div class="form-group row px-3">
                                <h5>Sign Up To PIKUPA</h5>
                            </div>
                            <?php if (isset($_SESSION['message'])) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Yay! Cek Email Kamu Ya.</strong> <?= $_SESSION['message']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>
                            <div class="form-group row px-3">
                                <div class="col-md-12 py-2">
                                    <label style="font-weight: normal;" for="name">Nama</label>
                                    <input type="text"
                                        class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>"
                                        style="border-radius: 10px; background-color: C4C4C4; opacity: 0.8" id="name"
                                        name="name" placeholder="ex: Iron Man" value="<?= old('name'); ?>" autofocus>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('name'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 py-2">
                                    <label style="font-weight: normal;" for="id">Username</label>
                                    <input type="text"
                                        class="form-control <?= ($validation->hasError('id')) ? 'is-invalid' : ''; ?>"
                                        style="border-radius: 10px; background-color: C4C4C4; opacity: 0.8" id="id"
                                        name="id" placeholder="ex: akangIronMan" value="<?= old('id'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('id'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 py-2">
                                    <label style="font-weight: normal;" for="email">Email</label>
                                    <input type="text"
                                        class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>"
                                        style="border-radius: 10px; background-color: C4C4C4; opacity: 0.8" id="email"
                                        name="email" placeholder="ex: ironman@marvel.com" value="<?= old('email'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 py-2">
                                    <label style="font-weight: normal;" for="password">Password</label>
                                    <input type="password"
                                        class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>"
                                        style="border-radius: 10px; background-color: C4C4C4; opacity: 0.8"
                                        id="password" name="password" placeholder="ex: ironmanaliastonystark"
                                        value="<?= old('password'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 py-2">
                                    <label style="font-weight: normal;" for="password2">Konfirmasi Password</label>
                                    <input type="password"
                                        class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : ''; ?>"
                                        style="border-radius: 10px; background-color: C4C4C4; opacity: 0.8"
                                        id="password2" name="password2" placeholder="ex: ironmanaliastonystark"
                                        value="<?= old('password2'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password2'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row px-3 justify-content-center">
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-block"
                                        style="font-weight: bold; background-color: #FEB724; border-radius: 20px">Sign
                                        Me
                                        Up</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!--<div class="col-md-6 px-5 mb-5 mt-3">
                <div class="row justify-content-center">
                    <a href="" class="btn mx-2 mb-3"
                        style="background-color: #5AAAF4; color: #ffffff; border-radius: 10px"><img class="mx-2"
                            src="/img/twitter.png" style="width:5%">Sign
                        Up With Twitter</a>
                    <a href="" class="btn mx-2 mb-3"
                        style="background-color: #fafafa; color: #424242; border-radius: 10px; border-color:#424242"><img
                            class="mx-2" src="/img/google.png" style="width:3%">Sign
                        Up With Google</a>
                </div>
            </div>-->
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