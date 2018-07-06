<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
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
                <br />
                <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    <?php if ($this->fitur2 == 'Lihat Jawaban Reminder') { ?>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $answer_detail->user_nama; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Shift
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $answer_detail->shift; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $answer_detail->tgl_sol; ?><p>
                            </div>
                        </div>

                          <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tindakan
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $answer_detail->isi; ?><p>
                            </div>
                        </div>
                          <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Koreksi
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>: <?php echo $answer_detail->correct; ?><p>
                            </div>
                        </div>
                        
                        
                                            
                        <?php
                            } else {
                         ?>
                        <?php if ($this->fitur2 == 'Ubah Jawaban') { ?>

                        <input type="hidden" name="answer_id" value="<?php echo $answer_detail->answer_id; ?>">
                        <?php } ?>
                        <input type="hidden" name="issue_id" value="<?php echo $answer_detail->issue_id; ?>">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama <span class="required">*</span></label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="user_nama" required="required" class="form-control col-md-7 col-xs-12" value="<?php if($this->fitur2 == 'Tambah Jawaban') echo $this->active_user; elseif ($this->fitur2 == 'Ubah Jawaban') echo $answer_detail->user_nama; ?>" readonly>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jawaban</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea class="resizable_textarea form-control" name="answer" ><?php if ($this->fitur2 == 'Ubah Jawaban') echo $answer_detail->answer; ?></textarea>
                            </div>
                        </div>
                         <?php if($this->fitur2 == 'Ubah Jawaban' && ($this->active_privilege == "superadmin" || $this->active_privilege == "signer")){?>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Koreksi
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="correct">       
                                        <option value="belum dikoreksi">Belum dikoreksi</option>    
                                        <option value="tidak tepat">Tidak Tepat</option>
                                        <option value="tepat">Tepat</option>
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
                                <a class="btn btn-sm bg-blue" href="<?php echo base_url($this->cname.'/action/view/'. $answer_detail->record_id); ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <?php if ($this->fitur2 == 'Lihat Jawaban') { ?>
                                <a href="<?php echo base_url($this->cname . '/action/edit_answer/' . $answer_detail->id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
                                <?php } ?>
                                <?php if ($this->fitur2 == 'Tambah Jawaban' || $this->fitur2 == 'Ubah Jawaban') { ?>
                                <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur2 == 'Ubah Jawaban') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
