<div class="main-content">
    <div class="wrap-content container" id="container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
            <div class="row">
                <div class="col-sm-8">
                    <h1 class="mainTitle">List Of Sessions</h1>
                </div>
            </div>
        </section>
        <!-- end: PAGE TITLE -->
        <!-- start: DYNAMIC TABLE -->
        <div class="container-fluid container-fullw">
            <div class="row">
                <div class="panel panel-primary" id="panel5">
                    <div class="panel-heading">
                        <h4 class="panel-title text-white">Sessions</h4>
                    </div>
                    <div class="panel-body bg-white" style="border: 1px solid #b2b7bb!important;">
                        <h5 class="over-title margin-bottom-15">
                            <a href="<?= base_url() ?>admin/sessions/add_sessions" class="btn btn-green add-row">
                                Add Sessions  &nbsp;<i class="fa fa-plus"></i>
                            </a>
                        </h5>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered table-striped text-center " id="sessions_table">
                                    <thead class="th_center">
                                        <tr>
                                            <th>Date</th>
                                            <th>Photo</th>
                                            <th>Title</th>
                                            <th>Session Type</th>
                                            <th>Type</th>
                                            <th>Presenter</th>
                                            <th>Time Slot</th>
                                            <th colspan="3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($sessions) && !empty($sessions)) {
                                            foreach ($sessions as $val) {
                                                ?>
                                                <tr>
                                                    <td style="white-space: pre;"><?= date("Y-m-d", strtotime($val->sessions_date)) ?></td>
                                                    <td>
                                                        <?php if ($val->sessions_photo != "") { ?>
                                                            <img src="<?= base_url() ?>uploads/sessions/<?= $val->sessions_photo ?>" style="height: 40px; width: 40px;">
                                                        <?php } else { ?>
                                                            <img src="<?= base_url() ?>front_assets/images/session_avtar.jpg" style="height: 40px; width: 40px;">
                                                        <?php } ?>    
                                                    </td>
                                                    <td style="text-align: left;"><?= $val->session_title ?></td>
                                                     <td style="text-align: left;">
                                                      <?php
                                                        if (isset($val->session_type_details) && !empty($val->session_type_details)) {
                                                            foreach ($val->session_type_details as $value) {
                                                                echo $value->sessions_type . " <br>";
                                                            }
                                                        }
                                                        ?>
                                                     </td>
                                                      <td><?= $val->sessions_type_status ?></td>
                                                    <td style="text-align: left;">
                                                        <?php
                                                        if (isset($val->presenter) && !empty($val->presenter)) {
                                                            foreach ($val->presenter as $value) {
                                                                echo $value->presenter_name . " <br>";
                                                            }
                                                        }
                                                        ?>
                                                    </td>
<!--                                                    <td>
                                                        <?php
                                                        if (isset($val->presenter) && !empty($val->presenter)) {
                                                            foreach ($val->presenter as $value) {
                                                                echo $value->title . " <br>";
                                                            }
                                                        }
                                                        ?>
                                                    </td>-->
                                                    <td style="white-space: pre; text-align: right;"><?= date("h:i A", strtotime($val->time_slot)) . ' - ' . date("h:i A", strtotime($val->end_time)) ?></td>
                                                    <td>
                                                        <a href="<?= base_url() ?>admin/sessions/view_session/<?= $val->sessions_id ?>" class="btn btn-info btn-sm" style="margin: 3px;">View Session</a>
                                                        <a href="<?= base_url() ?>admin/sessions/edit_sessions/<?= $val->sessions_id ?>" class="btn btn-green btn-sm" style="margin: 3px;">Edit</a>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url() ?>admin/sessions/create_poll/<?= $val->sessions_id ?>" class="btn btn-success btn-sm" style="margin: 3px;">Create Poll</a>
                                                        <a href="<?= base_url() ?>admin/sessions/view_poll/<?= $val->sessions_id ?>" class="btn btn-info btn-sm" style="margin: 3px;">View Poll</a>
                                                        <a href="<?= base_url() ?>admin/sessions/view_question_answer/<?= $val->sessions_id ?>" class="btn btn-primary btn-sm" style="margin: 3px;">View Q&A</a>
                                                        <a href="<?= base_url() ?>admin/sessions/report/<?= $val->sessions_id ?>" class="btn btn-grey btn-sm" style="margin: 3px;">Report</a>
                                                        <a href="<?= base_url() ?>admin/groupchat/sessions_groupchat/<?= $val->sessions_id ?>" class="btn btn-blue btn-sm" style="margin: 3px;">Create Chat</a>
                                                        <a href="<?= base_url() ?>admin/sessions/resource/<?= $val->sessions_id ?>" class="btn btn-success btn-sm" style="margin: 3px;">Resources</a>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url() ?>admin/sessions/delete_sessions/<?= $val->sessions_id ?>" class="btn btn-danger btn-sm" style="margin: 3px;">Delete Session</a>
                                                         <?php if($val->sessions_type_status == "Private") { ?>
                                                        <a href="<?= base_url() ?>admin/sessions/user_sign_up/<?= $val->sessions_id ?>" class="btn btn-grey btn-sm" style="margin: 3px;">Registrants</a>
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
<script type="text/javascript">
    $(document).ready(function () {
        $("#sessions_table").dataTable({
            "ordering": false,
        });
    });
</script>