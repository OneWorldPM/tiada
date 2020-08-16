<link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<?php
if (isset($booth_tracking) && !empty($booth_tracking))
{
    $unique_list = [];
    foreach ($booth_tracking as $val)
    {
        $unique_list[] = $val->cust_id;
    }

    $unique_list = array_unique($unique_list);
}
?>

<style>
    .post-info {
        margin-bottom: 0px;
        opacity: 1;
    }
    .post-item {
        border-bottom: 2px solid #9b9b9b;
    }

    .hidden {
        visibility: hidden;
    }
    a:hover {
        color: #000 !important;
    }

    .modal-dialog-xl {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .modal-content-xl {
        height: auto;
        min-height: 100%;
        border-radius: 0;
    }

    #tracking-info-table_info{
        font-weight: bold;
    }
</style>

<div class="main-content">
    <div class="wrap-content container" id="container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
            <div class="row">
                <div class="col-sm-8">
                    <h1 class="mainTitle">User Tracking</h1>
                </div>
            </div>
        </section>
        <!-- end: PAGE TITLE -->
        <!-- start: DYNAMIC TABLE -->
        <div class="container-fluid container-fullw">
            <div class="row">
                <div class="panel panel-primary" id="panel5">
                    <div class="panel-heading">
<!--                        <span style="font-size: 20px;font-weight: bold;margin-right: 90px;">Sum of visits: --><?//=sizeof($booth_tracking)?><!--</span>-->
<!--                        <span style="font-size: 20px;font-weight: bold;margin-right: 90px;">Number of unique visitors: --><?//=sizeof($unique_list)?><!--</span>-->
                    </div>
                    <div class="panel-body bg-white" style="border: 1px solid #b2b7bb!important;">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="tracking-info-table" class="table table-bordered table-striped text-center ">
                                    <thead class="th_center">
                                    <tr>
                                        <th>Sponsor</th>
                                        <th>Action</th>
                                        <th>Addnl Info</th>
                                        <th>Full Name</th>
                                        <th>Phone No.</th>
                                        <th>Email</th>
                                        <th>Entry Time</th>
                                        <th>End Time</th>
                                        <th>Total Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (isset($booth_tracking) && !empty($booth_tracking)) {
                                        foreach ($booth_tracking as $val) {
                                            if ($val->end_date_time != '')
                                            {
                                                $totalTime = date('H:i:s', mktime(0, 0, (strtotime($val->end_date_time)- strtotime($val->start_date_time))));
                                            }else{
                                                $totalTime = "-";
                                            }
                                            ?>
                                            <tr>
                                                <td><?= $val->company_name ?></td>
                                                <td><?= $val->action ?></td>
                                                <td><?= $val->addnl_info ?></td>
                                                <td><?= $val->first_name . ' ' . $val->last_name ?></td>
                                                <td><?= $val->phone ?></td>
                                                <td><?= $val->email ?></td>
                                                <td><?= date("Y-m-d h:i:s", strtotime($val->start_date_time)) ?></td>
                                                <td>
                                                    <?php if ($val->end_date_time != '') { ?>
                                                        <?= date("Y-m-d h:i:s", strtotime($val->end_date_time)) ?>
                                                    <?php } else { ?>
                                                        -
                                                    <?php } ?>
                                                </td>
                                                <td><?=$totalTime?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
$(document).ready(function () {

    $('#tracking-info-table thead th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
    var trackingTable = $('#tracking-info-table').DataTable({
        "order": [[ 6, "desc" ]],
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;

                $( 'input', this.header() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });


    });
</script>
