function logout() {
  $.ajax({
    url: "sec_api/v1/logout",
    type: "POST",
    success: function (response) {
      // Redirect to the login page
      window.location.href = "login";
    },
    error: function (xhr, status, error) {
      // Handle error
      console.error(error);
    },
  });
}
