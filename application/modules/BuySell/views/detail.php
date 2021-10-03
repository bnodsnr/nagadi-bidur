 <!--main content start-->
 <style type="text/css">
   table, tr, td {
      border: none;
    }
 </style>
 <section id="main-content">

  <section class="wrapper site-min-height">

    <nav aria-label="breadcrumb">

      <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>

        </li>

        <li class="breadcrumb-item"><a href="javascript:;">व्यक्तिगत अभिलेख</a></li>

      </ol>

    </nav>

    <!-- page start-->

    <div class="row">

      <div class="col-sm-12">

        <?php $success_message = $this->session->flashdata("MSG_SUCCESS");

                      if(!empty($success_message)) { ?>

        <div class="alert alert-success">

          <button class="close" data-close="alert"></button>

          <span> <?php echo $success_message;?> </span>

        </div>

        <?php } ?>

        <section class="card">
          <div class="card-header" style="background-color:#e21a1a;color:#fff">जग्गाधनीको नाम: <?php echo get_name($list['seller_file_no'])?>(<?php echo $this->mylibrary->convertedcit($list[0]['seller_file_no'])?>)</div>
          <div class="card-body" style="background-color: #e21a1a; color:#fff">
            <table class="table table-bordered table-striped" id="">
              <thead style="background-color: #e5e5e5; color:#000">
                <tr>
                  <th align="center">कित्ता नं.</th>
                  <th align="center"> रोपनी  </th>
                  <th align="center"> आना  </th>
                  <th align="center"> पैसा  </th>
                  <th align="center"> दाम  </th>
                  <th align="center"> वर्ग फु  </th>
                  <th align="center"> वर्ग मि  </th>
                  <th align="center">मूल्याङ्कन रकम</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                 <?php $i=1; if(!empty($land_details)) :
                    foreach($land_details as $ld) : ?>
                <tr style="color:#000">
                  <td><?php echo $this->mylibrary->convertedcit($ld['k_number'])?></td>
                  <td style="width: 100px;"><?php echo $this->mylibrary->convertedcit($ld['a_ropani'])?></td>
                  <td style="width: 100px;"><?php echo $this->mylibrary->convertedcit($ld['a_ana'])?></td>
                  <td style="width: 150px;"><?php echo $this->mylibrary->convertedcit($ld['a_paisa'])?></td>
                  <td style="width: 150px;"><?php echo $this->mylibrary->convertedcit($ld['a_dam'])?></td>
                  <td style="width: 100px;"><?php echo $this->mylibrary->convertedcit($ld['total_square_feet'])?></td>

                  <td style="width: 100px;"><?php echo '-'?></td>
                  <td style="width: 200px;"><?php echo $this->mylibrary->convertedcit($ld['t_rate'])?></td>
                  <td><?php if($ld['buy_sell_status'] == 2 ){ echo '<i class ="fa fa-times-circle"></i>';} else{ echo '<i class="fa fa-check-circle"></i>';}?></td>
                </tr>
              <?php endforeach;endif;?>
              </tbody>
            </table>
          </div>
        </section>

        <section class="card">
          <div class="card-header" style="background-color:#1b5693;color:#fff"><h3>जग्गाको कित्ता काट्को विवरण</h3></div>
          <div class="card-body">
            <table class="table table-bordered table-striped" id="">
              <thead>
                <tr style="color:#000">
                  <th align="center">कित्ता नं.</th>
                  <th align="center"> रोपनी  </th>
                  <th align="center"> आना  </th>
                  <th align="center"> पैसा  </th>
                  <th align="center"> दाम  </th>
                  <th align="center"> वर्ग फु  </th>
                  <th align="center"> वर्ग मि  </th>
                  <th align="center">मूल्याङ्कन रकम</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($list)) : 
                foreach($list as $bs) : ?>
                <tr class="" style="color:#000">
                  <td><?php echo $this->mylibrary->convertedcit($bs['jk_no'])?></td>
                  <td style="width: 100px;"><?php echo $this->mylibrary->convertedcit($bs['b_ropani'])?></td>
                  <td style="width: 100px;"><?php echo $this->mylibrary->convertedcit($bs['b_aana'])?></td>
                  <td style="width: 100px;"><?php echo $this->mylibrary->convertedcit($bs['b_paisa'])?></td>
                  <td style="width: 150px;"><?php echo $this->mylibrary->convertedcit($bs['b_dam'])?></td>
                  <td style="width: 150px;"><?php echo $this->mylibrary->convertedcit($bs['new_sq_feet'])?></td>
                  <td style="width: 100px;"><?php echo '-'?></td>
                  <td style="width: 200px;"><?php echo $this->mylibrary->convertedcit($bs['new_tax_amount'])?></td>
                </tr>
              <?php endforeach;endif;?>
              </tbody>
            </table>
          </div>
        </section>
      </div>

    </div>

    <!-- page end-->

  </section>

</section>