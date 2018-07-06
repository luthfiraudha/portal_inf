<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="shortcut icon" href="<?php echo base_url();?>assets/favicon.ico" /> 


        <title>
            <?php
            if ($title)
                echo $title . ' | PORTALINF';
            else
                echo 'PORTALINF';
            ?>

        </title>

        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo base_url(); ?>/assets/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="<?php echo base_url(); ?>/assets/vendors/animate.css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo base_url(); ?>/assets/build/css/custom.min.css" rel="stylesheet">
    </head>

    <body class="login">
        <div>
<!--            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>-->

            <div class="login_wrapper">



                <div class="animate form login_form">
                    <?php echo cetak_flash_msg(); ?>
                    <?php if (!empty($alert['message'])) { ?>

                        <div class="alert alert-<?php echo $alert['class']; ?> alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <?php echo $alert['message']; ?>
                        </div>

                    <?php } ?>
                    <section class="login_content">
                      
                        <form method="post" action="<?php base_url('auth/login') ?>" id="login">
                            <h1>Sign In</h1>
                            <div>
                                <input type="text" id="ItemName" name="username" class="form-control" placeholder="Personal Number Or Email" required="" />
                            </div>
                            <div>
                                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div style="padding-left: 6em;">
                                <input type="submit" style="width: 8em;" value="login" class="btn btn-large btn-primary submit"/>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">New to site?
                                    <a href="<?php echo base_url('register');?>" class="to_register"> Register </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1>Portal INF</h1>
                                    <p>©2018 All Rights Reserved. Bagian INF - Divisi OPT. PT Bank Rakyat Indonesia.</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                
            </div>
        </div>
    </body>


    <!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- NProgress -->
<script src="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>


<script src="<?php echo base_url(); ?>assets/vendors/jquery-ui/jquery-ui.js"></script>


<!-- Custom Theme Scripts -->
<script src="<?php echo base_url(); ?>assets/build/js/custom.js"></script>

<script type="text/javascript">
    
    // $('#ItemName').keypress(function (e) {
    // var txt = String.fromCharCode(e.which);
    // if (!txt.match(/[A-Za-z0-9&.]/)) {
    //     return false;
    // }


    $(document).ready(function () {
    $("#ItemName").keydown(function (e) {

        var regex = new RegExp("^[a-zA-Z]+$");
        var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);

        console.log(e.keyCode); // check for backspace, delete etc. keyCodes you need

        if (e.keyCode != 8) { // e.g: backspace keyCode for Backspace on OS X
            if (!regex.test(key)) {
                e.preventDefault();
                return false;
            }
        }
    });
});
});
</script>>
   
</html>
