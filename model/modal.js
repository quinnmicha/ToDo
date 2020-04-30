
function addFunction(){
    // Get the modal
    var modal = document.getElementById("addModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    modal.style.display = "block";


    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
}


function displayFunction(){    
    // Get the modal
    var modal = document.getElementById("displayModal0");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closeModal")[0];

    // When the user clicks on the button, open the modal
    modal.style.display = "block";


    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
}

function outputForPurchaseConf(){
    
}