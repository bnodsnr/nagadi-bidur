<?php
if (!empty($lands)) { ?>
  <hr>
  <div class="alert alert-info">कित्ता नामसारी गर्नुपर्ने कित्ता नं. मा टिक लगानुहोस</div>
  <form class="form" action="<?php echo base_url() ?>LandDetails/ImportLandDetails">
    <table class="table table-bordered table-stripe print_table" id="">
      <thead style="background:#1b5693;color:#fff">
        <tr>
          <th>#</th>
          <th>दाखिला मिति</th>
          <th>कि.नं</th>
          <th>साबिक</th>
          <th>हाल</th>
          <th style="width:250px;">सडकको नाम</th>
          <th>जग्गाको क्षेत्रगत किसिम</th>
          <?php if (MODULE == 2) { ?>
            <th>जग्गाको क्षेत्रगत किसिम</th>
          <?php } ?>
          <th>न.न</th>

          <th>क्षेत्रफल</th>
          <?php if (MODULE != 3) { ?>
            <th>तोकिएको न्युनतम मुल्य
              (<?php if (CALC == 1) {
                  echo 'प्रति रोपनी';
                } else {
                  echo 'प्रति कठ्ठा';
                } ?>)</th>
            <th>कबुल गरेको मुल्य( <?php if (CALC == 1) {
                                    echo '(प्रति रोपनी';
                                  } else {
                                    echo 'प्रति कठ्ठा';
                                  } ?>)</th>
          <?php } ?>
          <th>मुल्यांकन रकम </th>
          <th>आ व. </th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        if (!empty($lands)) :
          foreach ($lands as $post) : ?>
            <tr style="background-color: <?php if ($post->buy_sell_status  == 2) {
                                            echo '#e21a1a';
                                          } ?>;color:<?php if ($post->buy_sell_status  == 2) {
                                                        echo '#fff';
                                                      } ?>">

              <td><input type="checkbox" name="land_id" value="<?php echo $post->id ?>" required="true"></td>

              <td><?php echo $this->mylibrary->convertedcit($post->added_on) ?></td>
              <td><?php echo $this->mylibrary->convertedcit($post->k_number) ?></td>
              <td><?php echo $post->old_gapa_napa . '-' . $this->mylibrary->convertedcit($post->old_ward) ?></td>
              <td><?php echo $post->present_gapa_napa . '-' . $this->mylibrary->convertedcit($post->present_ward) ?></td>
              <td><?php echo $post->rm ?></td>
              <td><?php echo $post->lat ?></td>
              <td><?php echo $this->mylibrary->convertedcit($post->nn_number) ?></td>
              <td>
                <?php
                $biga = !empty($post->a_ropani) ? $post->a_ropani : 0;
                $kattha = !empty($post->a_ana) ? $post->a_ana : 0;
                $dhur = !empty($post->a_paisa) ? $post->a_paisa : 0;
                $dam = !empty($post->a_dam) ? $post->a_dam : 0;
                echo $this->mylibrary->convertedcit($biga) . '.' . $this->mylibrary->convertedcit($kattha) . '.' . $this->mylibrary->convertedcit($dhur) . '.' . $this->mylibrary->convertedcit($dam) . ' (रोपनी. आना .पैसा.दाम)';
                ?>
              </td>
              <td><?php echo $this->mylibrary->convertedcit($post->min_land_rate); ?></td>
              <td><?php echo $this->mylibrary->convertedcit($post->k_land_rate) ?></td>
              <td><?php echo $this->mylibrary->convertedcit($post->t_rate) ?></td>
              <td><?php echo $this->mylibrary->convertedcit($post->fiscal_year) ?></td>
            </tr>
        <?php endforeach;
        endif; ?>
      </tbody>
    </table>

    <div class="col-md-12 text-center">

      <hr>

      <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Save"> सेभ
        गर्नुहोस्</button>
    </div>
  </form>
<?php } else { ?>
<div class="alert alert-danger">जग्गा दाखिला गरिएको छैन !!</div>
<?php } ?>