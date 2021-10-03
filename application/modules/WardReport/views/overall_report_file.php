
<!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item"><a href="javascript:;"> समग्र नग दि सङ्कलङ रेपोर्त </a></li>
              </ol>
            </nav>
              <!-- page start-->
              <div class="row">
                <div class="col-sm-12">
                  <section class="card" style="margin-bottom: -25px;">
                      <header class="card-header" style="background: #1b5693;color:#FFF">
                       समग्र नग दि सङ्कलङ रेपोर्त
                       <span class="tools pull-right">
						<a href="<?php echo base_url()?>NagadiReport/printOverAllReport" target="_blank" id="print"><img src="<?php echo base_url()?>assets/img/ppt.png" style="height: 20px;"></a>
						<a href="javascript:;"><img src="<?php echo base_url()?>assets/img/pdf.png" style="height: 20px;"></a>
						<a href="<?php echo base_url()?>NagadiReport/exportOverAllReport"><img src="<?php echo base_url()?>assets/img/xls.png" style="height: 20px;"></a>
					</span>
                      </header>
                      <div class="card-body">
                        <div class="adv-table">
							<table class=" table table-bordered table-responsive" id="hidden-table-info">
							<thead>
								<tr>
									<th>सि.नं</th>
									<th>आम्दानी शिर्षक</th>
									<th class="hidden-phone">शिर्षक नं	</th>
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
										$ward_0 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '0');
										$ward_1 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '1');
										$ward_2 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '2');
										$ward_3 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'],'3');
										$ward_4 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'],'4');
										$ward_5 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'],'5');
										$ward_6 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'],'6');
										$ward_7 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'],'7');
										$ward_8 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'],'8');
										$ward_9 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'],'9');
										$ward_10 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'],'10');
										$ward_11 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'],'11');
										$ward_12 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'],'12');
										$ward_13 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'],'13');
										$total_byMt = $this->Reportmodel->getNagadiTotalByMT($mt['id']);
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
											$sward_0 = $this->Reportmodel->getNagadiTotalByWard( '0');
											$sward_1 = $this->Reportmodel->getNagadiTotalByWard( '1');
											$sward_2 = $this->Reportmodel->getNagadiTotalByWard( '2');
											$sward_3 = $this->Reportmodel->getNagadiTotalByWard('3');
											$sward_4 = $this->Reportmodel->getNagadiTotalByWard('4');
											$sward_5 = $this->Reportmodel->getNagadiTotalByWard('5');
											$sward_6 = $this->Reportmodel->getNagadiTotalByWard('6');
											$sward_7 = $this->Reportmodel->getNagadiTotalByWard('7');
											$sward_8 = $this->Reportmodel->getNagadiTotalByWard('8');
											$sward_9 = $this->Reportmodel->getNagadiTotalByWard('9');
											$sward_10 = $this->Reportmodel->getNagadiTotalByWard('10');
											$sward_11 = $this->Reportmodel->getNagadiTotalByWard('11');
											$sward_12 = $this->Reportmodel->getNagadiTotalByWard('12');
											$sward_13 = $this->Reportmodel->getNagadiTotalByWard('13'); 
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
										<td colspan="14">अक्षरुपी : <?php echo $this->convertlib->convert_number($total_value,"मात्र |")."मात्र |";?></td>
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

      <script type="text/javascript" src="<?php echo base_url()?>assets/jsprint/printThis.js"></script>

	  <script type="text/javascript">
	    $(document).ready(function(){
	      $('#print').on("click", function () {
	      $('.adv-table').printThis();
	    });
	    });
	  </script>
   
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
            success:function(resp){
              if(resp.status == 'success') {
                $('.adv-table').empty().html(resp.data);
              }
            }
          }); 
        });
        
      })
  </script>
    
   
