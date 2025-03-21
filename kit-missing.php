<?php include("includes/header.php"); 
$con = db_conn();

if (isset($_POST['submit'])) {
    
    // grabs data
    $season = $_POST['inlineRadioOptions'];
    $event = $_POST['drop'];
    $missing_kit = $_POST['missing'];
    $quantity = $_POST['quantity'];

    // get date
    $event_explode = explode(" ", $event);
    $date = end($event_explode);
    $event_date = date('Y-m-d', strtotime($date)); 
    // var_dump($event_date);
     
  
    // sql statemant + pushing changes to database
    // $sql = "UPDATE `event-status` SET status = 'returned' WHERE event_name = '$event' AND season = '$season'";
    $sql = "INSERT INTO `missing-kit` (id, season, event_name, event_date, kit, quantity)
    VALUES (NULL, '$season', '$event', '$event_date', '$missing_kit', '$quantity')";
    $result = mysqli_query($con, $sql);
  
  
    // echo return message
    if ($result){
      $message = "<h2 class='subhead'>" . $event . " Has been set to returned" . "</h2>";
    } else {
      echo"something went wrong";
    }
  
   $con = NULL;
  }


// same thing with the seasons / weekend brackets and just display what kit is missing 
// can follow the table structure of the returned kit but with brakes for the different weekend dates? 
// would need to automatically calculate / input the weekends that would be taking place 
?>
  <form action="" method="post">
    <div class="container" radio="seasons">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" onclick="radioCheck(this.value)">
          <label class="form-check-label" for="inlineRadio1">season 1</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2" onclick="radioCheck(this.value)">
          <label class="form-check-label" for="inlineRadio2">season 2</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="3" onclick="radioCheck(this.value)">
          <label class="form-check-label" for="inlineRadio3">season 3</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="4" onclick="radioCheck(this.value)">
          <label class="form-check-label" for="inlineRadio3">season 4</label>
        </div>
    </div>
    <div class="container">
      <div class="form-group">
        <label for="exampleFormControlSelect1">Event Name</label>
        <select class="form-control" id="exampleFormControlSelect1" name="drop">
        </select>
      </div>
      <div class="form-group">
        <label for="missing">Missing Kit</label>
          <input class="form-control" type="text" placeholder="" name="missing">
      </div>
      <div class="form-group">
          <label for="quantity">Quantity</label>    
          <input type="number" placeholder="" name="quantity">
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>  
  </form>

<script src="resources/js/main.js"></script>