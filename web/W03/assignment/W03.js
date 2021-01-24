

// counter for items in cart
// listen to add to cart events


let addToCart = document.querySelectorAll(".add");
let deleteFromCart = document.querySelectorAll(".fa-trash");
let refresh = document.querySelectorAll('.fa-refresh');
let purchase = document.querySelector('#purchase');

addToCart.forEach(elem => {
  elem.onclick = function () {
    elem.parentElement.parentElement.submit();
  }
});

deleteFromCart.forEach(elem => {
  elem.onclick = function () {
    elem.parentElement.submit();
  }
});

refresh.forEach(elem => {
  elem.onclick = function () {
    elem.parentElement.parentElement.parentElement.submit();
  }
});

purchase.onclick = function () {
  purchase.parentElement.submit();
}