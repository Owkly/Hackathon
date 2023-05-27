console.log("Hello World");

function send() {
    const elem = document.getElementById("contactform");
    //console.log(elem);
    console.log(2)
    console.log(document.getElementsByClassName("inputboite"));
  }

sendbutton = document.getElementById("contactform");
// console.log(buttonsend);
// console.log(document)
sendbutton.addEventListener("click", send);