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
                            <!-- <th>आर्थिक वर्ष</th>
                            <th>महिना</th> -->
                            <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td class="p-name">
                                नगदी रशिद विवरण
                              </td>
                              <td>
                               <!--  <button type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</button> -->
                               <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>ImportData/NagadiDetails">आयात गर्नुहोस्</button>
                              </td>
                          </tr>
                          <tr>
                              <td class="p-name">
                                नगदी रशिद रकम विवरण
                              </td>
                            
                                <td>
                                    <!-- <a href="<?php echo base_url()?>ExportData/NagadiDetails" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</a> </a> -->
                                   <!--  <button type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm">निर्यात गर्नुहोस्</button> -->
                                    <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>ImportData/NagadiAmountDetails">आयात गर्नुहोस्</button>
                                </td>
                          </tr>
                          <tr>
                              <td class="p-name">
                                नगदी रशिद रद्द विवरण
                              </td>
                             
                                <td>
                                    <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>ImportData/NagadiCancelBills">आयात गर्नुहोस्</button>
                                </td>
                          </tr>
                          <tr>
                              <td class="p-name">
                                 जग्गाधनी प्रोफाइल 
                              </td>
                              
                                <td>
                                    <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>ImportData/ProfileDetails">आयात गर्नुहोस्</button>
                                </td>
                          </tr>
                       
                          <tr>
                              <td class="p-name">
                                जग्गाधनी पारिबारिक विवरण
                              </td>
                             
                                <td>
                                    <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>ImportData/FamailyDetails">आयात गर्नुहोस्</button>
                                </td>
                          </tr>
                          <tr>
                              <td class="p-name">
                                जग्गाको विवरण 
                              </td>
                              
                                <td>
                                    <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>ImportData/LandDetails">आयात गर्नुहोस्</button>
                                </td>
                          </tr>
                          <tr>
                              <td class="p-name">
                                भोतिक संरचनाको विवरण 
                              </td>
                              
                                <td>
                                    <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>ImportData/SanrachanaDetails">आयात गर्नुहोस्</button>
                                </td>
                          </tr>
                       
                          <tr>
                              <td class="p-name">
                                बक्यौता विवरण
                              </td>
                              
                                <td>
                                    <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>ImportData/BDetails">आयात गर्नुहोस्</button>
                                </td>
                          </tr>
                       
                        <tr>
                            <td class="p-name">
                              सम्पतिकर/भूमिकर नगदी रसिद
                            </td>
                           
                              <td>
                                 <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>ImportData/SampatiKarDetails">आयात गर्नुहोस्</button>

                              </td>
                        </tr>
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
    
   