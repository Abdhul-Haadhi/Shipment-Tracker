<?php
session_start();
// -------------------------to include db.php-------------------
include '../includes/db.php';

// ----------------------delete table data----------------------
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
  
    $deleteQuery = "DELETE FROM contacts WHERE id='$id'";
  
    if ($conn->query($deleteQuery) === TRUE) {
        $_SESSION['message'] = "Contact details deleted successfully";
        header("Location: viewContacts.php");
        exit();
    } else {
        echo "Error deleting contacts details: " . $conn->error;
    }
  }
  
  // ----------------------fetch data into the table-------------------
  $sql = "SELECT * FROM contacts";
  $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Contacts</title>

    <!-------------------- CSS links--------------------->
    <link rel="stylesheet" href="../css/viewContacts.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <!----------------------- Navigation bar -------------------------->

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
        <div class="container">
          <a class="navbar-brand" href="dashboard.php">Shipment Tracker</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="manageShipment.php">Manage Shipments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="viewContacts.php">View contacts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../auth/logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    <!------------------- Contact table ------------------------>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center fw-bold">Contacts Table</h4>
                    </div>
                    <div class="card-body">
                            <?php if(isset($_SESSION['message'])): ?>
                            <div class="alert alert-success text-center">
                                <?php 
                                echo $_SESSION['message']; 
                                unset($_SESSION['message']); 
                                ?>
                            </div>
                            <?php endif; ?>
                        <table class="table table-bordered table-custom">
                            <thead>
                                <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['subject'];?></td>
                                    <td><?php echo $row['message'];?></td>
                                    <td><a href="viewContacts.php?delete=<?php echo $row['id'] ?>" class="btn action_btn" name="delete" onclick="return confirm('Are you sure you want to delete this shipment?');">Delete</a></td>
                                </tr>  
                                    <?php
                                    }  
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>