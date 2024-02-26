$(document).ready(function() {
    //Check admin password is correct or not
    $("#current_password").keyup(function() {
        var current_password = $("#current_password").val();
        $.ajax({
            type: 'post',
            url: '/admin/check-current-password',
            data: {current_password:current_password},
            success: function(resp) {
                if(resp=="false") {
                    $("#checkCurrentPassword").html("<font color='red'>Current Password is incorrect</font>");
                } else if(resp=="true") {
                    $("#checkCurrentPassword").html("<font color='green'>Current Password is correct</font>");
                }
            }, error: function() {
                alert("Error");
            }
        })
    })
})
