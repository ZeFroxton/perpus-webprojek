<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpus</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <style>

    .book-card {
        margin: 15px; /* Margin di sekitar setiap card */
    }
</style>

</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
   @include('user.components.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        @include('components.navbar')
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->

        <div class="container mt-4">
            <div class="row">
                @foreach ($books as $book)
                <div class="col-md-3" style="margin-right: 20px"> <!-- Sesuaikan dengan jumlah kolom per baris -->
                    <div class="card border-dark mb-3"  style="width: 18rem;" >
                        <img src="{{ asset('/storage/posts/'.$book->cover_image) }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->judul }}</h5>

                            <p class="card-text"><small class="text-muted">Author: {{ $book->author }}</small></p>
                            <a href="{{ route('show.buku', $book->id) }}" class="btn btn-primary">Detail Book</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>

</html>
