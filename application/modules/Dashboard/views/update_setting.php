<section id="main-content">

    <section class="wrapper site-min-height">

      <nav aria-label="breadcrumb">

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>

            <li class="breadcrumb-item"><a href="javascript:;">जिल्ला</a></li>

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

              

              <div class="card-body">

                <div class="adv-table">

                  <table class="table table-hover table-bordered table-striped">

                      <thead>

                        <tr>

                            <th>शीर्षक</th>

                            <th>#</th>

                        </tr>

                      </thead>

                      <tbody>



                           <tr><td colspan="2" align="center"><div class="alert alert-info"><span class="text-center">नगदी तर्फ</span></div></td></tr>

                         <tr>

                            <td class="p-name">

                              मुख्य शीर्षक

                            </td>

                            

                            <td>

                              <?php if(empty($main_topic)) :?>

                              <a href="<?php echo base_url()?>Dashboard/updateMainTopic"  class="btn btn-primary">update</a>

                              <?php else : ?>

                                  <div class="alert alert-success">Updated successfully</div>

                                <?php endif;?>

                            </td>

                          </tr>



                          <tr>

                              <td class="p-name">

                                सह शीर्षक

                              </td>

                            

                              <td>

                                <?php if(empty($topic)) :?>

                                <a href="<?php echo base_url()?>Dashboard/updateTopic"  class="btn btn-primary">update</a>

                                <?php else : ?>

                                  <div class="alert alert-success">Updated successfully</div>

                                <?php endif;?>

                              </td>

                          </tr>



                          <tr>

                              <td class="p-name">

                                नगदी दर / रेट

                              </td>

                            

                              <td>

                                <?php if(empty($sub_topic)) :?>

                                <a href="<?php echo base_url()?>Dashboard/updateTopicRate"  class="btn btn-primary">update</a>

                                <?php else : ?>

                                  <div class="alert alert-success">Updated successfully</div>

                                <?php endif;?>

                              </td>

                          </tr>

                          <tr><td colspan="2" align="center"><div class="alert alert-info"><span class="text-center">सम्पति तर्फ</span></div></td></tr>

                          <tr>

                              <td class="p-name">

                               सडकको किसिम

                              </td>

                            

                              <td>

                                <?php if(empty($settings_road_type)) :?>

                                  <a href="<?php echo base_url()?>Dashboard/updateRoadType"  class="btn btn-primary">update</a>

                                <?php else : ?>

                                  <div class="alert alert-success">Updated successfully</div>

                                <?php endif;?>

                              </td>

                          </tr>

                          <tr>

                            <td class="p-name">

                             सडकहरुको सुची

                            </td>

                            

                              <td>

                                <?php if(empty($settings_road)) :?>

                                <a href="<?php echo base_url()?>Dashboard/updateRoad"  class="btn btn-primary">update</a>

                                 <?php else : ?>

                                  <div class="alert alert-success">Updated successfully</div>

                                <?php endif;?>

                              </td>

                          </tr>



                          <tr>

                              <td class="p-name">जग्गाको क्षेत्रगत किसिम</td>

                              

                              <td>

                                <?php if(empty($settings_land_area_type)) :?>

                                <a href="<?php echo base_url()?>Dashboard/updateLandAreaType"  class="btn btn-primary">update</a>

                                <?php else : ?>

                                  <div class="alert alert-success">Updated successfully</div>

                                <?php endif;?>

                              </td>

                          </tr>

                       

                          <tr>

                              <td class="p-name">

                                जग्गाको न्युनतम मूल्य 

                              </td>

                             

                                <td>

                                  <?php if(empty($settings_area_minimal_cost)) :?>

                                    <a href="<?php echo base_url()?>Dashboard/updateLandMinAmount"  class="btn btn-primary">update</a>

                                  <?php else : ?>

                                    <div class="alert alert-success">Updated successfully</div>

                                  <?php endif;?>

                                </td>

                          </tr>

                          <tr>

                              <td class="p-name">

                               संरचनाको प्रकार

                              </td>

                             

                                <td>

                                  <?php if(empty($settings_architect_type)) :?>

                                   <a href="<?php echo base_url()?>Dashboard/updatesanrachakoPrakar"  class="btn btn-primary">update</a>

                                  <?php else : ?>

                                    <div class="alert alert-success">Updated successfully</div>

                                  <?php endif;?>

                                </td>

                          </tr>

                          <tr>

                              <td class="p-name">

                                 संरचनाको बनौटको किसिम

                              </td>

                             

                                <td>

                                  <?php if(empty($settings_architect_structure)) :?>

                                  <a href="<?php echo base_url()?>Dashboard/updatesanrachakoBanotKoKisim"  class="btn btn-primary">update</a>

                                  <?php else : ?>

                                    <div class="alert alert-success">Updated successfully</div>

                                  <?php endif;?>

                                </td>

                          </tr>

                          <tr>

                              <td class="p-name">

                                संरचनाको न्युनतम मूल्य

                              </td>

                             

                              <td>

                                <?php if(empty($settings_structure_minimum_amount)) :?>

                                <a href="<?php echo base_url()?>Dashboard/updateSanrachanaMinAmount"  class="btn btn-primary">update</a>

                               <?php else : ?>

                                  <div class="alert alert-success">Updated successfully</div>

                                <?php endif;?>

                              </td>



                          </tr>



                          <tr>

                              <td class="p-name">

                               सम्पति / भुमि कर को रेटहर.

                              </td>

                             

                              <td>

                                <?php if(empty($sampati_bhumi_kar_rate)) :?>

                                <a href="<?php echo base_url()?>Dashboard/updateSampatiKarBhumiKarRate"  class="btn btn-primary">update</a>

                               <?php else : ?>

                                  <div class="alert alert-success">Updated successfully</div>

                                <?php endif;?>

                              </td>

                          </tr>
                          <tr>
                              <td class="p-name">
                                संरचनाको आयु 
                              </td>
                              <td>
                              <?php if(empty($settings_architect_age)) :?>
                                <a href="<?php echo base_url()?>Dashboard/updateSanrachanaDep"  class="btn btn-primary">update</a>
                             <?php else : ?>
                                <div class="alert alert-success">Updated successfully</div>
                              <?php endif;?>
                              </td>
                          </tr>

                          <tr>
                              <td class="p-name">
                                संरचनाको आयु राष्कत्ति 
                              </td>
                              <td>
                              <?php if(empty($settings_architect_age_rate)) :?>
                                <a href="<?php echo base_url()?>Dashboard/updateSanrachanaDepRate"  class="btn btn-primary">update</a>
                              <?php else : ?>
                                <div class="alert alert-success">Updated successfully</div>
                              <?php endif; ?>
                              </td>
                          </tr>
                      </tbody>

                  </table>

                </div>

              </div>

            </section>

          </div>

        </div>

        <!-- page end-->

    </section>

</section>

    

   