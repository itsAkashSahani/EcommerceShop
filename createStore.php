<!-- The Modal -->
<div class="modal" id="createStore">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Your Store</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->

            <?php 
                echo '
                <form method="post" id="createStoreForm" name="createStoreForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="sname">Shop Name</label>
                            <input type="text" class="form-control" name="sname" id="sname" placeholder="Enter Shop Name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="shoplogo">Shop Logo</label>
                            <input type="file" class="form-control-file" name="shoplogo" id="shoplogo" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="scategory">Type of shop</label>
                            <select id="scategory" name="scategory" class="form-control" required>
                                <option value="Food Shop" selected>Food Shop</option>
                                <option value="Electroncis">Electronics</option>
                                <option value="Clothing">Clothing</option>
                                <option value="Hardware">Hardware</option>
                                <option value="Apparels">Apparels</option>
                                <option value="Shoe Shop">Shoes Shop</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="shopemail">Shop Email</label>
                            <input type="email" class="form-control" name="shopemail" id="shopemail" placeholder="Enter Shop Email-id" required>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="shopaddr">Shop Address</label>
                        <textarea class="form-control" id="shopaddr" name="shopaddr" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city" id="city" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="state">State</label>
                            <input type="text" class="form-control" name="state" id="state" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="pin">Pincode</label>
                            <input type="number" class="form-control" name="pin" id="pin" required>
                        </div>

                        
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="'. $_SESSION['email'] .'" readonly>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Create Shop" />
                    </div>

                    <div id="msg">

                    </div>
                </div>
            </form>
                
                ';
            ?>



        </div>
    </div>
</div>



<script>
    jQuery('#createStoreForm').on('submit', function(e) {
        var formData = new FormData(this);
        jQuery.ajax({
            url: 'createStoreVal.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == "Shop_Created") {
                    swal("Store Created Successfully", "Click Button", "success");
                    $('#createStoreForm')[0].reset();
                    setTimeout(function(){
                        window.location.href = "admin/index.php";
                    }, 4000);
                } else {
                    $("#msg").html(data);
                }
            }
        });
        e.preventDefault();
    });
</script>