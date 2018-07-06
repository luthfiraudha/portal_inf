<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
                        <form method="post" action="<?php base_url('register/do_register') ?>" id="register">
                            <h1>Register</h1>
                            <div>
                                <input type="text" name="pn" class="form-control" placeholder="Personal Number" required="" id="pn" />
                              
                                    <span class="pn_err" ></span>
                               
                            </div>
                            <div>
                                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                            </div>
                            <div>
                                <input type="text" name="nama" class="form-control" placeholder="Nama" required="" />

                            </div>
                            <div>
                                <input type="text" name="nohp" class="form-control numeric" placeholder="Nomor Handphone" required="" />

                            </div>
                           
                              
                              <div >
                                 <select class="form-control" name="user_type">
                                    
                                        <option value="-">-----pilih jabatan-----</option>
                                       <?php
                                          foreach ($jabatan as $kategori) {
                                              if($kategori->nama != 'admin'){
                                              ?>

                                       <option value="<?php echo $kategori->id; ?>"><?php echo ucfirst($kategori->nama); ?></option>
                                       <?php
                                   }
                                          }
                                          ?>
                                 </select>
                              </div>
                           </br>
                            <!--<div>
                                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                            </div> -->
                            <div>
                                <div style="padding-left: 6em;">
                                    <input type="submit" style="width: 8em;" value="Register" class="btn btn-large btn-primary submit" id="submit" />
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Already a member ?
                                    <a href="<?php echo base_url('auth');?>" class="to_register"> Sign in </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />
                           
                                <div>
                                    <h1>Portal OSD</h1>
                                    <p>©2017 All Rights Reserved. Divisi OSD 1. PT Bank Rakyat Indonesia.</p>
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
        
$(document).ready(function () {



        $('body').on('keydown', '.numeric', function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 13]) !== -1 ||
                // Allow: Ctrl+A
                        (e.keyCode == 65 && e.ctrlKey === true) ||
                        // Allow: home, end, left, right
                                (e.keyCode >= 35 && e.keyCode <= 39) ||
                                // Allow : numelock number
                                        (e.keyCode >= 96 && e.keyCode <= 105)) {
                            // let it happen, don't do anything
                            return;
                        }
                        if (e.which < 48 || e.which > 57)
                            return false;
                        return true;
                    });
            $('body').on('keydown', '.numericDot', function (e) {
                // alert(e.keyCode);
                if ($.inArray(e.keyCode, [46, 8, 9, 13, 190]) !== -1 ||
                        // Allow: Ctrl+A
                                (e.keyCode == 65 && e.ctrlKey === true) ||
                                // Allow: home, end, left, right
                                        (e.keyCode >= 35 && e.keyCode <= 39) ||
                                        // Allow : numelock number
                                                (e.keyCode >= 96 && e.keyCode <= 105)) {
                                    // let it happen, don't do anything
                                    return;
                                }
                                if (e.which < 48 || e.which > 57)
                                    return false;
                                return true;
                            });
                    //Change hash for page-reload
                    $('.nav-tabs a').on('shown.bs.tab', function (e) {
                        if (history.pushState) {
                            history.pushState(null, null, e.target.hash);
                        } else {
                            window.location.hash = e.target.hash; //Polyfill for old browsers
                        }
                    });
                    });
</script>


    </script>
</html>
