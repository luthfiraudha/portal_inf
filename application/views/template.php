<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/favicon.ico" /> 

        <?php
        if ($title != NULL)
            echo "<title>".$title." | PORTAL INF</title>";
        else
            echo "<title>PORTAL INF</title>";
        ?>

        <?php $this->load->view('template/top_resource'); ?>
    </head>
<div id="loader-wrapper">
            <div id="loader"></div>

            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

        </div>

    <body class="nav-md" id="content">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="">
                            <a href="<?php echo base_url('dashboard');?>" class="site_title"><i class="fa fa-building-o"></i> <span>PORTAL INF</span></a>
                        </div>

                        <div class="clearfix"></div>



                        <br />

                        <!-- sidebar menu -->
                        <?php $this->load->view('template/sidebar'); ?>
                        <!-- /sidebar menu -->


                    </div>
                </div>

                <!-- top navigation -->
                <?php $this->load->view('template/topbar'); ?>
                <!-- /top navigation -->

                <!-- page content -->
                
                
                
                <div class="right_col" role="main" >


                    <?php $this->load->view('content/' . $content); ?>
                   
                    

               
                </div>
                
                <!-- /page content -->



                <!-- footer content -->
                 <?php $this->load->view('template/footbar'); ?>
               
                <?php $this->load->view('template/modal'); ?>

                <!-- /footer content -->
            </div>
        </div>

        <!-- BEGIN BOTTOM RESOURCE -->
        <?php $this->load->view('template/bottom_resource'); ?>

        <!-- END BOTTOM RESOURCE -->
    </body>
</html>
