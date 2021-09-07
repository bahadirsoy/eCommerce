<?php

    //database connection and session
    require "SharedFiles/databaseConnection.php";
    session_start();

?>

<!doctype html>
<html lang="en">

<head>

    <?php 
        require "SharedFiles/headTags.php";
    ?>

    <!--Data table CDN-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.js">
    </script>

    <title>E-Commerce</title>

    <style>
        td.details-control {
            background: url('resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.details td.details-control {
            background: url('resources/details_close.png') no-repeat center center;
        }

        .deleteOrderDemand {
            background: url('resources/deleteOrderDemand.png') no-repeat center center;
            cursor: pointer;
        }
    </style>

</head>

<body>

    <?php
        require "SharedFiles/navbar.php";
        
    ?>

    <!-- <button class="btn btn-secondary btn-sm my-3 mx-2" id="deleteButton">Delete rows</button> -->

    <table id="example" class="ui celled table cell-border mdl-data-table" style="width:100%">
        <thead>
            <tr>
                <th data-orderable="false"></th>
                <th>Products</th>
                <th>Order Date</th>
                <th>Status</th>
                <th data-orderable="false"></th>
            </tr>
        </thead>
    </table>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <script>
        function format(d) {
            return 'Receiver name: ' + d[0][0] + '<br>' +
                'Receiver surname: ' + d[0][1] + '<br>' +
                'Address: ' + d[0][2] + '<br>';
        }

        $(document).ready(function () {
            var dt = $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "data.php",
                responsive: true,
                "columns": [{
                        "class": "details-control",
                        "orderable": false,
                        "data": null,
                        "defaultContent": ""
                    },
                    {

                    },
                    {

                    },
                    {

                    },
                    {
                        "orderable": false,
                    },
                ],
                "order": [
                    [2, 'desc']
                ]
            });

            // Array to track the ids of the details displayed rows
            var detailRows = [];

            $('#example tbody').on('click', 'tr td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = dt.row(tr);
                var idx = $.inArray(tr.attr('id'), detailRows);

                if (row.child.isShown()) {
                    tr.removeClass('details');
                    row.child.hide();

                    // Remove from the 'open' array
                    detailRows.splice(idx, 1);
                } else {
                    tr.addClass('details');
                    row.child(format(row.data())).show();

                    // Add to the 'open' array
                    if (idx === -1) {
                        detailRows.push(tr.attr('id'));
                    }
                }
            });

            // On each draw, loop over the `detailRows` array and show any child rows
            dt.on('draw', function () {
                $.each(detailRows, function (i, id) {
                    $('#' + id + ' td.details-control').trigger('click');
                });
            });

            /*$('#example tbody').on('click', 'tr', function () {
                $(this).toggleClass('selected');
            });

            $('#deleteButton').click(function () {
                dt.row('.selected').remove().draw(false);
            });*/

        });
    </script>

</body>

</html>