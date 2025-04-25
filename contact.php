<?php
// -------------stating session------------------
    session_start();
//----------------- to include db.php----------------------------
    include 'includes/db.php';

    // ----------------------Insert values to contact table---------------------
    if(isset($_POST['contact_btn'])){
        $fullName = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $insertQuery = "INSERT INTO contacts(name,email,subject,message) VALUES ('$fullName','$email','$subject','$message')";

        if($conn->query($insertQuery)==TRUE){
            $_SESSION['status'] = "Message sent successfully";
            header("Location: contact.php");
            exit();
        }
        else{
            echo "Error:".$conn->error;
        }
        $conn->close();
    }
    $conn->close();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="CSS/contact.css" />
</head>
<body>

    <!-----------------------Navigation bar------------------->

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
        <div class="container">
        <a class="navbar-brand" href="home.php">Shipment Tracker</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="contact.php">Contact Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="auth/login.php">Admin</a>
            </li>
            </ul>
        </div>
        </div>
    </nav>

    <!------------------------ Contact form --------------------------->
    <div class="container">
        <div class="contact-form">
            <form class="mx-auto" id="contactForm" method="POST" action="contact.php">
                <?php
                    if(isset($_SESSION['status'])){
                ?>
                <div class="alert alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                unset($_SESSION['status']);
                }
                ?>
                <h4 class="text-center">Contact Us</h4>
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea name="message" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="contact_btn">Send Message</button>
            </form>
        </div>
    </div>

    <!---------------------------- Footer -------------------------------->
    <div>
        <footer>
        <p>&copy; 2025 ShipmentTracker. All rights reserved.</p>
        </footer>
    </div>
    

    <!---------------------- javaScipt connection -------------------------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
