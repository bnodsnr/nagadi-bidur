 <!--main content start-->
 <section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>
        </li>
        <li class="breadcrumb-item"><a href="">शिर्षकगत रिपोर्ट</a></li>
      </ol>
    </nav>
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
        <section class="card">
            <header class="card-header">
              <div class="row">
                <div class="col-md-3">
                 <select class="form-control search_added_ward" style="width:300px;" id="ward_no">
                  <option value="">वडा छानुहोस</option>
                  <?php if(!empty($wards)) : 
                    foreach ($wards as $key => $ward) : ?>
                      <option value="<?php echo $ward['ward']?>"><?php 
                      if($ward['ward'] == '0') {
                        echo 'पालिका';
                      } else {
                        echo $this->mylibrary->convertedcit($ward['ward']);
                      }
                      ?></option>
                    <?php endforeach;endif;?>
                  </select>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                     <input type="text" id="from_date" class="form-control nepali-calendar" value="" placeholder="देखी मिति " />
                    <div class="input-group-prepend">
                      <button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar"></i></button>
                    </div>
                  </div> 
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <input type="text" id="to_date" class="form-control nepali-calendar" value="" placeholder="सम्म मिति" />
                    <div class="input-group-prepend">
                      <button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar"></i></button>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="">
                    <button type="button" class="btn btn-warning" title="खोजी गर्नुहोस्" id="filter"><i class="fa fa-search"></i> खोजी गर्नुहोस्</button>
                  </div>
                </div>
              </div>
              </span>
            </header>
            <div class="card-body">
              <div class="search_div">
                 <?php if(!empty($titles)) : 
                      foreach($titles as $key => $maintopic):?>
                      <div class="chat-room">
                        <aside class="mid-side">
                            <div class="chat-room-head">
                                <h3><?php echo $this->mylibrary->convertedcit($maintopic->topic_no).'-'.$maintopic->topic_name?></h3>
                            </div>
                            <?php if(!empty($maintopic->children)) : 
                              foreach ($maintopic->children as $key => $subtopic) : ?>
                                <div class="room-desk">
                                  <h2 class="pull-left"><?php echo $this->mylibrary->convertedcit($key+1).'-'.$subtopic->sub_topic?></h2>
                                <div class="room-box">
                                <?php $topic_rates = $this->NagadiTitleWiseReportModel->getTopicRate($subtopic->id); ?>
                                 <?php if(!empty($topic_rates)) : ?>
                                    <table class="table table-bordered print_table" id="">
                                      <thead style="background:#1b5693;color:#fff">
                                        <tr>
                                          <th>#</th>
                                          <th>शिर्षक</th>
                                          <th>रकम</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php 
                                        $total_sum = 0;
                                        foreach($topic_rates as $key => $value) :  
                                          $sum = $this->NagadiTitleWiseReportModel->getMonthlySum($value->id);
                                        ?>
                                        <tr>
                                          <td><?php echo $this->mylibrary->convertedcit($key+1)?></td>
                                          <td><?php echo $value->topic_title?></td>
                                          <td><?php echo $this->mylibrary->convertedcit(!empty($sum->total) ? $sum->total:'0');?></td>
                                          <?php $total_sum += $sum->total; ?>
                                        </tr>
                                        <?php endforeach;?>
                                      </tbody>
                                      <tfoot>
                                        <tr style="background-color: #1b5693;color:#fff">
                                          <td colspan="2" align="right">जम्मा </td>
                                          <td><?php echo $this->mylibrary->convertedcit($total_sum)?></td>
                                        </tr>
                                      </tfoot>
                                    </table>
                                  <?php endif;?>
                                </div>
                              </div>
                            <?php endforeach;endif;?>
                        </aside>
                      </div>  
                 <?php endforeach;endif;?>
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
  $(document).ready(function() {
    var date = "<?php echo convertDate(date('Y-m-d'))?>";
    $('#nepaliDateD').nepaliDatePicker({});
    $('.nepali-calendar').nepaliDatePicker({});
      $(document).on('click', '#filter', function(){
        var obj = $(this);
        var from_date = $('#from_date').val();
        var to_date  = $('#to_date').val();
        var search_added_ward = $('.search_added_ward').val();
        var user_id = $('#user_id').val();
        $.ajax({
          method:"POST",
          url:"<?php echo base_url()?>NagadiTitleWiseReport/Search",
          data:{
            from_date:from_date,
            to_date:to_date,
            search_added_ward:search_added_ward,
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          },
           beforeSend: function () {
            obj.html('<i class="fa fa-spinner fa-spin"></i> <i class="fa fa-search"></i> खोज्नुहोस');
          },
          success:function(resp){
            if(resp.status == 'success') {
              $('.search_div').empty().html(resp.data);
              obj.html(' <i class="fa fa-search"></i> खोज्नुहोस');
            }
          }
        });
      });
    });
  </script>