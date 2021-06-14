<?php
include "common.php";
?>

<main>
    <div class="container">
        <h1 class="text-center">Add Products</h1>

        <!-- Button trigger modal -->
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addproductsmodal">
                Add Product
            </button>
        </div>

        <div id="success" class="mt-2">
            <div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>Product Added Successfully</b>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#success').hide();
            });
        </script>

        <!-- Modal -->
        <div class="modal fade" id="addproductsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Products</h5>
                        <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="addproducts" name="addproducts" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="pname">Product Name</label>
                                        <input type="text" class="form-control" name="pname" id="pname" placeholder="Product Name" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="pfile">Product Image</label>
                                        <input type="file" class="form-control-file" name="pfile" id="pfile" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="pcategory">Category</label>
                                        <select id="pcategory" name="pcategory" class="form-control" required>
                                            <option value="Shirt" selected>Shirt</option>
                                            <option value="Jeans">Jeans</option>
                                            <option value="TShirts">TShirt</option>
                                            <option value="Formals">Formals</option>
                                            <option value="Trousers">Trousers</option>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="pqty">Quantity</label>
                                        <input type="number" class="form-control" name="pqty" id="pqty" required>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="pdesc">Product Description</label>
                                    <textarea class="form-control" id="pdesc" name="pdesc" rows="3" required></textarea>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" name="price" id="price" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="brand">Brand</label>
                                        <input type="text" class="form-control" name="brand" id="brand" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-block" value="Add" />
                                </div>

                                <div id="msg">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="text-danger mb-4">All Products</h3>

        <div class="overflow-auto">
            <div id="all-products">

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            readRecord();
        })


        function readRecord() {
            var readRecord = "readRecord";
            jQuery.ajax({
                url: 'showproduct.php',
                type: 'post',
                data: {
                    readRecord: readRecord
                },
                success: function(data) {
                    $('#all-products').html(data);
                }
            });
        }


        jQuery('#addproducts').on('submit', function(e) {

            var formData = new FormData(this);
            jQuery.ajax({
                url: 'addproductBackend.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data == "Product_Added") {
                        $('#success').show();
                        readRecord();
                        $('#addproducts')[0].reset();
                        $('#closeModal').trigger('click');
                    } else {
                        $("#msg").html(data);
                    }
                }
            });
            e.preventDefault();
        });

        function DeleteProduct(deleteid){
            var conf = confirm("Are you sure");
            if (conf == true){
                $.ajax({
                    url: 'showproduct.php',
                    type: 'post',
                    data: {deleteid : deleteid},
                    success: function(data){
                        readRecord();
                    }
                })
            }
        }

    </script>
</main>
</div>