<!--main content start-->

<section id="main-content">

	<section class="wrapper site-min-height">

		<nav aria-label="breadcrumb">

			<ol class="breadcrumb">

				<li class="breadcrumb-item"><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>

				<li class="breadcrumb-item"><a href="javascript:;"> समग्र सङ्कलङ रिपोर्ट </a></li>

			</ol>

		</nav>

		<!-- page start-->

		<div class="row">

			<div class="col-sm-12">

				<section class="card">
					<header class="card-header">


					</header>

					<div class="card-body">
						<div class="tab-content tasi-tab" id="myTabContent">
							<div class="row">
								<div class="col-md-2">
									<div class="input-group">
										<select class="form-control" id="fiscal_year">
											<option value="">आर्थिक वर्ष छानुहोस</option>
											<?php if (!empty($fiscal_year)) : foreach ($fiscal_year as $key => $fy) : ?>
													<option value="<?php echo $fy['year'] ?>" <?php if ($fy['year'] == current_fiscal_year()) {
																																			echo 'selected';
																																		} ?>><?php echo $this->mylibrary->convertedcit($fy['year']) ?></option>
											<?php endforeach;
											endif; ?>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-group">
										<input type="text" id="from_date" class="form-control nepali-calendar" value="" placeholder="देखी मिति " />
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-group">
										<input type="text" id="to_date" class="form-control nepali-calendar" value="" placeholder="सम्म मिति" />
									</div>
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-danger btn-search" title=""><i class="fa fa-search"></i> खोज्नुहोस </button>

								</div>
							</div>
							<hr>

							<div class="search_details">
								<a href="<?php echo base_url() ?>NagadiReport/PrintOverallReport" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-print"></i> प्रिन्ट गर्नुहोस</a>
								<a href="<?php echo base_url() ?>NagadiReport/exportToExcel/" class="btn btn-success btn-sm" title="मासिक रिपोर्ट प्रिन्ट गर्नुहोस" alt="EXPORT TO EXCEL" target="_blank"><i class="fa fa-file"></i> Export To Excel</a>
								<a href="<?php echo base_url() ?>NagadiReport/exportToPDF/" class="btn btn-warning btn-sm" title="मासिक रिपोर्ट प्रिन्ट गर्नुहोस" alt="GENERATE PDF" target="_blank"><i class="fa fa-file"></i> Export To PDF</a>
								<hr>
								<div class="table-responsive">
									<table class=" table table-bordered print_table">

										<thead>

											<tr>

												<th style="width: 200px">आम्दानी शिर्षक</th>

												<th class="hidden-phone">शिर्षक नं </th>

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

											<?php if (!empty($main_topic)) :

												$i = 1;
												foreach ($main_topic as $mt) :

											?>

													<tr>

														<td><?php echo $mt['topic_name'] ?></td>

														<td><?php echo $this->mylibrary->convertedcit($mt['topic_no']) ?></td>

														<?php

														$ward_0 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '0');

														$ward_1 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '1');

														$ward_2 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '2');

														$ward_3 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '3');

														$ward_4 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '4');

														$ward_5 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '5');

														$ward_6 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '6');

														$ward_7 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '7');

														$ward_8 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '8');

														$ward_9 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '9');
														$ward_10 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '10');
														$ward_11 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '11');
														$ward_12 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '12');
														$ward_13 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '13');


														$total_byMt = $this->Reportmodel->getNagadiTotalByMT($mt['id']);

														?>

														<td><?php echo !empty($ward_0->total) ? $this->mylibrary->convertedcit(number_format($ward_0->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($ward_1->total) ? $this->mylibrary->convertedcit(number_format($ward_1->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($ward_2->total) ? $this->mylibrary->convertedcit(number_format($ward_2->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($ward_3->total) ? $this->mylibrary->convertedcit(number_format($ward_3->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($ward_4->total) ? $this->mylibrary->convertedcit(number_format($ward_4->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($ward_5->total) ? $this->mylibrary->convertedcit(number_format($ward_5->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($ward_6->total) ? $this->mylibrary->convertedcit(number_format($ward_6->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($ward_7->total) ? $this->mylibrary->convertedcit(number_format($ward_7->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($ward_8->total) ? $this->mylibrary->convertedcit(number_format($ward_8->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($ward_9->total) ? $this->mylibrary->convertedcit(number_format($ward_9->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($ward_10->total) ? $this->mylibrary->convertedcit(number_format($ward_10->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>
														<td><?php echo !empty($ward_11->total) ? $this->mylibrary->convertedcit(number_format($ward_11->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>
														<td><?php echo !empty($ward_12->total) ? $this->mylibrary->convertedcit(number_format($ward_12->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>
														<td><?php echo !empty($ward_13->total) ? $this->mylibrary->convertedcit(number_format($ward_13->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>


														<td><?php echo !empty($total_byMt->total) ? $this->mylibrary->convertedcit(number_format($total_byMt->total), 2) : $this->mylibrary->convertedcit(0) ?></td>


													<tr>
												<?php $i++;
												endforeach;
											endif; ?>
													<tr>



														<?php

														$sward_0 = $this->Reportmodel->getNagadiTotalByWard('0');

														$sward_1 = $this->Reportmodel->getNagadiTotalByWard('1');

														$sward_2 = $this->Reportmodel->getNagadiTotalByWard('2');

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
														$nward_0 = !empty($sward_0) ? $sward_0->total : 0;

														$nward_1 = !empty($sward_1) ? $sward_1->total : 0;
														$nward_2 = !empty($sward_2) ? $sward_2->total : 0;
														$nward_3 = !empty($sward_3) ? $sward_3->total : 0;
														$nward_4 = !empty($sward_4) ? $sward_4->total : 0;
														$nward_5 = !empty($sward_5) ? $sward_5->total : 0;
														$nward_6 = !empty($sward_6) ? $sward_6->total : 0;
														$nward_7 = !empty($sward_7) ? $sward_7->total : 0;
														$nward_8 = !empty($sward_8) ? $sward_8->total : 0;
														$nward_9 = !empty($sward_9) ? $sward_9->total : 0;
														$nward_10 = !empty($sward_10) ? $sward_10->total : 0;
														$nward_11 = !empty($sward_11) ? $sward_11->total : 0;
														$nward_12 = !empty($sward_12) ? $sward_12->total : 0;
														$nward_13 = !empty($sward_13) ? $sward_13->total : 0;

														?>

														<td colspan="2" align="right">जम्मा नगदि रु:</td>

														<td><?php echo !empty($sward_0->total) ? $this->mylibrary->convertedcit(number_format($sward_0->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($sward_1->total) ? $this->mylibrary->convertedcit(number_format($sward_1->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($sward_2->total) ? $this->mylibrary->convertedcit(number_format($sward_2->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($sward_3->total) ? $this->mylibrary->convertedcit(number_format($sward_3->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($sward_4->total) ? $this->mylibrary->convertedcit(number_format($sward_4->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($sward_5->total) ? $this->mylibrary->convertedcit(number_format($sward_5->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($sward_6->total) ? $this->mylibrary->convertedcit(number_format($sward_6->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($sward_7->total) ? $this->mylibrary->convertedcit(number_format($sward_7->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($sward_8->total) ? $this->mylibrary->convertedcit(number_format($sward_8->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>

														<td><?php echo !empty($sward_9->total) ? $this->mylibrary->convertedcit(number_format($sward_9->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>
														<td><?php echo !empty($sward_10->total) ? $this->mylibrary->convertedcit(number_format($sward_10->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>
														<td><?php echo !empty($sward_11->total) ? $this->mylibrary->convertedcit(number_format($sward_11->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>
														<td><?php echo !empty($sward_12->total) ? $this->mylibrary->convertedcit(number_format($sward_12->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>
														<td><?php echo !empty($sward_13->total) ? $this->mylibrary->convertedcit(number_format($sward_13->total, 2)) : $this->mylibrary->convertedcit(0) ?></td>



														<td>

															<?php $total_nagadi =

																$nward_0 + $nward_1 + $nward_2 + $nward_3 + $nward_4 + $nward_5 + $nward_6 + $nward_7 + $nward_8 + $nward_9 + $nward_10 + $nward_11 + $nward_12 + $nward_13;

															echo $this->mylibrary->convertedcit(round($total_nagadi, 2)) ?>

														</td>

													</tr>
													<tr>
														<td colspan="2" align="right">सम्पति/भुमि कर </td>
														<td>--</td>
														<?php
														$sam_ward_1 = $this->Reportmodel->getSampatiTotalByWard('1');

														$sam_ward_2 = $this->Reportmodel->getSampatiTotalByWard('2');

														$sam_ward_3 = $this->Reportmodel->getSampatiTotalByWard('3');

														$sam_ward_4 = $this->Reportmodel->getSampatiTotalByWard('4');

														$sam_ward_5 = $this->Reportmodel->getSampatiTotalByWard('5');

														$sam_ward_6 = $this->Reportmodel->getSampatiTotalByWard('6');

														$sam_ward_7 = $this->Reportmodel->getSampatiTotalByWard('7');

														$sam_ward_8 = $this->Reportmodel->getSampatiTotalByWard('8');

														$sam_ward_9 = $this->Reportmodel->getSampatiTotalByWard('9');
														$sam_ward_10 = $this->Reportmodel->getSampatiTotalByWard('10');
														$sam_ward_11 = $this->Reportmodel->getSampatiTotalByWard('11');
														$sam_ward_12 = $this->Reportmodel->getSampatiTotalByWard('12');
														$sam_ward_13 = $this->Reportmodel->getSampatiTotalByWard('13');


														$sam_1 = !empty($sam_ward_1) ? $sam_ward_1->sampati_total : 0;
														$sam_2 = !empty($sam_ward_2) ? $sam_ward_2->sampati_total : 0;
														$sam_3 = !empty($sam_ward_3) ? $sam_ward_3->sampati_total : 0;
														$sam_4 = !empty($sam_ward_4) ? $sam_ward_4->sampati_total : 0;
														$sam_5 = !empty($sam_ward_5) ? $sam_ward_5->sampati_total : 0;
														$sam_6 = !empty($sam_ward_6) ? $sam_ward_6->sampati_total : 0;
														$sam_7 = !empty($sam_ward_7) ? $sam_ward_7->sampati_total : 0;
														$sam_8 = !empty($sam_ward_8) ? $sam_ward_8->sampati_total : 0;
														$sam_9 = !empty($sam_ward_9) ? $sam_ward_9->sampati_total : 0;
														$sam_10 = !empty($sam_ward_10) ? $sam_ward_10->sampati_total : 0;
														$sam_11 = !empty($sam_ward_11) ? $sam_ward_11->sampati_total : 0;
														$sam_12 = !empty($sam_ward_12) ? $sam_ward_12->sampati_total : 0;
														$sam_13 = !empty($sam_ward_13) ? $sam_ward_13->sampati_total : 0;
														?>

														<td><?php echo $this->mylibrary->convertedcit(number_format($sam_1, 2)) ?></td>

														<td><?php echo $this->mylibrary->convertedcit(number_format($sam_2, 2)) ?></td>

														<td><?php echo $this->mylibrary->convertedcit(number_format($sam_3, 2)) ?></td>

														<td><?php echo $this->mylibrary->convertedcit(number_format($sam_4, 2)) ?></td>

														<td><?php echo $this->mylibrary->convertedcit(number_format($sam_5, 2)) ?></td>

														<td><?php echo $this->mylibrary->convertedcit(number_format($sam_6, 2)) ?></td>

														<td><?php echo $this->mylibrary->convertedcit(number_format($sam_7, 2)) ?></td>

														<td><?php echo $this->mylibrary->convertedcit(number_format($sam_8, 2)) ?></td>

														<td><?php echo $this->mylibrary->convertedcit(number_format($sam_9, 2)) ?></td>
														<td><?php echo $this->mylibrary->convertedcit(number_format($sam_10, 2)) ?></td>
														<td><?php echo $this->mylibrary->convertedcit(number_format($sam_11, 2)) ?></td>
														<td><?php echo $this->mylibrary->convertedcit(number_format($sam_12, 2)) ?></td>
														<td><?php echo $this->mylibrary->convertedcit(number_format($sam_13, 2)) ?></td>
														<td>
															<?php
															$total_sam = $sam_1 + $sam_2 + $sam_3 + $sam_4 + $sam_5 + $sam_6 + $sam_7 + $sam_8 + $sam_9 + $sam_10 + $sam_11 + $sam_12 + $sam_13;
															echo $this->mylibrary->convertedcit(number_format($total_sam, 2));
															?>
														</td>
													</tr>
										</tbody>
										<tfoot>

											<tr>

												<td colspan="2" align="right">समग्र रु:</td>

												<td><?php echo $this->mylibrary->convertedcit(round($nward_0, 2)) ?></td>
												<?php $ward_1_collection = $nward_1 + $sam_1;
												$ward_2_collection = $nward_2 + $sam_2;
												$ward_3_collection = $nward_3 + $sam_3;
												$ward_4_collection = $nward_4 + $sam_4;
												$ward_5_collection = $nward_5 + $sam_5;
												$ward_6_collection = $nward_6 + $sam_6;
												$ward_7_collection = $nward_7 + $sam_7;
												$ward_8_collection = $nward_8 + $sam_8;
												$ward_9_collection = $nward_9 + $sam_9;
												$ward_10_collection = $nward_10 + $sam_10;
												$ward_11_collection = $nward_11 + $sam_11;
												$ward_12_collection = $nward_12 + $sam_12;
												$ward_13_collection = $nward_13 + $sam_13;
												$total_collection = $ward_1_collection + $ward_2_collection + $ward_3_collection + $ward_4_collection + $ward_5_collection + $ward_6_collection + $ward_7_collection + $ward_8_collection + $ward_9_collection + $ward_10_collection + $ward_11_collection + $ward_12_collection + $ward_13_collection + $nward_0;
												?>
												<td><?php echo $this->mylibrary->convertedcit(number_format($ward_1_collection, 2)) ?></td>
												<td><?php echo $this->mylibrary->convertedcit(number_format($ward_2_collection, 2)) ?></td>
												<td><?php echo $this->mylibrary->convertedcit(number_format($ward_3_collection, 2)) ?></td>
												<td><?php echo $this->mylibrary->convertedcit(number_format($ward_4_collection, 2)) ?></td>
												<td><?php echo $this->mylibrary->convertedcit(number_format($ward_5_collection, 2)) ?></td>
												<td><?php echo $this->mylibrary->convertedcit(number_format($ward_6_collection, 2)) ?></td>
												<td><?php echo $this->mylibrary->convertedcit(number_format($ward_7_collection, 2)) ?></td>
												<td><?php echo $this->mylibrary->convertedcit(number_format($ward_8_collection, 2)) ?></td>
												<td><?php echo $this->mylibrary->convertedcit(number_format($ward_9_collection, 2)) ?></td>
												<td><?php echo $this->mylibrary->convertedcit(number_format($ward_10_collection, 2)) ?></td>
												<td><?php echo $this->mylibrary->convertedcit(number_format($ward_11_collection, 2)) ?></td>
												<td><?php echo $this->mylibrary->convertedcit(number_format($ward_12_collection, 2)) ?></td>
												<td><?php echo $this->mylibrary->convertedcit(number_format($ward_13_collection, 2)) ?></td>
												<td><?php echo $this->mylibrary->convertedcit(number_format($total_collection, 2)) ?></td>
												<!-- <td colspan="14">अक्षरुपी : <?php //echo $this->convertlib->convert($total_value);
																													?></td> -->
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

<script type="text/javascript" src="<?php echo base_url('assets/nepali_datepicker/nepali.datepicker.v2.2.min.js') ?>"></script>

<script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>



<script type="text/javascript" src="<?php echo base_url() ?>assets/jsprint/printThis.js"></script>



<script type="text/javascript">
	$(document).ready(function() {
		$('#nepaliDateD').nepaliDatePicker({});
		$('#print').on("click", function() {

			$('.search_details').printThis();
		});
	});
</script>



<script type="text/javascript">
	$(document).ready(function() {
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








		$(document).on('click', '.btn-search', function() {

			var obj = $(this);

			var from_date = $('#from_date').val();
			var to_date = $("#to_date").val();
			var fiscal_year = $('#fiscal_year').val();

			$.ajax({

				url: "<?php echo base_url() ?>NagadiReport/search",

				method: "POST",

				data: {
					from_date: from_date,
					to_date: to_date,
					fiscal_year: fiscal_year,
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				},

				beforeSend: function() {

					obj.html('<i class="fa fa-spinner fa-spin"></i> <i class="fa fa-search"></i> खोज्नुहोस');

				},
				success: function(resp) {

					if (resp.status == 'success') {

						$('.search_details').empty().html(resp.data);
						obj.html(' <i class="fa fa-search"></i> खोज्नुहोस');
					}

				}

			});

		});



	})
</script>