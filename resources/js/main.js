document.querySelector(".nosbm-form").addEventListener('submit', function(e) {
    e.preventDefault();
})


// function for event-status.php
function eventStatus($letter) {
    let op1 = document.getElementById("inlineRadio1");
    let op2 = document.getElementById("inlineRadio2");
    let op3 = document.getElementById("inlineRadio3");
    let op4 = document.getElementById("inlineRadio4");
    if (op1.checked == true) {
      radio = op1.value;
    } else if (op2.checked == true) {
      radio = op2.value;
    } else if (op3.checked == true) {
      radio = op3.value;
    } else if (op4.checked == true) {
      radio = op4.value;
    }
    // console.log(radio);
  
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("event-body").innerHTML = this.responseText;
    }
  
    xhttp.open("GET", "functions/funcs.php?" + $letter + "="+radio);
    xhttp.send();
  } //END OF FUNCTION



// function for Kit-missing.php   
function radioCheck(str) {
  let op1 = document.getElementById("inlineRadio1");
  let op2 = document.getElementById("inlineRadio2");
  let op3 = document.getElementById("inlineRadio3");
  let op4 = document.getElementById("inlineRadio4");
  if (op1.checked == true) {
    radio = op1.value;
  } else if (op2.checked == true) {
    radio = op2.value;
  } else if (op3.checked == true) {
    radio = op3.value;
  } else if (op4.checked == true) {
    radio = op4.value;
  }
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("exampleFormControlSelect1").innerHTML = this.responseText;
}
  xhttp.open("GET", "functions/funcs.php?q="+str);
  xhttp.send();
}//END OF FUNCTION




function radioButton(num) {
  // console.log(num);
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("divtest").innerHTML = this.responseText;
}
  xhttp.open("GET", "functions/funcs.php?radio="+num);
  xhttp.send();
}//END OF FUNCTION

function changeClass() {
  // table-responsive
  // if viewport width < 500px change class to ^
  const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0)
  // console.log(vw)
  if (vw < 770) {
    document.getElementById("event-table").className = "table-responsive";
  }
}

 

function event_check(eventName) {
  console.log(eventName);
  
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("test").innerHTML = this.responseText;
}
  xhttp.open("GET", "functions/funcs.php?ktr-form="+eventName);
  xhttp.send();

}


// function for scanners
function scannerCheck(answer) {
  document.getElementById('scanner-radio');
  // get checked yes or no
  // change value checked to true
}
// function for go pros
function GoProCheck(answer) {
  document.getElementById('go-pro-radio');
  // get checked yes or no
  // change value checked to true
}