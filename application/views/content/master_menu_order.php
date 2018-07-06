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
            
        <div class="alignleft">
                                        <h4>Info:</h4>
                                        <ul>
                                            <li>Drag and drop menu to reorder.</li>
                                            <li>click button save order if finished.</li>
                                        </ul>
                </div>

            <div class="x_content">
                

                    
                    
                        <ul id="sortable" style="list-style: none;">
                         <?php
                        $start = 1;
                        foreach ($menu as $menu) {
                           
                            ?>
                            <li  id="order-<?php echo $menu->id;?>" ><p class="btn btn-lg btn-default flat" style="width: 500px; text-align: left;background-color: #f3f3f3;font-size: 14px;"><?php echo strtoupper($menu->name) ?></br></p>

                            </li>
                            <?php } ?>
                        </br>
                                
                                 
                                
                        </ul>

                         <a class="btn btn-sm bg-blue" onclick="history.go(-1);" ><i class="fa fa-arrow-left"></i> Kembali</a>

                                  <a  id="post_sort" class="btn btn-sm bg-green" > 
                                        <i class="fa fa-folder"></i> Save Order
                                    </a>

                       
                        <!-- Query string: <span id="hasil"></span> -->

                        

            </div>
        </div>
    </div>
</div>

