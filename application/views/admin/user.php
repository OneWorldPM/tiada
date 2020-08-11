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
                    <h1 class="mainTitle">List Of User Data</h1>
                </div>
            </div>
        </section>
        <!-- end: PAGE TITLE -->
        <!-- start: DYNAMIC TABLE -->
        <div class="container-fluid container-fullw">
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <div class="panel panel-primary" id="panel5">
                        <div class="panel-heading">
                            <h4 class="panel-title text-white">Import CSV for Non-Member</h4>
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #b2b7bb;">
                            <form class="form-login" id="frm_import_full_conference_with_roundtables" name="frm_import_full_conference_with_roundtables" enctype="multipart/form-data" method="post" action="<?= base_url() ?>admin/user/import_user">
                                <div class="form-body">
                                    <div class="form-group">
                                        <a href="<?= base_url() ?>uploads/user_import_sample.csv" download>Download Sample CSV</a>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-large">Select Member Type :</label>
                                        <select class="form-control" id="member_type" name="member_type">
                                            <option value="">Select Member Type</option>
                                            <option value="full_conference_with_roundtables">Import for Full Conference - with roundtables</option>
                                            <option value="full_conference_no_roundtables">Import for Full Conference - no roundtables</option>
                                            <option value="expo_only">Expo only</option>
                                        </select>
                                        <span id="errormember_type" style="color:red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-large">Select Choose File :</label>
                                        <label id="projectinput8" class="file center-block">
                                            <input type="file" name="import_file" accept=".csv" id="import_file">
                                            <span class="file-custom"></span>
                                        </label><br>
                                        <span id="errorimport_file" style="color:red;"></span>
                                    </div>
                                </div>
                                <div class="form-actions center">
                                    <button type="submit" id="btn_import" class="btn btn-info">
                                        <i class="la la-check-square-o"></i> Import
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="panel panel-primary" id="panel5">
                        <div class="panel-heading">
                            <h4 class="panel-title text-white">Add New Member </h4>
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #b2b7bb;">
                            <form name="frm_credit" id="frm_credit" method="POST" action="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-large">Select Member Type :</label>
                                            <select class="form-control" id="member_type_manualy" name="member_type">
                                                <option value="">Select Member Type</option>
                                                <option value="full_conference_with_roundtables">Import for Full Conference - with roundtables</option>
                                                <option value="full_conference_no_roundtables">Import for Full Conference - no roundtables</option>
                                                <option value="expo_only">Expo Only</option>
                                            </select>
                                            <span id="errormember_type_manualy" style="color:red;"></span>
                                        </div>
                                        <div class="form-group" id="email_section">
                                            <label class="text-large">Email:</label>
                                            <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                                        </div>
                                        <div class="form-group" id="username_section">
                                            <label class="text-large">Username:</label>
                                            <input type="text" name="username" id="username" placeholder="Username" class="form-control">
                                            <input type="hidden" name="cust_id" id="cust_id" value="0">
                                            <input type="hidden" name="cr_type" id="cr_type" value="save">
                                        </div>
                                        <div class="form-group" id="password_section">
                                            <label class="text-large">Password:</label>
                                            <input type="text" name="password" id="password" placeholder="Password" class="form-control">
                                        </div>
                                        <h5 class="over-title margin-bottom-15">
                                            <button type="button" id="save_btn" name="save_btn" class="btn btn-green add-row">
                                                Submit
                                            </button>
                                        </h5>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="panel panel-primary" id="panel5">
                    <div class="panel-heading">
                        <h4 class="panel-title text-white">User Data</h4>
                    </div>
                    <div class="panel-body bg-white" style="border: 1px solid #b2b7bb!important;">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered table-striped text-center" id="user">
                                    <thead class="th_center">
                                        <tr>
                                            <th>Date</th>
                                            <th>User ID</th>
                                            <th>Register ID</th>
                                            <th>Profile</th>
                                            <th>Full Name</th>
                                            <th>Phone No.</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Address</th>
                                            <th>Address Type</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Country</th>
                                            <th>Website</th>
                                            <th>Members</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($user) && !empty($user)) {
                                            foreach ($user as $val) {
                                                ?>
                                                <tr>
                                                    <td><?= date("Y-m-d", strtotime($val->register_date)) ?></td>
                                                    <td><?= $val->user_id ?></td>
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
                                                    <td><?= $val->username ?></td>
                                                    <td><?= base64_decode($val->password) ?></td>
                                                    <td><?= $val->address ?></td>
                                                    <td><?= $val->address_cont ?></td>
                                                    <td><?= $val->city ?></td>
                                                    <td><?= $val->state ?></td>
                                                    <td><?= $val->country ?></td>
                                                    <td><?= $val->website ?></td>
                                                    <td><?= $val->member_status ?></td> 
                                                    <td>
                                                        <a class="btn btn-danger btn-sm delete_presenter" href="<?= base_url() . 'admin/user/deleteuser/' . $val->cust_id ?>">
                                                            <i class="fa fa-trash-o"></i> Delete
                                                        </a>
                                                        <a class="btn btn-primary btn-sm" href="<?= base_url() . 'admin/user/user_activity/' . $val->cust_id ?>">
                                                            Activity
                                                        </a>
                                                        <?php if ($val->v_card != "") { ?>
                                                            <a download class="btn btn-info btn-sm" href="<?= base_url() . 'uploads/upload_vcard/' . $val->v_card ?>">
                                                                vCard
                                                            </a>
                                                        <?php } else { ?>
                                                            <a class="btn btn-info btn-sm" href="<?= base_url() . 'admin/exportvcard/' . $val->cust_id ?>">
                                                                vCard
                                                            </a>
                                                        <?php } ?>

                                                        <?php if ($val->member_status == "non-member") { ?>
                                                            <a class="btn btn-primary btn-sm edit_user" data-id="<?= $val->cust_id ?>" href="#">
                                                                <i class="fa fa-pencil"></i> Edit
                                                            </a>
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
        $("#btn_import").on("click", function () {
            if ($('#member_type').val() == '') {
                alertify.error('Select Import Member Type');
                return false;
            } else if ($('#import_file').val() == '') {
                alertify.error('Select File');
                return false;
            } else {
                return true; //submit form
            }
            return false; //Prevent form to submitting
        });


        $('#save_btn').click(function () {
            if ($('#cr_type').val() == "save") {
                if ($('#member_type_manualy').val() == '') {
                    alertify.error('Select Import Member Type');
                    return false;
                } else if ($('#email').val() == '') {
                    alertify.error('Please Enter Email');
                    return false;
                } else if ($('#username').val() == '') {
                    alertify.error('Please Enter Username');
                    return false;
                } else if ($('#password').val() == '') {
                    alertify.error('Please Enter Password');
                    return false;
                } else {
                    $('#frm_credit').attr('action', '<?= base_url() ?>admin/user/add_user_with_type');
                    $('#frm_credit').submit();
                    return true;
                }
            } else if ($('#cr_type').val() == "update") {
                if ($('#member_type_manualy').val() == '') {
                    alertify.error('Select Import Member Type');
                    return false;
                } else {
                    $('#frm_credit').attr('action', '<?= base_url() ?>admin/user/add_user_with_type');
                    $('#frm_credit').submit();
                    return true;
                }
            }
        });


        $(document).on("click", ".edit_user", function () {
            var cr_id = $(this).attr('data-id');
            if (cr_id != '') {
                $.ajax({
                    url: "<?= base_url() ?>admin/user/getUserById/" + cr_id,
                    type: "post",
                    success: function (response) {
                        cr_data = JSON.parse(response);
                        if (cr_data.msg == "success")
                        {
                            $("#email_section").hide();
                            $("#username_section").hide();
                            $("#password_section").hide();
                            $('#member_type_manualy').val(cr_data.data.customer_type);
                            $('#cust_id').val(cr_data.data.cust_id);
                            $('#cr_type').val('update');
                        } else {
                            alertify.error('Something went wrong, Please try again!');
                            window.setTimeout('location.reload()', 3000);
                        }
                    }
                });
            } else {
                alertify.error('Something went wrong, Please try again!');
                window.setTimeout('location.reload()', 3000);
            }
        });


    });
</script>








