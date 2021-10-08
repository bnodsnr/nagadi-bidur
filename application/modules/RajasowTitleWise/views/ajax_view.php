<?php $fy = str_replace('/','-',$sfy);?>
<a href="<?php echo base_url()?>RajasowTitleWise/printReport/<?php echo $fy?>/<?php echo $month?>/<?php echo $ward?>" class="btn btn-info pull-right" data-toggle="tooltip" title="रिपोर्ट खोज्नुहोस" target ="_blank"> <i class="fa fa-print"></i> प्रिन्ट गर्नुहोस </a>
<table class="table table-bordered table-striped print_table">
  <thead>
    <tr>
      <th>सि नं</th>
      <th>राजश्व संकेत</th>
      <th>आम्दानी शिर्षक</th>
      <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
      <th>अनुमान</th>
      <?php } ?>
      <th>गत महिना सम्मको आम्दानी</th>
      <th>यस महिना आम्दानी</th>
      <th>यस महिना सम्मको आम्दानी</th>
      <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
      <th>बाकी</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
  <tr>
      <td><?php echo $this->mylibrary->convertedcit(1)?></td>
      <td><?php echo $this->mylibrary->convertedcit(11313)?></td>
      <td><?php echo 'एकिकृत सम्पती कर'?></td>
      <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
      <td><?php echo $this->mylibrary->convertedcit($aanumanit_sampatikar['annual_income'])?>  
      </td>
        <?php } ?>
      <td><?php 
          //$tsampati_kar_upto_lastmonth = $sampati_kar_lastmonth['sampati_total'] + $sampati_kar_lastmonth['ba_amount'] + $sampati_kar_lastmonth['fa_amount'] + $sampati_kar_lastmonth['oa_amount'];
        echo $this->mylibrary->convertedcit($sampati_kar_lastmonth['total'])
      ?></td>
      <td><?php $tsampati_kar = $sampati_kar['sampati_total'] + $sampati_kar['ba_amount'] + $sampati_kar['fa_amount'] + $sampati_kar['oa_amount'];
        echo $this->mylibrary->convertedcit($sampati_kar['total'])?></td>
      <td>
        <?php 
          $total_sampati_kar = $sampati_kar_lastmonth['total'] + $sampati_kar['total'];
          echo $this->mylibrary->convertedcit($total_sampati_kar);
        ?>
      </td>
        <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
      <td> <?php $due_sampati = $aanumanit_sampatikar['annual_income']-$total_sampati_kar; echo $this->mylibrary->convertedcit($due_sampati)?></td>
    <?php  } ?>
    </tr>

    <tr>
      <td><?php echo $this->mylibrary->convertedcit(2)?></td>
      <td><?php echo $this->mylibrary->convertedcit(11314)?></td>
      <td><?php echo 'भूमि कर / मालपोत'?></td>
        <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
      <td><?php echo $this->mylibrary->convertedcit($aanumanit_bhumikar['annual_income'])?></td>
      <?php  } ?>
        <td><?php 
          //$bhumi_kar_upto_lastmonth = $bhumi_kar_lastmonth['bhumi_total'] + $bhumi_kar_lastmonth['bhumi_bakeyuta'] - $bhumi_kar_lastmonth['malpot'];
          echo $this->mylibrary->convertedcit($bhumi_kar_lastmonth['total'])
        ?></td>
        <td><?php 
          $bhumi_kar_currentmonth = $bhumi_kar['bhumi_total'] - $bhumi_kar['malpot'] + $bhumi_kar['bhumi_bakeyuta'];
          echo $this->mylibrary->convertedcit($bhumi_kar['total']);
        ?></td>
        <td><?php
              $total_bhumi_kar = $bhumi_kar_lastmonth['total'] + $bhumi_kar['total'];
              echo $this->mylibrary->convertedcit($total_bhumi_kar);
        ?></td>
        <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
        <td><?php $due_bhumikar = $aanumanit_bhumikar['annual_income']-$total_bhumi_kar; echo $this->mylibrary->convertedcit($due_bhumikar);?></td>
      <?php } ?>
      
    </tr>
    <?php $i = 3;$totalupto_nagadi0;$totalcurrent_month=0;$total_anumanit=0;$totalcollection=0;$totaldue=0; if(!empty($report)) : foreach($report as $nagadi) : 
      $total_anumanit += $nagadi['income_amount'];
      $totalupto_nagadi += $nagadi['uptolast_month'];
      $totalcurrent_month += $nagadi['current_month'];
      $uptototal += $nagadi['uptolast_month'] + $nagadi['current_month'];
      $totalcollection += $uptocurrentmonth;
      $due_amount = $nagadi['income_amount'] - $nagadi['uptolast_month'] - $nagadi['current_month'];
      $totaldue +=$due_amount;  
    ?>
      <tr>
        <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
        <td><?php echo $this->mylibrary->convertedcit($nagadi['topic_no'])?></td>
        <td><?php echo $nagadi['topic_name']?></td>
        <td><?php echo $this->mylibrary->convertedcit(number_format($nagadi['income_amount']))?></td>
        <td><?php echo $this->mylibrary->convertedcit(number_format($nagadi['uptolast_month']))?></td>
        <td><?php echo $this->mylibrary->convertedcit(number_format($nagadi['current_month']))?></td>
        <td><?php $total = $nagadi['uptolast_month'] + $nagadi['current_month'];
                  
        echo $this->mylibrary->convertedcit(number_format($total));?></td>
        <td><?php echo $this->mylibrary->convertedcit(number_format($due_amount))?></td>
      </tr>
    <?php endforeach; endif;?>
    <tr>
      <td colspan="3" align="right">जम्मा </td>
      <td><?php echo $this->mylibrary->convertedcit($total_anumanit)?></td>
      <!-- total upto last month -->
      <td><?php $total_upto_last_month = $tsampati_kar_upto_lastmonth + $bhumi_kar_upto_lastmonth + $totalupto_nagadi; echo $this->mylibrary->convertedcit($total_upto_last_month); ?> </td>
      <td><?php $total_current_month = $tsampati_kar + $bhumi_kar_currentmonth + $totalcurrent_month; echo $this->mylibrary->convertedcit(number_format($total_current_month)); ?> </td>

      <td><?php $stotal = $total_upto_last_month + $total_current_month  ; echo $this->mylibrary->convertedcit(number_format($stotal)); ?> </td>

      <td><?php echo $this->mylibrary->convertedcit($totaldue); ?> </td>
    </tr>
  </tbody>
  </table>