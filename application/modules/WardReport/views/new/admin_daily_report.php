 <a href="<?php echo base_url()?>WardReport/viewDailyCollectionDetails/<?php echo $session_ward?>/<?php echo $date?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-eye"></i> पुरा विवरण हेर्नुहोस</a>

 <a href="<?php echo base_url()?>WardReport/printDailyCollection/<?php echo $date?><?php echo $session_ward?>" class="btn btn-info btn-sm pull-right" style="margin-right: 4px;"><i class="fa fa-print"></i> प्रिन्ट गर्नुहोस</a>

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

            $collection_rate = $this->WardReportModel->SearchDailyNagadi($mt['id']);

            ?>

            <td><?php echo !empty($collection_rate['total'])?$this->mylibrary->convertedcit($collection_rate['total']):$this->mylibrary->convertedcit(0)?></td>

            <?php $nagadi_total += $collection_rate['total'];?>



            <td><a href="<?php echo base_url()?>WardReport/viewByTopic/<?php echo $mt['id'].'/'.$date.'/'.$session_ward?>" class="btn btn-warning" target ="_blank">विवरण हेर्नुहोस</a></td>

          </tr>

        <?php endforeach;endif;?>

        <td>१०</td>

        <td>सम्पति /भुमि कर </td>

        <td>--</td>

        <td><?php echo !empty($sampati_kar_bhumi['total'])?$this->mylibrary->convertedcit($sampati_kar_bhumi['total']):$this->mylibrary->convertedcit(0)?></td>



        <td><a href="<?php echo base_url()?>WardReport/viewSampatiKarDetails/<?php echo $date.'/'.$session_ward?>" class="btn btn-warning">विवरण हेर्नुहोस</a></td>

      </tbody>

      <tfoot>

        <tr>

          <td colspan="3" style="text-align: right"> जम्मा </td>

          <?php

          $net_total = $nagadi_total + $sampati_kar_bhumi['total'];

          ?>

          <td colspan="2" align="left"><?php echo !empty($net_total)?$this->mylibrary->convertedcit($net_total):$this->mylibrary->convertedcit(0)?>(<?php  echo $this->convertlib->convert($net_total,"मात्र |");?>)</td>

        </tr>

      </tfoot>

  </table>