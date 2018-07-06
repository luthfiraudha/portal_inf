
 
          <form action="<?php echo base_url($this->cname.'/ts_performm');?>" method="post">
                         Type chart:  
                            <select  name="tipe">
                              <option value="empty">select type</option>
                                    <option value="l">Line Chart</option>
                                    <option value="v">Venn Chart</option>
                                    <option value="b">Bar Chart</option>
                                   
                           </select><span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                         Report by month:  
                          <select onchange="this.form.submit()" name="month">
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
                           </select>
                            
                          
                    </form>
                    </br>

          <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Troubleshooting Perform<small>month: <?php echo $month;?> year: <?php echo date('Y');?></small></h2>
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





           



