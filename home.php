<?php
// ----------------stating session------------------
session_start();
//----------------- to include db.php----------------------------
require_once 'includes/db.php';

$shipment = null;
$history = [];

if (isset($_GET['tracking_number'])) {
    $tracking_number = $_GET['tracking_number'];

    try {
        //--------------------Get shipment details-----------------------------
        $statement = $conn->prepare("SELECT * FROM shipments WHERE tracking_number = ?");
        $statement->bind_param("s", $tracking_number);
        $statement->execute();
        $result = $statement->get_result();
        $shipment = $result->fetch_assoc();

        if ($shipment) {
            $sql = "SELECT * FROM shipments";
            $result = mysqli_query($conn,$sql);

            $result = $statement->get_result();
        }
    } catch (mysqli_sql_exception $e) {
      echo "<div class='alert alert-danger'>Database error: " . $e->getMessage() . "</div>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Track Your Shipment</title>
  <!-------------------- CSS links--------------------->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="CSS/home.css" />

  <!------------------ AOS --------------------->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>

<!-----------------------Navigation bar------------------->

  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#home">Shipment Tracker</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#tracking">Tracking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="auth/login.php">Admin</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-------------------------- Home Section ---------------------------->

  <section id="home" class="home-section">
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/carousel_1.jpeg" class="d-block w-100" alt="..." />
          <div class="carousel-caption d-none d-md-block">
            <h5>Reliable Shipment Tracking</h5>
            <p>Stay updated with real-time shipment updates.</p>
            <a href="#tracking" class="btn btn-custom">Track Now</a>
          </div>
        </div>
        <div class="carousel-item">
          <img src="images/carousel_2.jpeg" class="d-block w-100" alt="..." />
          <div class="carousel-caption d-none d-md-block">
            <h5>Fast and Secure</h5>
            <p>Experience seamless logistics and delivery.</p>
            <a href="#tracking" class="btn btn-custom">Track Now</a>
          </div>
        </div>
        <div class="carousel-item">
          <img src="images/carousel_3.jpeg" class="d-block w-100" alt="..." />
          <div class="carousel-caption d-none d-md-block">
            <h5>Fast Shipment</h5>
            <p>Experience fast delivery.</p>
            <a href="#tracking" class="btn btn-custom">Track Now</a>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!------------------------------- Content Section ---------------------------->

    <div class="container mt-5">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col" data-aos="flip-down">
          <div class="card">
            <img src="images/SHIPMENT-TRACKING1.png" class="card-img-top" alt="Room Booking" />
            <div class="card-body">
              <h5 class="card-title">Easy Tracking</h5>
              <p class="card-text">
                Input your shipment ID and get instant updates.
              </p>
              <a href="#tracking" class="btn btn-custom button">Track Now</a>
            </div>
          </div>
        </div>
        <div class="col" data-aos="flip-down">
          <div class="card card2">
            <img src="images/SecureData.jpg" class="card-img-top" alt="Equipment Booking" />
            <div class="card-body">
              <h5 class="card-title">Secure Data</h5>
              <p class="card-text">
                Your shipment details are kept safe and private.
              </p>
            </div>
          </div>
        </div>
        <div class="col" data-aos="flip-down">
          <div class="card">
            <img src="images/support.jpg" class="card-img-top" alt="Support" />
            <div class="card-body">
              <h5 class="card-title">24/7 Support</h5>
              <p class="card-text">
                Contact us anytime for support or queries.
              </p>
              <a href="contact.php" class="btn btn-custom">Contact Us</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section_04" style="background-image: url(images/carousel_1.jpeg)">
    <div class="img_new">
      <h2>Shipment tracker</h2>
    </div>
  </section>

  <!------------------------- Tracking Section --------------------------->

  <section id="tracking" class="form-section">
    <div class="container">
      <div class="text-center mb-4">
        <h2>Track Your Shipment</h2>
        <p>Enter your shipment details below to get real time updates.</p>
      </div>

      <form class="mx-auto" id="trackingForm" method="GET">
        <div class="mb-3 text-center">
          <label for="trackingId" class="form-label">Shipment ID</label>
          <input type="text" class="form-control" id="trackingId" name="tracking_number" placeholder="Enter your shipment ID" required />
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-track" name="trackBtn">Track Now</button>
        </div>
      </form>

      <!----------------------- Show Shipment Details in a table ------------------------>
        <?php if ($shipment): ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card table_card">
                <div class="card-header">
                  <h4 class="text-center">Shipment Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-custom" id="table">
                      <tr>
                        <th>Tracking Number</th><td><?= htmlspecialchars($shipment['tracking_number']) ?></td>
                      </tr>
                      <tr>
                        <th>Sender</th><td><?= htmlspecialchars($shipment['sender_name']) ?></td>
                      </tr>
                      <tr>
                        <th>Recipient</th><td><?= htmlspecialchars($shipment['recipient_name']) ?></td>
                      </tr>
                      <tr>
                        <th>Status</th><td><?= htmlspecialchars($shipment['status']) ?></td>
                      </tr>
                      <div class="text-center">
                        <a href="?#tracking" type="button" class="btn btn-track text-center">Ok</a>
                      </div>
                    </table>
                  <?php elseif (isset($_GET['tracking_number'])): ?>
                      <div class="alert alert-dismissible fade show mt-4" role="alert">
                        No shipment found with that tracking number.
                        <a href="?#tracking" type="button" class="btn-close bg-white"></a>
                      </div>
                      
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
            

      <div class="mt-4">
        <main>
          <section class="restrictions mt-4">
            <div class="container mt-6">
              <!-------------------- Shipment Details ---------------------->
              <div class="restriction-card">
                <div class="icon-container">
                  <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h3>Shipment Details</h3>
                <p>Ensure accurate input for precise tracking:</p>
                <ul>
                  <li>Double check the Shipment ID before submission.</li>
                  <li>Provide additional information if prompted.</li>
                  <li>Contact support for invalid Shipment ID issues.</li>
                  <li>Keep your tracking details confidential.</li>
                </ul>
              </div>

              <!---------------------------- Restriction for Delivery Times --------------------->
              <div class="restriction-card">
                <div class="icon-container"><i class="fas fa-flask"></i></div>
                <h3>Delivery Times</h3>
                <p>Delivery schedules depend on various factors:</p>
                <ul>
                  <li>Weather conditions may impact delivery timelines.</li>
                  <li>Expect delays during holidays or peak seasons.</li>
                  <li>Track updates for the latest information.</li>
                  <li>Contact the courier for urgent queries.</li>
                </ul>
              </div>

              <!------------------------------ Restriction for Lost Shipments ------------------------>
              <div class="restriction-card">
                <div class="icon-container"><i class="fas fa-tools"></i></div>
                <h3>Lost Shipments</h3>
                <p>Steps to take if your shipment is missing:</p>
                <ul>
                  <li>Report lost shipments immediately.</li>
                  <li>Provide supporting documents for verification.</li>
                  <li>Cooperate with the investigation process.</li>
                  <li>Check refund or replacement policies.</li>
                </ul>
              </div>

              <!------------------------------- Restriction for Support Hours ----------------------->
              <div class="restriction-card">
                <div class="icon-container"><i class="fas fa-clock"></i></div>
                <h3>Support Hours</h3>
                <p>Customer support availability:</p>
                <ul>
                  <li>
                    Support available from 9:00 AM to 8:00 PM on weekdays.
                  </li>
                  <li>Limited support on weekends and holidays.</li>
                  <li>Submit online requests outside support hours.</li>
                  <li>Response times may vary during peak periods.</li>
                </ul>
              </div>
            </div>
          </section>
        </main>
      </div>
    </div>
  </section>

  <!------------------------------ About Section ------------------------------->

  <section id="about" class="about-section">
    <div class="container text-center">
      <h2>About ShipTrack</h2>
      <p>
        At ShipTrack, we provide state of the art shipment tracking services
        to ensure your packages arrive on time and in perfect condition. Our
        platform is designed for reliability, security, and user satisfaction.
      </p>
      <div class="row mt-5">
        <div class="col-md-4">
          <div class="restriction-card">
            <div class="icon-container">
              <i class="fas fa-shield-alt"></i>
            </div>
            <h3>Secure Tracking</h3>
            <p>
              Your data and shipment details are protected with industry
              standard encryption protocols.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="restriction-card">
            <div class="icon-container"><i class="fas fa-users"></i></div>
            <h3>Customer Support</h3>
            <p>
              Our dedicated team is here to assist you with all your tracking
              needs, 24/7.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="restriction-card">
            <div class="icon-container"><i class="fas fa-globe"></i></div>
            <h3>Global Reach</h3>
            <p>
              Track your shipments across multiple countries with seamless
              integration.
            </p>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-md-4">
          <div class="restriction-card">
            <div class="icon-container"><i class="fas fa-sync-alt"></i></div>
            <h3>Real Time Updates</h3>
            <p>
              Stay informed with live tracking and real-time notifications.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="restriction-card">
            <div class="icon-container">
              <i class="fas fa-chart-line"></i>
            </div>
            <h3>Performance Metrics</h3>
            <p>
              Analyze delivery trends and performance statistics for better
              decision making.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="restriction-card">
            <div class="icon-container"><i class="fas fa-cogs"></i></div>
            <h3>Custom Solutions</h3>
            <p>
              Tailored tracking solutions to meet unique business
              requirements.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--------------------------- Footer -------------------------->
  
  <div>
    <footer>
      <p>&copy; 2025 ShipmentTracker. All rights reserved.</p>
    </footer>
  </div>

  <!---------------------- javaScipt connection -------------------------->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="JS/home.js"></script>
</body>

</html>