<?php include("includes/header.php"); ?>
<form class="nosbm-form" action="" method="post">
  <div class="container" radio="seasons">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
        <label class="form-check-label" for="inlineRadio1">season 1</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
        <label class="form-check-label" for="inlineRadio2">season 2</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="3">
        <label class="form-check-label" for="inlineRadio3">season 3</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="4">
        <label class="form-check-label" for="inlineRadio3">season 4</label>
      </div>
  </div>

  <div class="container">
    <button onclick="eventStatus('status');" type="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
  <div id="event-table" class="container">
      <table class="table table-striped">
          <thead class="table-dark">
              <tr>Comedy
                  <th scope="col">Event Type</th>
                  <th scope="col">City</th>
                  <th scope="col">Event Date</th>
                  <th scope="col">Status</th>
                  <th scope="col">Date returned</th>
                  <th scope="col">Go Pro Box</th>
                  <th scope="col">Ticket Scanner</th>
                  <th scope="col">Autction Item 1</th>
                  <th scope="col">Autction Item 2</th>
                  <th scope="col">Checked By?</th>
              </tr>
          </thead>
          <tbody id="event-body">
          </tbody>
      </table>
  </div>
    
    <script src="resources/js/main.js"></script>
    <script>changeClass();</script>