
 
                  <div class="x_title">
                   <div class="x_content">
                    <h2><small> <?php date_default_timezone_set("Asia/Jakarta"); echo date('l, d/m/Y H:i:s');?></small></h2>
                    <ul class="nav navbar-right panel_toolbox"></ul>
                    <div class="clearfix"></div>
                   
                  </div>   

<form action="echo base_url($this->cname.'/report_ticketm');?>" method="post">
          </br></br>
                          Kategori:  
                         <input type="text" name="kategori_nama" id="kategoriapp" value="" style="height: 25px" required="required">
                            <span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                        Type chart:  
                            <select  name="tipe" style="height: 25px" required="required">
                              <option value="empty">select type</option>
                                    <option value="l">Line Chart</option>
                                    <option value="v">Venn Chart</option>
                                    <option value="b">Bar Chart</option>
                                   
                           </select>
                           <span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                        Dari : 
                            <input type="text" name="start_date" id="single_cal1" required="required" value="">
                            <span class="left" aria-hidden="true">&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                        Sampai :
                            <input type="text" name="end_date" id="single_cal2" required="required" value="">
                            <span class="left" aria-hidden="true">&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                           <input type="submit"  style="height: 25px" value="Filter">                          
                    </form>
                    </br>


<!-- 

                <form action="<?php echo base_url($this->cname.'/report_ticketm');?>" method="post">
                         Kategori:  
                         <input type="text" name="kategori_nama" id="kategoriapp" value="" style="height: 25px">
                            <span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                        Type chart:  
                            <select  name="tipe" style="height: 25px">
                              <option value="empty">select type</option>
                                    <option value="l">Line Chart</option>
                                    <option value="v">Venn Chart</option>
                                    <option value="b">Bar Chart</option>
                                   
                           </select><span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                         Report by month:  
                          <select name="month" style="height: 25px">
                              <option value="empty">select month</option>
                                <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                           </select><span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                           <input type="submit"  style="height: 25px" value="Filter">
                          
                    </form> -->
                    </br>

          <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <?php cetak_flash_msg(); ?>
                  
                 
                    <h2><?php echo $title;?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                     
                    
                    
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                      <div class="col-md-12" style="overflow:hidden; height: 20em;" id="show">
                        
                      
                      </div>
                     

                      
                    </div>
                  </div>
                </div>
              </div>
            </div>

            





           



