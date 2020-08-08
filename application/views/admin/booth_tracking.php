<style>
    #example_wrapper .dt-buttons .buttons-csv{
        background-color: #1fbba6;
        padding: 5px 15px 5px 15px;

    }
</style>
<div class="main-content">
    <div class="wrap-content container" id="container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
            <div class="row">
                <div class="col-sm-8">
                    <h1 class="mainTitle">List Of Booth Tracking</h1>
                </div>
            </div>
        </section>
        <!-- end: PAGE TITLE -->
        <!-- start: DYNAMIC TABLE -->
        <div class="container-fluid container-fullw">
            <div class="row">
                <div class="panel panel-primary" id="panel5">
                    <div class="panel-heading">
                        <h4 class="panel-title text-white">Booth Tracking</h4>
                    </div>
                    <div class="panel-body bg-white" style="border: 1px solid #b2b7bb!important;">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered table-striped text-center" id="user">
                                    <thead class="th_center">
                                        <tr>
                                            <th>User ID</th>
                                            <th>Full Name</th>
                                            <th>Phone No.</th>
                                            <th>Email</th>
                                            <th>vCard</th>
                                            <th>IP Address</th>
                                            <th>Operating System</th>
                                            <th>Browser</th>
                                            <th>Resolution</th>
                                            <th>Entry Time</th>
                                            <th>End Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($booth_tracking) && !empty($booth_tracking)) {
                                            foreach ($booth_tracking as $val) {
                                                ?>
                                                <tr>
                                                    <td><?= $val->user_id ?></td>
                                                    <td><?= $val->first_name . ' ' . $val->last_name ?></td>
                                                    <td><?= $val->phone ?></td>
                                                    <td><?= $val->email ?></td>
                                                    <td> 
                                                        <?php if ($val->v_card != "") { ?>
                                                            <a download class="btn btn-info btn-sm" href="<?= base_url() . 'uploads/upload_vcard/' . $val->v_card ?>">
                                                                vCard
                                                            </a>
                                                        <?php } else { ?>
                                                            <a class="btn btn-info btn-sm" href="<?= base_url() . 'admin/exportvcard/' . $val->cust_id ?>">
                                                                vCard
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?= $val->ip_address ?></td>
                                                    <td><?= $val->operating_system ?></td>
                                                    <td><?= $val->computer_type ?></td>
                                                    <td><?= $val->resolution ?></td>
                                                    <td><?= date("Y-m-d h:i:s", strtotime($val->start_date_time)) ?></td>
                                                    <td>
                                                        <?php if ($val->end_date_time != '') { ?>
                                                            <?= date("Y-m-d h:i:s", strtotime($val->end_date_time)) ?>
                                                        <?php } else { ?>
                                                            -
                                                        <?php } ?>
                                                    </td>

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
<?php
$msg = $this->input->get('msg');
switch ($msg) {
    case "D":
        $m = "User Delete Successfully...!!!";
        $t = "success";
        break;
    case "E":
        $m = "Something went wrong, Please try again!!!";
        $t = "error";
        break;
    default:
        $m = 0;
        break;
}
?>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
<?php if ($msg): ?>
            alertify.<?= $t ?>("<?= $m ?>");
<?php endif; ?>
        $("#user").dataTable({
            "ordering": true,
        });
    });
</script>








