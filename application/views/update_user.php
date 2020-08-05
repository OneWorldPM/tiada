<section class="parallax">
    <div class="container container-fullscreen">
        <div class="text-middle">
            <div class="row">
                <form id="frm_reg" name="frm_reg" method="post" action="<?= base_url() ?>register/update_user" enctype="multipart/form-data">
                    <div class="col-md-12 background-white" style="border-radius: 10px; padding: 0px 60px 20px 60px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-1 form-group">
                                    <img src="<?= base_url() ?>assets/images/Avatar.png" width="100%">
                                </div>
                                <div class="col-md-3 form-group" style="margin-top: 15px;">
                                    <label><?= (isset($myprofile)) ? $myprofile->first_name : ''; ?> <?= (isset($myprofile)) ? $myprofile->last_name : ''; ?> </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h5 style="padding-bottom: 4px; border-bottom: 2px solid #ebebeb">Registrant Profile</h5>
                            <small>Please fill in your registrant details:</small>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3 form-group">
                                    <input type="text" name="first_name" id="first_name"  value="<?= (isset($myprofile)) ? $myprofile->first_name : ''; ?>" placeholder="First Name" class="form-control input-lg">
                                    <span id="errorfirst_name" style="color:red"></span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" name="last_name" id="last_name" value="<?= (isset($myprofile)) ? $myprofile->last_name : ''; ?>" placeholder="Last Name" class="form-control input-lg">
                                    <span id="errorlast_name" style="color:red"></span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="email" name="email" id="email" value="<?= (isset($myprofile)) ? $myprofile->email : ''; ?>" placeholder="Email" class="form-control input-lg">
                                    <span id="erroremail" style="color:red"></span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" name="specialty" id="specialty" value="" placeholder="Specialty" class="form-control input-lg">
                                    <span id="errorspecialty" style="color:red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 m-t-20">
                            <h5 style="padding-bottom: 4px; border-bottom: 2px solid #ebebeb">Address</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3 form-group">
                                    <input type="text" value="" placeholder="Address" name="address" id="address" class="form-control input-lg">
                                    <span id="erroraddress" style="color:red"></span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" value="" placeholder="Address 2" name="address_2" id="address_2" class="form-control input-lg">
                                    <span id="erroraddress_2" style="color:red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3 form-group">
                                    <input type="text" value="" placeholder="City" name="city" id="city" class="form-control input-lg">
                                    <span id="errorcity" style="color:red"></span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" value="" placeholder="State" name="state" id="state" class="form-control input-lg">
                                    <span id="errorstate" style="color:red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <select id="country" name="country" class="form-control">
                                        <option value="" selected="">Country</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antartica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo">Congo, the Democratic Republic of the</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                                        <option value="Croatia">Croatia (Hrvatska)</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="East Timor">East Timor</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="France Metropolitan">France, Metropolitan</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                                        <option value="Holy See">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran (Islamic Republic of)</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                                        <option value="Korea">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macau">Macau</option>
                                        <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia">Micronesia, Federated States of</option>
                                        <option value="Moldova">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                                        <option value="Saint LUCIA">Saint LUCIA</option>
                                        <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia (Slovak Republic)</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                                        <option value="Span">Spain</option>
                                        <option value="SriLanka">Sri Lanka</option>
                                        <option value="St. Helena">St. Helena</option>
                                        <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syrian Arab Republic</option>
                                        <option value="Taiwan">Taiwan, Province of China</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Viet Nam</option>
                                        <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                        <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                                        <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Yugoslavia">Yugoslavia</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                    <span id="errorcountry" style="color:red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12  m-t-20">
                            <h5 style="padding-bottom: 4px; border-bottom: 2px solid #ebebeb">Profile</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <input type="file" id="profile" name="profile" class="form-control">
                                    <small class="form-text text-muted">Add a photo to personalize your account</small>
                                    <span id="errorprofile" style="color:red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12  m-t-20">
                            <h5 style="padding-bottom: 4px; border-bottom: 2px solid #ebebeb">Upload vCard</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <input type="file" id="upload_vcard" name="upload_vcard" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12  m-t-20">
                            <h5 style="padding-bottom: 4px; border-bottom: 2px solid #ebebeb">Social Accounts</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4 form-group">
                                    <div class="col-md-1">
                                        <i class="fa fa-twitter" style="font-size: 25px; margin-top: 8px;"></i>
                                    </div>
                                    <div class="col-md-11">
                                        <input type="text" value="" placeholder="Twitter" id="twitter" name="twitter" class="form-control input-lg">
                                        <span id="errortwitter" style="color:red"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4 form-group">
                                    <div class="col-md-1">
                                        <i class="fa fa-facebook" style="font-size: 25px; margin-top: 8px;"></i>
                                    </div>
                                    <div class="col-md-11">
                                        <input type="text" value="" placeholder="Facebook" id="facebook" name="facebook" class="form-control input-lg">
                                        <span id="errorfacebook" style="color:red"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4 form-group">
                                    <div class="col-md-1">
                                        <i class="fa fa-instagram" style="font-size: 25px; margin-top: 8px;"></i>
                                    </div>
                                    <div class="col-md-11">
                                        <input type="text" value="" placeholder="Instagram" id="instagram" name="instagram" class="form-control input-lg">
                                        <span id="errorinstagram" style="color:red"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12  m-t-20">
                            <h5 style="padding-bottom: 4px; border-bottom: 2px solid #ebebeb">Membership Details</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-12">
                                    <label class="custom-control custom-checkbox m-0">
                                        <input type="checkbox" name="terms" id="terms" class="custom-control-input">
                                        <span class="form-text text-muted">I am currently a member of this organization</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 m-t-20">
                                <div class="form-group col-md-12">
                                    <small class="form-text text-muted"><?php
                                        if (!empty($cms_details)) {
                                            echo $cms_details->description;
                                        }
                                        ?></small>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="cust_id" id="cust_id"  value="<?= (isset($myprofile)) ? $myprofile->cust_id : ''; ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12 form-group">
                                    <button class="btn btn-primary" id="update_user" type="submit">Submit</button>
                                    <button type="button" class="btn btn-danger m-l-10">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {

//        $('#terms').click(function () {
//            if ($(this).is(':checked')) {
//                $('#update_user').removeAttr('disabled');
//            } else {
//                $('#update_user').attr('disabled', 'disabled');
//            }
//        });

        $("#update_user").on("click", function () {
            if ($("#first_name").val().trim() == "")
            {
                $("#errorfirst_name").text("Enter First Name").fadeIn('slow').fadeOut(5000);
                return false;
            } else if ($("#last_name").val().trim() == "") {
                $("#errorlast_name").text("Enter Last Name").fadeIn('slow').fadeOut(5000);
                return false;
            } else if ($("#email").val().trim() == "") {
                $("#erroremail").text("Enter Email").fadeIn('slow').fadeOut(5000);
                return false;
            } else {
                return true; //submit form
            }
            return false; //Prevent form to submitting
        });
    });
</script>
