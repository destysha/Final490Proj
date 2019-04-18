

/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openNav()
{
  document.getElementById("mySidenav").style.width = "250px";
  //document.getElementById("main").style.marginLeft = "250px";
}

function closeNav()
{
  document.getElementById("mySidenav").style.width = "0";
  //document.getElementById("main").style.marginLeft = "0";
}


  /************************** WIDGET MODAL PUP UP **********************/
  // Get the modal
  var wmodal = document.getElementById('wModal');

  // Get the button that opens the modal
  var wbtn = document.getElementById("bWidget");

  // Get the <span> element that closes the modal
  var wspan = document.getElementsByClassName("wclose")[0];

  // When the user clicks on the button, open the modal
  wbtn.onclick = function() {
    wmodal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  wspan.onclick = function() {
    wmodal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == wmodal) {
      wmodal.style.display = "none";
    }
  }
/*********************************************************************/


/************************** MAP MODAL PUP UP ****************************/

  // Get the modal
  var modal = document.getElementById('myModal');

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on the button, open the modal
  btn.onclick = function() {
    modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }


  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

  /*********************************************************************/
