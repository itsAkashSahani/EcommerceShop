<?php
include "common.php";
?>

<main>
    <div class="container">
        <h1 class="text-center">Add Products</h1>

        <!-- Button trigger modal -->
        <div class="d-flex justify-content-end">
            <a href="test.php" type="button" class="btn btn-primary">
                Print Report
            </a>
        </div>

        <h3 class="text-danger mb-4">Delivered Products</h3>

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
                url: 'showreport.php',
                type: 'post',
                data: {
                    readRecord: readRecord
                },
                success: function(data) {
                    $('#all-products').html(data);
                }
            });
        }

        function report() {
            var report = "report";
            jQuery.ajax({
                url: 'test.php',
                type: 'post',
                data: {
                    report: report
                },
                success: function(data) {
                    report();
                }
            });
        }

        function NotDelivered(id) {
            var conf = confirm("Are you sure");
            if (conf == true) {
                $.ajax({
                    url: 'showproduct.php',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        readRecord();
                    }
                })
            }
        }
    </script>
</main>
</div>