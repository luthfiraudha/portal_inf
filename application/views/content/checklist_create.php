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
        
         <div class="x_content">
            <br />
            <form  method="POST" id="demo-form2" action="<?php echo base_url($this->cname.'/create');?>" data-parsley-validate class="form-horizontal form-label-left">
              
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Data Center <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="ck_nama" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Type
                  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="jenis_field">
                        <option value="Daily">Daily</option>
                        <option value="Monthly">Monthly</option>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal <span class="required">*</span>
                </label>
                   <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                                <input type="text" name="ck_tgl" class="form-control has-feedback-left" id="datechecklist" placeholder="Tanggal" >
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                           
                                            </div>
                                        </div>
                     </div>
                            
               </div>
              
               <div class="ln_solid">
               </div>
               <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                    <!--  <a class="btn btn-sm bg-blue" href="<?php echo base_url($this->cname); ?>"><i class="fa fa-arrow-left"></i> Kembali</a> -->
                
                   
                     <button type="submit" class="btn btn-primary" ><i class="fa fa-check-square-o"></i> Create Form</button>
                    
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu;?> |<small><?php echo $this->fitur;?></small></h2>

                <div class="clearfix"></div>
            </div>

           
            <div class="x_content">



                 <table id="data-checklist" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Data Center</th>
                            <th>Type</th>
                            <th>Tanggal</th>
                          
                     
                            
                            <th>Status</th>
                            
                            <th width="">Action</th>
                           

                        </tr>
                    </thead>

<!--  -->
                </table>
            </div>
        </div>
    </div>
</div>