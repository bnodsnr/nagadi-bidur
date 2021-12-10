<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<title>विदुर नगरपालिका</title>
    <head>
      <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo base_url()?>assets/css/bootstrap-reset.css" rel="stylesheet">
		<style>
		body {
			font-family: freesans;
		}

		#customers {
			/*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
			border-collapse: collapse;
			width: 100%;
		}

		/*#customers td,
		#customers th {
			border: 1px solid #000 !important;
			padding: 8px;
		}*/

		/*#customers tr:nth-child(even){background-color: #f2f2f2;}*/

		/* #customers tr:hover {
			background-color: #000;
		} */

		#customers th {
			
			text-align: left;
			/* background-color: #4CAF50;*/
			color: #000;
		}

		</style>
	</head>
	<body>
		<div id="container" style="margin:10px;">
			<div style="height: 100px;width: 100px; ">
				<img src="<?php echo base_url()?>assets/img/nepal-govt.png"
					style="height: 70px; width: 70px;">
			</div>
			<div style="height: 70px; width: 200px;margin-top: -90px;margin-left:376px;"><?php echo GNAME?></div>
			<div style="height: 70px; width: 200px;margin-top: -47px;margin-left:50px;"><b><?php echo SLOGAN?></b></div>
			<div style="height: 70px; width: 200px;margin-top: -50px;margin-left:580px;"><?php echo GNAME?>
				<?php echo DISTRICT?></div> 
			<div style="height: 70px; width: 200px;margin-top: -47px;margin-left:576px;"><?php echo STATENAME?>,नेपाल</div>
			<br>
            <div style="margin-top:20px;">
	           <table class="" id="customers">
              <thead>
                <tr>
                  <th style="border: 1px solid #000 !important;border-collapse: collapse;">सि.नं</th>
                  <th style="border: 1px solid #000 !important;border-collapse: collapse;">आम्दानी शिर्षक</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">शिर्षक नं  </th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">नगरपालिका</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">वडा १</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">वडा २</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">वडा ३</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">वडा ४</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">वडा ५</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">वडा ६</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">वडा ७</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">वडा ८</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">वडा ९</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">वडा १०</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">वडा ११</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">वडा १२</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">वडा १३</th>
                  <th class="hidden-phone" style="border: 1px solid #000 !important;border-collapse: collapse;">जम्मा रु:</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($main_topic)) : 
                  $i=1; foreach($main_topic as $mt):
                  ?>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo $this->mylibrary->convertedcit($i)?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo $mt['topic_name']?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo $this->mylibrary->convertedcit($mt['topic_no'])?></td>
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
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_0->total)?$this->mylibrary->convertedcit(number_format($ward_0->total)):$this->mylibrary->convertedcit(0)?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_1->total)?$this->mylibrary->convertedcit(number_format($ward_1->total)):$this->mylibrary->convertedcit(0) ?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_2->total)?$this->mylibrary->convertedcit(number_format($ward_2->total)):$this->mylibrary->convertedcit(0) ?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_3->total)?$this->mylibrary->convertedcit(number_format($ward_2->total)):$this->mylibrary->convertedcit(0) ?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_4->total)?$this->mylibrary->convertedcit(number_format($ward_4->total)):$this->mylibrary->convertedcit(0) ?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_5->total)?$this->mylibrary->convertedcit(number_format($ward_5->total)):$this->mylibrary->convertedcit(0) ?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_6->total)?$this->mylibrary->convertedcit(number_format($ward_6->total)):$this->mylibrary->convertedcit(0) ?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_7->total)?$this->mylibrary->convertedcit(number_format($ward_7->total)):$this->mylibrary->convertedcit(0) ?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_8->total)?$this->mylibrary->convertedcit(number_format($ward_8->total)):$this->mylibrary->convertedcit(0) ?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_9->total)?$this->mylibrary->convertedcit(number_format($ward_9->total)):$this->mylibrary->convertedcit(0) ?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_10->total)?$this->mylibrary->convertedcit(number_format($ward_10->total)):$this->mylibrary->convertedcit(0) ?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_11->total)?$this->mylibrary->convertedcit(number_format($ward_11->total)):$this->mylibrary->convertedcit(0) ?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_12->total)?$this->mylibrary->convertedcit(number_format($ward_12->total)):$this->mylibrary->convertedcit(0) ?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_13->total)?$this->mylibrary->convertedcit(number_format($ward_12->total)):$this->mylibrary->convertedcit(0) ?></td>
                  <td style="border: 1px solid #000 !important;border-collapse: collapse;" ><?php echo !empty($total_byMt->total)?$this->mylibrary->convertedcit(number_format($total_byMt->total)):$this->mylibrary->convertedcit(0) ?></td>
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
                    <td colspan="3" align="right" style="border: 1px solid #000 !important;border-collapse: collapse;">जम्मा रु:</td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($sward_0->total)?$this->mylibrary->convertedcit(number_format($sward_0->total)):$this->mylibrary->convertedcit(0)?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($sward_1->total)?$this->mylibrary->convertedcit(number_format($sward_1->total)):$this->mylibrary->convertedcit(0) ?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($sward_2->total)?$this->mylibrary->convertedcit(number_format($sward_2->total)):$this->mylibrary->convertedcit(0) ?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($sward_3->total)?$this->mylibrary->convertedcit(number_format($sward_2->total)):$this->mylibrary->convertedcit(0) ?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($sward_4->total)?$this->mylibrary->convertedcit(number_format($sward_4->total)):$this->mylibrary->convertedcit(0) ?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($sward_5->total)?$this->mylibrary->convertedcit(number_format($sward_5->total)):$this->mylibrary->convertedcit(0) ?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($sward_6->total)?$this->mylibrary->convertedcit(number_format($sward_6->total)):$this->mylibrary->convertedcit(0) ?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($sward_7->total)?$this->mylibrary->convertedcit(number_format($sward_7->total)):$this->mylibrary->convertedcit(0) ?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($sward_8->total)?$this->mylibrary->convertedcit(number_format($sward_8->total)):$this->mylibrary->convertedcit(0) ?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($sward_9->total)?$this->mylibrary->convertedcit(number_format($sward_9->total)):$this->mylibrary->convertedcit(0) ?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($sward_10->total)?$this->mylibrary->convertedcit(number_format($sward_10->total)):$this->mylibrary->convertedcit(0) ?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($sward_11->total)?$this->mylibrary->convertedcit(number_format($sward_11->total)):$this->mylibrary->convertedcit(0) ?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($sward_12->total)?$this->mylibrary->convertedcit(number_format($sward_12->total)):$this->mylibrary->convertedcit(0) ?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo !empty($ward_13->total)?$this->mylibrary->convertedcit(number_format($sward_12->total)):$this->mylibrary->convertedcit(0) ?></td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;">
                      <?php $total_value = $sward_0->total + $sward_1->total+$sward_2->total +$sward_3->total+$sward_4->total+$sward_5->total+$sward_6->total+$sward_7->total+$sward_8->total+$sward_9->total+$sward_10->total+$sward_11->total+$sward_12->total+$sward_13->total;
                      echo $this->mylibrary->convertedcit(number_format($total_value))?>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3" align="right" style="border: 1px solid #000 !important;border-collapse: collapse;">कुल जम्मा रु:</td>
                    <td style="border: 1px solid #000 !important;border-collapse: collapse;"><?php echo $this->mylibrary->convertedcit(number_format($total_value))?></td>
                    <td colspan="14" style="border: 1px solid #000 !important;border-collapse: collapse;">अक्षरुपी : <?php echo $this->convertlib->convert_number($total_value,)." मात्र /-";?></td>
                  </tr>
                </tfoot>
                          </table>
	        </div>
        </div>
      <div style="margin-top: 40px;margin-left: 567px;">
        <button class="btn btn-info btn-sm " style="color:#FFF; margin-top: -50px;" id="basic">प्रिन्ट गर्नुहोस्</button>
         <a href="<?php echo base_url()?>" class ="btn btn-success btn-sm">Dashboard</a>
      </div>
      <script src="<?php echo base_url()?>assets/js/jquery.js"></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets/jsprint/printThis.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#basic').on("click", function () {
        $('#container').printThis();
      });
      });
    </script>
	</body>
</html>
