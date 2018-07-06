

<!-- <div class="row">
   <div class="col-md-12">
      <div class="x_panel">
         <div class="x_title">
            <h2 class="block">Selamat Datang, <?php echo $this->active_user; ?>! </h2>
            <div class="filter">
               <div id="reportrange" class="pull-right">
                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                  <span><?php echo date("l , d M Y") ?></span> 
               </div>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="demo-container" style="height:50px">
                  <ul>
                     <li>Selamat datang.</li>
                     <li>Untuk informasi atau pertanyaan lebih lanjut, silahkan hubungi Administrator </a>.</li>
                  </ul>
                  </br>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> -->
   <!-- <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Weekly Summary <small>Activity shares</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                       
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                      <div class="col-md-6" style="overflow:hidden; height: 20em;" id="tes">
                        
                      
                      </div>
                      <div class="col-md-6" style="overflow:hidden; height: 20em;" id="tes2">
                        
                      
                      </div>

                      
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
<div class="row">
  <!--  <div class="col-md-2">
       <button id="compose" class="btn btn-sm btn-success btn-block" type="button">CREATE NOTE</button>
   </div> -->
    <div class="col-md-3">
       <a href="<?php echo base_url('data_issue/add')?>" class="btn btn-lg btn-success btn-block" >CREATE TICKET</a>
   </div>
  <!--  <div class="col-md-12">

      <div class="x_panel">
         <div class="x_title">
            <h2>Make Note</h2>
            <ul class="panel_toolbox">
               <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </ul>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <form class="span12" id="postForm" action="<?php echo base_url('dashboard/add_note2')?>"  method="POST" enctype="multipart/form-data" onsubmit="return postForm()">
               <fieldset>
                  <p class="container">
                     <textarea class="input-block-level" id="summernote" name="text" rows="18">
                     </textarea>
                  </p>
               </fieldset>
               <button type="submit" class="btn btn-primary">Save</button>
            </form>
         </div>
      </div>
   </div> -->
</div>



<div class="row">
   <?php 
      $notif_vendor = get_notif_vendor();
      $notif_issue = get_notif_issue(); 
      $notif_user = get_notif_user(); 
      
      
      ?>
   <?php if($notif_vendor > 0){?>
   <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="tile-stats">
         <div class="icon"><i class="fa fa-database"></i></div>
         <div class="count"><?php echo $notif_vendor;?></div>
         <h3>Kontrak Vendor Baru</h3>
         <p><a href="<?php echo base_url('reminder_vendor');?>">pergi ke halaman reminder vendor</a></p>
      </div>
   </div>
   <?php } ?>
   <?php if($notif_issue > 0){?>
   <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="tile-stats">
         <div class="icon"><i class="fa fa-warning"></i></div>
         <div class="count"><?php echo $notif_issue;?></div>
         <h3>New Ticket</h3>
         <p><a href="<?php echo base_url('reminder_issue');?>">pergi ke halaman List Ticketing</a></p>
      </div>
   </div>
   <?php } ?>
   <?php if($notif_user > 0){?>
   <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="tile-stats">
         <div class="icon"><i class="fa fa-user"></i></div>
         <div class="count"><?php echo $notif_user;?></div>
         <h3>User Baru</h3>
         <p><a href="<?php echo base_url('pengajuan_user');?>">pergi ke halaman pengajuan user</a></p>
      </div>
   </div>
   <?php } ?>
</div>


  <!-- <div class="row">
      <?php foreach ($shift as $shift) { ?>
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="x_panel"  style="height: 16em;overflow-y:scroll;">
            <div class="x_title">
               <h2>Note <small><?php echo $shift->updatedate; ?> by <?php echo $shift->user_nama; ?></small></h2>
               <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="click2edit<?php echo $shift->text_id;?>" name="text" data-id="<?php echo $shift->text_id;?>" >
                  <?php echo $shift->text; ?>
               </div>
               <div class="col-sm-7">
               <button id="edit<?php echo $shift->text_id;?>" class="col-sm-3 btn btn-xs btn-primary" onclick="edit(<?php echo $shift->text_id;?>)" type="button" style="display:block;">Edit</button>
               <button id="save<?php echo $shift->text_id;?>" class="col-sm-3 btn btn-xs btn-primary" onclick="save(<?php echo $shift->text_id;?>)" type="button" style="display:none;">Save</button>
               <a class="col-sm-4 btn btn-xs btn-danger" href="<?php echo base_url($this->cname.'/delete_note/'.$shift->text_id)?>" type="button">Delete </a>
               </div>
            </div>
         </div>
      </div>
      <?php
         }?>
   </div>
   <div class="row">
      <div class="col-md-6"><?php 
         echo $this->pagination->create_links();
         ?>
      </div>
   </div> -->
   </div>
   <!-- compose -->
   <!--  <div class="compose col-md-6 col-xs-12">
      <div class="compose-header">
        Make note
        <button type="button" class="close compose-close">
          <span>×</span>
        </button>
      </div>

      <div class="compose-body">
        
       
            <form class="span12" id="postForm" action="<?php echo base_url('dashboard/add_note2')?>"  method="POST" enctype="multipart/form-data" onsubmit="return postForm()">
               <fieldset>
                  <p class="container">
                     <textarea class="input-block-level" id="summernotes" name="text" rows="6" style="width:100%" required="required"></textarea>
                  </p>
               </fieldset>
               <button type="submit" class="btn btn-primary">Save</button>
            </form>
   
       
     
     
    </div>
 </div> -->
    <!-- /compose -->