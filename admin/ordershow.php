<?php
include "common.php";
?>

<main>
    <div class="container">
        <h1 class="text-center">Orders</h1>

        <div class="overflow-auto">
            <div id="all-orders">

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
                url: 'orderback.php',
                type: 'post',
                data: {
                    readRecord: readRecord
                },
                success: function(data) {
                    $('#all-orders').html(data);
                }
            });
        }


        function Delivered(id){
            var conf = confirm("Are you sure");
            if (conf == true){
                $.ajax({
                    url: 'orderback.php',
                    type: 'post',
                    data: {id : id},
                    success: function(data){
                        readRecord();
                    }
                })
            }
        }

    </script>
</main>
</div>