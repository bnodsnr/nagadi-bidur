<section id="main-content">
    <section class="wrapper site-min-height">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">जिल्ला</a></li>
        </ol>
      </nav>
        <!-- page start-->
        <div class="row">
          <div class="col-sm-12">
            <?php $success_message = $this->session->flashdata("MSG_EMP");
                if(!empty($success_message)) { ?>
                <div class="alert alert-success">
                    <button class="close" data-close="alert"></button>
                    <span> <?php echo $success_message;?> </span>
                </div>
              <?php } ?>
        
            <section class="card">
              <header class="card-header">
                
                  <span class="tools">
                  <?php if($this->authlibrary->HasModulePermission('ROAD', "ADD")) { ?>
                    <a class="btn btn-primary tbl-sm pull-right" href="<?php echo base_url()?>Road/addSadakKoKisim" style="color:#FFF"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                  <?php } ?>
                  
                </span>
              </header>
              <div class="card-body">
                <div class="adv-table">
                  <!-- <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <tbody>
                      <tr>
                        <td><a href="<?php echo base_url()?>ExportData/NagadiDetails">नगदी रशिद विवरण</a></td>
                        <td><a href="<?php echo base_url()?>ExportData/">नगदी रशिद रकम विवरण</a></td>
                        <td><a href="<?php echo base_url()?>ExportData/">नगदी रशिद  रदिद विवरण</a></td>
                     </tr>
                    </tbody>
                  </table> -->

                  <table class="table table-hover p-table">
                      <thead>
                        <tr>
                            <th>शीर्षक</th>
                            <th>आर्थिक वर्ष</th>
                            <th>महिना</th>
                            <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                        <form action="<?php echo base_url()?>ExportData/NagadiDetails" method="post">
                          <?php 
                            $current_month = get_current_month();
                          ?>
                          <tr>
                              <td class="p-name">
                                नगदी रशिद विवरण
                              </td>
                              <td class="p-name">
                                <select class="form-control" name="n_fiscal_year">
                                  <?php if(!empty($fiscal_year)){
                                    foreach ($fiscal_year as $key => $value) { ?>
                                      <option value="<?php echo $value['year']?>" <?php if($value['year'] ==current_fiscal_year()['year']){ echo 'selected';}?>><?php echo $value['year']?></option>
                                  <?php  }
                                  }?>
                                </select>
                              </td>
                              <td class="p-name">
                                <select class="form-control" name="n_month">
                                    <option value="1" <?php if($current_month =='01'){ echo 'selected';}?>>बैशाख</option>
                                    <option value="2" <?php if($current_month =='02'){ echo 'selected';}?>>जेठ</option>
                                    <option value="3" <?php if($current_month =='03'){ echo 'selected';}?>>असार</option>
                                    <option value="4" <?php if($current_month =='04'){ echo 'selected';}?>>श्रावण</option>
                                    <option value="5" <?php if($current_month =='05'){ echo 'selected';}?>>भदौ</option>
                                    <option value="6" <?php if($current_month =='06'){ echo 'selected';}?>>आश्विन</option>
                                    <option value="7" <?php if($current_month =='07'){ echo 'selected';}?>>कार्तिक</option>
                                    <option value="8" <?php if($current_month =='08'){ echo 'selected';}?>>मंसिर</option>
                                    <option value="9" <?php if($current_month =='09'){ echo 'selected';}?>>पुष</option>
                                    <option value="10" <?php if($current_month =='10'){ echo 'selected';}?>>माघ</option>
                                    <option value="11" <?php if($current_month =='11'){ echo 'selected';}?>>फाल्गुन</option>
                                    <option value="12" <?php if($current_month =='12'){ echo 'selected';}?>>चैत्र</option>
                                </select>
                              </td>
                              <td>
                                 <!--  <a href="<?php echo base_url()?>ExportData/NagadiDetails" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</a> </a> -->
                                 <button type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</button>
                              </td>
                          </tr>
                        </form>

                        <form action="<?php echo base_url()?>ExportData/ExportNagadiAmountDetails" method="post">
                          <tr>
                              <td class="p-name">
                                नगदी रशिद रकम विवरण
                              </td>
                             <td class="p-name">
                                  <select class="form-control" name="n_fiscal_year">
                                    <?php if(!empty($fiscal_year)){
                                      foreach ($fiscal_year as $key => $value) { ?>
                                        <option value="<?php echo $value['year']?>" <?php if($value['year'] ==current_fiscal_year()['year']){ echo 'selected';}?>><?php echo $value['year']?></option>
                                    <?php  }
                                    }?>
                                  </select>
                                </td>
                                <td class="p-name">
                                  <select class="form-control" name="n_month">
                                      <option value="1" <?php if($current_month =='01'){ echo 'selected';}?>>बैशाख</option>
                                    <option value="2" <?php if($current_month =='02'){ echo 'selected';}?>>जेठ</option>
                                    <option value="3" <?php if($current_month =='03'){ echo 'selected';}?>>असार</option>
                                    <option value="4" <?php if($current_month =='04'){ echo 'selected';}?>>श्रावण</option>
                                    <option value="5" <?php if($current_month =='05'){ echo 'selected';}?>>भदौ</option>
                                    <option value="6" <?php if($current_month =='06'){ echo 'selected';}?>>आश्विन</option>
                                    <option value="7" <?php if($current_month =='07'){ echo 'selected';}?>>कार्तिक</option>
                                    <option value="8" <?php if($current_month =='08'){ echo 'selected';}?>>मंसिर</option>
                                    <option value="9" <?php if($current_month =='09'){ echo 'selected';}?>>पुष</option>
                                    <option value="10" <?php if($current_month =='10'){ echo 'selected';}?>>माघ</option>
                                    <option value="11" <?php if($current_month =='11'){ echo 'selected';}?>>फाल्गुन</option>
                                    <option value="12" <?php if($current_month =='12'){ echo 'selected';}?>>चैत्र</option>
                                  </select>
                                </td>
                                <td>
                                    <!-- <a href="<?php echo base_url()?>ExportData/NagadiDetails" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</a> </a> -->
                                    <button type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</button>
                                </td>
                          </tr>
                        </form>

                        <form action="<?php echo base_url()?>ExportData/ExportnagadiCancelBills" method="post">
                          <tr>
                              <td class="p-name">
                                नगदी रशिद रद्द विवरण
                              </td>
                              <td class="p-name">
                                  <select class="form-control" name="n_fiscal_year">
                                    <?php if(!empty($fiscal_year)){
                                      foreach ($fiscal_year as $key => $value) { ?>
                                        <option value="<?php echo $value['year']?>" <?php if($value['year'] ==current_fiscal_year()['year']){ echo 'selected';}?>><?php echo $value['year']?></option>
                                    <?php  }
                                    }?>
                                  </select>
                                </td>
                                <td class="p-name">
                                  <select class="form-control" name="n_month">
                                     <option value="1" <?php if($current_month =='01'){ echo 'selected';}?>>बैशाख</option>
                                    <option value="2" <?php if($current_month =='02'){ echo 'selected';}?>>जेठ</option>
                                    <option value="3" <?php if($current_month =='03'){ echo 'selected';}?>>असार</option>
                                    <option value="4" <?php if($current_month =='04'){ echo 'selected';}?>>श्रावण</option>
                                    <option value="5" <?php if($current_month =='05'){ echo 'selected';}?>>भदौ</option>
                                    <option value="6" <?php if($current_month =='06'){ echo 'selected';}?>>आश्विन</option>
                                    <option value="7" <?php if($current_month =='07'){ echo 'selected';}?>>कार्तिक</option>
                                    <option value="8" <?php if($current_month =='08'){ echo 'selected';}?>>मंसिर</option>
                                    <option value="9" <?php if($current_month =='09'){ echo 'selected';}?>>पुष</option>
                                    <option value="10" <?php if($current_month =='10'){ echo 'selected';}?>>माघ</option>
                                    <option value="11" <?php if($current_month =='11'){ echo 'selected';}?>>फाल्गुन</option>
                                    <option value="12" <?php if($current_month =='12'){ echo 'selected';}?>>चैत्र</option>
                                  </select>
                                </td>
                                <td>
                                    <button type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</button>
                                </td>
                          </tr>
                        </form>

                        <form action="<?php echo base_url()?>ExportData/ExportProfileDetails" method="post">
                          <tr>
                              <td class="p-name">
                                 जग्गाधनी प्रोफाइल 
                              </td>
                              <td class="p-name">
                                  <select class="form-control" name="n_fiscal_year">
                                    <?php if(!empty($fiscal_year)){
                                      foreach ($fiscal_year as $key => $value) { ?>
                                        <option value="<?php echo $value['year']?>" <?php if($value['year'] ==current_fiscal_year()['year']){ echo 'selected';}?>><?php echo $value['year']?></option>
                                    <?php  }
                                    }?>
                                  </select>
                                </td>
                                <td class="p-name">
                                  <select class="form-control" name="n_month">
                                      <option value="1" <?php if($current_month =='01'){ echo 'selected';}?>>बैशाख</option>
                                    <option value="2" <?php if($current_month =='02'){ echo 'selected';}?>>जेठ</option>
                                    <option value="3" <?php if($current_month =='03'){ echo 'selected';}?>>असार</option>
                                    <option value="4" <?php if($current_month =='04'){ echo 'selected';}?>>श्रावण</option>
                                    <option value="5" <?php if($current_month =='05'){ echo 'selected';}?>>भदौ</option>
                                    <option value="6" <?php if($current_month =='06'){ echo 'selected';}?>>आश्विन</option>
                                    <option value="7" <?php if($current_month =='07'){ echo 'selected';}?>>कार्तिक</option>
                                    <option value="8" <?php if($current_month =='08'){ echo 'selected';}?>>मंसिर</option>
                                    <option value="9" <?php if($current_month =='09'){ echo 'selected';}?>>पुष</option>
                                    <option value="10" <?php if($current_month =='10'){ echo 'selected';}?>>माघ</option>
                                    <option value="11" <?php if($current_month =='11'){ echo 'selected';}?>>फाल्गुन</option>
                                    <option value="12" <?php if($current_month =='12'){ echo 'selected';}?>>चैत्र</option>
                                  </select>
                                </td>
                                <td>
                                    <button type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</button>
                                </td>
                          </tr>
                        </form>
                        <form action="<?php echo base_url()?>ExportData/ExportFamilyDetails" method="post">
                          <tr>
                              <td class="p-name">
                                जग्गाधनी पारिबारिक विवरण
                              </td>
                              <td class="p-name">
                                  <select class="form-control" name="n_fiscal_year">
                                    <?php if(!empty($fiscal_year)){
                                      foreach ($fiscal_year as $key => $value) { ?>
                                        <option value="<?php echo $value['year']?>" <?php if($value['year'] ==current_fiscal_year()['year']){ echo 'selected';}?>><?php echo $value['year']?></option>
                                    <?php  }
                                    }?>
                                  </select>
                                </td>
                                <td class="p-name">
                                  <select class="form-control" name="n_month">
                                      <option value="1" <?php if($current_month =='01'){ echo 'selected';}?>>बैशाख</option>
                                    <option value="2" <?php if($current_month =='02'){ echo 'selected';}?>>जेठ</option>
                                    <option value="3" <?php if($current_month =='03'){ echo 'selected';}?>>असार</option>
                                    <option value="4" <?php if($current_month =='04'){ echo 'selected';}?>>श्रावण</option>
                                    <option value="5" <?php if($current_month =='05'){ echo 'selected';}?>>भदौ</option>
                                    <option value="6" <?php if($current_month =='06'){ echo 'selected';}?>>आश्विन</option>
                                    <option value="7" <?php if($current_month =='07'){ echo 'selected';}?>>कार्तिक</option>
                                    <option value="8" <?php if($current_month =='08'){ echo 'selected';}?>>मंसिर</option>
                                    <option value="9" <?php if($current_month =='09'){ echo 'selected';}?>>पुष</option>
                                    <option value="10" <?php if($current_month =='10'){ echo 'selected';}?>>माघ</option>
                                    <option value="11" <?php if($current_month =='11'){ echo 'selected';}?>>फाल्गुन</option>
                                    <option value="12" <?php if($current_month =='12'){ echo 'selected';}?>>चैत्र</option>
                                  </select>
                                </td>
                                <td>
                                    <button type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</button>
                                </td>
                          </tr>
                        </form>
                        <form action="<?php echo base_url()?>ExportData/ExportLandDetails" method="post">
                          <tr>
                              <td class="p-name">
                                जग्गाको विवरण 
                              </td>
                              <td class="p-name">
                                  <select class="form-control" name="n_fiscal_year">
                                    <?php if(!empty($fiscal_year)){
                                      foreach ($fiscal_year as $key => $value) { ?>
                                        <option value="<?php echo $value['year']?>" <?php if($value['year'] ==current_fiscal_year()['year']){ echo 'selected';}?>><?php echo $value['year']?></option>
                                    <?php  }
                                    }?>
                                  </select>
                                </td>
                                <td class="p-name">
                                  <select class="form-control" name="n_month">
                                     <option value="1" <?php if($current_month =='01'){ echo 'selected';}?>>बैशाख</option>
                                    <option value="2" <?php if($current_month =='02'){ echo 'selected';}?>>जेठ</option>
                                    <option value="3" <?php if($current_month =='03'){ echo 'selected';}?>>असार</option>
                                    <option value="4" <?php if($current_month =='04'){ echo 'selected';}?>>श्रावण</option>
                                    <option value="5" <?php if($current_month =='05'){ echo 'selected';}?>>भदौ</option>
                                    <option value="6" <?php if($current_month =='06'){ echo 'selected';}?>>आश्विन</option>
                                    <option value="7" <?php if($current_month =='07'){ echo 'selected';}?>>कार्तिक</option>
                                    <option value="8" <?php if($current_month =='08'){ echo 'selected';}?>>मंसिर</option>
                                    <option value="9" <?php if($current_month =='09'){ echo 'selected';}?>>पुष</option>
                                    <option value="10" <?php if($current_month =='10'){ echo 'selected';}?>>माघ</option>
                                    <option value="11" <?php if($current_month =='11'){ echo 'selected';}?>>फाल्गुन</option>
                                    <option value="12" <?php if($current_month =='12'){ echo 'selected';}?>>चैत्र</option>
                                  </select>
                                </td>
                                <td>
                                    <button type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</button>
                                </td>
                          </tr>
                        </form>
                        <form action="<?php echo base_url()?>ExportData/ExportSanrachanaDetails" method="post">
                          <tr>
                              <td class="p-name">
                                भोतिक संरचनाको विवरण 
                              </td>
                              <td class="p-name">
                                  <select class="form-control" name="n_fiscal_year">
                                    <?php if(!empty($fiscal_year)){
                                      foreach ($fiscal_year as $key => $value) { ?>
                                        <option value="<?php echo $value['year']?>" <?php if($value['year'] ==current_fiscal_year()['year']){ echo 'selected';}?>><?php echo $value['year']?></option>
                                    <?php  }
                                    }?>
                                  </select>
                                </td>
                                <td class="p-name">
                                  <select class="form-control" name="n_month">
                                      <option value="1" <?php if($current_month =='01'){ echo 'selected';}?>>बैशाख</option>
                                    <option value="2" <?php if($current_month =='02'){ echo 'selected';}?>>जेठ</option>
                                    <option value="3" <?php if($current_month =='03'){ echo 'selected';}?>>असार</option>
                                    <option value="4" <?php if($current_month =='04'){ echo 'selected';}?>>श्रावण</option>
                                    <option value="5" <?php if($current_month =='05'){ echo 'selected';}?>>भदौ</option>
                                    <option value="6" <?php if($current_month =='06'){ echo 'selected';}?>>आश्विन</option>
                                    <option value="7" <?php if($current_month =='07'){ echo 'selected';}?>>कार्तिक</option>
                                    <option value="8" <?php if($current_month =='08'){ echo 'selected';}?>>मंसिर</option>
                                    <option value="9" <?php if($current_month =='09'){ echo 'selected';}?>>पुष</option>
                                    <option value="10" <?php if($current_month =='10'){ echo 'selected';}?>>माघ</option>
                                    <option value="11" <?php if($current_month =='11'){ echo 'selected';}?>>फाल्गुन</option>
                                    <option value="12" <?php if($current_month =='12'){ echo 'selected';}?>>चैत्र</option>
                                  </select>
                                </td>
                                <td>
                                    <button type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</button>
                                </td>
                          </tr>
                        </form>
                        <form action="<?php echo base_url()?>ExportData/ExportBDetails" method="post">
                          <tr>
                              <td class="p-name">
                                बक्यौता विवरण
                              </td>
                              <td class="p-name">
                                  <select class="form-control" name="n_fiscal_year">
                                    <?php if(!empty($fiscal_year)){
                                      foreach ($fiscal_year as $key => $value) { ?>
                                        <option value="<?php echo $value['year']?>" <?php if($value['year'] ==current_fiscal_year()['year']){ echo 'selected';}?>><?php echo $value['year']?></option>
                                    <?php  }
                                    }?>
                                  </select>
                                </td>
                                <td class="p-name">
                                  <select class="form-control" name="n_month">
                                    <option value="1" <?php if($current_month =='01'){ echo 'selected';}?>>बैशाख</option>
                                    <option value="2" <?php if($current_month =='02'){ echo 'selected';}?>>जेठ</option>
                                    <option value="3" <?php if($current_month =='03'){ echo 'selected';}?>>असार</option>
                                    <option value="4" <?php if($current_month =='04'){ echo 'selected';}?>>श्रावण</option>
                                    <option value="5" <?php if($current_month =='05'){ echo 'selected';}?>>भदौ</option>
                                    <option value="6" <?php if($current_month =='06'){ echo 'selected';}?>>आश्विन</option>
                                    <option value="7" <?php if($current_month =='07'){ echo 'selected';}?>>कार्तिक</option>
                                    <option value="8" <?php if($current_month =='08'){ echo 'selected';}?>>मंसिर</option>
                                    <option value="9" <?php if($current_month =='09'){ echo 'selected';}?>>पुष</option>
                                    <option value="10" <?php if($current_month =='10'){ echo 'selected';}?>>माघ</option>
                                    <option value="11" <?php if($current_month =='11'){ echo 'selected';}?>>फाल्गुन</option>
                                    <option value="12" <?php if($current_month =='12'){ echo 'selected';}?>>चैत्र</option>
                                  </select>
                                </td>
                                <td>
                                    <button type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</button>
                                </td>
                          </tr>
                        </form>
                        <form action="<?php echo base_url()?>ExportData/ExportSampatiKarDetails" method="post">
                        <tr>
                            <td class="p-name">
                              सम्पतिकर/भूमिकर नगदी रसिद
                            </td>
                            <td class="p-name">
                                <select class="form-control" name="n_fiscal_year">
                                  <?php if(!empty($fiscal_year)){
                                    foreach ($fiscal_year as $key => $value) { ?>
                                      <option value="<?php echo $value['year']?>" <?php if($value['year'] ==current_fiscal_year()['year']){ echo 'selected';}?>><?php echo $value['year']?></option>
                                  <?php  }
                                  }?>
                                </select>
                              </td>
                              <td class="p-name">
                                <select class="form-control" name="n_month">
                                   <option value="1" <?php if($current_month =='01'){ echo 'selected';}?>>बैशाख</option>
                                    <option value="2" <?php if($current_month =='02'){ echo 'selected';}?>>जेठ</option>
                                    <option value="3" <?php if($current_month =='03'){ echo 'selected';}?>>असार</option>
                                    <option value="4" <?php if($current_month =='04'){ echo 'selected';}?>>श्रावण</option>
                                    <option value="5" <?php if($current_month =='05'){ echo 'selected';}?>>भदौ</option>
                                    <option value="6" <?php if($current_month =='06'){ echo 'selected';}?>>आश्विन</option>
                                    <option value="7" <?php if($current_month =='07'){ echo 'selected';}?>>कार्तिक</option>
                                    <option value="8" <?php if($current_month =='08'){ echo 'selected';}?>>मंसिर</option>
                                    <option value="9" <?php if($current_month =='09'){ echo 'selected';}?>>पुष</option>
                                    <option value="10" <?php if($current_month =='10'){ echo 'selected';}?>>माघ</option>
                                    <option value="11" <?php if($current_month =='11'){ echo 'selected';}?>>फाल्गुन</option>
                                    <option value="12" <?php if($current_month =='12'){ echo 'selected';}?>>चैत्र</option>
                                </select>
                              </td>
                              <td>
                                  <button type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</button>
                              </td>
                        </tr>
                        </form>
                      </tbody>
                  </table>
                </div>
              </div>
            </section>
          </div>
        </div>
        <!-- page end-->
    </section>
</section>
    
   