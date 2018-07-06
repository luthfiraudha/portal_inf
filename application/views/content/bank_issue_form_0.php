<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu; ?><small><?php echo $this->fitur; ?></small></h2>
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
                <br />
                <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    <?php if ($this->fitur == 'Lihat') { ?>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $issue_detail->user_nama; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Shift
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $issue_detail->shift; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $issue_detail->tgl_input; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Status
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $issue_detail->status; ?><p>
                            </div>
                        </div>
                          <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Kategori
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $issue_detail->kategori_nama; ?><p>
                            </div>
                        </div>
                      
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Deskripsi
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $issue_detail->isi; ?><p>
                            </div>
                        </div>
                        <div class="ln_solid">
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal Solusi
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $issue_detail->tgl_sol; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Shift
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $issue_detail->shift2; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $issue_detail->nama2; ?><p>
                            </div>
                        </div>
                         <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Solusi
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $issue_detail->isi2; ?><p>
                            </div>
                        </div>
                        
                        
                                            
                        <?php
                            } else {
                         ?>
                        <?php if ($this->fitur == 'Ubah') { ?>
                        <input type="hidden" name="issue_id" value="<?php echo $issue_detail->issue_id; ?>">
                        <?php } ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama <span class="required">*</span></label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="user_nama" required="required" class="form-control col-md-7 col-xs-12" value="<?php if($this->fitur == 'Tambah') echo $this->active_user; elseif ($this->fitur == 'Ubah') echo $issue_detail->user_nama; ?>" readonly>
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
                       <!--  <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal <span class="required">*</span>
                            </label>
                            <?php 
                           // if($this->fitur == 'Ubah'){
                           // $newdate1 = date("m/d/Y", strtotime($issue_detail->tgl_input));
                       // }
                            
                            ?>
                               <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                         <input type="text" name="tgl_input" class="form-control has-feedback-left" id="single_cal1"  value="<?php //if ($this->fitur == 'Ubah') echo $newdate1; ?>">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            
                                        </div>
                                    </div>
                                 </div>
                            
                        </div> -->
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="kategori_id">
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
                                    <option value="<?php echo $kategori->kategori_id;?>"><?php echo ucfirst($kategori->kategori_nama) ;?></option>
                                    <?php
                                    }
                                    ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Judul <span class="required">*</span></label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="issue_judul" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $issue_detail->issue_judul; ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea class="resizable_textarea form-control" name="issue_des" ><?php if ($this->fitur == 'Ubah') echo $issue_detail->issue_des; ?></textarea>
                            </div>
                        </div>
                         <?php if($this->fitur == 'Ubah'){?>
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
                        <div class="ln_solid">
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a class="btn btn-sm bg-blue" href="<?php echo base_url($this->cname); ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <?php if ($this->fitur == 'Lihat') { ?>
                                 <?php if($this->active_user == $issue_detail->user_nama) { ?>
                                 <?php if($issue_detail->status == "selesai"){ ?>
                                  
                                     <?php }else{ ?>
                                      <a href="<?php echo base_url($this->cname . '/action/edit/' . $issue_detail->issue_id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
                                     <?php } ?>
                                
                                <?php } ?>
                                <?php } ?>

                                <?php if ($this->fitur == 'Tambah' || $this->fitur == 'Ubah') { ?>
                                <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if($this->fitur2 == 'Jawaban'){ 

        ?>

    
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu;?><small><?php echo $this->fitur2;?></small></h2>

                <div class="clearfix"></div>
            </div>

            <?php if($issue_detail->status=="belum selesai"){?>
         
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="<?php echo base_url($this->cname . '/action/add_answer/'.$issue_detail->issue_id)?>" class="btn btn-small sbold bg-green" >
                                    <i class="fa fa-plus"></i> Tambah
                                </a>
                            </div>
                            <!-- <div class="btn-group">
                                <a href="<?php //echo base_url($this->cname . '/upload_file')?>" class="btn btn-small sbold" >
                                    <i class="fa fa-upload"></i> Upload file
                                </a>
                            </div> -->
                        </div>

                    </div>
                </div>            
              <?php } ?>

            <div class="x_content">


<!--                <div>
                    <h4>Informasi</h4>
                    <ul>
                        <li>Hak Akses tidak dapat dihapus.</li>
                        <li>Beberapa Hak Akses tidak dapat diubah.</li>
                    </ul>
                </div>-->

                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="10px">No</th>
                            <th>Tanggal</th>
                            <th>Shift</th>
                            <th>Nama</th>
                            <th>Jawaban</th>
                            <th>Koreksi</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $start = 0;
                        foreach ($issue_answer as $issue) {

                           ?>
                            <tr>
                                <td><?php echo ++$start?></td>
                                <td><?php echo $issue->tgl_sol?></td>
                                <td><?php echo $issue->shift?></td>
                                <td><?php echo $issue->user_nama?></td>
                                <td><?php 
                                $string = strip_tags($issue->answer);
                                    if (strlen($string) > 20) {
                                     // truncate string
                                $stringCut = substr($string, 0, 20);

                                 // make sure it ends in a word so assassinate doesn't become ass...
                                $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
                                }
                                echo $string;
                                ?></td>
                                <td><?php
                             
                                    if ($issue->correct == "belum dikoreksi" ) {  ?>
                                        <i class='btn btn-circle btn-xs bg-orange'>belum dikoreksi</i>
                                    <?php } 
                                    elseif($issue->correct == "tidak tepat") { ?>
                                        <i class='btn btn-circle btn-xs bg-red'>tidak tepat</i>
                                    <?php }
                                    elseif($issue->correct == "tepat"  ) { ?>
                                        <i class='btn btn-circle btn-xs bg-green'>tepat</i>
                                    <?php }
                                    ?>
                                    </td>

                                

                                    <?php if ($this->active_privilege == "superadmin"){?>
                                    <td style="text-align:center" width="">
                                    <a title='Lihat' href=" <?php echo base_url($this->cname . '/action/view_answer/' . $issue->answer_id);?>" class='btn btn-circle btn-sm bg-green'>
                                        <i class='fa fa-folder'></i>
                                    </a>
                                    <a title='Edit' href=" <?php echo base_url($this->cname . '/action/edit_answer/' . $issue->answer_id);?>" class='btn btn-circle btn-sm bg-blue'>
                                        <i class='fa fa-edit'></i>
                                    </a>

                                    <a title='Delete' data-href=" <?php echo base_url($this->cname . '/action/delete_answer/' . $issue->answer_id);?>" class='btn btn-circle btn-sm bg-red' data-toggle="modal" data-target=".delete-modal">
                                        <i class='fa fa-trash'></i>
                                    </a>
                                     </td>

                                    <?php }elseif($this->active_privilege == "signer" || $this->active_privilege == "checker" || $this->active_privilege == "maker" ){
                                        ?>
                                        <?php if($this->active_user == $issue->user_nama){?>
                                    <td style="text-align:center" width="">
                                    <a title='Lihat' href=" <?php echo base_url($this->cname . '/action/view_answer/' . $issue->answer_id);?>" class='btn btn-circle btn-sm bg-green'>
                                        <i class='fa fa-folder'></i>
                                    </a>
                                    <a title='Edit' href=" <?php echo base_url($this->cname . '/action/edit_answer/' . $issue->answer_id);?>" class='btn btn-circle btn-sm bg-blue'>
                                        <i class='fa fa-edit'></i>
                                    </a>

                                    <a title='Delete' data-href=" <?php echo base_url($this->cname . '/action/delete_answer/' . $issue->answer_id);?>" class='btn btn-circle btn-sm bg-red' data-toggle="modal" data-target=".delete-modal">
                                        <i class='fa fa-trash'></i>
                                    </a>
                                     </td>

                                        <?php } else{?>

                                             <td style="text-align:center" width="">
                                             <a title='Lihat' href=" <?php echo base_url($this->cname . '/action/view_answer/' . $issue->answer_id);?>" class='btn btn-circle btn-sm bg-green'>
                                              <i class='fa fa-folder'></i>
                                           </a>
                                             
                                         </td>
                                         <?php } ?>
                                   
                                        <?php
                                    }else{
                                    ?>
                                    <td style="text-align:center" width=""> 
                                    <a>
                                      no action
                                    </a>
                                    </td>
                                    <?php
                                    } ?>
                            </tr>
                            <?php
                                }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <?php }
    ?>