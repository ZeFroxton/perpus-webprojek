<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
            <div class="row justify-content-center">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                      <div class="col-md-4">

                      </div>
                      <div class="col-lg-10">
                        <div class="card-body">
                        <img src="{{ asset('/storage/posts/'.$post->cover_image) }} " class="w-100 rounded">
                          <h5 class="card-title">{{ $post->judul }}</h5>
                          <p class="card-text">{{ $post->detailbuku }}</p>
                          <p class="card-text"><small class="text-muted">{{ $post->tahunterbit }}</small></p>
                          <p class="card-text">{{ $post->penerbit }}</p>
                          <form action="{{ route('loan.request') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $post->id }}">
                            <input type="date" name="return_date" required>
                            <button type="submit" class="btn btn-success" {{ $post->stock < 1 ? 'disabled' : '' }}>Borrow</button>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
  </div>
  @if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>

</body>

</html>
