
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu;?> |<small><?php echo $this->fitur;?></small></h2>

                <div class="clearfix"></div>
            </div>

            <?php cetak_flash_msg();?>
            <?php if (!empty($alert['message'])) {?>
                <div class="alert alert-<?php echo $alert['class'];?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <?php echo $alert['message'];?>
                </div>
            <?php }
?>
            <?php if ( $this->active_privilege == 'maker' || $this->active_privilege == 'checker' || $this->active_privilege == 'signer' || $this->active_privilege == 'superadmin') {?>

                <div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="btn-group">
                                <a href="<?php echo base_url($this->cname . '/add')?>" class="btn btn-small sbold bg-green" >
                                    <i class="fa fa-plus"></i> Create Daily Activity
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
                
                <?php
}
?>

            <div class="x_content">


<!--                <div>
                    <h4>Informasi</h4>
                    <ul>
                        <li>Hak Akses tidak dapat dihapus.</li>
                        <li>Beberapa Hak Akses tidak dapat diubah.</li>
                    </ul>
                </div>-->

                 <div class="row">
                    <div class="col-xs-12">
                        <!--<form  method="POST" id="demo-form2" action="<?php echo base_url($this->cname. '/search/');?>" data-parsley-validate class="form-horizontal form-label-left">-->

                    <form  id="form-filterdaily" class="form-horizontal form-label-left" >
                           
            
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Shift
                              
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="shift" id="shift2">  
                                        <option value="">No selected</option>       
                                        <option value="Shift 1">Shift 1</option>    
                                        <option value="Shift 2">Shift 2</option>
                                        <option value="Shift 3">Shift 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal
                            </label>
                               <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                         <input type="text" name="tanggal" class="form-control has-feedback-left" id="tglIssue" value="">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>                        
                                        </div>
                                    </div>
                                 </div>
                        </div>

                         
             <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Kategori
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="kategori_nama" required="required" id="kategoriapp2" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $issue_detail->kategori_nama; ?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Job
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="job_nama" required="required" id="namajob" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $issue_detail->kategori_nama; ?>">
                      </div>
                  </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             <!--<button type="submit" class="btn btn-sm btn-primary" data-toggle='confirmation'><i class="fa fa-search"></i> Filter </button>
                             <a type="button" href="<?php echo base_url($this->cname);?>" class="btn btn-sm btn-default">Reset</a>-->
                                
                               
                            <button type="button" id="btn-filterdaily" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Filter </button>
                            <button type="button" id="btn-resetdaily" class="btn btn-sm btn-default">Reset</button>
                                
                            </div>  
                                    
                        </div>
                        
                       
                    </form>
                    </div>
                </div>

                <table id="data-daily" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Shift</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>ET</th>
                            <th>App</th>
                            <th>Fitur</th>
                            <th>Job</th>
                            <th>Kategori</th>
                            <!-- <th>Jenis Ticket</th> -->
                            <th>Isi</th>
                            <th>total trx(EOD)</th>

                        <!--     <th>Status</th> -->
                            <?php if ($this->fitur == "Daftar" && ($this->active_privilege == "superadmin")){?>
                            <th width="140px">Action</th>
                            <?php }else{ ?>
                            <th width="140px">Detail</th>
                            <?php } ?>

                        </tr>
                    </thead>

<!--  -->
                </table>
            </div>
        </div>
    </div>
</div>