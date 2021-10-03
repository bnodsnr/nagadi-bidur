  <h2 class="text-center"><b>  
  <?php
    if(!$ward_no != '-') {
        if($ward_no != 'palika') {
            echo $this->mylibrary->convertedcit($ward_no).' वडा कार्यलय';    
        } else {
            echo GNAME;
        }
        
    }
  
    if($from_date !='-') {
      echo 'मिति '.$this->mylibrary->convertedcit($from_date).' देखि ';
    }
  ?>
  <?php if($to_date != '-') { ?>
   -
   <?php echo $this->mylibrary->convertedcit($to_date) .' सम्म';?>
   <?php } ?> कर सङ्कलन रिपोर्ट</b>
 <!-- <a href="<?php //echo base_url()?>MonthlyReport/viewOverAllDetailsBySearch/<?php //echo $ward_no?>/<?php //echo $from_date?>/<?php //echo $to_date?>/<?php //echo $fiscal_year?>" class="btn btn-warning btn-sm pull-right" target="_blank"><i class="fa fa-eye"></i> रसिदको विवरण हेर्नुहोस</a> -->

 <a href="<?php echo base_url()?>MonthlyReport/printSearchMonthlyReport/<?php echo $from_date?>/<?php echo $to_date?>/<?php echo $ward_no?>/<?php echo $fiscal_year?>" class="btn btn-info btn-sm pull-right" style="margin-right: 4px;" target="_blank"><i class="fa fa-print"></i> रिपोर्ट प्रिन्ट गर्नुहोस</a>
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
      <td><?php echo !empty($sampati_kar['total'])?$this->mylibrary->convertedcit($sampati_kar['total']):$this->mylibrary->convertedcit(0)?></td>
      <td>
        <!-- <a href="<?php //echo base_url()?>MonthlyReport/MonthlySampatiBhumiKarDetailsView/<?php //echo $from_date.'/'.$to_date.'/'.$ward_no?>" class="btn btn-warning">रसिदको विवरण हेर्नुहोस</a> -->
      </td>
    </tr>
    <tr>
      <td>१</td>
      <td>११३१४</td>
      <td>भुमिकर/मालपोत</td>
      <td><?php echo !empty($bhumi_kar['total'])?$this->mylibrary->convertedcit($bhumi_kar['total']):$this->mylibrary->convertedcit(0)?></td>
      <td>
         <a href="<?php echo base_url()?>MonthlyReport/MonthlySampatiBhumiKarDetailSearch/<?php echo $from_date.'/'.$to_date.'/'.$ward_no.'/'.$fiscal_year?>" class="btn btn-warning" target ="_blank">रसिदको विवरण हेर्नुहोस</a> 
      </td>
    </tr>
    <?php if(!empty($main_topic)) : 
      $i=1;
      $nagadi_total = 0;
      foreach($main_topic as $mt):
        ?>
        <tr>
          <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
          <td><?php echo $this->mylibrary->convertedcit($mt['topic_no'])?></td>
          <td><?php echo $mt['topic_name']?></td>
          <?php
            $fy = str_replace('-','/',$fiscal_year);
            $collection_rate = $this->MonthlyReportMDL->SearchNagadiMontlhy($mt['id'],$ward_no,$from_date,$to_date, $fy);
          ?>
          <td><?php echo !empty($collection_rate['total']) ? $this->mylibrary->convertedcit(round($collection_rate['total'])):$this->mylibrary->convertedcit(0)?></td>

          <?php $nagadi_total += $collection_rate['total']?>
          <td><a href="<?php echo base_url()?>MonthlyReport/viewMonthlyNagadiDetailsSearch/<?php echo $mt['id'].'/'.$from_date.'/'.$to_date.'/'.$ward_no.'/'.$fiscal_year?>" class="btn btn-warning" target="_blank">रसिदको विवरण हेर्नुहोस</a></td>

        </tr>
      <?php endforeach;endif;?>
                          
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3" style="text-align: right"><b>जम्मा</b></td>
      <?php
      $net_total = $nagadi_total + $sampati_kar['total'] + $bhumi_kar['total'];
      ?>
      <td colspan="2" align="left"><?php echo !empty($net_total)?$this->mylibrary->convertedcit(round($net_total)):$this->mylibrary->convertedcit(0)?></td>
    </tr>
  </tfoot>                    
 </table>