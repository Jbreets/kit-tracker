<?php include("includes/header.php"); ?>

<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-lg p-4">
                <h3 class="text-center mb-3">Login Successfull ✅</h3>
            </div>
        </div>
    </div>
</div>