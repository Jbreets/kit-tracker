<?php include("includes/header.php"); ?>
<div class="container mt-4">

    <div class="Notice"></div>

    <?php if(isset($_SESSION['loggedin'])) { ?>
    
    <div class="list-group">
        <a href="event-status.php" class="list-group-item list-group-item-action">📅 Event Status</a>
        <a href="kit-returning.php" class="list-group-item list-group-item-action">🔄 Returning Kit</a>
        <a href="kit-missing.php" class="list-group-item list-group-item-action">⚠️ Log Kit Missing</a>
        <a href="view-kit-missing.php" class="list-group-item list-group-item-action">📋 View Kit Missing</a>
        <a href="logout.php" class="list-group-item list-group-item-action text-danger">🚪 Log Out</a>
    </div>

    <?php } else { ?>

    <div class="list-group">
        <a href="event-status.php" class="list-group-item list-group-item-action">📅 Event Status</a>
        <a href="kit-missing.php" class="list-group-item list-group-item-action">⚠️ Log Kit Missing</a>
        <a href="view-kit-missing.php" class="list-group-item list-group-item-action">📋 View Kit Missing</a>
        <a href="login.php" class="list-group-item list-group-item-action text-primary">🔑 Login</a>
    </div>

    <?php } ?>

</div>
