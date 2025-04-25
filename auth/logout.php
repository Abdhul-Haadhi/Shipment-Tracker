<!-- To logout from admin page -->

<?php
session_destroy();
header("Location:../home.php")
?>