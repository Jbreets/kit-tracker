<?php 
// database connection function
function db_conn() {
  // local
  $db_host = 'localhost';
  $db_user = 'jack';
  $db_password = '';
  $db_name = 'kit-manager2'; 

  // opalstack connection
  // $db_host = '';
  // $db_user = '';
  // $db_password = '';
  // $db_name = 'kit_manager';
  
  $con = mysqli_connect($db_host, $db_user, $db_password, $db_name);

  return $con;
} // END OF FUNCTION


/////////////////////////////////////////////////////////// 
///////////////////// vAJAX JS CODEv //////////////////////
/////////////////////////////////////////////////////////// 



// catches js from kit returning.php / dropdown form
// add if set to avoid errors
$test = $_GET['q'];
if ($test == true) {
  // sql, grabs info from event status
  $con = db_conn();
  $sql = "SELECT * FROM `event-status` WHERE season = $test ORDER BY event_date";
  $result = mysqli_query($con, $sql);
  $season = mysqli_fetch_all($result, MYSQLI_ASSOC);
  

  // echoes options for drowdown form
  echo"<option hidden value=''></option>";
  echo"<optgroup label=Season-" . $test . "></optgroup>"; 
  foreach ($season as $val) {

    // channges date to Date - Month - Year
    $date = date("d-m-Y", strtotime($val['event_date'])); 
    echo"<option> " . $val['event_type'] . " - " . $val['event_name'] . " - " . $date . " </option>"; 

  }
} //END OF AJAX STATEMENT



// catches js from event-status.php
$drop_table = $_GET['status'];
if($drop_table == true) {

  $events = generate_events($drop_table);
  $prev_date = "";
  // foreach
  foreach ($events as $event) {

    // breaks the events into weekends by looking at the dates provided and comparing them

    if (empty($prev_date)) {
      # code...
    } else {
      $date1 = new DateTime($event['event_date']);
      $date2 = new DateTime($prev_date);
      $interval = $date1->diff($date2);
    }
    
    // change red to black and add another if statement that changes row to red if $interval->d > 1 
    // red block is to seperate days and black is to seperate weekends
    if ($interval->d > 3) {
      echo"<tr><th style='height: 34px;' colspan='10' class='event-type' event='break'></th></tr>";
    } elseif ($interval->d > 0) {
      echo"<tr><th style='height: 34px;' colspan='10' class='event-type' event='UCOMEDY'></th></tr>";
    }

    
    // echo table data
    echo "<tr>";
    // switch to change event type box color
    switch ($event['event_type']) {
      case 'UWCB':
        echo "<th scope='row' class='event-type' event='UWCB'>" . $event['event_type'] . "</th>";
        break;
      case 'MMA':
        echo "<th scope='row' class='event-type' event='UMMA'>" . $event['event_type'] . "</th>";
        break;
      case 'BALLROOM':
        echo "<th scope='row' class='event-type' event='UBALLROOM'>" . $event['event_type'] . "</th>";
        break;  
        case 'COMEDY':
        echo "<th scope='row' class='event-type' event='UCOMEDY'>" . $event['event_type'] . "</th>";
        break;  
    }


    echo "<th>" . $event['event_name'] . "</th>";
    echo "<th>" . $event['event_date'] . "</th>";



    // if else to change status type box color 
    if ($event['status'] == "returned") {
      echo "<th event='returned'>" . $event['status'] . "</th>";
    } else {
      echo "<th>" . $event['status'] . "</th>";  
    }
    echo "<th>" . $event['date_returned'] . "</th>";

    $prev_date = $event['event_date'];



    // If else for Go Pro Box
    if ($event['Go Pro Box'] == "Yes") {
      echo "<th event='returned'>" . $event['Go Pro Box'] . "</th>";
    } elseif ($event['Go Pro Box'] == "No") {
      echo "<th event='missing'>" . $event['Go Pro Box'] . "</th>";
    } else {
      echo "<th>" . $event['Go Pro Box'] . "</th>"; 
    } 



    // If Else for ticket scanner
    if ($event['Ticket scanner'] == "Yes") {
      echo "<th event='returned'>" . $event['Ticket scanner'] . "</th>";
    } elseif ($event['Ticket scanner'] == "No") {
      echo "<th event='missing'>" . $event['Ticket scanner'] . "</th>";
    } else {
      echo "<th>" . $event['Ticket scanner'] . "</th>";  
    }


    // If else auction Items
    if ($event['auction_one'] == "Yes") {
      echo "<th event='returned'>" . $event['auction_one'] . "</th>";
    } elseif ($event['auction_one'] == "No") {
      echo "<th event='missing'>" . $event['auction_one'] . "</th>";
    }else {
      echo "<th>" . $event['auction_one'] . "</th>"; 
    }

    if ($event['auction_two'] == "Yes") {
      echo "<th event='returned'>" . $event['auction_two'] . "</th>";
    }elseif ($event['auction_two'] == "No") {
      echo "<th event='missing'>" . $event['auction_two'] . "</th>";
    }else {
      echo "<th>" . $event['auction_two'] . "</th>"; 
    }



    echo"<th>" . $event['user_check'] . "</th>";
    echo"</tr>";


  }
} //END OF AJAX STATEMENT




// catches the js for view-kit-missing.php
$drop_table = $_GET['missing'];
$key = 0;
if($drop_table == true) {
  $events = generate_missing_kit($drop_table);
  // foreach
  foreach ($events as $event) {
    $id = $event['id']; 
    // echo table data
    echo "<tr>";
    echo "<th scope='row'>" . $event['id'] . "</th>";
    echo "<th>" . $event['event_name'] . "</th>";
    echo "<th>" . $event['kit'] . "</th>";
    echo "<th>" . $event['quantity'] . "</th>";
    echo "<th event='blank'> <input type='checkbox' name='$key' value='$id'><label for='check'>Returned?</label></th>";
    echo"</tr>";
    $key ++;
  }
} //END OF AJAX STATEMENT




$radio = $_GET['radio'];
if (isset($radio)) {
  $events = generate_missing_kit($radio);
  // LOOP FOR THE KIT DATA
  foreach ($events as $event) {
    $id = $event['id']; 
    // echo table data
    echo "<tr>";
    echo "<th scope='row'>" . $event['id'] . "</th>";
    echo "<th>" . $event['event_name'] . "</th>";
    echo "<th>" . $event['kit'] . "</th>";
    echo "<th>" . $event['quantity'] . "</th>";
    echo "<th event='blank'> <input type='checkbox' name='$key' value='$id'><label for='check'></label></th>";
    echo"</tr>";
    $key ++;
  }
  
}

/////////////////////////////////////////////////////////// 
///////////////////// ^AJAX JS CODE^ //////////////////////
/////////////////////////////////////////////////////////// 


// Inserts event status into database

/*

function event_status_insert() {
  $con = db_conn();
  $sql = "INSERT INTO `event-status` (id, event_type, event_name, event_date, status, season, date_returned)
  VALUES (NULL, '$event_type', '$event_name', '$event_date', '$status', '$season', NULL)";
  $result = mysqli_query($con, $sql);

}*/

 // END OF FUNCTION


// generates the event names depending on the season provided
function generate_events($season_num) {
  $con = db_conn();
  $sql = "SELECT * FROM `event-status` WHERE season = $season_num ORDER BY event_date";
  $result = mysqli_query($con, $sql);
  $team_display = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return($team_display);
} // END OF FUNCTION

// generates the kit missing depending on season provided
function generate_missing_kit($season_num) {
  $con = db_conn();
  $sql = "SELECT * FROM `missing-kit` WHERE season = $season_num ORDER BY event_date";
  $result = mysqli_query($con, $sql);
  $kit = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return($kit);
} // END OF FUNCTION


// function that seperates events via weekend
function event_weekend() {

}

// function that removes item from kit-missing db
function remove_kit_missing($id) {
  $con = db_conn();
  $sql = "DELETE FROM `missing-kit` WHERE `missing-kit`.`id` = $id";
  $result = mysqli_query($con, $sql);
  if ($result) {
    // echo"Item has been removed from the database";
  }
}

// Function that grabs event info from the database
function get_event_info($event_type, $event_name, $event_date) {
  $con = db_conn();
  $event_date = date("Y-m-d", strtotime($event_date));
  // var_dump($event_date);
  $sql = "SELECT * FROM `event-status` WHERE event_type = '$event_type' AND event_name = '$event_name' AND event_date = '$event_date'";
  $result = mysqli_query($con, $sql);
  $event = mysqli_fetch_all($result, MYSQLI_ASSOC); 
  $array = [
    // 'scanner'->$event['Ticket scanner'],
    // 'go-pro'->$event['Go Pro Box'],
  ];
  return $event;
  
  
}

?>