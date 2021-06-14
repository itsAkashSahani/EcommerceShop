<div class="container w-50 mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h2>Admin Login</h2>
        </div>
        <div class="card-body">
            <form method="post" id="adminLogin" name="adminLogin">
                <div class="form-group">
                    <label for="adminEmail">Email Address</label>
                    <input type="email" class="form-control" id="adminEmail" name="adminEmail" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="adminPass">Password</label>
                    <input type="password" class="form-control" id="adminPass" name="adminPass" placeholder="Enter Password">
                </div>
                <br>

                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" value="Login">
                </div>
            
                <div id="msg">

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    jQuery('#adminLogin').on('submit', function(e) {
        jQuery.ajax({
            url: 'login.php',
            type: 'post',
            data: jQuery('#loginForm').serialize(),
            success: function(data) {
                if (data == "user_exist") {
                    swal("Welcome Back!", "You logged in successfully", "success");
                    setTimeout(function() {
                        window.location.href = "dashboard.php";
                    }, 4000);
                } else if (data == "something_wrong") {
                    swal("Oops !", "Something went wrong, Try again", "error");
                } else {
                    $("#msg").html(data);
                }


            }
        });
        e.preventDefault();
    });
</script>