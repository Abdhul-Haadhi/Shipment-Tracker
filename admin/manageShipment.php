<?php
// --------------------stating session------------------
session_start();
//------------------- to include db.php----------------------------
include '../includes/db.php';

// ----------------------add tracking details-------------------------
if(isset($_POST['mng_ship_btn'])){
  $trackingNumber = $_POST['trackingNumber'];
  $senderName = $_POST['senderName'];
  $senderAddress = $_POST['senderAddress'];
  $recipientName = $_POST['recipientName'];
  $recipientAddress = $_POST['recipientAddress'];
  $weight = $_POST['weight'];
  $status = $_POST['status'];

  // ---------Check if the tracking number already exists---------------
  $checkQuery = "SELECT * FROM shipments WHERE tracking_number = '$trackingNumber'";
  $checkResult = $conn->query($checkQuery);

  if ($checkResult->num_rows > 0) {
    $_SESSION['message'] = "Tracking number already exists!";
    header("Location: manageShipment.php");
    exit();

  } 
  else {
      // -------------Insert if tracking number is unique--------------
      $insertQuery = "INSERT INTO shipments(tracking_number,sender_name,sender_address,recipient_name,recipient_address,weight,status) VALUES ('$trackingNumber','$senderName','$senderAddress','$recipientName','$recipientAddress','$weight','$status')";

      if($conn->query($insertQuery)===TRUE){
        $_SESSION['message'] = "Tracking details added successfully";
        header("Location: manageShipment.php");
        exit();
      }
      else{
          echo "Error:".$conn->error;
      }
  }
  
}


// ------------------delete table data--------------------------
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
  

  $deleteQuery = "DELETE FROM shipments WHERE id='$id'";

  if ($conn->query($deleteQuery) === TRUE) {
      $_SESSION['message'] = "Data deleted successfully";
      header("Location: manageShipment.php");
      exit();
  } else {
      echo "Error deleting data: " . $conn->error;
  }
}

// ---------------------------fetch data into the table-------------------
$sql = "SELECT * FROM shipments";
$result = mysqli_query($conn,$sql);


// -------------------------update status---------------------
if(isset($_GET['id'])){
  $s_id = $_GET['id'];
  $get_sql = "SELECT status FROM shipments WHERE id='$s_id'";

  $query = mysqli_query($conn,$get_sql);

  $row = mysqli_fetch_assoc($query);
}

// --------------------update table--------------------------
if (isset($_POST['update_btn'])) {
  $id = $_POST['id'];
  $status = $_POST['status'];

  $updateQuery = "UPDATE shipments SET status='$status' WHERE id='$id'";

  if ($conn->query($updateQuery) === TRUE) {
      $_SESSION['message'] = "Status updated successfully";
      header("Location: manageShipment.php");
      exit();
  } else {
      echo "Error updating status: " . $conn->error;
  }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage shipment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/manageShipment.css" />

</head>
<body>

    <!---------------------------- Navigation bar ---------------------->

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
                <a class="nav-link active" href="manageShipment.php">Manage Shipments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="viewContacts.php">View contacts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../auth/logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    <div class="container">

      <!---------------------- Tracking details form --------------------->

        <div class="row">
            <div class="col-md-12">
              
                <div class="contact-form">
                    <form class="mx-auto" id="contactForm" method="POST">
                        <?php
                        if(isset($_SESSION['message'])){
                        ?>
                        <div class="alert alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['message']; ?>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                        unset($_SESSION['message']);
                        }
                        ?>
                        <h4 class="text-center">Add Shipment Details</h4>
                        <div class="mb-3">
                            <label class="form-label">Tracking Number</label>
                            <input type="text" name="trackingNumber" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sender's Name</label>
                            <input type="text" name="senderName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sender's Address</label>
                            <input type="text" name="senderAddress" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Recipient's Name</label>
                            <input type="text" name="recipientName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Recipient's Address</label>
                          <input type="text" name="recipientAddress" class="form-control" required>
                      </div>
                        <div class="mb-3">
                            <label class="form-label">Weight(g)</label>
                            <input type="text" name="weight" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status"  class="form-select form-control" aria-label="Default select example">
                                <option value="created">Created</option>
                                <option value="in_transit">In Transit</option>
                                <option value="outForDelevery">Out for delevery</option>
                                <option value="delivered">Delivered</option>
                                <option value="delayed">Delayed</option>
                            </select>
                        </div>
                        <button type="submit" class="add_details_btn btn btn-primary " name="mng_ship_btn">Add Details</button>
                    </form>
                </div>
            </div>     
        </div>

        <!------------------------ Pop up form ------------------------>

        <div class="row">
            <div>
                <div class="contact-form">
                    <form class="mx-auto popup " id="popup" method="POST">
                        <h4 class="text-center">Update Status</h4>
                        <div class="mb-3">
                                <label class="form-label">Status</label>
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                                <select name="status" class="form-select form-control" aria-label="Default select example">
                                    <option value="created" <?php if($row['status'] == 'created') echo 'selected'; ?>>Created</option>
                                    <option value="in_transit" <?php if($row['status'] == 'in_transit') echo 'selected'; ?>>In Transit</option>
                                    <option value="outForDelevery" <?php if($row['status'] == 'outForDelevery') echo 'selected'; ?>>Out for delevery</option>
                                    <option value="delivered" <?php if($row['status'] == 'delivered') echo 'selected'; ?>>Delivered</option>
                                    <option value="delayed" <?php if($row['status'] == 'delayed') echo 'selected'; ?>>Delayed</option>
                                </select>
                            </div>
                        <button type="submit" class="btn btn-primary" name="update_btn" onclick="closePopup()">Update</button>
                    </form>
                </div>
            </div>
        </div>

        <!----------------------- Tracking table ------------------------->

        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="text-center">Tracking Table</h4>
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
                          <th>Tracking Number</th>
                          <th>Sender's Name</th>
                          <th>Recipient Name</th>
                          <th>Status</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <?php
                            while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <td><?php echo $row['tracking_number'];?></td>
                            <td><?php echo $row['sender_name'];?></td>
                            <td><?php echo $row['recipient_name'];?></td>
                            <td><?php echo $row['status'];?></td>
                            <td><a href="manageShipment.php?id=<?php echo $row['id'] ?>" class="btn action_btn update_btn" name="update" onclick="openPopup()">Update</a></td>
                            <td><a href="manageShipment.php?delete=<?php echo $row['id'] ?>" class="btn action_btn delete_btn" name="delete" onclick="return confirm('Are you sure you want to delete this shipment?');">Delete</a></td>
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

    <!--------------------- show the popup only if $_GET['id'] is set  ------------------->
    <?php if (isset($_GET['id'])): ?>
      <script>
        window.onload = function() {
          openPopup();
        };
      </script>
    <?php endif; ?>

    <!---------------------- javaScipt connection -------------------------->
    <script src="../js/manageShipment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>