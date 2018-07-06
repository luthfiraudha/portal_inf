
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
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <a href="<?php echo base_url($this->cname . '/add')?>" class="btn btn-small sbold bg-green" >
                                <i class="fa fa-plus"></i> New Tape PF
                            </a>
                        </div>
                       
                    </div>
                </div>
            </div>

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
                        <!-- <<form  method="POST" id="demo-form2" action="<?php echo base_url($this->cname. '/search/');?>" data-parsley-validate class="form-horizontal form-label-left"> -->

                    <form  id="form-filter" class="form-horizontal form-label-left" >
                            <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal
                            </label>
                               <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                         <input type="text" name="start_date" class="form-control has-feedback-left" id="single_cal1" value="">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>                        
                                        </div>
                                    </div>
                                 </div>
                            </div>
                            <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Library
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="library" id="libraryapp" required="required" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="status" id="status"> 
                                        <option value ="">All</option> 
                                        <option value="New Tape">New Tape</option>
                                        <option value="Kosong">Kosong</option> 
                                        <option value="EOD">EOD</option>
                                        <option value="EOM">EOM</option>
                                        <option value="EOY">EOY</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">State
                              
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="state" id="state"> 
                                        <option value ="">All</option>         
                                        <option value="Before">Before</option>       
                                        <option value="After">After</option>    
                                </select>
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
                        <!--<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >State
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="kategori_nama" required="required" id="kategoriapp" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $issue_detail->kategori_nama; ?>">
                      </div>
                  </div>-->
                        
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
                <table id="data-tape-pf" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="15px">No</th>
                            <th width="70px">Volume ID</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th width="40px">Rak</th>
                            <!-- <th>Status</th> -->
                           <!--  <th >Tgl Solusi</th> -->
                            <th>Koordinat</th>
                            <th >Set</th>
                           <!--  <th>Koreksi</th> -->
                            <th>State</th>
                            <th>Status</th>
                            <th>Media</th>
                            <!--<th>Answer</th>-->
                            <th width="220px">Detail</th>
                           

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
<div class="modal fade d-modal" id="konfirmasi-ken--modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Recycle Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to recycle this data? <br/>
                <strong><span class="font-red">Recycling data can't be restored.</span></strong>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="" class="btn btn-danger bg-danger btn-delete"> Recycle</a>
            </div>

        </div>
    </div>
</div>