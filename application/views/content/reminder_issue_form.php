<div class="row">
   <div class="col-md-12">
      <div class="x_panel">
         <div class="x_title">
            <h2><?php echo $this->menu; ?> |<small><?php echo $this->fitur; ?></small></h2>
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
               <?php if ($this->fitur == 'Lihat Reminder') { ?>
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
                <?php } else { ?>
               <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                 
                  <?php if ($this->fitur == 'Ubah') { ?>
                  <input type="hidden" name="id" value="<?php echo $issue_detail->id; ?>">
                  <?php } ?>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="user_nama" required="required" class="form-control col-md-7 col-xs-12" value="<?php
                           if ($this->fitur == 'Tambah')
                               echo $this->active_user;
                           elseif ($this->fitur == 'Ubah')
                               echo $issue_detail->user_nama;
                           ?>" readonly>
                        <input type="hidden" name="user_id" value="<?php echo $this->active_user_id; ?>">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Shift
                     <span class="required">*</span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="shift">
                           <option value="Shift 1">Shift 1</option>
                           <option value="Shift 2">Shift 2</option>
                           <option value="Shift 3">Shift 3</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori
                     <span class="required">*</span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="kategori_id" id="kategori" >
                           <?php
                              if ($this->fitur == 'Ubah') {
                              
                                  foreach ($kategori as $kategori) {
                                      echo "<option value='$kategori->kategori_id' ";
                                      if ($this->fitur == "Ubah") {
                                          echo $kategori->kategori_id == $issue_detail->kategori_id ? 'selected' : '';
                                      }
                                      echo">" . ucfirst($kategori->kategori_nama) . "</option>";
                                  }
                                  ?>
                           <?php } else { ?>
                           <?php
                              foreach ($kategori as $kategori) {
                                  ?>
                           <option value="<?php echo $kategori->kategori_id; ?>"><?php echo ucfirst($kategori->kategori_nama); ?></option>
                           <?php
                              }
                              ?>
                           <?php } ?>
                           <option value="other" >Create New</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group" id="otherType" style="display:none;">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Kategori Baru <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="kategori_nama" class="form-control col-md-7 col-xs-12" >
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis
                     <span class="required">*</span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="type">
                           <option value="Daily Activity">Daily Activity</option>
                           <option value="Request">Request</option>
                           <option value="Problem">Problem</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi
                     <span class="required">*</span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea class="resizable_textarea form-control" style="height:15em" name="isi" ><?php if ($this->fitur == 'Ubah') echo $issue_detail->isi; ?></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" >
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="checkbox" name="pinned" value="1"/> Pinned ticket on dashboard
                     </div>
                  </div>
                  <?php if ($this->fitur == 'Ubah') { ?>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
                     <span class="required">*</span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="status">
                           <option value="belum selesai">Belum selesai</option>
                           <option value="selesai">Selesai</option>
                        </select>
                     </div>
                  </div>
                  <?php } ?>
                  <?php }
                     ?>
                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <a class="btn btn-sm bg-blue" href="<?php echo base_url("reminder_issue"); ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <?php if ($this->fitur == 'Lihat') { ?>
                        <?php if ($this->active_user == $issue_detail->user_nama) { ?>
                        <?php if ($issue_detail->status == "selesai") { ?>
                        <?php } else { ?>
                        <a href="<?php echo base_url($this->cname . '/action/edit/' . $issue_detail->id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>
                        <?php if ($this->fitur == 'Tambah' || $this->fitur == 'Ubah') { ?>
                        <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                        <?php } ?>
                     
                    
                        <?php
                           if ($this->fitur2 == 'Jawaban Reminder') {
                               if ($issue_detail->type != "Daily Activity") {
                                    if ($issue_detail->status == "belum selesai") { 
                                   ?>
                        <a data-href="<?php echo base_url($this->cname . '/action/add_answer/' . $issue_detail->id) ?>" class="btn btn-sm sbold bg-green" data-id="<?php echo $issue_detail->id; ?>" data-fitur="Tambah Jawaban" data-toggle="modal" data-target=".add-answer-modal">
                        <i class="fa fa-plus"></i> Input Tindakan
                        </a>
                        <?php
                           }
                            } 
                           }
                           ?>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   if ($this->fitur2 == 'Jawaban Reminder') {
       if ($issue_detail->type != "Daily Activity") {
           ?>
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2><?php echo $this->menu; ?><small>Tindakan Lanjut</small></h2>
            <div class="clearfix"></div>
         </div>
         <?php if ($issue_detail->status == "belum selesai") { ?>
         <!--  <div>
            <div class="row">
               <div class="col-md-1 col-md-offset-10">
                  <div class="btn-group">
                     <a data-href="<?php echo base_url($this->cname . '/action/add_answer/' . $issue_detail->id) ?>" class="btn btn-small sbold bg-green" data-id="<?php echo $issue_detail->id; ?>" data-fitur="Tambah Jawaban" data-toggle="modal" data-target=".add-answer-modal">
                     <i class="fa fa-plus"></i> Tambah
                     </a>
                  </div>
                  <div class="btn-group">
                     <a href="<?php echo base_url($this->cname . '/action/add_answer/'.$issue_detail->id)     ?>" class="btn btn-small sbold bg-green" >
                         <i class="fa fa-plus"></i> Tambah
                     </a>
                     </div>
                  <div class="btn-group">
                     <a href="<?php echo base_url($this->cname . '/upload_file')     ?>" class="btn btn-small sbold" >
                         <i class="fa fa-upload"></i> Upload file
                     </a>
                     </div>
               </div>
            </div>
            </div> -->
         <?php } ?>
         <div class="x_content">
            <div>
               <!--  <h4>Tindakan Lanjut</h4> -->
               <!-- end of user messages -->
               <ul class="messages">
                  <?php 
                     foreach ($issue_answer as $issue) { ?>
                  <li>
                     <?php if ($issue->correct == "belum dikoreksi"){?>
                     <a class="avatar bg-orange" title="belum dikoreksi"><i class="fa fa-warning"></i></a>
                     <?php }else if($issue->correct == "tepat"){?>
                     <a class="avatar bg-green" title="tepat"><i class="fa fa-check"></i></a>
                     <?php }else{?>
                     <a class="avatar bg-red" title="tidak tepat"><i class="fa fa-times"></i></a>
                     <?php } ?>
                     <div class="message_date">
                        <h3 class="date text-info"><?php echo date("h:i a", strtotime($issue->tgl_sol))?></h3>
                        <p class="month"><?php echo $issue->shift." / ".date("d M 'y", strtotime($issue->tgl_sol))?></p>
                     </div>
                     <div class="message_wrapper">
                        <h4 class="heading"><?php echo $issue->user_nama?></h4>
                        <p class="message"><?php echo $issue->isi?></p>
                        <br />
                        <p class="url">
                           <?php if ($this->active_privilege == "superadmin"){?>
                           <!--  <a title='Lihat' href=" <?php echo base_url($this->cname . '/action/view_answer/' . $issue->id);?>" class='green'>Lihat
                              </a> -->
                           <?php if($issue_detail->status=="belum selesai"){?>
                           <a data-href="<?php echo base_url($this->cname . '/action/edit_answer/' . $issue_detail->id) ?>"  data-id="<?php echo $issue->id; ?>" data-fitur="Ubah Jawaban" data-toggle="modal" data-target=".edit-answer-modal" class="blue">edit </a>
                           <a title='Delete' data-href=" <?php echo base_url($this->cname . '/action/delete_answer/' . $issue->id);?>" class='red' data-toggle="modal" data-target=".delete-modal">delete
                           </a>
                           <?php } ?>
                           <?php }elseif($this->active_privilege == "signer" || $this->active_privilege == "checker" || $this->active_privilege == "maker" ){
                              ?>
                           <?php if($this->active_user == $issue->user_nama){?>
                      
                           <!--  <a title='Lihat' href=" <?php echo base_url($this->cname . '/action/view_answer/' . $issue->id);?>" class='green'>Lihat
                              </a> -->
                           <?php if($issue_detail->status=="belum selesai"){?>
                           <a data-href="<?php echo base_url($this->cname . '/action/edit_answer/' . $issue_detail->id) ?>"  data-id="<?php echo $issue->id; ?>" data-fitur="Ubah Jawaban" data-toggle="modal" data-target=".edit-answer-modal" class="blue">edit </a>
                           <a title='Delete' data-href=" <?php echo base_url($this->cname . '/action/delete_answer/' . $issue->id);?>" class='red' data-toggle="modal" data-target=".delete-modal">delete
                           </a>
                           <?php } ?>
                        
                        <?php } else{?>
                       
                           <!--  <a title='Lihat' href=" <?php echo base_url($this->cname . '/action/view_answer/' . $issue->id);?>" class='green'>Lihat
                              </a> -->
                        
                        <?php } ?>
                        <?php
                           }else{
                           ?>
                       
                           <a>
                           no action
                           </a>
                        
                        <?php
                           } ?>
                        </p>
                     </div>
                  </li>
                  <?php   }?>
               </ul>
               <!-- end of user messages -->
               <?php 
   echo $this->pagination->create_links();
   ?> 
            </div>
         </div>
      </div>
   </div>
</div>
  
<?php
   }
   }
   ?>