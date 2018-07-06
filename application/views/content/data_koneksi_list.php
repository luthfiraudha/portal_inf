
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
            <!-- <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <a href="<?php echo base_url($this->cname . '/add')?>" class="btn btn-small sbold bg-green" >
                                <i class="fa fa-plus"></i> New Connection
                            </a>
                        </div>
                       
                    </div>
                </div>
            </div>
 -->
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

                    <form  method="POST" id="form-filter" class="form-horizontal form-label-left" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Aplikasi
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="namaapp" id="namaapp" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Fitur
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="namafitur" id="namafitur" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >IP
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="ip" id="ip" class="form-control col-md-7 col-xs-12" value="">
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
                <table id="data-koneksi" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th width="200px">Aplikasi</th>
                            <th>Fitur</th>
                            <th width="150px">Tipe Fitur</th>
                            <th width="150px">IP</th>
                            <th width="110px">Total Koneksi</th>
                            <th width="170px">Action</th>
                        </tr>
                    </thead>


                </table>
                </div>
            </div>
        </div>
    </div>
</div>


