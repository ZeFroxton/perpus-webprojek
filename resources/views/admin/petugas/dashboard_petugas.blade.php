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
   @include('admin.petugas.components.sidebar')
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
        <h1>Loan Logs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Book</th>
                <th>Action</th>
                <th>Fine Amount</th>
                <th>Action Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loanLogs as $log)
                <tr>
                    <td>{{ $log->loan->user->name }}</td>
                    <td>{{ $log->loan->book->judul }}</td>
                    <td>{{ ucfirst($log->action) }}</td>
                    <td>{{ $log->fine_amount ? $log->fine_amount : 'N/A' }}</td>
                    <td>{{ $log->action_date->format('d M Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

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
