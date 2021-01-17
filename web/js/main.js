function toggleMenu() {
  let ul = document.querySelector("menu ul");
  if (ul.style.display != "block") {
    ul.style.display = "block";
  }
  else {
    ul.style.display = "";
  }
}

let ham = document.querySelector("#ham");
ham.onclick = function () {
  toggleMenu();
}