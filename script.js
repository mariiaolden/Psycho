$(document).ready(function () {
  var registration = $('#register-form');
  var registrationLink = $('#register-form-link');

  var login = $('#login-form');
  var loginLink = $('#login-form-link');

  loginLink.click(function () {
    login.show();
    registration.hide();
  });

  registrationLink.click(function () {
    registration.show();
    login.hide();
  });
});
