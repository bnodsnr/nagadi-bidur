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
    }
  </style>
</head>



<body style="--bleeding: 0.5cm;--margin: 1cm;">
  <div class="">
    <img src="<?php echo base_url() ?>assets/img/nepal-govt.png" style="height: 120px; width: 140px;">
    <div style="font-size:12px; margin-left:25px;">आ ब: <?php echo $this->mylibrary->convertedcit('2077/078') ?></div>
    <div style="font-size: 28px;margin-left: 250px;margin-top: -130px;"><b><?php echo GNAME ?></b></div>
    <div style="margin-left: 277px;margin-top: 0;font-size: 14px;"><b>
        <?php if ($this->session->userdata('PRJ_USER_ID') == 1) {
          echo SLOGAN;
        } else {
          echo $this->mylibrary->convertedcit($this->session->userdata('PRJ_USER_WARD')) . ' नं. वडा कार्यलय';
        } ?></b></div>
    <div style="margin-left: 320px;margin-top:0;font-size: 14px;"><b><?php echo ADDRESS . ',' . DISTRICT ?></b></div>
    <div style="margin-left: 280px;;margin-top: 25px;font-size: 22px;"><b>
        सम्पति रसिद विवरण
      </b>
    </div>

    <table class=" table table-bordered table-striped">
      <thead>
        <tr>
          <th text-aligh="right">#</th>
          <th>वडा नं </th>
          <th>रसिद विवरण</th>
          <!-- <th>रसिद अवस्था</th> -->
          <th>आ. व.</th>
          <!-- <th>
                        
                      </th> -->
        </tr>
      </thead>

      <tbody>
        <?php if (!empty($sampati_bills)) :
          $i = 1;
          foreach ($sampati_bills as $key => $value) : ?>
            <tr class="gradeX">
              <td><?php echo $this->mylibrary->convertedcit($i++) ?></td>
              <td><?php if ($value['ward'] == 0) {
                    echo "नगरपालिका";
                  } else {
                    echo 'वडा नं ' . $this->mylibrary->convertedcit($value['ward']);
                  } ?>( <?php echo $value['name'] ?>)</td>
              <td><?php echo $this->mylibrary->convertedcit($value['bill_from']) . '-' . $this->mylibrary->convertedcit($value['bill_to']) ?></td>
              <!-- <td><?php if ($value['status'] == 1) {
                          echo 'सक्रिय';
                        } else {
                          echo 'निश्क्रिय';
                        } ?></td> -->
              <td><?php echo $this->mylibrary->convertedcit($value['fiscal_year']) ?></td>
              <!-- <td> -->
              <?php
              // $bill_due = $this->BillSettingModel->getLastActiveNagadiBills($value['user_id']);
              //echo $bill_due['bill_no'];
              ?>
              <!-- </td> -->
            </tr>
          <?php endforeach;
        else : ?>
          <tr>
            <td colspan="4">
              <div class="alert alert-danger">चालु आर्थिक वर्षको नगदी रसिद नं दाखिला गरिएको छैन.<br><br>
                <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "ADD")) { ?>
                  <a class="btn btn-secondary btn-sm" style="color:#FFF" href="<?php echo base_url() ?>BillSetting/add"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                <?php } ?>
              </div>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <!--end of page-->
</body>

</html>