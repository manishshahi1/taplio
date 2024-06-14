$(document).ready(function () {
  $("#loginFormBtn").click(function (event) {
    event.preventDefault();
    var formData = $("#loginForm").serialize();

    var email_address = $("#email_address").val().trim();
    var password = $("#password").val().trim();

    if (email_address === "" || password === "") {
      hattip_fire("Please fill all fields.", "ht-danger");
      return;
    }

    $.ajax({
      url: "sec_api/v1/login",
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
          setTimeout(pageRedirect, 2000); // Removed quotes around function name
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error: " + textStatus, errorThrown);
      },
    });
  });
});

function pageRedirect() {
  window.location.href = "home"; // Replace with your redirect page URL
}
