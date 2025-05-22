<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
}

if ($_SESSION['is_client'] == 0) {
  header("Location: ../freelancer/index.php");
}

// Fetch all proposals for gigs owned by this client
$allProposals = getAllProposalsByClient($pdo, $_SESSION['user_id']); // You need to implement this function in your models if not present
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
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container-fluid">
      <h1 class="text-center mt-4">All Proposals</h1>
      <div class="row justify-content-center">
        <div class="col-md-10">
          <?php if (!empty($allProposals)) { ?>
            <div class="row">
              <?php foreach ($allProposals as $proposal) { ?>
                <div class="col-md-4 mt-4">
                  <div class="card shadow p-3">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo htmlspecialchars($proposal['gig_title']); ?></h5>
                      <p class="card-text">
                        <strong>From:</strong> <?php echo htmlspecialchars($proposal['first_name'] . ' ' . $proposal['last_name']); ?><br>
                        <strong>Description:</strong> <?php echo htmlspecialchars($proposal['gig_proposal_description']); ?><br>
                        <strong>Date:</strong> <?php echo htmlspecialchars($proposal['date_added']); ?>
                      </p>
                      <a href="get_gig_proposals.php?gig_id=<?php echo $proposal['gig_id']; ?>" class="btn btn-primary btn-block">View Proposals</a>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          <?php } else { ?>
            <h3 class="text-center mt-4">No proposals yet</h3>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php include 'includes/footer.php'; ?>
  </body>
</html>
