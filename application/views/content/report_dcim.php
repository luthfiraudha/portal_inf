
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
                        <form  method="POST" id="demo-form2" action="<?php echo base_url($this->cname. '/search/');?>" data-parsley-validate class="form-horizontal form-label-left">
                            <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Data Center
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                               <select class="form-control" name="datacenter" id="datacenter"> 
                                        <option value ="1">DC GTI</option>         
                                        <option value="2">DC Sudirman</option>       
                                        <option value="3">DC Tabanan</option>   
                                        <option value="4">DC 1 GTI</option>  
                                        <option value="5">DC 2 Sudirman</option> 
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Location Cabinet
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="cabinet" id="cabinet"  class="form-control col-md-7 col-xs-12" value="">
                            </div>
                            </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >No Serial Device
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="no_serial" id="no_serial" class="form-control col-md-7 col-xs-12" value="">
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
                                
                               
                                <button type="submit" id="btn-filter" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Filter </button>
                                <button type="button" id="btn-reset" class="btn btn-sm btn-default">Reset</button>
                                
                            </div>  
                                    
                        </div>
                        
                       
                    </form>
                    </div>
                </div>
                </br>

                <div class="row">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                <?php if(!empty($dcim)){?>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Data Center</th>
                            <th>Administrator</th>
                            <th>Location</th>
                            <th>Model</th>
                            <th>Total Slot</th>
                            <th>Used Slot</th>
                            <th>Total Host</th>
                            <th>Total Aplikasi</th>
                        </tr>
                    </thead>
                        <?php $no=1; foreach($dcim as $row){?>
                            <tr>
                                <th><?php echo $no++;?></th>
                                <th><?php echo $row->Name; ?></th>
                                <th><?php echo $row->Administrator; ?></th>
                                <th><?php echo $row->Location; ?></th>
                                <th><?php echo $row->Model; ?></th>
                                <th><?php echo $row->CabinetHeight; ?></th>
                                <th><?php echo $row->jumlah_device; ?></th>
                                <th><?php echo $row->jumlah_host; ?></th>
                                <th><?php echo $row->jumlah_aplikasi; ?></th>
                            </tr>
                        <?php }?>
                    
                <?php }?>
                <?php if(!empty($data_cabinet)){?>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Location</th>
                            <th>Model</th>
                            <th>Total Slot</th>
                            <th>Used Slot</th>
                            <th>Total Host</th>
                            <th>Total Aplikasi</th>
                        </tr>
                    </thead>
                        <?php $no=1; foreach($data_cabinet as $row){?>
                            <tr>
                                <th><?php echo $no++;?></th>
                                <th><?php echo $row->Location; ?></th>
                                <th><?php echo $row->Model; ?></th>
                                <th><?php echo $row->CabinetHeight; ?></th>
                                <th><?php echo $row->jumlah_device; ?></th>
                                <th><?php echo $row->jumlah_host; ?></th>
                                <th><?php echo $row->jumlah_aplikasi; ?></th>
                            </tr>
                        <?php }?>
                    
                <?php }?>
                <?php if(!empty($data_location)){?>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Label</th>
                            <th>Serial Number</th>
                            <th>Primary IP</th>
                            <th>Total Host</th>
                            <th>Total Aplikasi</th>
                            <th>Warranty By</th>
                            <th>Kadaluarsa Warranty</th>
                        </tr>
                    </thead>
                        <?php $no=1; foreach($data_location as $row){?>
                            <tr>
                                <th><?php echo $no++;?></th>
                                <th><?php echo $row->Label; ?></th>
                                <th><?php echo $row->SerialNo; ?></th>
                                <th><?php echo $row->PrimaryIP; ?></th>
                                <th><?php echo $row->jumlah_host; ?></th>
                                <th><?php echo $row->jumlah_aplikasi; ?></th>
                                <th><?php echo $row->WarrantyCo; ?></th>
                                <th><?php echo $row->WarrantyExpire; ?></th>
                            </tr>
                        <?php }?>
                    
                <?php }?>
                <?php if(!empty($data_serial)){?>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Server</th>
                            <th>IP</th>
                            <th>OS</th>
                            <th>Total Harddisk</th>
                            <th>Total Aplikasi</th>
                            <th>Aplikasi</th>
                            <th>Tipe Aplikasi</th>
                        </tr>
                    </thead>
                        <?php $no=1; foreach($data_serial as $row){?>
                            <tr>
                                <th><?php echo $no++;?></th>
                                <th><?php echo $row->ServerName; ?></th>
                                <th><?php echo $row->IPServer; ?></th>
                                <th><?php echo $row->OS; ?></th>
                                <th><?php echo $row->TotalHardisk; ?></th>
                                <th><?php echo $row->jumlah_aplikasi; ?></th>
                                <th><?php echo $row->ApplicationName; ?></th>
                                <th><?php echo $row->ApplicationType; ?></th>
                            </tr>
                        <?php }?>
                    
                <?php }?>
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