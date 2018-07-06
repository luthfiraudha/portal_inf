        


        <?php if ($this->fitur2 == 'Lihat Jawaban') { ?>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Judul
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <p>: <?php echo $answer_detail->issue_judul; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Jawaban
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

                            <input type="hidden" name="id" value="<?php echo $answer_detail->id; ?>">
                            
                        <?php } ?>
                       <!--  <input type="hidden" name="issue_id" value="<?php //echo $answer_detail->issue_id; ?>"> -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="user_nama" required="required" class="form-control col-md-7 col-xs-12" value="<?php
                                if ($this->fitur2 == 'Tambah Jawaban')
                                    echo $this->active_user;
                                elseif ($this->fitur2 == 'Ubah Jawaban')
                                    echo $answer_detail->user_nama;
                                ?>" readonly>
                                <input type="hidden" name="user_id" value="<?php echo $this->active_user_id; ?>">
                            </div>
                        </div>
                         <div class="form-group" ">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal <span class="required">*</span></label>

                              <div class="control-group">
                              <div class="controls">
                               
                                <div class="col-md-3 col-sm-3 col-xs-12 xdisplay_inputx form-group has-feedback">
                                      <input type="text" name="tgl" class="form-control has-feedback-left" id="tglIssue" placeholder="Tanggal" value="<?php if ($this->fitur == 'Ubah'){
                                        
                                      $newdate1 = date("m/d/Y", strtotime($answer_detail->tgl_sol));
                                        echo $newdate1;
                                        } ?>"  required="required">
                                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                      
                                  </div>
                             

                            </div>
                              </div>
                            
                          </div>
                          <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" >Jam <span class="required">*</span></label>
                              <div class="control-group">
                              <div class="controls">

                                  <div class="col-md-2 col-sm-2 col-xs-12 xdisplay_inputx form-group has-feedback">
                                      <input type="text" name="jam" class="form-control has-feedback-left" id='jamIssue' placeholder="Jam" value="<?php if ($this->fitur == 'Ubah'){
                                        
                                        $newdate1 = date("H:m", strtotime($answer_detail->tgl_sol));
                                        echo $newdate1;
                                        } ?>" required="required">
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jawaban</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="resizable_textarea form-control" name="isi" ><?php if ($this->fitur2 == 'Ubah Jawaban') echo $answer_detail->isi; ?></textarea>
                            </div>
                        </div>
                        <?php if ($this->fitur2 == 'Ubah Jawaban') { ?>
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
                         <!--    <a class="btn btn-sm bg-blue" href="<?php //echo base_url($this->cname . '/action/view/' . $answer_detail->issue_id); ?>"><i class="fa fa-arrow-left"></i> Kembali</a> -->
                         <button class="btn btn-default" data-dismiss="modal">Close</button>
                            <?php if ($this->fitur2 == 'Lihat Jawaban') { ?>
                                <?php if ($this->active_user == $answer_detail->user_nama) { ?>
                                    <a href="<?php echo base_url($this->cname . '/action/edit_answer/' . $answer_detail->id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($this->fitur2 == 'Tambah Jawaban' || $this->fitur2 == 'Ubah Jawaban') { ?>
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <?php } ?>
                        </div>
                    </div>