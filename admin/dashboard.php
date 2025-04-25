<?php
// -------------stating session------------------
session_start();
//----------------- to include db.php----------------------------
require_once '../includes/db.php';   

    $statement = $conn->query("SELECT COUNT(*) as total_shipments FROM shipments");
    $row =  mysqli_fetch_assoc($statement);
    $total_shipments = $row['total_shipments'];

    $statement = $conn->query("SELECT COUNT(*) as pending_contacts FROM contacts");
    $row = mysqli_fetch_assoc($statement);
    $pending_contacts = $row['pending_contacts'];

    $sql = "SELECT * FROM shipments";
    $ship_result = mysqli_query($conn,$sql);

    $sql = "SELECT * FROM contacts";
    $contact_result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-------------------- CSS links--------------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/dashboard.css" />
</head>
<body>

  <div class="container-fluid">
    <!-----------------------Navigation bar------------------->
    <div class="row">
      <div class="col-md-12">
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
                      <a class="nav-link active" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="manageShipment.php">Manage Shipments</a>
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
      </div>
    </div>

<!------------------Shipment details ---------------->
      <div class="container mt-4">
          <div class="row mt-4">
              <div class="col-md-12">
                    <div class="card mb-3 text-white">
                          <div class="card-body">
                              <h5 class="card-title fs-2">Total Shipments</h5>
                              <p class="card-text display-4"><?= $total_shipments ?></p>
                              <div class="row">
                                  <div class="col-md-12">
                                    <div class="card">
                                      <div class="card-body">
                                          <div class="ship_table">
                                              <table class="table table-bordered table-custom">
                                                  <thead>
                                                    <tr>
                                                      <th>Tracking Number</th>
                                                      <th>Sender's Name</th>
                                                      <th>Recipient Name</th>
                                                      <th>Weight</th>
                                                      <th>Status</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                        <?php
                                                        while($row = mysqli_fetch_assoc($ship_result)){
                                                        ?>
                                                        <td><?php echo $row['tracking_number'];?></td>
                                                        <td><?php echo $row['sender_name'];?></td>
                                                        <td><?php echo $row['recipient_name'];?></td>
                                                        <td><?php echo $row['weight'];?></td>
                                                        <td><?php echo $row['status'];?></td>
                                                        
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
                          </div>
                    </div>
                </div>
            </div>

  <!--------------------------- Contact details ---------------------->
            <div class="container mt-4">
                  <div class="row mt-4">
                      <div class="col-md-12">
                            <div class="card mb-3 text-white">
                                  <div class="card-body">
                                      <h5 class="card-title fs-2">Pending Contacts</h5>
                                      <p class="card-text display-4"><?= $pending_contacts ?></p>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="card">
                                                  <div class="card-body">
                                                    <div class="contact_table">
                                                      <table class="table table-bordered table-custom">
                                                          <thead>
                                                              <tr>
                                                              <th>Name</th>
                                                              <th>Email</th>
                                                              <th>Subject</th>
                                                              <th>Message</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                              <tr>
                                                                  <?php
                                                                  while($row = mysqli_fetch_assoc($contact_result)){
                                                                  ?>
                                                                  <td><?php echo $row['name'];?></td>
                                                                  <td><?php echo $row['email'];?></td>
                                                                  <td><?php echo $row['subject'];?></td>
                                                                  <td><?php echo $row['message'];?></td>
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
                                  </div>
                            </div>
                        </div>
                  </div>
            </div>
            
      </div>
  </div>

  <!---------------------- javaScipt connection -------------------------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

