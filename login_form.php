<div class="login-main">
    <section class="ftco-section">
        <div class="container" data-settings="{&quot;can_previous&quot;:true,&quot;show_progress_bar&quot;:false,&quot;progress_bar_bottom&quot;:false,&quot;block_previous&quot;:false,&quot;any_tab&quot;:true,&quot;type&quot;:&quot;2&quot;,&quot;scroll&quot;:true,&quot;decimal_point&quot;:2,&quot;auto_progress&quot;:false,&quot;auto_progress_delay&quot;:&quot;1500&quot;,&quot;auto_submit&quot;:false,&quot;hidden_buttons&quot;:false,&quot;scroll_on_error&quot;:true}">

            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">

                        <div class="login-img d-flex align-items-center justify-content-center">
                            <img src="images/Logo-Image2.png" alt="" class="img-fluid">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4"><i title="" class=" ipticm prefix" data-ipt-icomoon="">
                                        </i>Sign In</h3>
                                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_blank_container" id="ipt_fsqm_form_56_design_8">
                                        <div class="ipt_uif_column_inner">
                                            <div class="ipt_uif_blank_container">
                                                <?php
                                                if ($ispost == true && sizeof($errors) > 0)
                                                    foreach ($errors as $error) {
                                                ?>
                                                    <div class="alert alert-danger">
                                                        <span><?php echo $error; ?></span>
                                                    </div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <form method="post" action="" id="login_form">
                                <div class="form-group mb-3">
                                    <label class="label lb" for="name">Username</label>
                                    <input type="email" class="form-control validate[required,custom[email]]" placeholder="Username" name="username " id="username" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label lb" for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="sign_in_button" id="sign_in_button" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                                </div>
                                <div class="form-group d-md-flex rmb">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="#">Forgot Password</a>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center">Not a member? <a data-toggle="tab" class="signUpBtn" href="registration.php">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>