
function changeColor(inputSelector, divSelector) {
  let inputElem = document.querySelector(inputSelector);
  let divElem = document.querySelector(divSelector);

  if (inputElem && divElem) {
    divElem.style.backgroundColor = inputElem.value;
  }
  
}
let button1 = document.querySelector("#button1");
let changeColorButton = document.querySelector("#changeColor");

// changeColorButton.onclick = () => {
//   changeColor("#color", "#first"); 
// }

button1.onclick = () => {
  alert("Clicked!!!");
}

$("#changeColor").click(()=>{
  $("#first").css("background-color", $("#color").val());
});

$("#toggleVis").click(()=>{
  $("#third").fadeToggle();
});