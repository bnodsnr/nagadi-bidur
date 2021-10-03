 <!--main content start-->
 <section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>
        </li>
        <li class="breadcrumb-item"><a href="javascript:;">रिपोर्ट</a></li>
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
      
          <header class="card-header" style="background: #1b5693;color:#FFF">

              <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                  <li class="nav-item">
                      <a class="nav-link  active btn btn-warning"  href="<?php echo base_url()?>Report/DailyReport" >दैनिक रिपोर्ट</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link  btn btn-warning"  href="<?php echo base_url()?>MonthlyReport">मासिक रिपोर्ट </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link  btn btn-warning" id="contact-tab" href="<?php echo base_url()?>Report/Search" >रिपोर्ट खोज्नुहोस</a>
                  </li>
                 
              </ul>
          </header>
          <div class="card-body">
            <div class="tab-content tasi-tab" id="myTabContent">
                <div class="row">
                  <div class="col-md-12">
                    <div class="alert alert-info"><h3 class="text-center"> दैनिक कर सङ्कलन रिपोर्ट </h3>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" id="nepaliDateD" class="form-control nepali-calendar" value="<?php echo convertDate(date('Y-m-d'))?>"/>
                    </div>
                  </div>
                  <?php if($this->session->userdata('PRJ_USER_ID') == 1) { ?>
                    <div class="col-md-4">
                      <select class="form-control" id="daily_ward_no">
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
                        <button class="btn btn-danger admin-search"><i class="fa fa-search"></i> खोज्नुहोस </button>
                      </div>
                </div>
                <hr>
                <div class = "search_daily_report">
                  <a href="<?php echo base_url()?>Report/DailyReport/viewDailyCollectionDetails" class="btn btn-warning btn-sm pull-right" style=""> <i class="fa fa-eye"></i> विवरण हेर्नुहोस</a>
                  <a href="<?php echo base_url()?>Report/DailyReport/printDailyCollection/<?php echo $date?>/<?php echo $session_ward?>" class="btn btn-info btn-sm pull-right" style="margin-right: 4px;"><i class="fa fa-print"></i> प्रिन्ट गर्नुहोस</a>
                  <table class="print_table table table-stripe table-bordered">
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
                         <tr>
        <td>१</td>

    <td>सम्पति /भुमि कर </td>

    <td>११३१३/११३१४</td>
    <td><?php echo !empty($sampati_kar_bhumi['total'])?$this->mylibrary->convertedcit($sampati_kar_bhumi['total']):$this->mylibrary->convertedcit(0)?></td>
<td><a href="<?php echo base_url()?>Report/DailyReport/viewSampatiKarDetails/<?php echo $mt['id'].'/'.$date.'/'.$session_ward?>" class="btn btn-warning">विवरण हेर्नुहोस</a></td>
    </tr>
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
                            $collection_rate = $this->DailyReportModel->DailyNagadiCollection($mt['id']);
                            ?>
                            <td><?php echo !empty($collection_rate['total'])?$this->mylibrary->convertedcit($collection_rate['total']):$this->mylibrary->convertedcit(0)?></td>
                            <?php $nagadi_total += $collection_rate['total']?>
                            <td><a href="<?php echo base_url()?>Report/DailyReport/viewByTopic/<?php echo $mt['id'].'/'.$date?>" class="btn btn-warning">विवरण हेर्नुहोस</a></td>
                          </tr>
                        <?php endforeach;endif;?>
                      
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="3" style="text-align: right"> जम्मा </td>
                          <?php
                          $net_total = $nagadi_total + $sampati_kar_bhumi['total'];
                          ?>
                          <td colspan="" align="left"><?php echo !empty($net_total)?$this->mylibrary->convertedcit(round($net_total)):$this->mylibrary->convertedcit(0)?></td>
                          <td colspan="" align="left"></td>
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
    var date = "<?php echo convertDate(date('Y-m-d'))?>";
    $('#nepaliDateD').nepaliDatePicker({});
    $('.nepali-calendar').nepaliDatePicker({});
    $(document).on('click', '.admin-search', function(){

      var obj = $(this);
      var date = $('#nepaliDateD').val();
      var ward = $('#daily_ward_no').val();
      $.ajax({
        url:"<?php echo base_url()?>Report/DailyReport/AdminDailyReport",
        method:"POST",
        data:{date:date,ward:ward,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        beforeSend: function () {
          obj.html('<i class="fa fa-spinner fa-spin"></i> <i class="fa fa-search"></i> खोज्नुहोस');
        },
        success:function(resp){
          if(resp.status == 'success') {
            $('.search_daily_report').empty().html(resp.data);
            obj.html(' <i class="fa fa-search"></i> खोज्नुहोस');
          }
        }
      }); 
    });
    
  });
</script>