<?php
// -------------stating session------------------
    session_start();
//----------------- to include db.php----------------------------
    include '../includes/db.php';

    if(isset($_POST['login'])){
        $userName = $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password);

        $sql="SELECT * FROM users WHERE username = '$userName' and password = '$password'";
        $result = $conn->query($sql);

        if($result->num_rows>0){
            session_start();
            $row = $result->fetch_assoc();
            $_SESSION['username']=$row['username'];
            header("Location: ../admin/dashboard.php");
            exit();
        }
        else{
            $_SESSION['status'] = "Incorrect user name or password";
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
    <link rel="stylesheet" href="../CSS/login.css" />
</head>

<body>
    
    <!-----------------------Navigation bar------------------->

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
            <div class="container">
            <a class="navbar-brand" href="../home.php">Shipment Tracker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="login.php">Admin</a>
                </li>
                </ul>
            </div>
            </div>
        </nav>
    </div>
    
    
    <div class="container">
        <section>
            <div class="login_form">
                <form class="mx-auto"  method="POST">
                    <?php
                        if(isset($_SESSION['status'])){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops!</strong> <?php echo $_SESSION['status']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['status']);
                    }
                    ?>
                    <h4 class="text-center">Login</h4>
                    <div class="mb-3 mt-5">
                        <label class="form-label">User name</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter user name" required/>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password" required/>
                    </div>
                    <input type="submit" class="btn btn-primary" name="login" value="Login">
                </form>
            </div>
        </section>
        
    </div>
    

    <!---------------------- javaScipt connection -------------------------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>