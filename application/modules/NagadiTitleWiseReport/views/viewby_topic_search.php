<style type="text/css">
  .print_table {
        width: 100%;
        border: solid 1px #FFF;
        border-collapse: collapse;
    }
    .print_table th{
        border-color: black;
        font-size: 12px;
        border: solid 1px;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        background-color:#407ac5;
        color: #FFF;
    }
    .print_table td{
        font-size: 14px;
        margin: 0;
        padding: 0;
    }
    .print_table tr:nth-child(odd){
        background-color:#FFF;
        color: #000;
    }
    .print_table tr:nth-child(even){
        background-color:#FFF;
        color: #000;
    }
</style>

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
            <div class="card-body">
              <div class="search_div">
                <div class="chat-room">
                  <h2 class="text-center"><?php echo $this->mylibrary->convertedcit($titles[0]->topic_no).'-'.$titles[0]->topic_name?> रिपोर्ट (<?php if($from_date !='00' && $to_date !='00'){echo $this->mylibrary->convertedcit($from_date).' देखि '.$this->mylibrary->convertedcit($to_date).' सम्म';}?>)
                    <a href="<?php echo base_url()?>NagadiTitleWiseReport/printDetailsByTopicIdSearch/<?php echo $titles[0]->id?>/<?php echo $from_date?>/<?php echo $to_date?>/<?php echo $ward_no?>" class="btn btn-info btn-sm pull-right" title="मासिक शिर्षकगत रिपोर्ट विवरण" alt="मासिक शिर्षकगत रिपोर्ट विवरण" target="_blank"><i class="fa fa-print"></i> प्रिन्ट गर्नुहोस</a>
                  </h2>
                  <table class="table table-bordered print_table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>शिर्षक नं </th>
                        <th>आम्दानी शिर्षक</th>
                        <th>सह शिर्षक</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $total_nagadi = 0;
                      $i= 2;if(!empty($titles)) :
                      foreach ($titles as $key => $maintopic) : ?>
                        <tr>
                          <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                          <td><?php echo $this->mylibrary->convertedcit($maintopic->topic_no)?></td>
                          <td><?php echo $maintopic->topic_name?></td>
                          <td>
                            <table class="print_table">
                              <thead>
                                <tr>
                                 <td>शिर्षक</td>
                                 <td>मूल्य रु</td>
                               </tr>
                             </thead>
                             <tbody>
                              <?php $total_sum =0;if(!empty($maintopic->children)) : 
                                foreach ($maintopic->children as $key => $subtopic) :
                                  $sum = $this->NagadiTitleWiseReportModel->getMonthlySearchNagadi($subtopic->id,$from_date,$to_date,$ward_no);
                                  $total_sum += $sum->total;
                                  ?>
                                  <tr>
                                   <td><?php echo $subtopic->sub_topic?></td>
                                   <td><?php echo $this->mylibrary->convertedcit(!empty($sum->total) ? round($sum->total):'0');?></td>
                                 </tr>
                               <?php endforeach;endif;?>
                             </tbody>
                             <tfooter>
                               <tr>
                                <td colspan="" align="right">जम्मा </td>
                                <td><?php echo $this->mylibrary->convertedcit(round($total_sum))?></td>
                               </tr>
                             </tfooter>
                           </table>
                         </td>
                         <td><a href="<?php echo base_url()?>NagadiTitleWiseReport/MonthlyBillDetailsByMainTopicBySearch/<?php echo $maintopic->id?>/<?php echo $from_date?>/<?php echo $to_date?>/<?php echo $ward_no?>" class="btn btn-warning">विवरण हेर्नुहोस्</a></td>
                         <?php $total_nagadi += $total_sum;?>
                       </tr>
                     <?php endforeach;endif;?>
                      <?php $net_total = $total_nagadi?>
                     <tr>
                      <td colspan="3" align="right">कुल जम्मा</td>
                      <td align="right"><?php echo $this->mylibrary->convertedcit(round($net_total))?></td>
                      <td></td>
                     </tr>
                   </tbody>
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