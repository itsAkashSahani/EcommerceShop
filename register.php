<!-- The Modal -->
<div class="modal" id="register">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Register</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->

            <form method="post" id="registerForm" name="registerForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter first name" required>

                        </div>
                        <div class="form-group col">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter last name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter last name" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="number" class="form-control" name="contact" id="contact" placeholder="Enter last name" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter last name" required>
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
    jQuery('#registerForm').on('submit', function(e) {
        jQuery.ajax({
            url: 'registerVal.php',
            type: 'post',
            async: false,
            data: jQuery('#registerForm').serialize(),
            success: function(data) {
                if (data == "register_success") {
                    swal("Welcome !", "You have registered Successfully", "success");
                    setTimeout(function(){
                        window.location.href = "index.php";
                    }, 4000);
                } else {
                    $("#msg").html(data);
                }
            }
        });
        e.preventDefault();
    });
</script>