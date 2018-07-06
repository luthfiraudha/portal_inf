
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu;?> | <small><?php echo $this->fitur;?></small></h2>

                <div class="clearfix"></div>
            </div>

            <?php cetak_flash_msg();?>
            <?php if (!empty($alert['message'])) {?>
                <div class="alert alert-<?php echo $alert['class'];?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" ></button>
                    <?php echo $alert['message'];?>
                </div>
            <?php }
?>

            <div class="x_content">


               <!--  <div>
                    <h4>Informasi</h4>
                    <ul>
                        <li>Hak Akses tidak dapat dihapus.</li>
                        <li>Beberapa Hak Akses tidak dapat diubah.</li>
                    </ul>
                </div> -->
                <div class="row">
                    <div class="col-xs-12">
                        <!--<form  method="POST" id="demo-form2" action="<?php echo base_url($this->cname. '/search/');?>" data-parsley-validate class="form-horizontal form-label-left">-->

                    <form  id="form-filter" class="form-horizontal form-label-left" >
                           
            
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Shift
                              
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="shift" id="shift">  
                                        <option value="">No selected</option>       
                                        <option value="Shift 1">Shift 1</option>    
                                        <option value="Shift 2">Shift 2</option>
                                        <option value="Shift 3">Shift 3</option>
                                </select>
                            </div>
                        </div>
                      <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Dari
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Sampai
                            </label>
                               <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                         <input type="text" name="tanggal2" class="form-control has-feedback-left" id="tglIssue2" value="">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>                        
                                        </div>
                                    </div>
                                 </div>
                        </div>

                          <!-- <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="kategori" id="kategori">
                                   <option value="">All</option>
                                    <?php
                                    foreach ($kategori as $kategori) {
                                    ?>
                                    <option value="<?php echo $kategori->kategori_id;?>"><?php echo ucfirst($kategori->kategori_nama) ;?></option>
                                    <?php
                                    }
                                    ?>
                                   
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Kategori
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="kategori_nama" required="required" id="kategoriapp" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $issue_detail->kategori_nama; ?>">
                      </div>
                  </div>
                  <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Ticket
                              
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="jenistik" id="jenistik">  
                                        <option value="">No selected</option>       
                                         
                                        <option value="Problem">Problem</option>
                                        <option value="Request">Request</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             <!--<button type="submit" class="btn btn-sm btn-primary" data-toggle='confirmation'><i class="fa fa-search"></i> Filter </button>
                             <a type="button" href="<?php echo base_url($this->cname);?>" class="btn btn-sm btn-default">Reset</a>-->
                                
                               
                            <button type="button" id="btn-filter" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Filter </button>
                                <button type="button" id="btn-reset" class="btn btn-sm btn-default">Reset</button>
                                
                            </div>  
                                    
                        </div>
                        
                       
                    </form>
                    </div>
                </div>
                </br>

                <div class="row">
                <table id="data-prob" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="120px">Tanggal</th>
                            <!-- <th>Shift</th> -->
                            <th>Issuer</th>
                            <th>Kategori</th>
                            <!-- <th>Status</th> -->
                           <!--  <th >Tgl Solusi</th> -->
                            <!-- <th>Shift</th> -->
                            <th>Responden</th>
                           <!--  <th>Koreksi</th> -->
                           
                            <th>Permasalahan</th>
                            <th>Tindakan</th>
                            <th>Jenis Ticket</th>
                            <th width="60px">Detail</th>
                           

                        </tr>
                    </thead>


                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

/*.dataTables_filter {
display: none; 
}*/
</style>
<script>

</script>