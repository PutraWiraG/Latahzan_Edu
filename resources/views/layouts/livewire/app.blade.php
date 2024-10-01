<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Latahzan Edu</title>

    <!-- Custom fonts for this template-->
    <link href={{ asset('admin/vendor/fontawesome-free/css/all.min.css') }} rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom styles for this template-->
    <link href={{ asset('admin/css/sb-admin-2.min.css') }} rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('layouts.admin.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
             <div id="content">
                @include('layouts.admin.topbar')
                @yield('container')
             </div>
             <footer class="sticky-footer bg-white">
                     @include('layouts.admin.footer')
             </footer>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src={{ asset("admin/vendor/bootstrap/js/bootstrap.bundle.min.js") }}></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script src={{ asset("admin/vendor/jquery-easing/jquery.easing.min.js") }}></script>

    <!-- Custom scripts for all pages-->
    <script src={{ asset("admin/js/sb-admin-2.min.js") }}></script>

    <!-- Page level plugins -->
    <script src={{ asset("admin/vendor/chart.js/Chart.min.js") }}></script>

    <!-- Page level custom scripts -->
    <script src={{ asset("admin/js/demo/chart-area-demo.js") }}></script>
    <script src={{ asset("admin/js/demo/chart-pie-demo.js") }}></script>

    <script src={{ asset("admin/js/script.js") }}></script>

</body>
</html>