<?php 
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
}

if ($_SESSION['is_admin'] == 0) {
  header("Location: ../employees/index.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
      body {
        font-family: "Arial";
      }
    </style>
    <title>Hello, world!</title>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <h1 class="p-5">Welcome to the Admin Center!, <?php echo $_SESSION['username']; ?>!</h1>
      </div>
    </div>
    <div class="container-fluid">
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-body p-1 text-center">
            <h3>Notifications</h3>
            <ul class="list-group mb-3">
              <?php $pendingLeavesCount = countLeaveStatus($pdo, 'Pending');?>
              <li class="list-group-item">You have <?php echo $pendingLeavesCount; ?> pending leave<?php echo $pendingLeavesCount == '1' ? '' : 's'; ?>.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php include 'includes/footer.php'; ?>
  </body>
</html>
