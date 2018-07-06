<style type="text/css">
   .blink {
  /* -webkit-animation-name: blinker;
   -webkit-animation-duration: 1s;
   -webkit-animation-timing-function: linear;
   -webkit-animation-iteration-count: infinite;
   -moz-animation-name: blinker;
   -moz-animation-duration: 1s;
   -moz-animation-timing-function: linear;
   -moz-animation-iteration-count: infinite;
   animation-name: blinker;
   animation-duration: 1s;
   animation-timing-function: linear;
   animation-iteration-count: infinite;
   }
   @-moz-keyframes blinker {  
   0% { opacity: 1.0; }
   50% { opacity: 0.0; }
   100% { opacity: 1.0; }
   }
   @-webkit-keyframes blinker {  
   0% { opacity: 1.0; }
   50% { opacity: 0.0; }
   100% { opacity: 1.0; }
   }
   @keyframes blinker {  
   0% { opacity: 1.0; }
   50% { opacity: 0.0; }
   100% { opacity: 1.0; }*/
   }
</style>
<script type="text/javascript">
   // function blinker() {
   //   $('.blink_me').fadeOut(500);
   //   $('.blink_me').fadeIn(500);
   // }
   
   // setInterval(blinker, 1000);
</script>

<div class="row">
   <?php cetak_flash_msg();?>
   <?php if (!empty($alert['message'])) {?>
   <div style="margin-top: 10em"> class="alert alert-<?php echo $alert['class'];?> alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
      <?php echo $alert['message'];?>
   </div>
   <?php }
      ?>
</div>
<div class="page-title">
  <!--  <div class="title_left">
     <h1>SELAMAT DATANG DI PORTAL INF</h1>
      
   </div> -->
  <!--  <div class="title_right">
      <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
         <form method="POST" action="<?php echo base_url($this->cname."/cari")?>">
            <div class="input-group">
               <input type="text" name="cari" class="form-control" placeholder="Search for...">
               <span class="input-group-btn">
               <button type="submit" class="btn btn-default" type="button">Go!</button>
               </span>
            </div>
         </form>
      </div>
   </div> -->
</div>
<div class="clearfix"></div>
 <!-- top tiles -->
 <!-- <div class="row tile_count">
   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-user"></i> Total User Login</span>
     <div class="count"><a class="green"><?php //foreach($totaluser as $k){ echo number_format((float)$k->total, 0, '.', ',');}?> </a></div>
     <span class="count_bottom"> </i> in one hours</span>
   </div>
   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-clock-o"></i>  Respontime Average</span>
     <div class="count"><a class="green"><?php //foreach($averageTime as $k){ echo number_format((float)$k->AverageTime, 2, '.', '');}?> </a></div>
     <span class="count_bottom"> </i> hours/ticket</span>
   </div>
   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-wrench"></i> Vendor Active</span>
     <div class="count"><a class="green"><?php //foreach($totalvendor as $k){ echo number_format((float)$k->totalvendor, 0, '.', ',');}?> </a></div>
     <span class="count_bottom"> </i> still ongoing</span>
   </div>
   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-question"></i> How To</span>
     <div class="count"><a class="green"><?php //foreach($totalsop as $k){ echo number_format((float)$k->totalsop, 0, '.', ',');}?> </a></div>
     <span class="count_bottom"> </i> stored data</span>
   </div>
   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-terminal"></i> Problem / Request</span>
     <div class="count"><a class="green"><?php //foreach($totalprob as $k){ echo number_format((float)$k->totalprob, 0, '.', ',');}?> </a></div>
     <span class="count_bottom"> </i> have been completed</span>
   </div>
   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-tags"></i> Daily Activity</span>
     <div class="count"><a class="green"><?php //foreach($totaldai as $k){ echo number_format((float)$k->totaldai, 0, '.', ',');}?> </a></div>
     <span class="count_bottom"> </i> has done</span>
   </div>
 </div> -->
 <!-- /top tiles -->
 <div class="row">
 <!-- <div class="animated flipInY col-lg-12 col-md-12 col-sm-6 col-xs-12">
   <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron">
                      <h2><strong>Note update</strong></h2>
                      <p style="font-size: 16px">1. Untuk menu ticketing problem/request menggunakan button create ticket di dashboard.</p></br>
                      <p style="font-size: 16px">2. Untuk menu Ticket Daily Activity Yang merupakan task pekerjaan sehari-hari masuk ke menu Ticketing -> Daily Activity -> Create Daily Activity.</p>
                    </div>
                  </div>
</div> -->
   
 </div>

<div class="row">
<?php 
  
   
   
   ?>
  <div class="animated flipInY col-lg-8 col-md-8 col-sm-6 col-xs-12">
   <a style="display:block"  href="#">
      <div class="tile-stats bg-blue">
         <div class="icon blink" style="color: white"><i class="fa fa-user"></i></div>
         <div class="count blink" style="color: white">Selamat Datang</div>
         <h3 style="color: white" class="blink">di Aplikasi Portal INF</h3>
         <p>
   <a href="#" style="color: white" class="blink"><?php echo $this->active_user;?></a></p>
   </div>
   </a>
</div>
   


<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
   <a style="display:block"  ">
      <div class="tile-stats bg-orange">
         <div class="icon blink"  style="color: white"><i class="fa fa-file-zip-o"></i></div>
         <div class="count blink" style="color: white"><?php echo $count_kpi; ?></div>
         <h3 style="color: white" class="blink" >NILAI KPI</h3>
         <p>
  
   </div>
   </a>
</div>
   
  
</div>

</div>