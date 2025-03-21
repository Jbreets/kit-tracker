<?php include("includes/header.php"); 

$con = db_conn();
if (isset($_POST['submit'])) {
    
    // potentially add a third option of pending before kit is sent
    $event_type = $_POST['event-type'];
    $event_name = $_POST['event-name'];
    $event_date = $_POST['event-date'];
    $status = "pending";
    $season = $_POST['season'];
    

    $sql = "INSERT INTO `event-status` (id, event_type, event_name, event_date, status, season, date_returned)
    VALUES (NULL, '$event_type', '$event_name', '$event_date', '$status', '$season', NULL)";
    $result = mysqli_query($con, $sql);

    if ($result){
        $message = "<h2 class='subhead'>" . $event . " Has been set to returned" . "</h2>";
      } else {
        echo"something went wrong";
      }
}
?>
<div class="container">
    <h1 class="pg-title">Insert Event</h1>
</div>
<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <label for="event-type">Event Type</label>
            <select class="form-control" name="event-type" id="">
                <option value="UWCB">UWCB</option>
                <option value="UMMA">UMMA</option>
                <option value="UBALLROOM">UBALLROOM</option>
                <option value="UCOMEDY">UCOMEDY</option>
            </select>
        </div>
        <div class="form-group">
            <label for="event-name">City</label>
            <input class="form-control" type="text" name="event-name">
        </div>
        <div class="form-group">
            <label for="event-name">Event Date</label>
            <input class="form-control" type="date" name="event-date">
        </div>
        <div class="form-group">
            <label for="event-name">Season</label>
            <input class="form-control" type="number" name="season" min=1 max=4>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>