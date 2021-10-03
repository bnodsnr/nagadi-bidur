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
        <section class="card">
          <!-- <header class="card-header" style="background: #1b5693;color:#FFF">
              <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                  <li class="nav-item">
                      <a class="nav-link  btn btn-warning" href="<?php echo base_url()?>Report/DailyReport">दैनिक रिपोर्ट</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link  btn btn-warning active"href="<?php echo base_url()?>Report/MonthlyReport" >मासिक रिपोर्ट </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link  btn btn-warning"  href="<?php echo base_url()?>Report/Search" >रिपोर्ट खोज्नुहोस</a>
                  </li>   
              </ul>
          </header> -->
          <div class="card-body">
            <div class="tab-content tasi-tab" id="myTabContent">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                          <label>चालु आ व.</label>
                          <div class="iconic-input right">
                            <select class="form-control" id= "fiscal_year">
                              <?php if(!empty($fiscal_year)) : foreach($fiscal_year as $fy) : ?>
                                <option value="<?php echo $fy['year'];?>" <?php if($fy['year'] == current_fiscal_year()){ echo 'selected';}?> ><?php echo $fy['year']?></option>
                              <?php endforeach;endif;?>
                            </select>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-<?php if($this->session->userdata('PRJ_USER_WARD')!=0 && $this->session->userdata('PRJ_USER_ID')!= 1){ echo '4';} else {echo '3';}?>">
                      <div class="form-group">
                        <label>देखि मिति</label>
                        <div class="iconic-input right">
                          <i class="fa fa-calendar f14" style="color:red"></i>
                          <input type="text" class="form-control"  name="from_date" id="from_date" value="" autocomplete="off">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-<?php if($this->session->userdata('PRJ_USER_WARD')!=0 && $this->session->userdata('PRJ_USER_ID')!= 1){ echo '4';} else {echo '3';}?>">
                      <div class="form-group">
                        <label>सम्म मिति</label>
                        <div class="iconic-input right">
                          <i class="fa fa-calendar f14" style="color:red"></i>
                          <input type="text" class="form-control"  name="to_date" id="to_date" value="" autocomplete="off">
                        </div>
                      </div>
                    </div>

                    <?php if($this->session->userdata('PRJ_USER_WARD') == '0') { ?>
                    <div class="col-md-2">
                      <label>वार्ड</label>
                      <select class="form-control" id="monthly_ward_no">
                        <option value=""></option>
                        <?php if(!empty($wards)) :
                          foreach ($wards as $key => $ward) : ?>
                            <option value="<?php if($ward['ward'] == '0'){echo 'palika';} else { echo $ward['ward']; }?>"
                              
                              ><?php 
                              if($ward['ward'] == '0'){ echo 'नगरपालिका';
                            } else { echo 'वडा नं '.$this->mylibrary->convertedcit($ward['ward']);}?></option>
                        <?php endforeach;endif;?>
                      </select>
                    </div>
                    <?php } ?>
                    <div class="col-md-2">
                      <button class="btn btn-danger admin-monthly-search" style="margin-top:21px" title=" रिपोर्ट प्रिन्ट खोज्नुहोस" alt="रिपोर्ट प्रिन्ट खोज्नुहोस"><i class="fa fa-search"></i> खोज्नुहोस </button>
                     
                    </div>
                  </div>
                  <hr>
                  <div class = "search_monthly_report">
                    <h2 class="text-center"><b> मासिक कर सङ्कलन रिपोर्ट महिना: <?php echo getNepaliMonthName(get_current_month())?> <b>

                       <!-- <a href="<?php //echo base_url()?>MonthlyReport/viewOverAllDetails" class="btn btn-warning btn-sm pull-right " style="margin-left: 5px;" title="मासिक रिपोर्ट पुरा विवरण" alt="मासिक रिपोर्ट पुरा विवरण" target="_blank"> <i class="fa fa-info-circle"></i> रसिदको विवरण हेर्नुहोस</a> -->

                      <a href="<?php echo base_url()?>MonthlyReport/printMonthlyReport/" class="btn btn-info btn-sm pull-right" style="" title="मासिक रिपोर्ट प्रिन्ट गर्नुहोस" alt="मासिक रिपोर्ट प्रिन्ट गर्नुहोस" target = "_blank"><i class="fa fa-print"></i> रिपोर्ट प्रिन्ट गर्नुहोस</a>
                    </h2>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>सि.नं</th>
                          <th class="hidden-phone">शिर्षक नं  </th>
                          <th>आम्दानी शिर्षक</th>
                          <th class="hidden-phone">मुल्य रु</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>१</td>
                          <td>११३१३</td>
                          <td>एकीकृत सम्पती कर</td>
                          <td><?php echo $this->mylibrary->convertedcit(number_format($sampati_kar['total'],2))?></td>
                          <td>
                           <!--  <a href="<?php //echo base_url()?>MonthlyReport/MonthlySampatiBhumiKarDetails" class="btn btn-warning" target="_blank">रसिदको विवरण हेर्नुहोस</a> -->
                          </td>
                        </tr>
                        <tr>
                          <td>२</td>
                          <td>११३१४</td>
                          <td>भुमिकर/मालपोत</td>
                          <td><?php echo $this->mylibrary->convertedcit(number_format($bhumi_kar['total'],2))?></td>
                          <td colspan="2">
                             <a href="<?php echo base_url()?>MonthlyReport/MonthlySampatiBhumiKarDetailsbyMonth" class="btn btn-warning" target="_blank">रसिदको विवरण हेर्नुहोस</a> 
                          </td>
                        </tr>
                        <?php if(!empty($main_topic)) : 
                          $i=2;
                          $nagadi_total = 0;
                          foreach($main_topic as $mt):
                            ?>
                            <tr>
                              <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                              <td><?php echo $this->mylibrary->convertedcit($mt['topic_no'])?></td>
                              <td><?php echo $mt['topic_name']?></td>
                              <?php
                                $collection_rate = $this->MonthlyReportMDL->NagadiMontlhy($mt['id']);
                  
                              ?>
                              <td><?php echo !empty($collection_rate['total'])?$this->mylibrary->convertedcit(number_format($collection_rate['total'],2)):$this->mylibrary->convertedcit(0)?></td>
                              <?php $nagadi_total += $collection_rate['total']?>
                              <td><a href="<?php echo base_url()?>MonthlyReport/viewMonthlyNagadiDetails/<?php echo $mt['id']?>" class="btn btn-warning" target="_blank">रसिदको विवरण हेर्नुहोस</a></td>
                            </tr>
                          <?php endforeach;endif;?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="3" align="right"><b>जम्मा</b></td>
                            <?php
                              $net_total = $nagadi_total + $sampati_kar['total'] + $bhumi_kar['total'];
                            ?>
                            <td colspan="2" align="left"><?php echo !empty($net_total)?$this->mylibrary->convertedcit(number_format($net_total,2)):$this->mylibrary->convertedcit(0)?></td>
                          </tr>
                        </tfoot>
                    </table>
                  </div>
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
    var mainInput = $("#from_date");
      mainInput.nepaliDatePicker({
      ndpYear: true,
      ndpMonth: true,
      ndpYearCount: 100
  });
    //entry_nisha_office
    var entry_nisha_date = $('#to_date')
    entry_nisha_date.nepaliDatePicker({
      ndpYear: true,
      ndpMonth: true,
      ndpYearCount: 100
    });
   
    var date = "<?php echo convertDate(date('Y-m-d'))?>";
    $('#nepaliDateD').nepaliDatePicker({});
    $('.nepali-calendar').nepaliDatePicker({});
      $(document).on('click', '.admin-monthly-search', function(){
        var obj = $(this);
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var ward = $('#monthly_ward_no').val();
        var fiscal_year = $('#fiscal_year').val();
        $.ajax({
          url:"<?php echo base_url()?>MonthlyReport/AdminMonthlyReport",
          method:"POST",
          data:{from_date:from_date,to_date:to_date,ward:ward,fiscal_year:fiscal_year,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
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