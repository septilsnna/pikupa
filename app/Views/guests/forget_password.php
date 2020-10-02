<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Atur Ulang Password - PIKUPA</title>
</head>

<body style="background-color:#f7f7f7; font-family: Montserrat; font-style: normal; color: #424242;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 my-2 px-5 pt-5">
                <form action="/Config/update_pass/<?= $token ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="card px-2 shadow p-3 mb-5 bg-white">
                        <div class="card-body">
                            <div class="form-group row px-3">
                                <h3>Pembaruan Password</h3>
                                <p>Silahkan update password kakak disini! Jangan sampai lupa lagi ya kak :)</p>
                            </div>
                            <div class="form-group row px-3">
                                <div class="col-md-12 pt-2">
                                    <label style="font-weight: normal;" for="password">Password</label>
                                    <input type="password"
                                        class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>"
                                        style="border-radius: 10px; background-color: C4C4C4; opacity: 0.8"
                                        id="password" name="password" placeholder="ex: ironmanaliastonystark">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 pt-2">
                                    <label style="font-weight: normal;" for="password2">Password</label>
                                    <input type="password"
                                        class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : ''; ?>"
                                        style="border-radius: 10px; background-color: C4C4C4; opacity: 0.8"
                                        id="password2" name="password2" placeholder="ex: ironmanaliastonystark">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password2'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row px-3 pt-4 justify-content-center">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-block"
                                        style="font-weight: bold; background-color: #FEB724; border-radius: 20px">Perbarui
                                        Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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