 <!--main content start-->

 <section id="main-content">

  <section class="wrapper site-min-height">

    <nav aria-label="breadcrumb">

      <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>

        </li>

        <li class="breadcrumb-item"><a href="javascript:;">दैनिक रिपोर्ट</a></li> 

        <li class="breadcrumb-item"><a href="javascript:;">मासिक रिपोर्ट</a></li> 

        <li class="breadcrumb-item"><a href="javascript:;">रिपोर्ट खोज्नुहोस</a></li> 

      </ol>

    </nav>

    <!-- page start-->

    <div class="row">

      <div class="col-sm-12">

        <?php $success_message = $this->session->flashdata("MSG_SUCCESS");

                      if(!empty($success_message)) { ?>

        <div class="alert alert-success">

          <button class="close" data-close="alert"></button>

          <span> <?php echo $success_message;?> </span>

        </div>

        <?php } ?>

        <section class="card">
          <header class="card-header" 
          >
            <h3 class=""> मासिक  कर सङ्कलन रिपोर्ट </h3>
              <!-- <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">

                  <li class="nav-item">
                      <a class="nav-link  btn btn-warning" href="<?php //echo base_url()?>Report/DailyReport" r>दैनिक रिपोर्ट</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link  btn btn-warning active"href="<?php //echo base_url()?>MonthlyReport" >मासिक रिपोर्ट </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link  btn btn-warning"  href="<?php //echo base_url()?>Report/Search" >रिपोर्ट खोज्नुहोस</a>
                  </li>

                 

              </ul> -->

          </header>

          <div class="card-body">

            <!-- <div class="tab-content tasi-tab" id="myTabContent"> -->

               <!--  <div class="row">

                    <div class="col-md-12">

                     

                      </div>

                    </div> -->

                  <!-- </div> -->

                  <div class="row">

                    <div class="col-md-3">
                     <select class="form-control" id="fiscal_year">
                      <option value="">--आर्थिक वर्ष छानहोस-- </option>
                      <?php if(!empty($fiscal_year)) :
                        foreach($fiscal_year as $fy) : ?>
                          <option value="<?php echo $fy['year']?>"><?php echo $fy['year']?></option>
                        <?php endforeach;endif;?>
                      </select>
                    </div>

                    <div class="col-md-3">

                      <select class="form-control" id="month">

                        <option></option>

                        <option value="01" <?php if($current_month == '01'){echo 'selected';}?>>वैशाख</option>

                        <option value="02" <?php if($current_month == '02'){echo 'selected';}?>>ज्येष्ठ</option>

                        <option value="03" <?php if($current_month == '03'){echo 'selected';}?>>आषाढ</option>

                        <option value="04" <?php if($current_month == '04'){echo 'selected';}?>>श्रावण</option>

                        <option value="05" <?php if($current_month == '05'){echo 'selected';}?>>भाद्र</option>

                        <option value="06" <?php if($current_month == '06'){echo 'selected';}?>>आश्विन</option>

                        <option value="07" <?php if($current_month == '07'){echo 'selected';}?>>कार्तिक</option>

                        <option value="08" <?php if($current_month == '08'){echo 'selected';}?>>मार्ग</option>

                        <option value="09" <?php if($current_month == '09'){echo 'selected';}?>>पौष</option>

                        <option value="10" <?php if($current_month == '10'){echo 'selected';}?>>माघ</option>

                        <option value="11" <?php if($current_month == '11'){echo 'selected';}?>>फाल्गुन</option>

                        <option value="12" <?php if($current_month == '12'){echo 'selected';}?>>चैत्र</option>

                      </select>

                    </div>

                    <?php if($this->session->userdata('PRJ_USER_ID') ==  1) { ?>

                    <div class="col-md-3">

                      <select class="form-control" id="monthly_ward_no">

                          <option value=""></option>

                          <?php if(!empty($wards)) :

                            foreach ($wards as $key => $ward) : ?>

                              <option value="<?php echo $ward['ward']?>"

                                <?php if($this->session->userdata['PRJ_USER_WARD'] == $ward['ward']){

                                  echo 'selected';

                                } ?>



                                ><?php 

                                if($ward['ward'] == '0'){ echo 'नगरपालिका';

                              } else { echo 'वडा नं '.$this->mylibrary->convertedcit($ward['ward']);}?></option>

                            <?php endforeach;endif;?>

                        </select>

                    </div>

                    <?php } ?>

                    <div class="col-md-2">

                      <button class="btn btn-danger admin-monthly-search"><i class="fa fa-search"></i> खोज्नुहोस </button>

                    </div>

                  </div>

                  <hr>

                  <div class = "search_monthly_report">
                    <a href="<?php echo base_url()?>Report/MonthlyReport/viewMonthlyCollectionDetails" class="btn btn-warning" style=""> <i class="fa fa-eye"></i> विवरण हेर्नुहोस</a>

                    <a href="<?php echo base_url()?>Report/MonthlyReport/printMonthlyCollection/<?php echo $current_month?>/<?php echo $session_ward?>" class="btn btn-info" style="margin-right: 4px;"><i class="fa fa-print"></i> प्रिन्ट गर्नुहोस</a>
                    <hr>
                    <table class="table table-striped table-bordered">

                      <thead>

                        <tr>

                          <th>सि.नं</th>

                          <th>आम्दानी शिर्षक</th>

                          <th class="hidden-phone">शिर्षक नं  </th>

                          <th class="hidden-phone">मुल्य रु</th>

                          <th></th>

                        </tr>

                      </thead>

                      <tbody>

                        <?php if(!empty($main_topic)) : 

                          $i=1;

                          $nagadi_total = 0;

                          foreach($main_topic as $mt):

                            ?>

                            <tr>

                              <td><?php echo $this->mylibrary->convertedcit($i++)?></td>

                              <td><?php echo $mt['topic_name']?></td>

                              <td><?php echo $this->mylibrary->convertedcit($mt['topic_no'])?></td>

                              <?php

                              $collection_rate = $this->MonthlyReportmodel->MonthlyNagadiCollection($mt['id']);

                              ?>

                              <td><?php echo !empty($collection_rate['total'])?$this->mylibrary->convertedcit($collection_rate['total']):$this->mylibrary->convertedcit(0)?></td>

                              <?php $nagadi_total += $collection_rate['total']?>

                              <td><a href="<?php echo base_url()?>Report/MonthlyReport/printNagadiDetailsByTopic/<?php echo $mt['id'].'/'.$current_month.'/'.$session_ward?>" class="btn btn-warning" target ="_blank">विवरण हेर्नुहोस</a></td>

                            </tr>

                          <?php endforeach;endif;?>

                          <td>१०</td>

                          <td>सम्पति /भुमि कर </td>

                          <td>--</td>

                          <td><?php echo !empty($sampati_kar_bhumi['total'])?$this->mylibrary->convertedcit($sampati_kar_bhumi['total']):$this->mylibrary->convertedcit(0)?></td>



                          <td><a href="<?php echo base_url()?>Report/MonthlyReport/viewSampatiKarDetails/<?php echo $current_month.'/'.$session_ward?>" class="btn btn-warning">विवरण हेर्नुहोस</a></td>

                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="3" align="right"> जम्मा </td>
                            <?php
                              $net_total = $nagadi_total + $sampati_kar_bhumi['total'];
                            ?>

                            <td><?php echo !empty($net_total)?$this->mylibrary->convertedcit($net_total):$this->mylibrary->convertedcit(0)?>/-</td>

                          </tr>

                        </tfoot>

                    </table>

              </div>

            </div>

        </section>

      </div>

    </div>

    <!-- page end-->

  </section>

</section>

<script type="text/javascript" src="<?php echo base_url('assets/nepali_datepicker/nepali.datepicker.v2.2.min.js')?>"></script>

<script type="text/javascript">

  $(document).ready(function(){

    var date = "<?php echo convertDate(date('Y-m-d'))?>";

    $('#nepaliDateD').nepaliDatePicker({});

    $('.nepali-calendar').nepaliDatePicker({});



      $(document).on('click', '.admin-monthly-search', function(){

        var obj = $(this);

        var date = $('#month').val();

        var ward = $('#monthly_ward_no').val();
        var fiscal_year = $('#fiscal_year').val();
        alert(fiscal_year);

        $.ajax({

          url:"<?php echo base_url()?>Report/MonthlyReport/AdminMonthlyReport",

          method:"POST",

          data:{date:date,ward:ward,fiscal_year:fiscal_year,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},

          beforeSend: function () {

            obj.html('<i class="fa fa-spinner fa-spin"></i> <i class="fa fa-search"></i> खोज्नुहोस');

          },

          success:function(resp){

            if(resp.status == 'success') {

              $('.search_monthly_report').empty().html(resp.data);

              obj.html(' <i class="fa fa-search"></i> खोज्नुहोस');

            }

          }

        }); 

      });

    });

  </script>