<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Kelola Pemesanan di PIKUPA</title>

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
                <li class="active">
                    <a href="/Admin/orders">Orders</a>
                </li>
                <li>
                    <a href="/Admin/manage_product">Products</a>
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
                <div class="row">
                    <h2 class="my-3">Kelola Pemesanan di PIKUPA</h2>
                </div>
                <div class="row my-3">
                    <h5 class="px-3 py-2" style="background-color: #FFCE67; border-radius: 5px;">Review</h5>
                    <table class="table table-hover my-2">
                        <thead>
                            <tr style="font-size: 16px; color:gray">
                                <th scope="col">Order ID</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Order Time</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($review as $d) : ?>
                            <tr>
                                <td><?= $d['id']; ?></td>
                                <td><?= $d['user_id']; ?></td>
                                <td><?= $d['product_id']; ?></td>
                                <td><?= $d['note']; ?></td>
                                <td><?= $d['order_date']; ?></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <a href="" class="btn" data-toggle="modal" data-target="#Modal<?= $d['id'] ?>Center"
                                        style="border-color: #FFCE67;">Detail</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="Modal<?= $d['id'] ?>Center" tabindex="-1" role="dialog"
                                        aria-labelledby="Modal<?= $d['id'] ?>CenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="Modal<?= $d['id'] ?>LongTitle">Detail
                                                        Pemesanan <?= $d['id'] ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>Name</td>
                                                                <td><?= $d['nama_user']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email</td>
                                                                <td><?= $d['email_user']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Contact</td>
                                                                <td><?= $d['contact']; ?> (<?= $d['contact_method']; ?>)
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Payment</td>
                                                                <td>Rp <?= $d['total_payment']; ?>
                                                                    (<?= $d['payment_method']; ?>)
                                                                </td>
                                                            </tr>
                                                            <?php $ab = str_split($d['product_id']);
                                                                if ($ab[0] == 'C') : ?>
                                                            <tr>
                                                                <td>Deadline</td>
                                                                <td><?= $d['deadline']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Proof of Identity</td>
                                                                <td><img src="/idcard/<?= $d['id_card']; ?>"
                                                                        style="width: 100%;"></td>
                                                            </tr>
                                                            <?php endif; ?>
                                                            <tr>
                                                                <td>Proof of Payment</td>
                                                                <td><img src="/invoices/<?= $d['proof_of_payment']; ?>"
                                                                        style="width: 100%;"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="/ConfigAdmin/reject/<?= $d['id']; ?>" class="btn"
                                                        style="background-color: #FF6767; color: #f7f7f7;border-radius: 10px;">Reject</a>
                                                    <a href="/ConfigAdmin/process/<?= $d['id']; ?>" class="btn"
                                                        style="background-color: #C4C4C4; border-radius: 10px;">Process</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row my-3">
                    <h5 class="px-3 py-2" style="background-color: #C4C4C4; border-radius: 5px;">
                        Process</h5>
                    <table class="table table-hover my-2">
                        <thead>
                            <tr style="font-size: 16px; color:gray">
                                <th scope="col">Order ID</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Order Time</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($process as $d) : ?>
                            <tr>
                                <td><?= $d['id']; ?></td>
                                <td><?= $d['user_id']; ?></td>
                                <td><?= $d['product_id']; ?></td>
                                <td><?= $d['note']; ?></td>
                                <td><?= $d['order_date']; ?></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <a href="" class="btn" data-toggle="modal" data-target="#Modal<?= $d['id'] ?>Center"
                                        style="border-color: #C4C4C4;">Detail</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="Modal<?= $d['id'] ?>Center" tabindex="-1" role="dialog"
                                        aria-labelledby="Modal<?= $d['id'] ?>CenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="Modal<?= $d['id'] ?>LongTitle">Detail
                                                        Pemesanan <?= $d['id'] ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>Name</td>
                                                                <td><?= $d['nama_user']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email</td>
                                                                <td><?= $d['email_user']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Contact</td>
                                                                <td><?= $d['contact']; ?> (<?= $d['contact_method']; ?>)
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Last Update</td>
                                                                <td><?= $d['updated_at']; ?> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="/ConfigAdmin/finish/<?= $d['id']; ?>" class="btn"
                                                        style="background-color: #B5F3AB; border-radius: 10px;">Finish</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row my-3">
                    <h5 class="px-3 py-2" style="background-color: #B5F3AB; border-radius: 5px;">Finish</h5>
                    <table class="table table-hover my-2">
                        <thead>
                            <tr style="font-size: 16px; color:gray">
                                <th scope="col">Order ID</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Order Time</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($finish as $d) : ?>
                            <tr>
                                <td><?= $d['id']; ?></td>
                                <td><?= $d['user_id']; ?></td>
                                <td><?= $d['product_id']; ?></td>
                                <td><?= $d['note']; ?></td>
                                <td><?= $d['order_date']; ?></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <a href="" class="btn" data-toggle="modal" data-target="#Modal<?= $d['id'] ?>Center"
                                        style="border-color: #B5F3AB;">Detail</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="Modal<?= $d['id'] ?>Center" tabindex="-1" role="dialog"
                                        aria-labelledby="Modal<?= $d['id'] ?>CenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="Modal<?= $d['id'] ?>LongTitle">Detail
                                                        Pemesanan <?= $d['id'] ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>Name</td>
                                                                <td><?= $d['nama_user']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email</td>
                                                                <td><?= $d['email_user']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Contact</td>
                                                                <td><?= $d['contact']; ?> (<?= $d['contact_method']; ?>)
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Payment</td>
                                                                <td>Rp <?= $d['total_payment']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Last Update</td>
                                                                <td><?= $d['updated_at']; ?> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row my-3">
                    <h5 class="px-3 py-2" style="background-color: #FF6767; color: #f7f7f7; border-radius: 5px;">
                        Rejected</h5>
                    <table class="table table-hover my-2">
                        <thead>
                            <tr style="font-size: 16px; color:gray">
                                <th scope="col">Order ID</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Order Time</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reject as $d) : ?>
                            <tr>
                                <td><?= $d['id']; ?></td>
                                <td><?= $d['user_id']; ?></td>
                                <td><?= $d['product_id']; ?></td>
                                <td><?= $d['note']; ?></td>
                                <td><?= $d['order_date']; ?></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <a href="" class="btn" data-toggle="modal" data-target="#Modal<?= $d['id'] ?>Center"
                                        style="border-color: #FF6767;">Detail</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="Modal<?= $d['id'] ?>Center" tabindex="-1" role="dialog"
                                        aria-labelledby="Modal<?= $d['id'] ?>CenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="Modal<?= $d['id'] ?>LongTitle">Detail
                                                        Pemesanan <?= $d['id'] ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>Name</td>
                                                                <td><?= $d['nama_user']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email</td>
                                                                <td><?= $d['email_user']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Contact</td>
                                                                <td><?= $d['contact']; ?> (<?= $d['contact_method']; ?>)
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Last Update</td>
                                                                <td><?= $d['updated_at']; ?> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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