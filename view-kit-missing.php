<?php include("includes/header.php"); ?>
<?php
$con = db_conn(); 
if (isset($_POST['submit'])) {
//   var_dump($_POST);
  foreach ($_POST as $key => $value) {
    if (is_int($key)) {
        remove_kit_missing($value);    
    }
  }  
}
?>
<div class="container">
    <div class="form-check form-check-inline">
      <input class="form-check-input" onclick="radioButton(1)" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
      <label class="form-check-label" for="inlineRadio1">season 1</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" onclick="radioButton(2)" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
      <label class="form-check-label" for="inlineRadio2">season 2</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" onclick="radioButton(3)" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="3">
      <label class="form-check-label" for="inlineRadio3">season 3</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" onclick="radioButton(4)" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="4">
      <label class="form-check-label" for="inlineRadio3">season 4</label>
    </div>
</div>
<form action='' method='post'>
    <div class='container'>
        <table class='table table-striped'>
            <thead class='table-dark'>
                <tr>
                    <th scope='col'>ID</th>
                    <th scope='col'>Event</th>
                    <th scope='col'>Kit Missing</th>
                    <th scope='col'>Quantity</th>
                    <th scope='col'>Kit Returned</th>
                </tr>
            </thead>
            <tbody id='divtest'>
            </tbody>
        </table>        
    </div>
    <div class="container">
      <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
    </div>
</form>    
<script src="resources/js/main.js"></script>
    