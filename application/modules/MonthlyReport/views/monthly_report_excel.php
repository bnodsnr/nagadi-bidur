  <table class=" table table-bordered">
    <thead>
      <tr>
        <th>सि.नं</th>
        <th class="hidden-phone">शिर्षक नं </th>
        <th>आम्दानी शिर्षक</th>
        <th class="hidden-phone">मुल्य रु</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>१</td>
        <td>११३१३</td>
        <td>एकीकृत सम्पती कर</td>
        <td><?php echo $this->mylibrary->convertedcit($sampati_kar['total']) ?></td>
      </tr>
      <tr>
        <td>२</td>
        <td>११३१४</td>
        <td>भुमिकर/मालपोत</td>
        <td><?php echo $this->mylibrary->convertedcit($bhumi_kar['total']) ?></td>
      </tr>
      <?php if (!empty($main_topic)) :
        $i = 3;
        $nagadi_total = 0;
        foreach ($main_topic as $mt) :
      ?>
          <tr>
            <td><?php echo $this->mylibrary->convertedcit($i++) ?></td>
            <td><?php echo $this->mylibrary->convertedcit($mt['topic_no']) ?></td>
            <td><?php echo $mt['topic_name'] ?></td>
            <?php
            $collection_rate = $this->MonthlyReportMDL->NagadiMontlhy($mt['id']);
            ?>
            <td><?php echo !empty($collection_rate['total']) ? $this->mylibrary->convertedcit(round($collection_rate['total'])) : $this->mylibrary->convertedcit(0) ?></td>
            <?php $nagadi_total += $collection_rate['total'] ?>
          </tr>
      <?php endforeach;
      endif; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3" style="text-align: right"><b>जम्मा</b></td>
        <?php
        $net_total = $nagadi_total + $sampati_kar['total'] + $bhumi_kar['total'];
        ?>
        <td colspan="2" align="left"><?php echo !empty($net_total) ? $this->mylibrary->convertedcit(round($net_total)) : $this->mylibrary->convertedcit(0) ?></td>
      </tr>
    </tfoot>
  </table>