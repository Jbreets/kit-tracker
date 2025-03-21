<?php include("includes/header.php");
// var_dump($_SESSION);

$con = db_conn();


// Check if form is submitted
if (isset($_POST['submit'])) {

  // Post Go pro box and ticket scanner
  $user = $_SESSION['username'];
  $go_pro = $_POST['go-pro'];
  $ticket_scanner = $_POST['scanner'];
  $season = $_POST['inlineRadioOptions'];
  $event = $_POST['drop'];
  $auction_item_one = $_POST['auc-one'];
  $auction_item_two = $_POST['auc-two'];


  
  $feilds = array();
  


  // since name is grabbed from options needs breaking into seperate arrays to grab just name
  $event_name = explode(" ", $event);
  $date = date("y-m-d");

  if ($go_pro != "") {
    $feilds['Go Pro Box'] = $go_pro; 
  }
  if ($ticket_scanner != "") {
    $feilds['Ticket scanner'] = $ticket_scanner; 
  }
  if ($auction_item_one != "") {
    $feilds['auction_one'] = $auction_item_one; 
  }
  if ($auction_item_two != "") {
    $feilds['auction_two'] = $auction_item_two; 
  }

  $sql = "UPDATE `event-status` 
  SET 
  status = 'returned', 
  date_returned = '$date', ";

  foreach($feilds as $feild => $value) {

    $sql .= "`$feild`"." = '".$value."'" . ", ";

  }

  $sql .= "`user_check` = '$user' WHERE event_name = '$event_name[2]' AND season = '$season' AND event_type = '$event_name[0]'";

  // var_dump($sql);


  // Seperate SQL statement for Billy
  // if ($go_pro != NULL) {
    // $sql = "UPDATE `event-status` SET status = 'returned', date_returned = '$date', `Go Pro Box` = '$go_pro', `user_check` = 'Billy' WHERE event_name = '$event_name[2]' AND season = '$season' AND event_type = '$event_name[0]'";
  // } elseif($go_pro == NULL) {
    // $sql = "UPDATE `event-status` SET status = 'returned', date_returned = '$date', `Ticket scanner` = '$ticket_scanner', `user_check` = '$user', `auction_one` = '$auction_item_one', `auction_two` = '$auction_item_two' WHERE event_name = '$event_name[2]' AND season = '$season' AND event_type = '$event_name[0]'";
    // 
  // }

 

  // sql statemant + pushing changes to database
  // $sql = "UPDATE `event-status` SET status = 'returned',date_returned = '$date',`Ticket scanner` = COALESCE('$ticket_scanner', `Ticket scanner`),`Go Pro Box` = COALESCE('$go_pro', `Go Pro Box`), `user_check` = '$user',`auction_one` = COALESCE('$auction_item_one', `auction_one` ),`auction_two` = COALESCE('$auction_item_two',`auction_two` ) WHERE event_name = '$event_name[2]' AND season = '$season' AND event_type = '$event_name[0]'";
  $result = mysqli_query($con, $sql);



  






  // echo return message
  if ($result){

  } else {
    echo"something went wrong";
  }

 $con = NULL;


 // Onchange for Select form option 
 //event_check(this.value)
}


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
      <select class="form-control" id="exampleFormControlSelect1" name="drop" onchange="event_check(this.value)" value="" >
      </select>
    </div>
    <div class="form-group">
      <p>Go Pro Box?</p>
      <input type="radio" name="go-pro" value="Yes">
      <label for="Yes">Yes</label>
      <input type="radio" name="go-pro" value="No">
      <label for="No">No</label>
    </div>
    <div class="form-group">
      <p>Ticekt Scanner?</p>
      <input type="radio" name="scanner" value="Yes">
      <label for="Yes" >Yes</label>
      <input type="radio" name="scanner" value="No">
      <label for="No">No</label>
    </div>
    <div class="form-group">
      <p>Auction Item 1?</p>
      <input type="radio" name="auc-one" value="Yes">
      <label for="Yes">Yes</label>
      <input type="radio" name="auc-one" value="No">
      <label for="No">No</label>
    </div>
    <div class="form-group">
      <p>Auction Item 2?</p>
      <input type="radio" name="auc-two" value="Yes">
      <label for="Yes">Yes</label>
      <input type="radio" name="auc-two" value="No">
      <label for="No">No</label>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>  
</form>

<h1 id="test"></h1>
<script src="resources/js/main.js"></script>

    
<?php 
  if($result) {
    $message = "<h3 style='margin-top: 50px; text-align: center;' class='subhead'>Kit Submitted</h3>";
    echo"$message";
  }
?>