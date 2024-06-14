$(document).ready(function () {
  $("#signupFormBtn").click(function (event) {
    event.preventDefault();
    var formData = $("#signupForm").serialize();

    var username = $("#username").val().trim();
    var fname = $("#first_name").val().trim();
    var lname = $("#last_name").val().trim();
    var email_address = $("#email_address").val().trim();
    var password = $("#password").val().trim();
    var confirm_password = $("#confirm-password").val().trim();
    var my_country = $("#my_country").val().trim();

    if (
      email_address === "" ||
      password === "" ||
      username === "" ||
      fname === "" ||
       lname === "" ||
      my_country === "" ||
      confirm_password === ""
    ) {
      hattip_fire("Please fill all fields.", "ht-danger");
      return;
      }
      
    if (password !== confirm_password) {
    hattip_fire("Passwords do not match.", "ht-danger");
    return;
    }

    $.ajax({
      url: "sec_api/v1/signup",
      type: "POST",
      data: formData,
      success: function (response) {
        var jsonResponse = JSON.parse(response);
        var status = jsonResponse.status;
        var message = jsonResponse.message;
        if (status === 400) {
          hattip_fire(message, "ht-danger");
        } else {
          hattip_fire(message, "ht-success");
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error: " + textStatus, errorThrown);
      },
    });
  });
});
