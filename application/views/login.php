<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view("_includes/header") ?>
</head>

<body>
    <div id="main-wrapper">
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background-image:url(<?php echo base_url('assets/images/bg-01.jpg') ?>);background-size: cover;background-position: center;">
            <div class="auth-box" style="margin:0">
                <div id="loginform">
                    <div class="logo" style="margin-top: 40px;">
                        <span class="db"><img src="<?php echo base_url('assets/images/company_logo.png') ?>" alt="logo" width=150 /></span>
                        <h5 class="font-medium mb-3">Log in</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <?php echo $this->session->flashdata('msg'); ?>
                            <form action="http://localhost/taskbgr/login" method="post" validate>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" placeholder="Email" name="email" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password" required>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 pb-3">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>