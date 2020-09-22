<!-- SECTION -->
<section class="parallax fullscreen" style="background-image: url(<?= base_url() ?>front_assets/images/tiada.jpg); top: 0; padding-top: 0px;">
    <div class="container container-fullscreen">
        <div class="text-middle">
            <div class="row">
                <div class="col-md-4 center p-40 background-white" style="border-radius: 10px; margin-top: 60px;">
                    <div class="row">
                        <div class="col-md-12"> 
                            <h4>Welcome Back!</h4>
                            <p>Sign in Below</p>
                            <?php
                            echo ($this->session->flashdata('msg')) ? $this->session->flashdata('msg') : '';
                            ?> 
                            <form id="login-form" name="frm_login" method="post" action="<?= base_url() ?>guestlogin/authentication">
                                <div class="form-group">
                                    <label class="sr-only">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                    <span id="errorusername" style="color:red"></span>
                                </div>
                                <div class="form-group m-b-5">
                                    <label class="sr-only">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                    <span id="errorpassword" style="color:red"></span>
                                </div>
                              
                                <div class="text-left form-group">
                                    <button type="submit" id="btn_login" class="btn btn-primary">Login</button>
                                </div>
                                <!--<h4 style="margin-bottom: 0px;"><a href="https://www.txiada.org/login.asp?redirectURL=https://yourconference.live/tiadaannualconference/login/authenticate">Login with TIADA</a></h4>-->
                            </form>
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
            if ($("#username").val().trim() == "") {
                $("#errorusername").text("Please Enter Username").fadeIn('slow').fadeOut(5000);

                return false;
            } else if ($("#password").val() == "") {
                $("#errorpassword").text("Please Enter Password").fadeIn('slow').fadeOut(5000);
                return false;
            } else {
                return true; //submit form
            }
            return false; //Prevent form to submitting
        });
    });
</script>

