<style type="text/css">

   table, th, td {

    border: 1px solid black;

    border-collapse: collapse;

  }

  td.details-control {

      background: url('../resources/details_open.png') no-repeat center center;

      cursor: pointer;

  }

  tr.shown td.details-control {

      background: url('../resources/details_close.png') no-repeat center center;

  }

</style>

 <!--main content start-->

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

      

          <header class="card-header" style="background: #1b5693;color:#FFF">



              <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">

                  <li class="nav-item">

                      <a class="nav-link show active btn btn-warning" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">व्यक्तिगत विवरण</a>

                  </li>

                  <li class="nav-item">

                      <a class="nav-link  btn btn-warning" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">पारिवारिक विवरण</a>

                  </li>

                  <li class="nav-item">

                      <a class="nav-link  btn btn-warning" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">जग्गा/संरचनाको को विवरण</a>

                  </li>

                 

              </ul>

          </header>

          <div class="card-body">

            <div class="tab-content tasi-tab" id="myTabContent">

                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <table class="table table-bordered table-striped">

                       <tr>

                         <td>

                            <div class="bio-row">

                              <span class=""> जग्गाधनिको नाम र थर  </span>: <span class=""><b><?php echo $profile_details['land_owner_name_np']?></b></span>

                            </div>

                            <div class="bio-row">

                               <span class="">जग्गाधनिको नाम (अंग्रेजी) </span>:  <span class=""><b><?php echo $profile_details['land_owner_name_en']?></b></span>

                            </div>

                         </td>

                       </tr>

                        <tr>

                          <td>

                            <div class="bio-row">

                             <span class="">बाबु/पतिको नाम र थर </span>: <span class=""><?php echo $profile_details['land_owner_father_name']?></span>

                            </div>

                            <div class="bio-row">

                               <span class="">बाजे/ससुराको नाम र थर </span>: <?php echo $profile_details['land_owner_grandpa_name']?>

                            </div>

                          </td>

                        </tr>

                         <tr>

                          <td>

                            <div class="bio-row">

                             <span class="">नगरिकता नं </span>: <span class=""><?php echo $this->mylibrary->convertedcit($profile_details['lo_czn_no'])?></span>

                            </div>

                            <div class="bio-row">

                               <span class="">स्थायी लेखा नं </span>: <?php echo $this->mylibrary->convertedcit($profile_details['lo_pan_no'])?>

                            </div>

                          </td>

                        </tr>

                         <tr>

                          <td>

                            <div class="bio-row">

                             <span class="">पेशा </span>: <?php echo $this->mylibrary->convertedcit($jobs['name'])?><span class=""></span>

                            </div>

                            <div class="bio-row">

                               <span class="">करदाताको लिंग</span>: <?php echo $profile_details['land_owner_gender']?>

                            </div>

                          </td>

                        </tr>

                         <tr>

                          <td>

                            <div class="bio-row">

                             <span class="">राष्ट्रियता</span>: <span class=""><?php echo $nationality['name']?></span>

                            </div>

                            <div class="bio-row">

                               <span class="">इमेल ठेगाना</span>: <?php echo $profile_details['land_owner_email']?>

                            </div>

                          </td>

                        </tr>

                         <tr>

                          <td>

                            <div class="bio-row">

                             <span class="">सम्पर्क फोन नं.</span>: <span class=""><?php echo $profile_details['land_owner_contact_no']?></span>

                            </div>

                             <div class="bio-row">

                             <span class="">करदाताको क्र.स नम्बर.</span>: <span class="badge badge-warning"><?php echo $this->mylibrary->convertedcit($profile_details['file_no'])?></span>

                            </div>

                            

                          </td>

                        </tr>

                    </table>



                    <table class="table table-bordered table-striped">

                      <thead style="background: #1b5693;color:#FFF">

                        <tr colspan ="2">

                          <th>जग्गाधनिको ठेगाना(स्थायी)</th>

                        </tr>

                      </thead>

                       <tr>

                         <td>

                            <div class="bio-row">

                              <span class="">प्रदेश  </span>: <span class=""><b><?php echo $lo_state['Title']?></b></span>

                            </div>

                            <div class="bio-row">

                               <span class="">जिल्ला </span>:  <span class=""><b><?php echo $lo_districts['name']?></b></span>

                            </div>

                         </td>

                       </tr>

                        <tr>

                          <td>

                            <div class="bio-row">

                             <span class="">वडा</span>: <span class=""><?php echo $this->mylibrary->convertedcit($profile_details['lo_ward'])?></span>

                            </div>

                            <div class="bio-row">

                               <span class="">जग्गा रहेको वडा नं </span>: <?php echo $this->mylibrary->convertedcit($profile_details['lo_land_lac_ward'])?>

                            </div>

                          </td>

                        </tr>



                        <tr>

                          <td>

                            <div class="bio-row">

                             <span class="">टोल/ठाउँ</span>: <span class=""><?php echo $profile_details['lo_tol']?></span>

                            </div>

                            <div class="bio-row">

                               <span class="">घर नम्बर</span>: <?php echo $this->mylibrary->convertedcit($profile_details['lo_house_no'])?>

                            </div>

                          </td>

                        </tr>

                      </table>





                    <table class="table table-bordered table-striped">

                      <thead style="background: #1b5693;color:#FFF">

                        <tr colspan ="2">

                          <th>जग्गाधनिको ठेगाना(अस्थायी)</th>

                        </tr>

                      </thead>

                      <tr>

                         <td>

                            <div class="bio-row">

                              <span class="">प्रदेश  </span>: <span class=""><b><?php echo $lo_state['Title']?></b></span>

                            </div>

                            <div class="bio-row">

                               <span class="">जिल्ला </span>:  <span class=""><b><?php echo $lo_districts['name']?></b></span>

                            </div>

                         </td>

                      </tr>

                      <tr>

                        <td>

                          <div class="bio-row">

                           <span class="">वडा</span>: <span class=""><?php echo $this->mylibrary->convertedcit($profile_details['lo_ward'])?></span>

                          </div>

                          <div class="bio-row">

                             <span class="">जग्गा रहेको वडा नं </span>: <?php echo $this->mylibrary->convertedcit($profile_details['lo_land_lac_ward'])?>

                          </div>

                        </td>

                      </tr>

                      <tr>

                        <td>

                          <div class="bio-row">

                           <span class="">टोल/ठाउँ</span>: <span class=""><?php echo $profile_details['lo_temp_tol']?></span>

                          </div>

                          <div class="bio-row">

                             <span class="">घर नम्बर</span>: <?php echo $this->mylibrary->convertedcit($profile_details['lo_house_no'])?>

                          </div>

                        </td>

                      </tr>

                    </table>

                    <table class="table table-bordered table-striped">

                      <thead style="background: #1b5693;color:#FFF">

                        <tr colspan ="2">

                          <th>विवरण दाखिला गर्ने को विवरण(सुचक)</th>

                        </tr>

                      </thead>

                      <tr>

                         <td>

                            <div class="bio-row">

                              <span class="">प्रदेश  </span>: <span class=""><b><?php echo $lo_fi_state['Title']?></b></span>

                            </div>

                            <div class="bio-row">

                               <span class="">जिल्ला </span>:  <span class=""><b><?php echo $lo_fi_district['name']?></b></span>

                            </div>

                         </td>

                      </tr>

                      <tr>

                        <td>

                          <div class="bio-row">

                           <span class="">गा पा / न पा</span>: <span class=""><?php echo $this->mylibrary->convertedcit($lo_fi_gapanapa['name'])?></span>

                          </div>

                          <div class="bio-row">

                             <span class="">वडा नं </span>: <?php echo $this->mylibrary->convertedcit($profile_details['lo_fi_ward'])?>

                          </div>

                        </td>

                      </tr>

                      <tr>

                        <td>

                          <div class="bio-row">

                           <span class="">नाम/थर</span>: <span class=""><?php echo $profile_details['lo_fi_name']?></span>

                          </div>

                          <div class="bio-row">

                             <span class="">जग्गाधनी संगको नाता</span>: <?php echo $this->mylibrary->convertedcit($profile_details['lo_fi_relation'])?>

                          </div>

                        </td>

                      </tr>

                    </table>

                </div>

                

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

              <div class="card">
                    <div class="card-header">
                      <a href="<?php echo base_url()?>PersonalProfile/addFamilyDetails/<?php echo $profile_details['file_no']?>" class="btn btn-success"><i class="fa fa-plus-circle"></i> पारिवारिक विवरण थप्नुहोस</a>
                      <a href="<?php echo base_url()?>PersonalProfile/editFamilyDetails/<?php echo $profile_details['file_no']?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> पारिवारिक विवरण सम्पादन गर्नुहोस </a>
                    </div>
                  
                    <div class="card-body">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>क्र.सं</th>
                            <th align="text-center">परिवार सदस्यहरुको नाम</th>
                            <th align="text-center"> जन्म मिति </th>
                            <th align="text-center">नाता</th>
                            <th align="text-center">नागरिकता नं</th>
                            <th align="text-center"> जन्म दर्ता नं</th>
                          </tr>
                        </thead>

                        <?php if(!empty($family_details)) {

                          foreach($family_details as $key=> $family) { ?>
                            <tr>
                              <td><?php echo $this->mylibrary->convertedcit($key+1)?></td>
                              <td><?php echo $family['member_name']?></td>
                              <td><?php echo $this->mylibrary->convertedcit($family['member_age'])?></td>
                              <td><?php echo $family['member_relation']?></td>
                              <td><?php echo $this->mylibrary->convertedcit($family['citizenship_no'])?></td>
                              <td><?php echo $this->mylibrary->convertedcit($family['birth_darta'])?></td>
                            </tr>
                          <?php } } else {
                            echo '<div class="alert alert-danger">पारिवारिक विवरण विवरण दाखिला गरिएको छैन</div>';
                          } ?>
                        </table>
                    </div>
                  </div>
                </div>

                </div>

                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                    <?php if(!empty($Billsdetails)) { ?> 

                        <table class="table table-bordered table-responsive print_table">

                          <thead>

                              <tr>

                                <th rowspan="2">क्र.सं</th>

                                <th colspan="8" class="text-center">जग्गाको विवरण</th>

                                <th colspan="5" style="width:180px;">भौतिक संरचनाको विवरण</th>

                                <th colspan="2" style="width:180px;">भूमिकर मूल्यांकन</th>

                                <!-- <th colspan="2" style="width:180px;">करहरुकोदर रेट</th> -->

                                <!-- <th rowspan="2" style="width:180px;">सम्पतीकर</th>

                                <th rowspan="2" style="width:180px;">भूमिकर</th> -->

                              </tr>

                              <tr>

                                <th style="width:180px;">साबिक गा.पा/न.पा</th>

                                <th style="width:180px;">हालको वडा</th>

                                <th style="width:180px;">सडकको नाम</th>

                                    <th style="width:180px;">जग्गाको क्षेत्रगत किसिम</th>

                                    <?php if(MODULE == 2){ ?>

                                      <th style="width:180px;">जग्गाको श्रेणी</th>

                                    <?php } ?>

                                    <th style="width:180px;">तोकिएको न्युनतम मुल्य(प्रति <?php echo 'रोपनी'?>)</th>

                                <th style="width:180px;">नक्सा नं</th>

                                <th style="width:180px;">कित्ता नं</th>

                                <th style="width:180px;">क्षेत्रफल</th>



                                <th style="width:180px;">बनावटको किसिम</th>

                                <th style="width:180px;">प्रयोग</th>

                                <th style="width:180px;">प्रकार </th>

                                <th style="width:180px;">क्षेत्रफल(व फु )</th>

                                <th style="width:180px;">सम्पतिकर मूल्यांकन </th>



                                <th>क्षेत्रफल(व फु )</th>

                                <th>कर लाग्ने मुल्य </th>

                              </tr>

                          </thead>

                          <tbody>

                              <?php 

                              if(!empty($Billsdetails)){

                                $i=1;

                                $sampati_mulyankan_amount = 0;

                                $bhumi_kar_mulyankan_rakam = 0;

                                $total_ropani = 0;

                                foreach ($Billsdetails as $key => $value) { ?>

                                  <tr>

                                    <!-- jagga ko biwaran -->

                                    <td style="width: 180px"><?php echo $this->mylibrary->convertedcit($i++)?></td>

                                    <td><?php echo $value['old_gapa_napa'].'-'.$value['old_ward']?></td>

                                    <td><?php echo $value['present_gapa_napa'].'-'.$value['present_ward']?></td>

                                    <td><?php echo $value['rm']?></td>

                                    <td><?php echo $value['land_area_type']?></td>

                                    <?php if(MODULE == 2) { ?>

                                      <td><?php echo $value['category']?></td>

                                    <?php } ?>

                                    <td><?php echo $this->mylibrary->convertedcit($value['k_land_rate'])?></td>

                                    <td><?php echo $this->mylibrary->convertedcit($value['nn_number'])?></td>

                                    <td><?php echo $this->mylibrary->convertedcit($value['k_number'])?></td>

                                    <!-- land area details -->

                                    <td>

                                      <?php

                                        echo $this->mylibrary->convertedcit($value['a_ropani']).'-'.$this->mylibrary->convertedcit($value['a_ana']).'-'.$this->mylibrary->convertedcit($value['a_paisa']).$this->mylibrary->convertedcit($value['a_dam']);

                                      ?>

                                      = <?php echo $this->mylibrary->convertedcit($value['total_square_feet']).'(व फु)'?>

                                      <br></td>

                                    <!-- ends land area details -->

                                    <!-- if not empty show snarachana details -->

                                    <?php if(!empty($value['sanrachana_id'])) { ?>

                                      <td><?php echo $value['structure_type']?></td>

                                      <td><?php echo $value['sanrachana_usages']?></td>

                                      <td><?php echo $value['architect_type']?></td>

                                      <td><?php echo $this->mylibrary->convertedcit($value['sanrachana_ground_housing_area_sqft'])?>

                                        <?php 

                                          $sanrachanako_sqft = $value['sanrachana_ground_housing_area_sqft']/5476;  // sanrachan ground level convert into ropani



                                        ?>

                                        =<?php echo $this->mylibrary->convertedcit(round($sanrachanako_sqft,2));?>

                                      </td>

                                      <td><?php echo $this->mylibrary->convertedcit($value['net_tax_amount'])?></td>

                                      <!-- sum sampati mulyankan rakam -->

                                      <?php if(!empty($value['net_tax_amount'])){

                                        $sampati_mulyankan_amount += $value['net_tax_amount']; //sum sampati mulyankan rakam.

                                      } else{

                                        $sampati_mulyankan_amount = 0;

                                      } ?>

                                      <!-- sum sampati mulyankan rakam -->

                                    <?php } else { ?>

                                      <td colspan="5"><div class="alert alert-danger">भौतिक संरचनाको विवरण बनेको छैन </div></td>

                                    <?php } ?>

                                    <!-- end of sanrachana section -->

                                    <td>

                                      <?php if(!empty($value['sanrachana_id'])) { 

                                        $bhumi_eval = $value['r_bhumi_area'];

                                        $ropani = $bhumi_eval/5476;

                                      } else { 

                                        $bhumi_eval = $value['total_square_feet'];

                                        $ropani = $bhumi_eval/5476;

                                       } 

                                       if(CALC ==1) {

                                        $unit = 'रोपनी';

                                       } else {

                                        $unit = 'कठ्ठा';

                                       }

                                       echo $this->mylibrary->convertedcit($bhumi_eval).'('.$this->mylibrary->convertedcit(round($ropani,2)).$unit.')';

                                       ?>

                                    </td>

                                    <!-- bhumi kar rakam -->

                                    <td>

                                      <?php if(!empty($value['sanrachana_id'])) {

                                        $bhumi_kar_lagne_rakam =  $value['r_bhumi_kar'];

                                      }else {

                                        $bhumi_kar_lagne_rakam = $value['t_rate'];

                                      } 

                                      //get bhumi_kar_mulyankan_rakam

                                      if(!empty($bhumi_kar_lagne_rakam)) {

                                        $bhumi_kar_mulyankan_rakam += $bhumi_kar_lagne_rakam;

                                      }

                                      echo $this->mylibrary->convertedcit($bhumi_kar_lagne_rakam);

                                      ?>

                                      <?php $total_ropani += $value['total_square_feet'];?>

                                    </td>

                                  </tr>

                                  

                              <?php }

                              } ?>

                          </tbody>

                          <tfoot>

                              <tr>

                                <td colspan="13" class="text-right">जम्मा सम्पती मूल्यांकन </td>

                                <td colspan="" class="text-left"><?php echo $this->mylibrary->convertedcit($sampati_mulyankan_amount)?></td>

                                <td colspan="">जम्मा भूमिकर मूल्यांकन</td>

                                <td colspan="">

                                <?php echo !empty($bhumi_kar_mulyankan_rakam)?$this->mylibrary->convertedcit($bhumi_kar_mulyankan_rakam):0; ?>

                                </td>

                              </tr>

                        </table>

                    <?php  } else {

                        echo '<div class="alert alert-danger">विवरण दाखिला गरिएको छैन</div>';

                    } ?>

                </div>

            </div>      

          </div>

        </section>

      </div>

    </div>

    <!-- page end-->

  </section>

</section>