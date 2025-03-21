<?php 
include("includes/header.php");
$con = db_conn();

// Check if form is submitted
if (isset($_POST['submit'])) {
    $user = $_SESSION['username'];
    $go_pro = isset($_POST['go-pro']) ? $_POST['go-pro'] : '';
    $ticket_scanner = isset($_POST['scanner']) ? $_POST['scanner'] : '';
    $season = isset($_POST['inlineRadioOptions']) ? $_POST['inlineRadioOptions'] : '';
    $event = isset($_POST['drop']) ? $_POST['drop'] : '';
    $auction_item_one = isset($_POST['auc-one']) ? $_POST['auc-one'] : '';
    $auction_item_two = isset($_POST['auc-two']) ? $_POST['auc-two'] : '';

    $fields = [];

    // Split event name into an array
    $event_name = explode(" ", $event);
    $date = date("Y-m-d");

    if ($go_pro != "") $fields['Go Pro Box'] = $go_pro;
    if ($ticket_scanner != "") $fields['Ticket scanner'] = $ticket_scanner;
    if ($auction_item_one != "") $fields['auction_one'] = $auction_item_one;
    if ($auction_item_two != "") $fields['auction_two'] = $auction_item_two;

    // Prepare SQL query
    $sql = "UPDATE `event-status` SET status = 'returned', date_returned = '$date', ";
    foreach ($fields as $field => $value) {
        $sql .= "`" . mysqli_real_escape_string($con, $field) . "` = '" . mysqli_real_escape_string($con, $value) . "', ";
    }
    $sql .= "`user_check` = '$user' WHERE event_name = '" . mysqli_real_escape_string($con, $event_name[2]) . "' 
             AND season = '" . mysqli_real_escape_string($con, $season) . "' 
             AND event_type = '" . mysqli_real_escape_string($con, $event_name[0]) . "'";

    $result = mysqli_query($con, $sql);
    $message = $result ? "<div class='alert alert-success mt-4 text-center'>✅ Kit Submitted Successfully!</div>" 
                       : "<div class='alert alert-danger mt-4 text-center'>❌ Something went wrong!</div>";

    mysqli_close($con);
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4">
                <h3 class="text-center mb-3">Return Event Kit</h3>
                <form action="" method="post">
                    
                    <!-- Season Selection -->
                    <div class="mb-3">
                        <label class="form-label">Select Season:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" onclick="radioCheck(this.value)">
                            <label class="form-check-label" for="inlineRadio1">Season 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2" onclick="radioCheck(this.value)">
                            <label class="form-check-label" for="inlineRadio2">Season 2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="3" onclick="radioCheck(this.value)">
                            <label class="form-check-label" for="inlineRadio3">Season 3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="4" onclick="radioCheck(this.value)">
                            <label class="form-check-label" for="inlineRadio4">Season 4</label>
                        </div>
                    </div>

                    <!-- Event Name Selection -->
                    <div class="mb-3">
                        <label class="form-label">Event Name</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="drop" onchange="event_check(this.value)" required>
                            <option value="">Select an event</option>
                            <!-- Options should be dynamically populated here -->
                        </select>
                    </div>

                    <!-- Equipment Status -->
                    <div class="mb-3">
                        <label class="form-label">Go Pro Box?</label>
                        <div>
                            <input type="radio" name="go-pro" id="goProYes" value="Yes"> 
                            <label for="goProYes">Yes</label>
                            <input type="radio" name="go-pro" id="goProNo" value="No"> 
                            <label for="goProNo">No</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ticket Scanner?</label>
                        <div>
                            <input type="radio" name="scanner" id="scannerYes" value="Yes"> 
                            <label for="scannerYes">Yes</label>
                            <input type="radio" name="scanner" id="scannerNo" value="No"> 
                            <label for="scannerNo">No</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Auction Item 1?</label>
                        <div>
                            <input type="radio" name="auc-one" id="aucOneYes" value="Yes"> 
                            <label for="aucOneYes">Yes</label>
                            <input type="radio" name="auc-one" id="aucOneNo" value="No"> 
                            <label for="aucOneNo">No</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Auction Item 2?</label>
                        <div>
                            <input type="radio" name="auc-two" id="aucTwoYes" value="Yes"> 
                            <label for="aucTwoYes">Yes</label>
                            <input type="radio" name="auc-two" id="aucTwoNo" value="No"> 
                            <label for="aucTwoNo">No</label>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
                </form>
                
                <!-- Display submission message -->
                <?php if(isset($message)) echo $message; ?>
            </div>
        </div>
    </div>
</div>

<script src="resources/js/main.js"></script>
