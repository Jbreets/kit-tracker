<?php 
// file that authorizes who it is that is trying to log in
session_start();

require_once __DIR__ . "/funcs.php";
$con = db_conn();

if (!$con) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ( !isset($_POST['username'], $_POST['password']) ) {
    exit('Please fill in both the username and password fields!');
}
if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    var_dump($stmt);
    // No difference in admin based roles yet since should not be necessary
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        if (md5($_POST['password']) === $password) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: ../loggedin.php');
            // also need to add a login landing page for authentication
        } else  {
            header('Location: ../login.php');
            $_SESSION['message'] = '<h3 style="text-align: center;">Sorry, Your username or Password was incorrect</h3>';
        }
   
        
    } else {
        header('Location: ../login.php');
        $_SESSION['message'] = '<h3 style="text-align: center;">Sorry, Your username or Password was incorrect</h3>';
    }
    $stmt->close();




}

?>