
 <style type="text/css">
   
.button {
    background-color: #e7e7e7; /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 1px 1px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    width: 700px; height: 60px; 
    text-align: left;
    background-color: #f3f3f3;
    padding-top: 2%;
    border-radius:10px;
}


.button4 {
    background-color: #e7e7e7;
    color: black;
    border: none;
}

.button4:hover {
  background-color: #2A3F54;
  color: white;
}


</style>
 



<div class="row">
  <?php cetak_flash_msg();?>
            <?php if (!empty($alert['message'])) {?>

            <div style="margin-top: 10em"> class="alert alert-<?php echo $alert['class'];?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <?php echo $alert['message'];?>
            </div>
            <?php }
            ?>
</div>
<div class="page-title">
  
              <div class="title_left">

                 <h3 style="width: 300px;" href="<?php echo base_url($this->cname)?>" >Portal Monitor</h3>
                 <?php if($this->fitur == "cari"){?>
                 <a style="width: 100px;" href="<?php echo base_url($this->cname)?>" class="btn btn-sm btn-info btn-block" >reset</a>
                 <?php } ?>

              </div>

              <div class="title_right">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                <form method="POST" action="<?php echo base_url($this->cname."/cari")?>">
                  
                  <div class="input-group">
                    <input type="text" name="cari" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </form>
                  
                </div>

              </div>
            </div>
            
            <div class="clearfix"></div>


<div class="row">
  
 
   <div class="col-md-9 col-sm-9 col-xs-9">
      <div class="x_panel">
         <div class="x_title">
            <h2>List <small>Monitor</small></h2>
            <ul class="panel_toolbox">
             <!--   <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> -->

               
            </ul>
            <div class="clearfix"></div>
         </div>
         <div class="x_content" style="text-align: center;">
            <?php foreach ($monitor as $monitor) { ?>
          <div class="row">
            <a  href="<?php echo "http://".$monitor->monitor_link; ?>"  class="button button4" target="_blank">  <?php echo $monitor->monitor_nama;?> <i style="font-size: 14px; padding-top: 1%;" class="fa fa-play pull-right"></i></a>

          <!--   </br><a style="font-size: 10px">blabla</a> -->
          
           </div>
               <?php   } ?>
         </div>
      </div>
   </div>


</div>
   <div><?php 
   echo $this->pagination->create_links();
   ?>
  
   </div>
   
<div class="clearfix"></div>
<br />
