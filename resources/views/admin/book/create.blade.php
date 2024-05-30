<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('components.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        @include('components.navbar')
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Forms</h5>
              <div class="card">
                <div class="card-body">
                  <form action="{{ route('buku.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="judul" class="form-label">JUDUL</label>
                      <input type="text" class="form-control" id="judul">
                    </div>
                    <div class="mb-3">
                      <label for="author" class="form-label">Author</label>
                      <input type="text" class="form-control" id="author">
                    </div>
                    <div class="mb-3">
                        <label for="publisher" class="form-label">Publisher</label>
                        <input type="text" class="form-control" id="publisher">
                      </div>
                      <div class="mb-3">
                        <label for="detailbuku" class="form-label">Detail Buku</label>
                        <input type="text" class="form-control" id="detailbuku">
                      </div>
                      <div class="mb-3">
                        <label for="halaman" class="form-label">Halaman</label>
                        <input type="number" class="form-control" id="halaman">
                      </div>
                      <div class="mb-3">
                        <label for="tahunterbit" class="form-label">Tahun-terbit</label>
                        <input type="number" class="form-control" id="tahunterbit">
                      </div>
                      <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock">
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold">GAMBAR</label>
                        <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">

                        <!-- error message untuk title -->
                        @error('cover_image')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="kategori_id">Kategori:</label>
                        <select id="kategori_id" name="kategori_id" required>
                            @foreach($category as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>
