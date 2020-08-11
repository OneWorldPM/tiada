<!-- SECTION -->
<section class="parallax fullscreen" style="background-image: url(<?= base_url() ?>front_assets/images/tiada_new.jpeg); top: 0; padding-top: 0px;">
    <div class="container container-fullscreen">
        <div class="text-middle">
            <div class="row">
                <div class="col-md-3 col-md-offset-2 p-40 background-white" style="border-radius: 10px; margin-top: 60px;">
                    <div class="row">
                        <div class="col-md-12"> 
                            <h4>TIADA Members</h4>
                            <form id="tiada_login-form" name="tiada_frm_login" method="post" action="<?= base_url() ?>login/tiada_authentication">
                                <div class="form-group">
                                    <label class="sr-only">Username</label>
                                    <input type="text" class="form-control" id="tiada_email" name="tiada_email" placeholder="Username">
                                    <span id="errortiada_email" style="color:red"></span>
                                </div>
                                <div class="form-group m-b-5">
                                    <label class="sr-only">Password</label>
                                    <input type="password" id="tiada_password" name="tiada_password" class="form-control" placeholder="Password">
                                    <span id="errortiada_password" style="color:red"></span>
                                </div>
                                <div class="clearfix m-b-10"></div>
                                <div class="text-left form-group">
                                    <button type="submit" id="tiada_btn_login" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3  p-40 background-white" style="border-radius: 10px; margin-top: 60px; margin-left: 10px;">
                    <div class="row">
                        <div class="col-md-12"> 
                            <h4>Non Members</h4>
<!--                            <p>Sign in Below</p>-->
                            <?php
                            echo ($this->session->flashdata('msg')) ? $this->session->flashdata('msg') : '';
                            ?> 
                            <form id="login-form" name="frm_login" method="post" action="<?= base_url() ?>login/authentication">
                                <div class="form-group">
                                    <label class="sr-only">Username</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Username">
                                    <span id="erroremail" style="color:red"></span>
                                </div>
                                <div class="form-group m-b-5">
                                    <label class="sr-only">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                    <span id="errorpassword" style="color:red"></span>
                                </div>
                                <div class="form-group form-inline text-left ">
                                    <a href="<?= base_url() ?>forgotpassword" class="right"><small>Forgot Password?</small></a>
                                </div>
                                <div class="text-left form-group">
                                    <button type="submit" id="btn_login" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                            <!--                            <h4 style="margin-bottom: 0px;"><a href="https://www.txiada.org/login.asp?redirectURL=https://yourconference.live/tiadaannualconference/login/authenticate">Login with TIADA</a></h4>-->
                        </div>
                        <!--                        <div class="col-md-6">
                                                    <h4>Register Now!</h4>
                                                    <p class="text-left"><a href="<?= base_url() ?>register">Click here to start your registration</a> </p>
                                                </div>-->
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        $("#btn_login").on("click", function () {
            if ($("#email").val().trim() == "") {
                $("#erroremail").text("Please Enter Username").fadeIn('slow').fadeOut(5000);
                return false;
            } else if ($("#password").val() == "") {
                $("#errorpassword").text("Please Enter Password").fadeIn('slow').fadeOut(5000);
                return false;
            } else {
                return true; //submit form
            }
            return false; //Prevent form to submitting
        });

        $("#tiada_btn_login").on("click", function () {
            if ($("#tiada_email").val().trim() == "") {
                $("#errortiada_email").text("Please Enter Username").fadeIn('slow').fadeOut(5000);
                return false;
            } else if ($("#tiada_password").val() == "") {
                $("#errortiada_password").text("Please Enter Password").fadeIn('slow').fadeOut(5000);
                return false;
            } else {
                return true; //submit form
            }
            return false; //Prevent form to submitting
        });
    });
</script>

