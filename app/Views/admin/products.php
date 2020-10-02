<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Kelola Produk PIKUPA</title>

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
                <li class="active">
                    <a href="/Admin/manage_product">Products</a>
                </li>
                <li>
                    <a href="/Admin/manage_template_gif">Template GIF</a>
                </li>
                <li>
                    <a href="/Admin/manage_portofolios">Portofolios</a>
                </li>
                <li>
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
                    <h2>Kelola Produk PIKUPA</h2>
                </div>
                <div class="row my-3">
                    <h5 style="color:gray">Twitter Profile Needs</h5>
                </div>
                <div class="row mb-5">
                    <!--Template GIF-->
                    <div class="col-md-4">
                        <div class="card align-item-center shadow p-3 mb-5 bg-white" style="border-radius: 20px">
                            <div class="card-body py-3 px-3">
                                <h5 class="card-title text-center" style="font-weight: bold">
                                    <?= $template_gif['sub_category_name']; ?>
                                </h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Terjual <?= $template_gif['sold'] ?> produk</li>
                                <li class="list-group-item">Tersisa <?= $template_gif['stock'] ?> produk</li>
                                <li class="list-group-item">Harga produk : Rp <?= $template_gif['price'] ?></li>
                                <li class="list-group-item">Diskon produk : <?= $template_gif['discount'] ?>%</li>
                                <li class="list-group-item">Terakhir update pada <?= $template_gif['updated_at'] ?></li>
                            </ul>
                            <!-- Button trigger modal -->
                            <a href="" class="btn text-center py-3" data-toggle="modal"
                                data-target="#Modal<?= $template_gif['id'] ?>Center"
                                style="background-color: #fed98b; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">Kelola
                                Produk</a>

                            <!-- Modal -->
                            <div class="modal fade" id="Modal<?= $template_gif['id'] ?>Center" tabindex="-1"
                                role="dialog" aria-labelledby="Modal<?= $template_gif['id'] ?>CenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="Modal<?= $template_gif['id'] ?>LongTitle">Kelola
                                                Produk
                                                <?= $template_gif['sub_category_name']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/ConfigAdmin/edit_product/<?= $template_gif['id'] ?>"
                                            method="post">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="stock"
                                                        class="col-md-4 col-form-label text-right">Stok</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="stock"
                                                            id="stock" placeholder="<?= $template_gif['stock'] ?>"
                                                            min="<?= $template_gif['stock'] ?>"
                                                            value="<?= $template_gif['stock'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="price"
                                                        class="col-md-4 col-form-label text-right">Harga</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="price"
                                                            id="price" id="price"
                                                            placeholder="<?= $template_gif['price'] ?>"
                                                            value="<?= $template_gif['price'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="discount"
                                                        class="col-md-4 col-form-label text-right">Diskon</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="discount"
                                                            id="discount" id="discount"
                                                            placeholder="<?= $template_gif['discount'] ?>"
                                                            value="<?= $template_gif['discount'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn"
                                                    style="background-color: #fed98b; border-radius: 10px;">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Custom GIF-->
                    <div class="col-md-4">
                        <div class="card align-item-center shadow p-3 mb-5 bg-white" style="border-radius: 20px">
                            <div class="card-body py-3 px-3">
                                <h5 class="card-title text-center" style="font-weight: bold">
                                    <?= $custom_gif['sub_category_name']; ?>
                                </h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Terjual <?= $custom_gif['sold'] ?> produk</li>
                                <li class="list-group-item">Tersisa <?= $custom_gif['stock'] ?> produk</li>
                                <li class="list-group-item">Harga produk : Rp <?= $custom_gif['price'] ?></li>
                                <li class="list-group-item">Diskon produk : <?= $custom_gif['discount'] ?>%</li>
                                <li class="list-group-item">Terakhir update pada <?= $custom_gif['updated_at'] ?></li>
                            </ul>
                            <!-- Button trigger modal -->
                            <a href="" class="btn text-center py-3" data-toggle="modal"
                                data-target="#Modal<?= $custom_gif['id'] ?>Center"
                                style="background-color: #fed98b; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">Kelola
                                Produk</a>

                            <!-- Modal -->
                            <div class="modal fade" id="Modal<?= $custom_gif['id'] ?>Center" tabindex="-1" role="dialog"
                                aria-labelledby="Modal<?= $custom_gif['id'] ?>CenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="Modal<?= $custom_gif['id'] ?>LongTitle">Kelola
                                                Produk
                                                <?= $custom_gif['sub_category_name']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/ConfigAdmin/edit_product/<?= $custom_gif['id'] ?>" method="post">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="stock"
                                                        class="col-md-4 col-form-label text-right">Stok</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="stock"
                                                            id="stock" placeholder="<?= $custom_gif['stock'] ?>"
                                                            min="<?= $custom_gif['stock'] ?>"
                                                            value="<?= $custom_gif['stock'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="price"
                                                        class="col-md-4 col-form-label text-right">Harga</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="price"
                                                            id="price" id="price"
                                                            placeholder="<?= $custom_gif['price'] ?>"
                                                            value="<?= $custom_gif['price'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="discount"
                                                        class="col-md-4 col-form-label text-right">Diskon</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="discount"
                                                            id="discount" id="discount"
                                                            placeholder="<?= $custom_gif['discount'] ?>"
                                                            value="<?= $custom_gif['discount'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn"
                                                    style="background-color: #fed98b; border-radius: 10px;">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <h5 style="color:gray">Custom Design</h5>
                </div>
                <div class="row mb-5">
                    <!--Banner Event-->
                    <div class="col-md-4">
                        <div class="card align-item-center shadow p-3 mb-5 bg-white" style="border-radius: 20px">
                            <div class="card-body py-3 px-3">
                                <h5 class="card-title text-center" style="font-weight: bold">
                                    <?= $banner_event['sub_category_name']; ?>
                                </h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Terjual <?= $banner_event['sold'] ?> produk</li>
                                <li class="list-group-item">Tersisa <?= $banner_event['stock'] ?> produk</li>
                                <li class="list-group-item">Harga produk : Rp <?= $banner_event['price'] ?></li>
                                <li class="list-group-item">Diskon produk : <?= $banner_event['discount'] ?>%</li>
                                <li class="list-group-item">Terakhir update pada <?= $banner_event['updated_at'] ?></li>
                            </ul>
                            <!-- Button trigger modal -->
                            <a href="" class="btn text-center py-3" data-toggle="modal"
                                data-target="#Modal<?= $banner_event['id'] ?>Center"
                                style="background-color: #fed98b; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">Kelola
                                Produk</a>

                            <!-- Modal -->
                            <div class="modal fade" id="Modal<?= $banner_event['id'] ?>Center" tabindex="-1"
                                role="dialog" aria-labelledby="Modal<?= $banner_event['id'] ?>CenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="Modal<?= $banner_event['id'] ?>LongTitle">Kelola
                                                Produk
                                                <?= $banner_event['sub_category_name']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/ConfigAdmin/edit_product/<?= $banner_event['id'] ?>"
                                            method="post">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="stock"
                                                        class="col-md-4 col-form-label text-right">Stok</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="stock"
                                                            id="stock" placeholder="<?= $banner_event['stock'] ?>"
                                                            min="<?= $banner_event['stock'] ?>"
                                                            value="<?= $banner_event['stock'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="price"
                                                        class="col-md-4 col-form-label text-right">Harga</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="price"
                                                            id="price" id="price"
                                                            placeholder="<?= $banner_event['price'] ?>"
                                                            value="<?= $banner_event['price'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="discount"
                                                        class="col-md-4 col-form-label text-right">Diskon</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="discount"
                                                            id="discount" id="discount"
                                                            placeholder="<?= $banner_event['discount'] ?>"
                                                            value="<?= $banner_event['discount'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn"
                                                    style="background-color: #fed98b; border-radius: 10px;">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Poster Event-->
                    <div class="col-md-4">
                        <div class="card align-item-center shadow p-3 mb-5 bg-white" style="border-radius: 20px">
                            <div class="card-body py-3 px-3">
                                <h5 class="card-title text-center" style="font-weight: bold">
                                    <?= $poster_event['sub_category_name']; ?>
                                </h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Terjual <?= $poster_event['sold'] ?> produk</li>
                                <li class="list-group-item">Tersisa <?= $poster_event['stock'] ?> produk</li>
                                <li class="list-group-item">Harga produk : Rp <?= $poster_event['price'] ?></li>
                                <li class="list-group-item">Diskon produk : <?= $poster_event['discount'] ?>%</li>
                                <li class="list-group-item">Terakhir update pada <?= $poster_event['updated_at'] ?></li>
                            </ul>
                            <!-- Button trigger modal -->
                            <a href="" class="btn text-center py-3" data-toggle="modal"
                                data-target="#Modal<?= $poster_event['id'] ?>Center"
                                style="background-color: #fed98b; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">Kelola
                                Produk</a>

                            <!-- Modal -->
                            <div class="modal fade" id="Modal<?= $poster_event['id'] ?>Center" tabindex="-1"
                                role="dialog" aria-labelledby="Modal<?= $poster_event['id'] ?>CenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="Modal<?= $poster_event['id'] ?>LongTitle">Kelola
                                                Produk
                                                <?= $poster_event['sub_category_name']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/ConfigAdmin/edit_product/<?= $poster_event['id'] ?>"
                                            method="post">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="stock"
                                                        class="col-md-4 col-form-label text-right">Stok</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="stock"
                                                            id="stock" placeholder="<?= $poster_event['stock'] ?>"
                                                            min="<?= $poster_event['stock'] ?>"
                                                            value="<?= $poster_event['stock'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="price"
                                                        class="col-md-4 col-form-label text-right">Harga</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="price"
                                                            id="price" id="price"
                                                            placeholder="<?= $poster_event['price'] ?>"
                                                            value="<?= $poster_event['price'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="discount"
                                                        class="col-md-4 col-form-label text-right">Diskon</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="discount"
                                                            id="discount" id="discount"
                                                            placeholder="<?= $poster_event['discount'] ?>"
                                                            value="<?= $poster_event['discount'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn"
                                                    style="background-color: #fed98b; border-radius: 10px;">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Curriculum Vitae-->
                    <div class="col-md-4">
                        <div class="card align-item-center shadow p-3 mb-5 bg-white" style="border-radius: 20px">
                            <div class="card-body py-3 px-3">
                                <h5 class="card-title text-center" style="font-weight: bold">
                                    <?= $curriculum_vitae['sub_category_name']; ?>
                                </h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Terjual <?= $curriculum_vitae['sold'] ?> produk</li>
                                <li class="list-group-item">Tersisa <?= $curriculum_vitae['stock'] ?> produk</li>
                                <li class="list-group-item">Harga produk : Rp <?= $curriculum_vitae['price'] ?></li>
                                <li class="list-group-item">Diskon produk : <?= $curriculum_vitae['discount'] ?>%</li>
                                <li class="list-group-item">Terakhir update pada <?= $curriculum_vitae['updated_at'] ?>
                                </li>
                            </ul>
                            <!-- Button trigger modal -->
                            <a href="" class="btn text-center py-3" data-toggle="modal"
                                data-target="#Modal<?= $curriculum_vitae['id'] ?>Center"
                                style="background-color: #fed98b; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">Kelola
                                Produk</a>

                            <!-- Modal -->
                            <div class="modal fade" id="Modal<?= $curriculum_vitae['id'] ?>Center" tabindex="-1"
                                role="dialog" aria-labelledby="Modal<?= $curriculum_vitae['id'] ?>CenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="Modal<?= $curriculum_vitae['id'] ?>LongTitle">
                                                Kelola Produk
                                                <?= $curriculum_vitae['sub_category_name']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/ConfigAdmin/edit_product/<?= $curriculum_vitae['id'] ?>"
                                            method="post">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="stock"
                                                        class="col-md-4 col-form-label text-right">Stok</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="stock"
                                                            id="stock" placeholder="<?= $curriculum_vitae['stock'] ?>"
                                                            min="<?= $curriculum_vitae['stock'] ?>"
                                                            value="<?= $curriculum_vitae['stock'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="price"
                                                        class="col-md-4 col-form-label text-right">Harga</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="price"
                                                            id="price" id="price"
                                                            placeholder="<?= $curriculum_vitae['price'] ?>"
                                                            value="<?= $curriculum_vitae['price'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="discount"
                                                        class="col-md-4 col-form-label text-right">Diskon</label>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="discount"
                                                            id="discount" id="discount"
                                                            placeholder="<?= $curriculum_vitae['discount'] ?>"
                                                            value="<?= $curriculum_vitae['discount'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn"
                                                    style="background-color: #fed98b; border-radius: 10px;">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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