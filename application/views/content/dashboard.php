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
   <div class="title_left">
      <a style="width: 200px;" href="<?php echo base_url('data_issue/add')?>" class="btn btn-lg btn-success btn-block" >CREATE TICKET</a>
      
   </div>
   <div class="title_right">
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
   </div>
</div>
<div class="clearfix"></div>
 <!-- top tiles -->
 <div class="row tile_count">
   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-user"></i> Total User Login</span>
     <div class="count"><a class="green"><?php foreach($totaluser as $k){ echo number_format((float)$k->total, 0, '.', ',');}?> </a></div>
     <span class="count_bottom"> </i> in one hours</span>
   </div>
   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-clock-o"></i>  Respontime Average</span>
     <div class="count"><a class="green"><?php foreach($averageTime as $k){ echo number_format((float)$k->AverageTime, 2, '.', '');}?> </a></div>
     <span class="count_bottom"> </i> hours/ticket</span>
   </div>
   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-wrench"></i> Vendor Active</span>
     <div class="count"><a class="green"><?php foreach($totalvendor as $k){ echo number_format((float)$k->totalvendor, 0, '.', ',');}?> </a></div>
     <span class="count_bottom"> </i> still ongoing</span>
   </div>
   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-question"></i> How To</span>
     <div class="count"><a class="green"><?php foreach($totalsop as $k){ echo number_format((float)$k->totalsop, 0, '.', ',');}?> </a></div>
     <span class="count_bottom"> </i> stored data</span>
   </div>
   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-terminal"></i> Problem / Request</span>
     <div class="count"><a class="green"><?php foreach($totalprob as $k){ echo number_format((float)$k->totalprob, 0, '.', ',');}?> </a></div>
     <span class="count_bottom"> </i> have been completed</span>
   </div>
   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-tags"></i> Daily Activity</span>
     <div class="count"><a class="green"><?php foreach($totaldai as $k){ echo number_format((float)$k->totaldai, 0, '.', ',');}?> </a></div>
     <span class="count_bottom"> </i> has done</span>
   </div>
 </div>
 <!-- /top tiles -->
 <div class="row">
 <div class="animated flipInY col-lg-12 col-md-12 col-sm-6 col-xs-12">
   <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron">
                      <h2><strong>Note update</strong></h2>
                      <p style="font-size: 16px">1. Untuk menu ticketing problem/request menggunakan button create ticket di dashboard.</p></br>
                      <p style="font-size: 16px">2. Untuk menu Ticket Daily Activity Yang merupakan task pekerjaan sehari-hari masuk ke menu Ticketing -> Daily Activity -> Create Daily Activity.</p>
                    </div>
                  </div>
</div>
   
 </div>

<div class="row">
<?php 
   $notif_vendor = get_notif_vendor();
   $notif_issue = get_notif_issue(); 
   $notif_user = get_notif_user(); 
   
   
   ?>
   <?php
 if($this->active_privilege == 'superadmin' || $this->active_privilege == 'signer'){
 if($notif_user < 0){
   $notif_user = 0;
   }?>
<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
   <a style="display:block"  href="<?php echo base_url('pengajuan_user'); ?>">
      <div class="tile-stats bg-blue">
         <div class="icon blink" style="color: white"><i class="fa fa-user"></i></div>
         <div class="count blink" style="color: white"><?php echo $notif_user;?></div>
         <h3 style="color: white" class="blink">New User</h3>
         <p>
   <a href="#" style="color: white" class="blink">go to users activation page </a></p>
   </div>
   </a>
</div>
<?php if($notif_vendor < 0){
   $notif_vendor = 0;
   }?>
<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
   <a style="display:block"  href="<?php echo base_url('reminder_vendor');?>">
      <div class="tile-stats bg-orange">
         <div class="icon blink"  style="color: white"><i class="fa fa-file-zip-o"></i></div>
         <div class="count blink" style="color: white"><?php echo $notif_vendor;?></div>
         <h3 style="color: white" class="blink" >Check Contract</h3>
         <p>
   <a style="color: white" href="#" class="blink">go to reminder vendor page</a></p>
   </div>
   </a>
</div>
   <?php }else{ ?>
   <div class="animated flipInY col-lg-8 col-md-8 col-sm-6 col-xs-12">
   <a style="display:block"  href="#">
      <div class="tile-stats bg-blue">
         <div class="icon blink" style="color: white"><i class="fa fa-user"></i></div>
         <div class="count blink" style="color: white">Welcome,</div>
         <h3 style="color: white" class="blink"><?php echo $this->active_user;?></h3>
         <p>
   <a href="#" style="color: white" class="blink">always check request/problem ticket</a></p>
   </div>
   </a>
</div>
   <?php } ?>

<?php if($notif_issue < 0){ 
   $notif_issue = 0;
   }?>
<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
   <a style="display:block"  href="<?php echo base_url('reminder_issue');?>">
      <div class="tile-stats bg-green">
         <div class="icon blink" style="color: white" ><i class="fa fa-terminal"></i></div>
         <div class="count blink" style="color: white"><?php echo $notif_issue;?></div>
         <h3 style="color: white" class="blink">New Ticket</h3>
         <p>
   <a href="#" style="color: white" class="blink">go to list ticketing page</a></p>
   </div>
   </a>
</div>

</div>
<div class="row">
   <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Recent Activities</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <div class="dashboard-widget-content">
               <ul class="list-unstyled timeline widget">
                  <ul class="list-unstyled timeline widget">
                     <?php foreach ($daily as $daily) { ?>
                     <li>
                        <div class="block" >
                           <div class="block_content">
                              <h2 class="title">
                                 <a><?php echo $daily->id; ?> / <?php echo $daily->type; ?></a>
                              </h2>
                              <div class="byline">
                                 <span><?php echo $daily->tanggal; ?></span> by <a><?php echo $daily->user_nama; ?> </a>
                              </div>
                              <p class="excerpt"><?php 
                                 $string = strip_tags($daily->isi);
                                     if (strlen($string) > 140) {
                                      // truncate string
                                 $stringCut = substr($string, 0, 140);
                                 
                                  // make sure it ends in a word so assassinate doesn't become ass...
                                 $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
                                 }
                                 echo $string;
                                 ?>
                              </p>
                           </div>
                           <a title='Lihat' href=" <?php echo base_url('data_daily/action/view/' . $daily->id);?>" class='green'>view</i>
                           </a>
                        </div>
                     </li>
                     <?php
                        }
                        ?>
                  </ul>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-8 col-sm-8 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Task <small>by request and problem</small></h2>
            <ul class="nav navbar-right panel_toolbox">
               <li>
                  <form action="<?php echo base_url($this->cname).'/filter/';?>" method="post">
                     Filter:  
                     <select onchange="this.form.submit()" name="type">
                        <option value="empty">select</option>
                        <option value="Request">Request</option>
                        <option value="Problem">Problem</option>
                        <option value="">All</option>
                     </select>
                  </form>
               </li>
            </ul>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <div class="dashboard-widget-content">
               <ul class="list-unstyled timeline widget">
                  <?php foreach ($record as $record) { ?>
                  <li class="content"  style="display:block">
                     <div class="block" >
                        <div class="block_content">
                           <h2 class="title">
                              <a><?php echo $record->id; ?> / <?php echo $record->type; ?></a>
                           </h2>
                           <div class="byline">
                              <span><?php echo $record->tgl_input; ?></span> by <a><?php echo $record->user_nama; ?> | status :  <?php if($record->status!="selesai"){ echo "<a class='red'>belum selesai</a>";}else{echo "<a class='green'>selesai</a>";} ?> </a>
                           </div>
                           <p class="excerpt"><?php 
                              $string = strip_tags($record->isi);
                                  if (strlen($string) > 140) {
                                   // truncate string
                              $stringCut = substr($string, 0, 140);
                              
                               // make sure it ends in a word so assassinate doesn't become ass...
                              $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
                              }
                              echo $string;
                              ?>
                           </p>
                        </div>
                        <a title='Lihat' href=" <?php echo base_url('data_issue/action/view/' . $record->id);?>" class='green'>view</i>
                        </a>
                        <a title='Remove from dashboard' href=" <?php echo base_url('dashboard/unpin/' . $record->id);?>" class='red'>remove</i>
                        </a>
                     </div>
                  </li>
                  <?php
                     }?>
               </ul>
            </div>
            <?php 
               echo $this->pagination->create_links();
               ?>
         </div>
      </div>
   </div>
</div>