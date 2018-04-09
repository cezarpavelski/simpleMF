<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>

    <!-- Page title -->
    <title>Luck4me | Gerenciando o marketing de forma inteligente</title>

    <!-- Vendor styles -->
    <link rel="stylesheet" href="/vendor/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="/vendor/animate.css/animate.css"/>
    <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="/vendor/toastr/toastr.min.css"/>
    <link rel="stylesheet" href="/vendor/switchery/switchery.min.css"/>

    <!-- App styles -->
    <link rel="stylesheet" href="/styles/pe-icons/pe-icon-7-stroke.css"/>
    <link rel="stylesheet" href="/styles/pe-icons/helper.css"/>
    <link rel="stylesheet" href="/styles/stroke-icons/style.css"/>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>

<!-- Wrapper-->
<div class="wrapper">

    <!-- Header-->
        <?php include('partials/header.php'); ?>
        <!-- @include('partials.header') -->
    <!-- End header-->

    <!-- Navigation-->
        <?php include('partials/navigation.php'); ?>
        <!-- @include('partials.navigation') -->
    <!-- End navigation-->


    <!-- Main content-->
        <section class="content">
            <div class="container-fluid">
                <form action="#" method="post">
                    <?php Routes\Router::run(); ?>
                    <!-- @yield('content') -->
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </section>
    <!-- End main content-->

</div>
<!-- End wrapper-->

<!-- Vendor scripts -->
<script src="/vendor/pacejs/pace.min.js"></script>
<script src="/vendor/jquery/dist/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/vendor/toastr/toastr.min.js"></script>
<script src="/vendor/sparkline/index.js"></script>
<script src="/vendor/flot/jquery.flot.min.js"></script>
<script src="/vendor/flot/jquery.flot.resize.min.js"></script>
<script src="/vendor/flot/jquery.flot.spline.js"></script>
<script src="/vendor/datatables/datatables.min.js"></script>
<script src="/vendor/switchery/switchery.min.js"></script>

<!-- App scripts -->
<script src="/scripts/luna.js"></script>
<!-- @stack('scripts') -->

</body>

</html>
