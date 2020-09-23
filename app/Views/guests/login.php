<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>PIKUPA</title>
</head>

<body style="background-color:#f7f7f7; font-family: Montserrat; font-style: normal; color: #424242;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 px-5">
                <div class="row mt-4 mb-3">
                    <p>Belum punya akun?</p>
                    <a href="/Home/register" class="mx-2" style="color: #feb724;">Sign Up
                        Disini</a>
                    </p>
                </div>
            </div>
            <div class="col-md-7 my-2 px-5">
                <form action="/Config/login" method="post">
                    <?= csrf_field(); ?>
                    <div class="card px-2">
                        <div class="card-body">
                            <div class="form-group row px-3">
                                <h3>Welcome back!</h3>
                            </div>
                            <div class="form-group row px-3">
                                <div class="col-md-12 py-2">
                                    <label style="font-weight: normal;" for="email">Email</label>
                                    <input type="email" class="form-control"
                                        style="border-radius: 10px; background-color: C4C4C4; opacity: 0.8" id="email"
                                        name="email" placeholder="ex: ironman@marvel.com" required>
                                </div>
                                <div class="col-md-12 py-2">
                                    <label style="font-weight: normal;" for="password">Password</label>
                                    <input type="password" class="form-control"
                                        style="border-radius: 10px; background-color: C4C4C4; opacity: 0.8"
                                        id="password" name="password" placeholder="ex: ironmanaliastonystark" required>
                                </div>
                            </div>
                            <div class="form-group row px-3 justify-content-center">
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-block"
                                        style="font-weight: bold; background-color: #FEB724; border-radius: 20px">Login</button>
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
                        In With Twitter</a>
                    <a href="" class="btn mx-2 mb-3"
                        style="background-color: #fafafa; color: #424242; border-radius: 10px; border-color:#424242"><img
                            class="mx-2" src="/img/google.png" style="width:3%">Sign
                        In With Google</a>
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