 $(document).ready(function() {
        $(".like-button").on("click", function(e) {
            e.preventDefault();
            var postId = $(this).data("post-id");
            var userId = "<?= $_SESSION['user_id']; ?>"

            $.ajax({
                url: "sec_api/v1/post_like.php",
                type: "POST",
                dataType: "json",
                data: {
                    post_id: postId,
                    user_id: userId,
                },
                success: function(res) {
                    if (res.status === 200) {
                        alert("Like saved successfully.");
                    } else {
                        alert(res.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    alert("An error occurred while saving the like.");
                },
            });
        });
    });