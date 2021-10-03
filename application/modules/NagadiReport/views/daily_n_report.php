<!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item"><a href="javascript:;">दैनिक नगदि स .्कलन </a></li>
              </ol>
            </nav>
              <!-- page start-->
              <div class="row">
                <div class="col-sm-12">
                  <section class="card" style="margin-bottom: -25px;">
                      <header class="card-header" style="background: #1b5693;color:#FFF">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="input-group">
                              <input type="text" id="nepaliDateD" class="form-control nepali-calendar" value="<?php echo convertDate(date('Y-m-d'))?>"/>
                              <div class="input-group-prepend">
                                <button type="button" class="input-group-text btn btn-danger btn-search" title="">खोज्नुहोस  </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </header>
                      <div class="card-body">
                        <div class="adv-table">
                          <table class=" table table-bordered" id="hidden-table-info">
                            <thead>
                              <tr>
                                <th>सि.नं</th>
                                <th>आम्दानी शिर्षक</th>
                                <th class="hidden-phone">शिर्षक नं  </th>
                                <th class="hidden-phone">नगरपालिका</th>
                                <th class="hidden-phone">वडा १</th>
                                <th class="hidden-phone">वडा २</th>
                                <th class="hidden-phone">वडा ३</th>
                                <th class="hidden-phone">वडा ४</th>
                                <th class="hidden-phone">वडा ५</th>
                                <th class="hidden-phone">वडा ६</th>
                                <th class="hidden-phone">वडा ७</th>
                                <th class="hidden-phone">वडा ८</th>
                                <th class="hidden-phone">वडा ९</th>
                                <th class="hidden-phone">वडा १०</th>
                                <th class="hidden-phone">वडा ११</th>
                                <th class="hidden-phone">वडा १२</th>
                                <th class="hidden-phone">वडा १३</th>
                                <th class="hidden-phone">जम्मा रु:</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(!empty($main_topic)) : 
                                $i=1; foreach($main_topic as $mt):
                                ?>
                                <td><?php echo $this->mylibrary->convertedcit($i)?></td>
                                <td><?php echo $mt['topic_name']?></td>
                                <td><?php echo $this->mylibrary->convertedcit($mt['topic_no'])?></td>
                                <?php
                                  $date = convertDate(date('Y-m-d'));
                                  $ward_0 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'], '0',$date);
                                 //print_r($war_0);
                                  $ward_1 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'], '1',$date);
                                  $ward_2 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'], '2',$date);
                                  $ward_3 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'],'3',$date);
                                  $ward_4 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'],'4',$date);
                                  $ward_5 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'],'5',$date);
                                  $ward_6 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'],'6',$date);
                                  $ward_7 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'],'7',$date);
                                  $ward_8 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'],'8',$date);
                                  $ward_9 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'],'9',$date);
                                  $ward_10 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'],'10',$date);
                                  $ward_11 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'],'11',$date);
                                  $ward_12 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'],'12',$date);
                                  $ward_13 = $this->Reportmodel->getNagadiTotalByTopicD($mt['id'],'13',$date);
                                  $total_byMt = $this->Reportmodel->getNagadiTotalByMTD($mt['id'], $date);
                                ?>
                                <td><?php echo !empty($ward_0->total)?$this->mylibrary->convertedcit(number_format($ward_0->total)):$this->mylibrary->convertedcit(0)?></td>
                                <td><?php echo !empty($ward_1->total)?$this->mylibrary->convertedcit(number_format($ward_1->total)):$this->mylibrary->convertedcit(0) ?></td>
                                <td><?php echo !empty($ward_2->total)?$this->mylibrary->convertedcit(number_format($ward_2->total)):$this->mylibrary->convertedcit(0) ?></td>
                                <td><?php echo !empty($ward_3->total)?$this->mylibrary->convertedcit(number_format($ward_2->total)):$this->mylibrary->convertedcit(0) ?></td>
                                <td><?php echo !empty($ward_4->total)?$this->mylibrary->convertedcit(number_format($ward_4->total)):$this->mylibrary->convertedcit(0) ?></td>
                                <td><?php echo !empty($ward_5->total)?$this->mylibrary->convertedcit(number_format($ward_5->total)):$this->mylibrary->convertedcit(0) ?></td>
                                <td><?php echo !empty($ward_6->total)?$this->mylibrary->convertedcit(number_format($ward_6->total)):$this->mylibrary->convertedcit(0) ?></td>
                                <td><?php echo !empty($ward_7->total)?$this->mylibrary->convertedcit(number_format($ward_7->total)):$this->mylibrary->convertedcit(0) ?></td>
                                <td><?php echo !empty($ward_8->total)?$this->mylibrary->convertedcit(number_format($ward_8->total)):$this->mylibrary->convertedcit(0) ?></td>
                                <td><?php echo !empty($ward_9->total)?$this->mylibrary->convertedcit(number_format($ward_9->total)):$this->mylibrary->convertedcit(0) ?></td>
                                <td><?php echo !empty($ward_10->total)?$this->mylibrary->convertedcit(number_format($ward_10->total)):$this->mylibrary->convertedcit(0) ?></td>
                                <td><?php echo !empty($ward_11->total)?$this->mylibrary->convertedcit(number_format($ward_11->total)):$this->mylibrary->convertedcit(0) ?></td>
                                <td><?php echo !empty($ward_12->total)?$this->mylibrary->convertedcit(number_format($ward_12->total)):$this->mylibrary->convertedcit(0) ?></td>
                                <td><?php echo !empty($ward_13->total)?$this->mylibrary->convertedcit(number_format($ward_12->total)):$this->mylibrary->convertedcit(0) ?></td>
                                <td><?php echo !empty($total_byMt->total)?$this->mylibrary->convertedcit(number_format($total_byMt->total)):$this->mylibrary->convertedcit(0) ?></td>
                              </tbody>
                              <?php $i++; endforeach; endif;?>
                              <tfoot>
                                <tr>

                                  <?php
                                    $sward_0 = $this->Reportmodel->getNagadiTotalByWardD( '0',$date);
                                    $sward_1 = $this->Reportmodel->getNagadiTotalByWardD( '1',$date);
                                    $sward_2 = $this->Reportmodel->getNagadiTotalByWardD( '2',$date);
                                    $sward_3 = $this->Reportmodel->getNagadiTotalByWardD('3',$date);
                                    $sward_4 = $this->Reportmodel->getNagadiTotalByWardD('4',$date);
                                    $sward_5 = $this->Reportmodel->getNagadiTotalByWardD('5',$date);
                                    $sward_6 = $this->Reportmodel->getNagadiTotalByWardD('6',$date);
                                    $sward_7 = $this->Reportmodel->getNagadiTotalByWardD('7',$date);
                                    $sward_8 = $this->Reportmodel->getNagadiTotalByWardD('8',$date);
                                    $sward_9 = $this->Reportmodel->getNagadiTotalByWardD('9',$date);
                                    $sward_10 = $this->Reportmodel->getNagadiTotalByWardD('10',$date);
                                    $sward_11 = $this->Reportmodel->getNagadiTotalByWardD('11',$date);
                                    $sward_12 = $this->Reportmodel->getNagadiTotalByWardD('12',$date);
                                    $sward_13 = $this->Reportmodel->getNagadiTotalByWardD('13',$date); 
                                  ?>
                                  <td colspan="3" align="right">जम्मा रु:</td>
                                  <td><?php echo !empty($sward_0->total)?$this->mylibrary->convertedcit(number_format($sward_0->total)):$this->mylibrary->convertedcit(0)?></td>
                                  <td><?php echo !empty($sward_1->total)?$this->mylibrary->convertedcit(number_format($sward_1->total)):$this->mylibrary->convertedcit(0) ?></td>
                                  <td><?php echo !empty($sward_2->total)?$this->mylibrary->convertedcit(number_format($sward_2->total)):$this->mylibrary->convertedcit(0) ?></td>
                                  <td><?php echo !empty($sward_3->total)?$this->mylibrary->convertedcit(number_format($sward_2->total)):$this->mylibrary->convertedcit(0) ?></td>
                                  <td><?php echo !empty($sward_4->total)?$this->mylibrary->convertedcit(number_format($sward_4->total)):$this->mylibrary->convertedcit(0) ?></td>
                                  <td><?php echo !empty($sward_5->total)?$this->mylibrary->convertedcit(number_format($sward_5->total)):$this->mylibrary->convertedcit(0) ?></td>
                                  <td><?php echo !empty($sward_6->total)?$this->mylibrary->convertedcit(number_format($sward_6->total)):$this->mylibrary->convertedcit(0) ?></td>
                                  <td><?php echo !empty($sward_7->total)?$this->mylibrary->convertedcit(number_format($sward_7->total)):$this->mylibrary->convertedcit(0) ?></td>
                                  <td><?php echo !empty($sward_8->total)?$this->mylibrary->convertedcit(number_format($sward_8->total)):$this->mylibrary->convertedcit(0) ?></td>
                                  <td><?php echo !empty($sward_9->total)?$this->mylibrary->convertedcit(number_format($sward_9->total)):$this->mylibrary->convertedcit(0) ?></td>
                                  <td><?php echo !empty($sward_10->total)?$this->mylibrary->convertedcit(number_format($sward_10->total)):$this->mylibrary->convertedcit(0) ?></td>
                                  <td><?php echo !empty($sward_11->total)?$this->mylibrary->convertedcit(number_format($sward_11->total)):$this->mylibrary->convertedcit(0) ?></td>
                                  <td><?php echo !empty($sward_12->total)?$this->mylibrary->convertedcit(number_format($sward_12->total)):$this->mylibrary->convertedcit(0) ?></td>
                                  <td><?php echo !empty($ward_13->total)?$this->mylibrary->convertedcit(number_format($sward_12->total)):$this->mylibrary->convertedcit(0) ?></td>
                                  <td>
                                    <?php $total_value = $sward_0->total + $sward_1->total+$sward_2->total +$sward_3->total+$sward_4->total+$sward_5->total+$sward_6->total+$sward_7->total+$sward_8->total+$sward_9->total+$sward_10->total+$sward_11->total+$sward_12->total+$sward_13->total;
                                    echo $this->mylibrary->convertedcit(number_format($total_value))?>
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="3" align="right">कुल जम्मा रु:</td>
                                  <td><?php echo $this->mylibrary->convertedcit(number_format($total_value))?></td>
                                  <td colspan="14">अक्षरुपी : <?php echo $this->convertlib->convert_number($total_value)." मात्र |";?></td>
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
    <script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>
   
    <script type="text/javascript">
      $(document).ready(function(){

        var date = "<?php echo convertDate(date('Y-m-d'))?>";
        $('#nepaliDateD').nepaliDatePicker({});

        $(document).on('click', '.btn-search', function(){
          var obj = $(this);
          var date = $('#nepaliDateD').val();
          $.ajax({
            url:"<?php echo base_url()?>NagadiReport/SearchDailyReportBy",
            method:"POST",
            data:{date:date},
            // contentType: false,
            // processData: false,
            beforeSend: function () {
              obj.html('<i class="fa fa-spinner fa-spin"></i> खोज्नुहोस');
            },
            success:function(resp){
              if(resp.status == 'success') {
                $('.adv-table').empty().html(resp.data);
                obj.html('खोज्नुहोस');
              }
            }
          }); 
        });
        
      })
  </script>
    
   