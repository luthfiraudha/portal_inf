<div class="row">
   <div class="col-md-12">
      <div class="x_panel">
         <div class="x_title">
            <h2><?php echo $this->menu; ?> | <small><?php echo $this->fitur; ?></small></h2>
            <div class="clearfix"></div>
         </div>
         <?php cetak_flash_msg(); ?>
         <?php if (!empty($alert['message'])) { ?>
         <div class="alert alert-<?php echo $alert['class']; ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <?php echo $alert['message']; ?>
         </div>
         <?php } ?>
         <?php if ($this->fitur != 'Lihat') { ?>
         <div class="alignleft" style="padding-left: 23%;">
            <!--                    <h4>Informasi</h4>
               <ul>
                   <li>Hak Akses tidak dapat dihapus.</li>
                   <li>Beberapa Hak Akses tidak dapat diubah.</li>
               </ul>-->
         </div>
         <?php } ?>
         <div class="x_content">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <?php if ($this->fitur == 'Lihat') { ?>
               <section class="panel">
                  <div class="panel-body">
                     <div class="col-md-9 col-sm-9 col-xs-12">
                        <?php if($issue_detail->status!="selesai"){?>
                        <h3 class="red">Nomor Ticket: <?php echo $issue_detail->id; ?></h3>
                        <?php }else{?>
                        <h3 class="green">Nomor Ticket: <?php echo $issue_detail->id; ?></h3>
                        <?php } ?>
                        <p><?php echo $issue_detail->isi; ?></p>
                        <br />
                        <div class="project_detail">
                           <p class="title">Type</p>
                           <?php if($issue_detail->status!="selesai"){?>
                           <p class="red"><?php echo $issue_detail->type; ?></p>
                           <?php }else{?>
                           <p class="green"><?php echo $issue_detail->type; ?></p>
                           <?php } ?>
                           <p class="title">Category</p>
                           <p><?php echo $issue_detail->kategori_nama; ?></p>
                           <p class="title">Post by</p>
                           <p> <?php echo $issue_detail->user_nama; ?></p>
                        </div>
                        <br />
                     </div>
                     <div class="col-md-3 col-sm-3 col-xs-12 right">
                        <h5>Details</h5>
                        <ul class="list-unstyled project_files">
                           <li><a ><i class="fa fa-clock-o"></i><?php echo $issue_detail->shift; ?></a>
                           </li>
                           <li><a ><i class="fa fa-calendar-o"></i> <?php echo $issue_detail->tgl_input; ?></a>
                           </li>
                           <li><?php if($issue_detail->status!="selesai"){?>
                              <a class="red"><i class="fa fa-flag-o"></i> <?php echo $issue_detail->status; ?></a>
                              <?php }else{?>
                              <a class="green"><i class="fa fa-flag-o"></i> <?php echo $issue_detail->status; ?></a>
                              <?php } ?>
                           </li>
                           <li><?php if($issue_detail->pinned!=0){?>
                              <a class="red"><i class="fa fa-tag"></i> pin to dashboard</a>
                              <?php }else{?>
                             
                              <?php } ?>
                           </li>
                        </ul>
                        <br />
                     </div>
                  </div>
               </section>
                 <a class="btn btn-sm bg-blue" href="#" onclick="history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</a>
                <?php }?>
              
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2><?php echo $this->menu; ?><small>Tindakan Lanjut</small></h2>
            <div class="clearfix"></div>
         </div>
         
         <div class="x_content">
            <div>
               <!--  <h4>Tindakan Lanjut</h4> -->
               <!-- end of user messages -->
               <ul class="messages">
                  
                  <li>
                     <?php if ($issue_detail->correct == "belum dikoreksi"){?>
                     <a class="avatar bg-orange" title="belum dikoreksi"><i class="fa fa-warning"></i></a>
                     <?php }else if($issue_detail->correct == "tepat"){?>
                     <a class="avatar bg-green" title="tepat"><i class="fa fa-check"></i></a>
                     <?php }else{?>
                     <a class="avatar bg-red" title="tidak tepat"><i class="fa fa-times"></i></a>
                     <?php } ?>
                     <div class="message_date">
                        <h3 class="date text-info"><?php echo date("h:i a", strtotime($issue_detail->tgl_sol))?></h3>
                        <p class="month"><?php echo date("d M 'y", strtotime($issue_detail->tgl_sol))?></p>
                     </div>
                     <div class="message_wrapper">
                        <h4 class="heading"><?php echo $issue_detail->user_nama?></h4>
                        <p class="message"><?php echo $issue_detail->isi?></p>
                        <br />
                        <p class="url">
                           
                        </p>
                     </div>
                  </li>
              
               </ul>
      
            </div>
         </div>
      </div>
   </div>
</div>
