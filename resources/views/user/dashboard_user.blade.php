<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perpustakaan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  @include('user.components.navbar')

  <div class="container mt-5">
    <h1 class="text-center mb-5">Buku Tersedia</h1>
    <div class="row">
      <!-- Card for each book -->
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
      <!-- Repeat for other books -->


    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
