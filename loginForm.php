<!-- The Modal -->
<div class="modal" id="login">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Login Here</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->

            <form method="post" id="loginForm" name="loginForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="log-email" id="email" placeholder="Enter email-id" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="log-password" id="password" placeholder="Enter password" required>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Submit" />
                    </div>

                    <div id="msg">

                    </div>
                </div>
            </form>



        </div>
    </div>
</div>



<script>
    jQuery('#loginForm').on('submit', function(e) {
        jQuery.ajax({
            url: 'login.php',
            type: 'post',
            async: false,
            data: jQuery('#loginForm').serialize(),
            success: function(data) {
                if (data == "user_exist") {
                    swal("Welcome Back!", "You logged in successfully", "success");
                    setTimeout(function(){
                        window.location.href = "index.php";
                    }, 4000);
                } 

                else if (data == "something_wrong") {
                    swal("Oops !", "Something went wrong, Try again", "error");
                }
                
                else {
                    $("#msg").html(data);
                }

                
            }
        });
        e.preventDefault();
    });
</script>