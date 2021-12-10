<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title><?php echo GNAME ?></title>

  <link rel="shortcut icon" href="https://bms_bidur.dev/assets/img/nepal-govt.png">

  <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?php echo base_url() ?>assets/css/bootstrap-reset.css" rel="stylesheet">

  <link href="<?php echo base_url() ?>assets/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

  <style type="text/css">
    body {
      font-family: freeserif;
      margin: 0 auto;
      padding: 0;
      display: flex;
      flex-direction: column;
    }

    .page {
      display: inline-block;
      position: relative;
      width: 310mm;
      font-size: 16pt;
      margin: 2em auto;
      padding: calc(var(--bleeding) + var(--margin));
      box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
      background: white;
    }

    @media screen {
      .page::after {
        position: absolute;
        content: '';
        top: 0;
        left: 0;
        width: calc(100% - var(--bleeding) * 2);
        height: calc(100% - var(--bleeding) * 2);
        margin: var(--bleeding);
        pointer-events: none;
        z-index: 9999;
      }
    }

    @media all {
      .print_table {
        width: 100%;
        border: solid 1px;
        border-collapse: collapse;
      }

      /* .print_table th {
        border-color: black;
        font-size: 16px;
        border: solid 1px #000;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        color: #000;
      } */

      /* .print_table td {
        font-size: 16px;
        border: solid 1px #000;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        text-align: left;
      } */

      /* .print_table tr:nth-child(odd) {
        background-color: #fff;
      }

      .print_table tr:nth-child(even) {
        background-color: #fff;
      } */

      /* .table-bordered thead td,
      .table-bordered thead th {
        border-color: #000;
      } */
    }
  </style>
</head>



<body style="--bleeding: 0.5cm;--margin: 1cm;">
  <div class="">
    <img src="<?php echo base_url() ?>assets/img/nepal-govt.png" style="height: 120px; width: 140px;">
    <div style="font-size:12px; margin-left:25px;">आ ब: <?php echo $this->mylibrary->convertedcit(get_current_fiscal_year()) ?></div>
    <div style="font-size: 28px;margin-left: 250px;margin-top: -130px;"><b><?php echo GNAME ?></b></div>
    <div style="margin-left: 277px;margin-top: 0;font-size: 14px;"><b>
        <?php if ($this->session->userdata('PRJ_USER_ID') == 1) {
          echo SLOGAN;
        } else {
          echo $this->mylibrary->convertedcit($this->session->userdata('PRJ_USER_WARD')) . ' नं. वडा कार्यलय';
        } ?></b></div>
    <div style="margin-left: 320px;margin-top:0;font-size: 14px;"><b><?php echo ADDRESS . ',' . DISTRICT ?></b></div>
    <div style="margin-left: 280px;;margin-top: 15px;font-size: 22px;"><b>
        <?php if ($ward_no != '-' && $ward_no != 'palika') {
          echo 'वडा ' . $this->mylibrary->convertedcit($ward_no);
        } ?> मासिक सङ्कलन रिपोर्ट
      </b>
    </div>

    <div style="margin-left: 745px; margin-top:50px;">
      <?php if ($from_date != '-') {
        echo 'देखि ' . $this->mylibrary->convertedcit($from_date);
      } ?>
      <?php if ($to_date != '-') {
        echo 'सम्म ' . $this->mylibrary->convertedcit($to_date);
      } ?>
      <?php if ($fiscal_year != '-') {
        echo 'आर्थिक वर्ष ' . $this->mylibrary->convertedcit($fiscal_year);
      } ?>
    </div>

    <hr style="margin-top: 5px;">
    <table class=" table table-stripe table-bordered">
      <thead style="background-color:blue">
        <tr>
          <th>सि.नं</th>
          <th>आम्दानी शिर्षक</th>
          <th class="hidden-phone">शिर्षक नं </th>
          <th class="hidden-phone">मुल्य रु</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>१</td>
          <td>एकीकृत सम्पती कर</td>
          <td>११३१३</td>
          <td><?php echo $this->mylibrary->convertedcit(number_format($sampati_kar['total'], 2)) ?></td>
        </tr>
        <tr>
          <td>२</td>
          <td>भुमिकर/मालपोत</td>
          <td>११३१४</td>
          <td><?php echo $this->mylibrary->convertedcit(number_format($bhumi_kar['total'], 2)) ?></td>
        </tr>
        <?php if (!empty($main_topic)) :
          $i = 3;
          $nagadi_total = 0;
          foreach ($main_topic as $mt) :
        ?>
            <tr>
              <td><?php echo $this->mylibrary->convertedcit($i++) ?></td>
              <td><?php echo $mt['topic_name'] ?></td>
              <td><?php echo $this->mylibrary->convertedcit($mt['topic_no']) ?></td>
              <?php
              $fy = str_replace('-', '/', $fiscal_year);
              $collection_rate = $this->MonthlyReportMDL->SearchNagadiMontlhy($mt['id'], $ward_no, $from_date, $to_date, $fy, $user);
              ?>
              <td><?php echo !empty($collection_rate['total']) ? $this->mylibrary->convertedcit(round($collection_rate['total'], 2)) : $this->mylibrary->convertedcit(0) ?></td>
              <?php $nagadi_total += $collection_rate['total'] ?>
            </tr>
        <?php endforeach;
        endif; ?>
      <tfoot>
        <tr>
          <td colspan="3" style="text-align: right"><b>जम्मा</b></td>
          <?php
          $net_total = $nagadi_total + $sampati_kar['total'] + $bhumi_kar['total'];
          ?>
          <td colspan="" align="left"><?php echo !empty($net_total) ? $this->mylibrary->convertedcit(round($net_total, 2)) : $this->mylibrary->convertedcit(0) ?></td>
        </tr>
      </tfoot>
    </table>
  </div>
  <!--end of page-->
</body>

</html>