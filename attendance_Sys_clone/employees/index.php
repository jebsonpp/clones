<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
}

if ($_SESSION['is_admin'] == 1) {
  header("Location: ../admin/index.php");
}
$getLeavesByUserId = getLeavesByUserId($pdo, $_SESSION['user_id']);
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
  <body onload="startTime()">
    <?php include 'includes/navbar.php'; ?>
    <div class="container-fluid">
      <div class="d-md-12 text-center">
        <h1 class="p-5">Welcome to the attendance system, <?php echo $_SESSION['username']; ?>!</h1>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card shadow">
            <div class="card-body p-5">
              <h4> Local Philippines Time: <span id="txt"></span></h4>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card shadow">
            <div class="card-body p-5">
                            <h2>
                Attendance for today (
                <?php 
                $date = date('Y-m-d H:i:s'); 
                 echo date('Y-m-d', strtotime($date));
                ?>
                )    
              </h2>
              <div class="row">
                <div class="col-md-6">
                  <h4>
                    TIME IN:
                    <?php 
                    $getTimeInOrOutForToday = getTimeInOrOutForToday($pdo, $_SESSION['user_id'], date('Y-m-d', strtotime($date)), "time_in");

                    if (!empty($getTimeInOrOutForToday)) {
                      echo $getTimeInOrOutForToday['timestamp_record_added'];
                    } else {
                      echo "<span style='color: red;'>No time in for today yet</span>";
                    }
                    ?>
                  </h4>
                </div>
                <div class="col-md-6">
                  <h4>
                    TIME OUT:
                    <?php 
                    $getTimeInOrOutForToday = getTimeInOrOutForToday($pdo, $_SESSION['user_id'], date('Y-m-d', strtotime($date)), "time_out");

                    if (!empty($getTimeInOrOutForToday)) {
                      echo $getTimeInOrOutForToday['timestamp_record_added'];                  
                    } else {
                      echo "<span style='color: red;'>No time out for today yet</span>";
                    }
                    ?>
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
          <div class="col-md-6">
            <div class="card shadow">
              <div class="card-body p-5">
                <h4>Leave Notifications:</h4>
                <ul class="list-group">
                  <?php if (empty($getLeavesByUserId)): ?>
                    <li class="list-group-item">No leave notifications.</li>
                  <?php else: ?>
                    <?php foreach ($getLeavesByUserId as $leave): ?>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                          <?php echo date('M d, Y', strtotime($leave['date_added'])); ?>
                        </span>
                        <span class="badge 
                          <?php
                            if ($leave['status'] == 'Accepted') echo 'badge-success';
                            elseif ($leave['status'] == 'Rejected') echo 'badge-danger';
                            else echo 'badge-secondary';
                          ?>">
                          <?php echo $leave['status']; ?>
                        </span>
                      </li>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
          </div>
      </div>
    </div>
    <?php include 'includes/footer.php'; ?>
  </body>
</html>
