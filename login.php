<?php include("includes/header.php"); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-lg p-4">
                <h3 class="text-center mb-3">Login</h3>

                <form action="functions/auth.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </div>
                </form>

                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php 
                            echo $_SESSION['message']; 
                            unset($_SESSION['message']); 
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
