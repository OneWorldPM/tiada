<style>
    .red-star{
        color: #ff3c2d;
        font-size: 20px;
    }
</style>
<div class="main-content">
    <div class="wrap-content container" id="container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
            <div class="row">
                <div class="col-sm-8">
                    <h1 class="mainTitle">Add Sponsors</h1>
                </div>
            </div>
        </section>
        <!-- end: PAGE TITLE -->
        <!-- start: DYNAMIC TABLE -->
        <div class="container-fluid container-fullw">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-primary" id="panel5">
                        <div class="panel-heading">
                            <h4 class="panel-title text-white pull-left">Add New Sponsors</h4>
                            <button class="add-new-admin-btn btn btn-info pull-right" <?= (isset($sponsors_edit)) ? "" : "disabled" ?>><i class="fa fa-user-plus" aria-hidden="true"></i> Add New Admin</button>
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #b2b7bb!important;">
                            <div class="col-md-12">
                                <form name="add_sponsors_frm" id="add_sponsors_frm" action="<?= isset($sponsors_edit) ? base_url() . "admin/sponsors/updateSponsors" : base_url() . "admin/sponsors/createSponsors" ?>" method="POST" enctype="multipart/form-data">
                                    <?php if (isset($sponsors_edit)) { ?>
                                        <input type="hidden" name="sponsors_id" value="<?= $sponsors_edit->sponsors_id ?>">
                                    <?php } ?>
                                    <div class="form-group">
                                        <label class="text-large">Company Name</label><i class="red-star">*</i>
                                        <input type="text" name="company_name" id="company_name" value="<?= (isset($sponsors_edit) && !empty($sponsors_edit) ) ? $sponsors_edit->company_name : "" ?>" class="form-control">
                                    </div>
                                    <div class="row">
                                        <label class="col-md-12 text-large">Sponsors Type</label>
                                        <div class="form-group col-md-3" style="color: #000;">
                                            <input type="radio" style="margin: 5px 0 0" class="col-md-3"  name="sponsors_type" <?= (isset($sponsors_edit) && !empty($sponsors_edit)) ? ($sponsors_edit->sponsors_type == "platinum") ? 'checked' : '' : '' ?> id="sponsors_type" value="platinum"><label class="text-large">Platinum</label>
                                        </div>
                                        <div class="form-group col-md-3" style="color: #000;">
                                            <input type="radio" style="margin: 5px 0 0" class="col-md-3"  name="sponsors_type" <?= (isset($sponsors_edit) && !empty($sponsors_edit)) ? ($sponsors_edit->sponsors_type == "gold") ? 'checked' : '' : '' ?> id="sponsors_type" value="gold"><label class="text-large">Gold</label>
                                        </div>
                                        <div class="form-group col-md-3" style="color: #000;">
                                            <input type="radio" style="margin: 5px 0 0" class="col-md-3"  name="sponsors_type" <?= (isset($sponsors_edit) && !empty($sponsors_edit)) ? ($sponsors_edit->sponsors_type == "silver") ? 'checked' : '' : '' ?> id="sponsors_type" value="silver"><label class="text-large">Silver</label>
                                        </div>
                                        <div class="form-group col-md-3" style="color: #000;">
                                            <input type="radio" style="margin: 5px 0 0" class="col-md-3"  name="sponsors_type" <?= (isset($sponsors_edit) && !empty($sponsors_edit)) ? ($sponsors_edit->sponsors_type == "bronze") ? 'checked' : '' : '' ?> id="sponsors_type" value="bronze"><label class="text-large">Bronze</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-large">Email</label><i class="red-star">*</i>
                                        <input type="text" name="email" id="email" value="<?= (isset($sponsors_edit) && !empty($sponsors_edit) ) ? $sponsors_edit->email : "" ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-large">Password</label><i class="red-star">*</i>
                                        <input type="text" name="password" id="password" value="<?= (isset($sponsors_edit) && !empty($sponsors_edit) ) ? $sponsors_edit->password : "" ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-large">Embed HTML Code</label>
                                        <textarea class="form-control" style="color: #000;" name="embed_code" id="embed_code"><?= (isset($sponsors_edit) && !empty($sponsors_edit) ) ? $sponsors_edit->embed_code : "" ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-large">Website</label>
                                        <input type="text" name="website" id="website" value="<?= (isset($sponsors_edit) && !empty($sponsors_edit) ) ? $sponsors_edit->website : "" ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-large">Twitter ID</label>
                                        <input type="text" name="twitter_id" id="twitter_id" value="<?= (isset($sponsors_edit) && !empty($sponsors_edit) ) ? $sponsors_edit->twitter_id : "" ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-large">Facebook ID</label>
                                        <input type="text" name="facebook_id" id="facebook_id" value="<?= (isset($sponsors_edit) && !empty($sponsors_edit) ) ? $sponsors_edit->facebook_id : "" ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-large">LinkedIn ID</label>
                                        <input type="text" name="linkedin_id" id="linkedin_id" value="<?= (isset($sponsors_edit) && !empty($sponsors_edit) ) ? $sponsors_edit->linkedin_id : "" ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-large">Sponsors Logo</label>
                                        <input type="file" class="form-control" name="sponsors_logo" id="sponsors_logo">
                                        <?php
                                        if (isset($sponsors_edit)) {
                                            if ($sponsors_edit->sponsors_logo != "") {
                                                ?>
                                                <img src="<?= base_url() ?>uploads/sponsors/<?= $sponsors_edit->sponsors_logo ?>" style="height: 100px; width: 100px;">
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-large">Sponsor Cover</label>
                                        <input type="file" class="form-control" name="sponsor_cover" id="sponsor_cover">
                                        <?php
                                        if (isset($sponsors_edit)) {
                                            if ($sponsors_edit->sponsor_cover != "") {
                                                ?>
                                                <img src="<?= base_url() ?>uploads/sponsors/<?= $sponsors_edit->sponsor_cover ?>?v=<?= rand(1, 100) ?>" style="height: 75px; width: 200px;">
                                                <?php
                                            } else {
                                                echo '<img src="' . base_url() . 'uploads/sponsors/tiada_default_cover.jpg" style="height: 75px; width: 200px;">';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="row" >
                                        <label class="col-md-12 text-large">Select Sponsors Category</label>
                                        <?php
                                        if (isset($sponsors_category) && !empty($sponsors_category)) {
                                            foreach ($sponsors_category as $val) {
                                                if ($val->sponsors_category_id != 2 && $val->sponsors_category_id != 5 && $val->sponsors_category_id != 11 && $val->sponsors_category_id != 12 && $val->sponsors_category_id != 14 && $val->sponsors_category_id != 16 && $val->sponsors_category_id != 21 && $val->sponsors_category_id != 22) {
                                                    ?>
                                                    <div class="form-group col-md-6" style="color: #000;">
                                                        <input type="checkbox" class="col-md-1"  name="sponsors_category[]" <?= (isset($sponsors_edit) && !empty($sponsors_edit)) ? in_array($val->sponsors_category_id, explode(",", $sponsors_edit->sponsors_category_id)) ? 'checked' : '' : '' ?> id="sponsors_category" value="<?= $val->sponsors_category_id ?>"> <?= $val->category_name ?><br>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <h5 class="over-title margin-bottom-15" style="text-align: center;">
                                        <button type="submit" id="btn_sponsors" name="btn_sponsors" class="btn btn-green add-row">Submit</button>
                                    </h5>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">Additional Admins</h4>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($extra_admins) && $extra_admins != '') {
                                        foreach ($extra_admins as $admin) {
                                            echo "
                                        <tr>
                                         <th>{$admin['id']}</th>
                                         <td>{$admin['name']}</td>
                                         <td>{$admin['email']}</td>
                                         <td>{$admin['password']}</td>
                                         <td><button class='btn btn-danger btn-small delete-admin-btn' admin-id='{$admin['id']}'>Delete</button></td>
                                        </tr>
                                        ";
                                        }
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div id="addNewAdminModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group" style="margin-bottom: 10px;">
                    <span class="input-group-addon" id="newAdminName">Name</span>
                    <input type="text" class="form-control new-admin-name" aria-describedby="newAdminName">
                </div>
                <div class="clearfix"></div>
                <div class="input-group" style="margin-bottom: 10px;">
                    <span class="input-group-addon" id="newAdminEmail">Email</span>
                    <input type="text" class="form-control new-admin-email" aria-describedby="newAdminEmail">
                </div>
                <div class="clearfix"></div>
                <div class="input-group">
                    <span class="input-group-addon" id="newAdminPassword">Password</span>
                    <input type="text" class="form-control new-admin-password" aria-describedby="newAdminPassword">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary add-admin-btn">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#btn_sponsors").on("click", function ()
        {
            if ($("#company_name").val() == "")
            {
                alertify.error("Enter Company Name");
                return false;
            } else if ($("#email").val() == "") {
                alertify.error("Email is required!");
                return false;
            } else if ($("#password").val() == "") {
                alertify.error("Password is required!");
                return false;
            } else {
                return true;
            }
            return false;
        });


        $('.add-new-admin-btn').on('click', function () {
            $('#addNewAdminModal').modal('show');
        });

        $('.add-admin-btn').on('click', function () {
            var email = $('.new-admin-email').val();
            var password = $('.new-admin-password').val();
            var name = $('.new-admin-name').val();
            var sponsor_id = '<?= $sponsors_edit->sponsors_id ?>';

            if (email != '' || password != '' || name != '')
            {
                $.post("/tiadaannualconference/admin/Sponsors/addNewSponsorAdminUser",
                        {
                            'name': name,
                            'email': email,
                            'password': password,
                            'sponsor_id': sponsor_id
                        },
                function (data, status) {
                    if (status == 'success')
                    {
                        if (data == true) {
                            $('#addNewAdminModal').modal('hide');
                            alertify.success("New admin added!");
                            location.reload();
                        } else {
                            alertify.error("Network problem!");
                        }

                    } else {
                        alertify.error("Network problem!");
                    }
                });
            } else {
                alertify.error("All the fields are mandatory!");
            }
        });


        $('.delete-admin-btn').on('click', function () {
            var adminId = $(this).attr('admin-id');

            $.post("/tiadaannualconference/admin/Sponsors/deleteSponsorAdminUser",
                    {
                        'adminId': adminId
                    },
            function (data, status) {
                if (status == 'success')
                {
                    alertify.success("Admin deleted!");
                    location.reload();

                } else {
                    alertify.error("Network problem!");
                }
            });

        });

    });
</script>
