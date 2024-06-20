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
                          <p class="card-text"><small class="text-muted">Tahun Terbit :{{ $post->tahunterbit->format('Y') }}</small></p>
                          <p class="card-text">{{ $post->penerbit }}</p>
                          @if($isFavorite)
                          <form action="{{ route('remove.from.favorites', $post->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">Remove from Favorites</button>
                          </form>
                      @else
                          <form action="{{ route('add.to.favorites', $post->id) }}" method="POST">
                              @csrf
                              <button type="submit" class="btn btn-success">Add to Favorites</button>
                          </form>
                      @endif
                          @if($loanApproved)
                         <form action="{{ route('return.book', $loanApproved->id) }}" method="POST">
                             @csrf
                             @method('PATCH')
                             <button type="submit" class="btn btn-warning">Return Book</button>
                         </form>
                         @elseif($loanReturned)
        <!-- Button to trigger review modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reviewModal{{ $loanReturned->id }}">
                            Submit Review
                        </button>

                     @elseif($loanPending)
                         <button class="btn btn-secondary" disabled>Pending Approval</button>
                     @else
                         <form action="{{ route('loan.request') }}" method="POST">
                             @csrf
                             <input type="hidden" name="book_id" value="{{ $post->id }}">
                             <div class="form-group">
                                 <label for="return_date">Return Date</label>
                                 <input type="date" name="return_date" class="form-control" required>
                             </div>
                             <button type="submit" class="btn btn-success" {{ $post->stock < 1 ? 'disabled' : '' }}>Borrow</button>
                         </form>
                     @endif

                     <hr>

    <h3>Reviews</h3>
    @if($post->reviews->isEmpty())
        <p>No reviews yet.</p>
    @else
        <ul>
            @foreach($post->reviews as $review)
            <li class="media">
                <img class="mr-3" src="{{ asset('storage/profilepic/' . $review->user->profile_photo) }}" alt="{{ $review->user->name }}" style="width: 64px; height: 64px; border-radius: 50%;">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">{{ $review->user->name }}</h5>
                    <span>{{ $review->rating }} / 5</span>
                    <p>{{ $review->review }}</p>
                </div>
            </li>
            @endforeach
        </ul>
        <p>Average Rating: {{ round($post->reviews->avg('rating'), 2) }} / 5</p>
    @endif

                        </div>

                        <!-- Review Modal -->
@if($loanReturned)
<div class="modal fade" id="reviewModal{{ $loanReturned->id }}" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel{{ $loanReturned->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('submit.review', ['loanId' => $loanReturned->id]) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel{{ $loanReturned->id }}">Berikan Review {{ $post->title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <select name="rating" id="rating" class="form-control" required>
                            <option value="5">5 - Excellent</option>
                            <option value="4">4 - Good</option>
                            <option value="3">3 - Average</option>
                            <option value="2">2 - Poor</option>
                            <option value="1">1 - Very Poor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review">Review</label>
                        <textarea name="review" id="review" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>

</body>

</html>
