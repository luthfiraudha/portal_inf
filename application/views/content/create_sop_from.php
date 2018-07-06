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
         <!-- <a class="btn btn-sm bg-blue" onclick="history.go(-1);" href="#<?php //echo base_url("data_issue"); ?>"><i class="fa fa-arrow-left"></i> Kembali</a> -->
            <div class="col-md-12 col-sm-12 col-xs-12">
               <?php if ($this->fitur == 'Lihat') { ?>
               <section class="panel">
                  <div class="panel-body">
                     <div class="col-md-6 col-sm-6 col-xs-12">
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
                     </div>
                     <div class="col-md-6 col-sm-6 col-xs-12 right">
                        <h3 >Tindakan</h3>
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
                             <!--  <div class="message_date">
                                 <h3 class="date text-info"><?php echo date("h:i a", strtotime($issue->tgl_sol))?></h3>
                                 <p class="month"><?php echo date("d M 'y", strtotime($issue->tgl_sol))?></p>
                                 <p><?php echo $issue->shift;?></p>
                              </div> -->
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
                                 <!--    <a title='Edit' href=" <?php echo base_url($this->cname . '/action/edit_answer/' . $issue->id);?>" class='blue'>edit
                                    </a> -->
                                   <a data-href="<?php echo base_url($this->cname . '/action/edit_answer/' . $issue_detail->id) ?>"  data-id="<?php echo $issue->id; ?>" data-fitur="Ubah Jawaban" data-toggle="modal" data-target=".edit-answer-modal" class="blue">edit </a>
                                    <a title='Delete' data-href=" <?php echo base_url($this->cname . '/action/delete_answer/' . $issue_detail->id);?>" class='red' data-toggle="modal" data-target=".delete-modal">delete
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
               </section>
                <?php } else { ?>
               <form   id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                   <!-- <form  method="POST" id="demo-form2" action="<?php echo base_url('data_issue/submit_createsop');?>" data-parsley-validate class="form-horizontal form-label-left"> -->
          <!--       
                  <input type="hidden" name="id" value="<?php echo $issue_detail->id; ?>"> -->
               
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nomor Ticket <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="id" required="required" class="form-control col-md-7 col-xs-12" value="<?php
                           if ($this->fitur == 'Tambah')
                               echo $idx;
                           elseif ($this->fitur == 'Ubah')
                               echo $issue_detail->id;
                           ?>" readonly>
                     </div>
                  </div>

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
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis
                     <span class="required">*</span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="type" id="dailyActi">
                             <?php
                              if ($this->fitur == 'Ubah') { ?>
                              <option value="<?php echo $issue_detail->type; ?>">Pilih jenis</option>
                             
                              <option value="Request">Request</option>
                              <option value="Problem">Problem</option>
                           <?php } else { ?>
                          <option value="Daily Activity">Daily Activity</option>
                           <option value="Request">Request</option>
                           <option value="Problem">Problem</option>
                           <?php } ?>
                           
                        </select>
                     </div>
                  </div>
                   <div class="form-group" id="tglIssueA" style="display: none;">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal <span class="required">*</span></label>

                      <div class="control-group">
                      <div class="controls">

                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                              <input type="text" name="tgl" class="form-control has-feedback-left" id="tglIssue" placeholder="Tanggal Ticket" value="<?php if ($this->fitur == 'Ubah'){
                                
                              $newdate1 = date("m/d/Y", strtotime($issue_detail->tgl_input));
                                echo $newdate1;
                                } ?>">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                              
                          </div>

                    </div>
                      </div>
                    
                  </div>
                  <div class="form-group" id="jamIssueA" style="display: none;">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Jam <span class="required">*</span></label>
                      <div class="control-group">
                      <div class="controls">

                          <div class="col-md-2 col-sm-2 col-xs-12 xdisplay_inputx form-group has-feedback">
                              <input type="text" name="jam" class="form-control has-feedback-left" id='jamIssue' placeholder="Jam Ticket" value="<?php if ($this->fitur == 'Ubah'){
                                
                                $newdate1 = date("H:m", strtotime($issue_detail->tgl_input));
                                echo $newdate1;
                                } ?>">
                              <span class="fa fa-clock-o form-control-feedback left" aria-hidden="true"></span>
                              
                          </div>
                      </div>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Aplikasi<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama_app" required="required" id="namaapp" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $sop_detail->nama_app; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Fitur<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama_fitur" required="required" id="namafitur" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $sop_detail->nama_fitur; ?>">
                            </div>
                        </div>
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Kategori<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="kategori_nama" required="required" id="kategoriapp" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $issue_detail->kategori_nama; ?>">
                      </div>
                  </div>
                
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi
                     <span class="required">*</span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea class="resizable_textarea form-control" id="summernotes" style="height:15em;" name="isi" required="required" ><?php if ($this->fitur == 'Ubah') echo $issue_detail->isi; ?></textarea>
                     </div>
                  </div>
                  <div class="form-group"  id="dailyAct" style="display:none;">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" >
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="checkbox" name="pinned" value="1"/> Pinned ticket on dashboard
                     </div>
                  </div>
               
                  <?php }
                     ?>
                  
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   if ($this->fitur2 == 'Jawaban') {
       if ($issue_detail->type != "Daily Activity") {
           ?>
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>CREATE SOP</h2>
            <div class="clearfix"></div>
         </div>
         
         <div class="x_content">
           <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" >
            <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Aplikasi<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama_app"  id="namaapp" class="form-control col-md-7 col-xs-12" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Fitur<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama_fitur" id="namafitur" class="form-control col-md-7 col-xs-12" value=""
                                onkeyup="cekfitur();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama SOP<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="sop_name" required="required"  id="kategoriapp" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal Release <span class="required">*</span>
                            </label>
                           
                          
                               <div class="control-group">
                                <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                             <input type="text" name="sop_tgl" class="form-control has-feedback-left" id="single_cal1" value="">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            
                                        </div>
                                    </div>
                                 </div>
                            
                        </div>
                       
                      
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Pembuat (PIC) <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="sop_pic" required="required" class="form-control col-md-7 col-xs-12" value="" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Keterangan 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="sop_ket" class="form-control col-md-7 col-xs-12" value="" >
                            </div>
                        </div>
                        
                        
                      
                        <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi SOP
                     <span class="required">*</span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea class="resizable_textarea form-control" id="summernotes" style="height:15em;" name="isi" required="required" ><?php if ($this->fitur == 'Ubah') echo $issue_detail->isi; ?></textarea>
                     </div>
                  </div>
                       
                  
                    <div class="ln_solid">

                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                            <a class="btn btn-sm bg-blue" href="#" onclick="history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</a>
                           
                                <button type="submit" class="btn btn-sm btn-primary " data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                            

                        </div>
                    </div>

                </form>
            </div>
         </div>
      </div>
   </div>
</div>
  
<?php
   }
   }
   ?>