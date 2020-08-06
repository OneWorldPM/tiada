<div class="main-content" >
    <div class="wrap-content container" id="container">
        <form name="frm_credit" id="frm_credit" method="POST" action="">
            <div class="container-fluid container-fullw bg-white">
                <div class="row">                     
                    <div class="col-md-12">
                        <div class="panel panel-light-primary" id="panel5">
                            <div class="panel-heading">
                                <h4 class="panel-title text-white">User</h4>
                            </div>
                            <div class="panel-body bg-white" style="border: 1px solid #b2b7bb;">
                                <span id="errortxtsendemail" style="color:red;"></span>
                                <h5 class="over-title margin-bottom-15 margin-top-5">User List<span class="text-bold"></span></h5>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-full-width" id="plan_table">
                                        <thead>
                                            <tr>
                                                <th>Register ID</th>
                                                <th>Profile</th>
                                                <th>Full Name</th>
                                                <th>Phone No.</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Country</th>                      
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($user) && !empty($user)) {
                                                foreach ($user as $val) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $val->register_id ?></td>
                                                        <td>
                                                            <?php if ($val->profile != "") { ?>
                                                                <img src="<?= base_url() ?>uploads/customer_profile/<?= $val->profile ?>" style="height: 40px; width: 40px;">
                                                            <?php } else { ?>
                                                                <img src="<?= base_url() ?>assets/images/Avatar.png" style="height: 40px; width: 40px;">
                                                            <?php } ?>
                                                        <td><?= $val->first_name . ' ' . $val->last_name ?></td>
                                                        <td><?= $val->phone ?></td>
                                                        <td><?= $val->email ?></td>
                                                        <td><?= $val->address ?></td>
                                                        <td><?= $val->city ?></td>
                                                        <td><?= $val->state ?></td>
                                                        <td><?= $val->country ?></td>

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
        </form>   
        <!-- end: DYNAMIC TABLE -->
    </div>
</div>

</div>


<script>
    $(document).ready(function () {

        $('#plan_table').dataTable({
            "aaSorting": []
        });

      
    });

</script>









