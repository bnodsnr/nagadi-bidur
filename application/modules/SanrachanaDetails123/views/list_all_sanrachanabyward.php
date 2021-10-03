 
<style type="text/css">
  table tbody {
  /*  display: table;
    width: 100%;*/
}
</style>
 <!--main content start-->
 <section id="main-content">
  <section class="wrapper site-min-height">
    
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
        <section class="card">
            <div class="card-body">
              <form class="form" action="<?php echo base_url()?>SanrachanaDetails/UpdateAll" method ="post">
                 <button class="btn btn-primary btn-block" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="submit" type="submit" value="Save"> सेभ
                                            गर्नुहोस्</button>

                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <table class="print_table table table-bordered table-responsive">
                  <thead>
                    <tr>
                      <th rowspan="2">क्र.सं</th>
                      <th rowspan="2">कर दाता संकेत</th>
                      <th colspan="5" >जग्गाको विवरण</th>
                      <th colspan="19" style="text-align:center;">भौतिक संरचनाको विवरण</th>
                    </tr>
                    <tr>
                      <th>कित्ता नं</th>
                      <th>रो-आ-पै-दा</th>
                      <th>वर्ग फुट</th>
                      <th>न्यु मुल्य</th>
                      <th>जग्गाको (मु. रकम )</th>

                      <th>कि.नं</th>
                      <th>संरचना रहेको जग्गाको क्षेत्रफ़ल् (रोपनी)</th>
                      <th>वा फु</th>

                      <th>प्रकार</th>
                      <th>ब. कि </th>
                      <th>प्रयोग  </th>
                      <th>तल्ला  </th>
                       <th>लम्बाई*</th>
                      <th>चौडाई</th>
                      <th>वर्गफुट</th>
                      <th>ज.वर्गफुट</th>
                      <th>न्यु मु(प्र व.फु. )</th>
                      <th>कवोल मु </th>
                      <th>कायम मु *</th>
                      <th>चर्चेकाे जग्गाको क्षेत्रफल*</th>
                      <th>चर्चेकाे जग्गाको कर लाग्ने मुल्य*</th>
                      <th>सम्पति मूल्याङ्कन जम्मा मुल्य *</th>
                      <th>चर्चेकाे बाहेक भूमिकर जग्गाको क्षेत्रफल</th>
                      <th>चर्चेकाे बाहेक जग्गाको भूमिकर मूल्याङ्कन *</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;if(!empty($report)) :foreach($report as $san) : ?>
                    <tr style="color:<?php if($san['stat'] == 'wrong'){echo '#fff';}?>;background-color:<?php if($san['stat'] == 'wrong'){echo '#e21a1a';}?>;">
                      <td><?php echo $i++?>
                      <?php if($san['stat'] == 'wrong') { ?>
                        <input type="checkbox" name="sanrachana_ids[]" value="<?php echo $san['id']?>" class="form-control" checked="true">
                       <?php } ?><?php echo $san['id'];?>
                      </td>
                      <td><?php echo $san['ls_file_no']?></td>
                      <td style="text-align:left;"><?php echo $san['k_number']?></td>
                      <td><?php echo $san['total_la']?></td>
                      <td><?php echo $san['total_land_area_sqft']?></td>
                      <td><?php echo $san['total_land_min_amount']?></td>
                      <td><?php echo $san['total_land_tax_amount']?></td>
                      <td><?php echo $san['k_no']?></td>
                      <td><?php echo $san['toal_land_area']?></td>
                      <td><?php echo $san['total_land_area_sqft']?></td>
                      <td><?php echo $san['prakar']?></td>
                      <td><?php echo $san['banot']?></td>
                      <td><?php echo $san['sanrachana_usages']?></td>
                      <td><?php echo $san['sanrachana_floor']?></td>
                      <td><?php echo $san['sanrachana_ground_lenth']?></td>
                      <td><?php echo $san['sanrachana_ground_width']?></td>
                      <td><?php echo $san['sanrachana_ground_area_sqft']?></td>
                      <td><?php echo $san['sanrachana_ground_housing_area_sqft']?></td>
                      <td><?php echo $san['sanrachana_min_amount']?></td>
                      <td><?php echo $san['sanrachana_kubul_amount']?></td>
                      <td><?php echo $san['sanrachana_khud_amount']?></td>
                      <td><?php echo $san['sanrachana_ground_area_ropani']?></td>
                      <td><?php echo $san['sanrachana_land_tax_amount']?></td>
                      <td><?php echo $san['net_tax_amount']?></td>
                      <td><?php echo $san['r_bhumi_area']?></td>
                      <td><?php echo $san['r_bhumi_kar']?></td>
                    </tr>
                  <?php endforeach;endif;?>
                  </tbody>
                </table>

              </form>
            </div>
        </section>
      </div>
    </div>
    <!-- page end-->
  </section>
 </section>