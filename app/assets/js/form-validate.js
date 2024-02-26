const loginForm = document.getElementById("login-form");
const signupForm = document.getElementById("signup-form");

const loginEmail = document.getElementById("login-email");
const loginPassword = document.getElementById("login-password");

const signupName = document.getElementById("signup-name");
const signupEmail = document.getElementById("signup-email");
const signupPassword = document.getElementById("signup-password");
const signupConfirmPass = document.getElementById("signup-confirm-password");

const loginError = document.getElementById("login-errors");
const signupError = document.getElementById("signup-errors");

let nameRegx = new RegExp(/^[a-zA-Z ]{4,30}$/);
let emailRegx = new RegExp(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/);
let passRegx = new RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/);

loginForm.addEventListener('keyup', function (e) {

  let loginMessages = [];

  // Email Validation
  if (loginEmail.value == '' || loginEmail.value == null) {
    loginMessages.push('Polje za email ne moze ostati prazno.');
  }
  if (!emailRegx.test(loginEmail.value)) {
    loginMessages.push('Unesi validan email');
  }

  // Password Validation
  if (loginPassword.value == '' || loginPassword.value == null) {
    loginMessages.push('Polje za lozinku ne moze ostati prazno.');
  }
  if (!passRegx.test(loginPassword.value)) {
    loginMessages.push('Lozinka mora da ima od 6 do 20 karaktera, bar 1 broj, 1 veliko slovo i 1 malo slovo.');
  }

  if (loginMessages.length > 0) {
    e.preventDefault();
    signupError.innerHTML = "";
    loginError.innerHTML = loginMessages.join('<br> ');
  }
  else {
    loginError.innerHTML = "";
  }
});

signupForm.addEventListener('keyup', function (e) {
  let signupMessages = [];

  // Name Validation
  if (signupName.value == '' || signupName.value == null) {
    signupMessages.push('Polje za ime ne moze ostati prazno.');
  }
  if (!nameRegx.test(signupName.value)) {
    signupMessages.push('Ime mora da sadrzi od 4 do 30 karaktera.');
  }

  // Email Validation
  if (signupEmail.value == '' || signupEmail.value == null) {
    signupMessages.push('Polje za email ne moze ostati prazno.');
  }
  if (!emailRegx.test(signupEmail.value)) {
    signupMessages.push('Unesi validan email');
  }

  // Password Validation
  if (signupPassword.value == '' || signupPassword.value == null) {
    signupMessages.push('Polje za lozinku ne moze ostati prazno.');
  }
  if (!passRegx.test(signupPassword.value)) {
    signupMessages.push('Lozinka mora da ima od 6 do 20 karaktera, bar 1 broj, 1 veliko slovo i 1 malo slovo.');
  }
  if (signupConfirmPass.value == '' || signupConfirmPass.value == null) {
    signupMessages.push('Polje za potvrdivanje lozinke ne moze ostati prazno.');
  }
  if (signupPassword.value != signupConfirmPass.value) {
    signupMessages.push('Lozinke se ne poklapaju.');
  }

  if (signupMessages.length > 0) {
    e.preventDefault();
    loginError.innerHTML = "";
    signupError.innerHTML = signupMessages.join('<br> ');
  }
  else {
    signupError.innerHTML = "";
  }
});

loginForm.addEventListener('submit', function (e) {

  let loginMessages = [];

  // Email Validation
  if (loginEmail.value == '' || loginEmail.value == null) {
    loginMessages.push('Polje za email ne moze ostati prazno.');
  }
  if (!emailRegx.test(loginEmail.value)) {
    loginMessages.push('Unesi validan email');
  }

  // Password Validation
  if (loginPassword.value == '' || loginPassword.value == null) {
    loginMessages.push('Polje za lozinku ne moze ostati prazno.');
  }
  if (!passRegx.test(loginPassword.value)) {
    loginMessages.push('Lozinka mora da ima od 6 do 20 karaktera, bar 1 broj, 1 veliko slovo i 1 malo slovo.');
  }

  if (loginMessages.length > 0) {
    e.preventDefault();
    signupError.innerHTML = "";
    loginError.innerHTML = loginMessages.join('<br> ');
  }
  else {
    loginError.innerHTML = "";
  }
});

signupForm.addEventListener('submit', function (e) {
  let signupMessages = [];

  // Name Validation
  if (signupName.value == '' || signupName.value == null) {
    signupMessages.push('Polje za ime ne moze ostati prazno.');
  }
  if (!nameRegx.test(signupName.value)) {
    signupMessages.push('Ime mora da sadrzi od 4 do 30 karaktera.');
  }

  // Email Validation
  if (signupEmail.value == '' || signupEmail.value == null) {
    signupMessages.push('Polje za email ne moze ostati prazno.');
  }
  if (!emailRegx.test(signupEmail.value)) {
    signupMessages.push('Unesi validan email');
  }

  // Password Validation
  if (signupPassword.value == '' || signupPassword.value == null) {
    signupMessages.push('Polje za lozinku ne moze ostati prazno..');
  }
  if (!passRegx.test(signupPassword.value)) {
    signupMessages.push('Lozinka mora da ima od 6 do 20 karaktera, bar 1 broj, 1 veliko slovo i 1 malo slovo.');
  }
  if (signupConfirmPass.value == '' || signupConfirmPass.value == null) {
    signupMessages.push('Polje za potvrdivanje lozinke ne moze ostati prazno.');
  }
  if (signupPassword.value != signupConfirmPass.value) {
    signupMessages.push('Lozinke se ne poklapaju.');
  }

  if (signupMessages.length > 0) {
    e.preventDefault();
    loginError.innerHTML = "";
    signupError.innerHTML = signupMessages.join('<br> ');
  }
  else {
    signupError.innerHTML = "";
  }
});