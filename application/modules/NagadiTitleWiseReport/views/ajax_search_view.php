 <table class="table table-bordered table-stripe print_table" id="">
  <thead style="background:#1b5693;color:#fff">
    <tr>
      <th>#</th>
      <th>शिर्षक नं</th>
      <th>शिर्षक</th>
      <td>रकम</td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>१</td>
      <td>११३१३</td>
      <td>एकीकृत सम्पती कर</td>
      <td><?php echo $this->mylibrary->convertedcit($sampatikar['sampati_total'] + $sampatikar['ba_amount'] + $sampatikar['fa_amount'] +$sampatikar['oa_amount'])?> </td>
    </tr>
    <tr>
      <td>२</td>
      <td>११३१४</td>
      <td>भुमिकर/मालपोत</td>
      <td><?php echo $this->mylibrary->convertedcit($bhumikar['bhumi_total']) ?> </td>
    </tr>
    <?php if(!empty($reports)) :
      $i =2;
      $total = 0;
      foreach($reports as $key => $report): ?>
        <tr>
          <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
          <td>--</td>
          <!--   <td><?php //echo $report['topic_name']?></td> -->
          <td><?php echo $report['sbutopic']?></td>
          <td><?php echo $this->mylibrary->convertedcit(round($report['total'],2))?></td>
          <?php $total += $report['total'] ?>
        </tr>
      <?php endforeach;endif;?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3" align="right">जम्मा </td>
        <td><?php echo $this->mylibrary->convertedcit(round($total + $sampatikar['sampati_total'] + $sampatikar['ba_amount'] + $sampatikar['fa_amount'] +$sampatikar['oa_amount'] +$bhumikar['bhumi_total']))?></td>
      </tr>
    </tfoot>
  </table>