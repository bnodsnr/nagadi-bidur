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
    :root {
      --bleeding: 0.5cm;
      --margin: 1cm;
    }

    @page {
      size: A4;
      margin: 0;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: freeserif;
      margin: 0 auto;
      padding: 0;
      /* background: rgb(204, 204, 204); */
      display: flex;
      flex-direction: column;
    }

    .page {
      display: inline-block;
      position: relative;
      /*height: 327mm;*/
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
        /*outline: thin dashed black;*/
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

      .print_table th {
        border-color: black;
        font-size: 16px;
        border: solid 1px #000;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        /*background-color:#407ac5;*/
        color: #000;
      }

      .print_table td {

        font-size: 16px;
        border: solid 1px #000;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        text-align: left;
      }

      .print_table tr:nth-child(odd) {
        background-color: #fff;
      }

      .print_table tr:nth-child(even) {
        background-color: #fff;
        /*color: #FFF;*/
      }

      .table-bordered thead td,
      .table-bordered thead th {
        border-color: #000;
      }
    }
  </style>

</head>

<body style="--bleeding: 0.5cm;--margin: 1cm;">
  <div class="">

    <img src="<?php echo base_url() ?>assets/img/nepal-govt.png" style="height: 120px; width: 140px;">
    <div style="font-size:12px; margin-left:25px;">आ ब: <?php echo $this->mylibrary->convertedcit(get_current_fiscal_year()) ?></div>

    <div style="font-size: 28px;margin-left: 250px;margin-top: -130px;"><b><?php echo GNAME ?></b></div>
    <div style="margin-left: 277px;margin-top: 0;font-size: 14px;"><b><?php if ($this->session->userdata('PRJ_USER_ID') == 1) {
                                                                        echo SLOGAN;
                                                                      } else {
                                                                        echo $this->mylibrary->convertedcit($this->session->userdata('PRJ_USER_WARD')) . ' नं. वडा कार्यलय';
                                                                      } ?></b></div>
    <div style="margin-left: 320px;margin-top:0;font-size: 14px;"><b><?php echo ADDRESS . ',' . DISTRICT ?></b></div>
    <div style="margin-left: 460px;margin-top: 12px;font-size: 22px;"><b>


      </b></div>
    <div style="text-align: center; margin-top:40px;">
      <h4>मासिक कर सङ्कलन रिपोर्ट महिना- <?php echo getNepaliMonthName(get_current_month()) ?></h4>
    </div>


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
          <td><?php echo $this->mylibrary->convertedcit(round($sampati_kar['total'], 2)) ?></td>
        </tr>
        <tr>
          <td>२</td>
          <td>११३१४</td>
          <td>भुमिकर/मालपोत</td>
          <td><?php echo $this->mylibrary->convertedcit(round($bhumi_kar['total'], 2)) ?></td>
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
              <td><?php echo !empty($collection_rate['total']) ? $this->mylibrary->convertedcit(round($collection_rate['total'], 2)) : $this->mylibrary->convertedcit(0) ?></td>
              <?php $nagadi_total += $collection_rate['total'] ?>
            </tr>
        <?php endforeach;
        endif; ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2" style="text-align: right"><b>जम्मा</b></td>
          <?php
          $net_total = $nagadi_total + $sampati_kar['total'] + $bhumi_kar['total'];
          ?>
          <td colspan="2" align="left"><?php echo !empty($net_total) ? $this->mylibrary->convertedcit(round($net_total, 2)) : $this->mylibrary->convertedcit(0) ?></td>
        </tr>
      </tfoot>
    </table>
  </div>
  <!--end of page-->

  <script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/jsprint/printThis.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#basic').on("click", function() {
        $('.hideme').hide();
        window.print();
        // $('#container').printThis();
      });
    });
  </script>

</body>

</html>