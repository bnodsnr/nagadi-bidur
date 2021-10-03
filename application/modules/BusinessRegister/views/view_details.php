 <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item active"><a href="<?php echo base_url()?>BusinessRegister" class="bactive">व्यावसायको दर्ता अभिलेख</a></li>
                  <li class="breadcrumb-item active"><a href="javascript:;" class="bactive">विवरण हेर्नुहोस</a></li>
                  
              </ol>
            </nav>
              <!-- page start-->
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="card">
                          <div class="user-heading round">
                              <a href="#">
                                  <img src="<?php echo base_url()?>assets/business_owner/<?php echo !empty($data['userfile'])?$data['userfile']:'owner.png'?>" alt="">
                              </a> 
                              <h1><?php echo !empty($data['firm_name_nepali'])?$data['firm_name_nepali']:''?></h1>
                              <p><?php echo !empty($data['owner_number'])?$this->mylibrary->convertedcit($data['owner_number']):''?></p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li class="active nav-item"><a class="nav-link" href="<?php echo base_url()?>BusinessRegister/Edit/<?php echo $data['id']?>" target="_blank"> <i class="fa fa-pencil"></i> विवरण सम्पादन गर्नुहोस्</a></li>
                              <li class="nav-item"><a class="nav-link" href="profile-activity.html"> <i class="fa fa-print"></i> प्रिन्ट गर्नुहोस् <span class="badge badge-danger pull-right r-activity">9</span></a></li>
                              <li class="nav-item"><a class="nav-link" href="profile-edit.html"> <i class="fa fa-file"></i>कर प्रमाणपत्र प्रिन्ट </a></li>
                              <li class="nav-item"><a class="nav-link" href="profile-edit.html"> <i class="fa fa-file"></i>फर्ममा हुने कारोबारहरु </a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                    <section class="card">
                        <div class="card-body bio-graph-info">
                            <h1>प्रोप्राइटरको अभिलेख</h1>
                            <div class="row">
                                <div class="bio-row">
                                    <p class="label label-success"><span>दर्ता नं </span>: <?php echo !empty($data['id'])?$this->mylibrary->convertedcit($data['id']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>आर्थिक वर्ष </span>: <?php echo !empty($data['fiscal_year'])?$this->mylibrary->convertedcit($data['fiscal_year']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>दर्ता मिती  </span>: <?php echo !empty($data['register_date'])?$this->mylibrary->convertedcit($data['register_date']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>प्रमाणपत्र नं</span>: <?php echo !empty($data['certificate_no '])?$this->mylibrary->convertedcit($data['certificate_no']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>नाम  </span>: <?php echo !empty($data['owner_name'])?$this->mylibrary->convertedcit($data['owner_name']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>लिंग  </span>: <?php echo !empty($data['owner_gender'])?$this->mylibrary->convertedcit($data['owner_gender']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>सम्पर्क नं  </span>: <?php echo !empty($data['owner_number'])?$this->mylibrary->convertedcit($data['owner_number']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>नागरिता नं </span>: <?php echo !empty($data['czn_no'])?$this->mylibrary->convertedcit($data['czn_no']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>नागरिता जारी मिती </span>: <?php echo !empty($data['czn_date'])?$this->mylibrary->convertedcit($data['czn_date']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>नागरिता जारी जिल्ला </span>: <?php echo !empty($data['czn_dis'])?$this->mylibrary->convertedcit($data['czn_dis']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>सडकको नाम </span>: <?php echo !empty($data['owner_road_name'])?$this->mylibrary->convertedcit($data['owner_road_name']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>घर नम्बर </span>: <?php echo !empty($data['owner_house_no'])?$this->mylibrary->convertedcit($data['owner_house_no']):''?></p>
                                </div>
                            </div>
                            <hr>
                            <h1>प्रोप्राइटरको ठेगाना</h1>
                            <div class="row">
                                <div class="bio-row">
                                    <p class="label label-success"><span style="width:250px;">नगरपालिका/गाउँपालिकाको नाम (स्थायी)</span>: <?php echo !empty($data['owner_per_napa'])?$this->mylibrary->convertedcit($data['owner_per_napa']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span style="width:250px;">नगरपालिका/गाउँपालिकाको नाम (हालको)</span>: <?php echo !empty($data['owner_present_na'])?$this->mylibrary->convertedcit($data['owner_present_na']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>वार्ड नं (स्थायी)</span>: <?php echo !empty($data['owner_per_ward'])?$this->mylibrary->convertedcit($data['owner_per_ward']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>वार्ड नं (हालको)</span>: <?php echo !empty($data['owner_present_ward'])?$this->mylibrary->convertedcit($data['owner_present_ward']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>टोल/गाउँ (स्थायी)</span>: <?php echo !empty($data['owner_per_tol'])?$this->mylibrary->convertedcit($data['owner_per_tol']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>टोल/गाउँ (हालको)</span>: <?php echo !empty($data['owner_present_tol'])?$this->mylibrary->convertedcit($data['owner_present_tol']):''?></p>
                                </div>
                            </div>
                            <hr>
                            <h1>व्यवसायको विवरण</h1>
                            <div class="row">
                                <div class="bio-row">
                                    <p class="label label-success"><span>व्यवसायको पुँजी  </span>: <?php echo !empty($data['firm_capital'])?$this->mylibrary->convertedcit($data['firm_capital']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>फर्मको उदेश्य </span>: <?php echo !empty($data['firm_aim'])?$this->mylibrary->convertedcit($data['firm_aim']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>फर्ममा संलग्न जनशक्ती (जना)  </span>: <?php echo !empty($data['firm_employee_no'])?$this->mylibrary->convertedcit($data['firm_employee_no']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>फर्मको शाखा</span>: <?php echo !empty($data['firm_branch '])?$this->mylibrary->convertedcit($data['firm_branch']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>फर्मको नाम  </span>: <?php echo !empty($data['firm_name_nepali'])?$this->mylibrary->convertedcit($data['firm_name_nepali']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>फर्मको नाम ( अंग्रेजीमा )  </span>: <?php echo !empty($data['firm_name_en'])?$this->mylibrary->convertedcit($data['firm_name_en']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span style="width: 250px">उद्योग / व्यवसायको किसिम (आम्दानी रशिद अनुसार)  </span>: <?php echo !empty($data['firm_income_bill'])?$this->mylibrary->convertedcit($data['firm_income_bill']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>श्रेणी </span>: <?php echo !empty($data['firm_level'])?$this->mylibrary->convertedcit($data['firm_level']):''?></p>
                                </div>

                                <div class="bio-row">
                                    <p class="label label-success"><span style="width: 250px">नगरपालिका / गाउँपालिकाको नाम  </span>: <?php echo !empty($data['firm_address'])?$this->mylibrary->convertedcit($data['owner_gender']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span >वडा नं</span>: <?php echo !empty($data['firm_ward'])?$this->mylibrary->convertedcit($data['firm_ward']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>टोल/गाउँ </span>:<?php echo !empty($data['firm_tol'])?$this->mylibrary->convertedcit($data['firm_tol']):''?></p>
                                </div>
                            </div>
                            <hr>
                            <h1>फर्म संचालन हुने घर वा जग्गाको स्वामित्व रहेको व्यक्तिको नाम र ठेगाना </h1>
                            <div class="row">
                                <div class="bio-row">
                                    <p class="label label-success"><span>नाम </span>: <?php echo !empty($data['firm_operator_name'])?$this->mylibrary->convertedcit($data['firm_operator_name']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>ठेगाना </span>: <?php echo !empty($data['firm_operator_address'])?$this->mylibrary->convertedcit($data['firm_operator_address']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span style="width: 250px;">भाडामा लिएको भएमा मासिक भाडा रकम </span>: <?php echo !empty($data['firm_land_rent'])?$this->mylibrary->convertedcit($data['firm_land_rent']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>सडकको नाम</span>: <?php echo !empty($data['firm_road_name '])?$this->mylibrary->convertedcit($data['firm_road_name']):''?></p>
                                </div>
                                <div class="bio-row">
                                    <p class="label label-success"><span>घर नम्बर </span>: <?php echo !empty($data['firm_house_number'])?$this->mylibrary->convertedcit($data['firm_house_number']):''?></p>
                                </div>
                            </div>
                            <hr>
                            <h1>करदाताको कारोबारको विवरण (फर्ममा हुने कारोबारहरु) </h1>
                            <div class="row">
                              <?php if(!empty($firm_trans)):?>
                              <table class="table" id="add_new_fields">
                                <thead>
                                  <tr>
                                    <th>कारोबारको नाम</th>
                                    <th>ठेगाना</th>
                                    <th>सुरू मिती</th>
                                    <th>प्रमाणित गर्ने</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $i=0;
                                    foreach ($firm_trans as $key => $trans) { ?>
                                    
                                  <tr class="dynamic-fields">
                                    <td><?php echo $trans['trans_name']?></td>
                                    <td><?php echo $trans['trans_address']?></td>
                                    <td><?php echo $trans['trans_date']?></td>
                                    <td><?php echo $trans['trans_verify']?></td>
                                  </tr>
                                <?php }?>
                                </tbody>
                              </table>
                            <?php endif;?>
                            </div>
                        </div>
                    </section>
                  </aside>
              </div>

              <!-- page end-->
          </section>
      </section>
      <!--main content end-->