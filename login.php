<?php 
error_reporting(0); 

session_start();

$username = $_POST['username'];
$password = $_POST['password'];


        
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "connectors.db";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if($conn->connect_error){
    die("connection failed : ".$conn->connect_error);
} 
else{
    $stmt = $conn->prepare("select * from users where username= ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if($data['password'] === $password) {
            $_SESSION['name'] = $data['name'];
            $_SESSION['user_id'] = $data['username'];
            echo '<script>alert("successfully loged in");</script>';
            // Redirect to another page
            echo '<script>window.location.href = "index.php";</script>';    
        } else {
            echo '<script>alert("Invalid username or password");</script>';
            // Redirect to another page
            echo '<script>window.location.href = "login.html";</script>'; 
            
        } 
    } else {
        echo '<script>alert("Invalid username or password");</script>';
            // Redirect to another page
            echo '<script>window.location.href = "login.html";</script>'; 
  
}
}
    
?>