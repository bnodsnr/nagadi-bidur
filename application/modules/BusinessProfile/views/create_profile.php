<style type="text/css">
  .select2-container--default .select2-selection--single {
    height: 36px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
  line-height: 37px;
}
</style>
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>BusinessProfile">
            उद्योगहरु अभिलेख</a></li>
        <li class="breadcrumb-item"><a href="javascript;">
            <?php echo !empty($row)?'प्रोफाइल सम्पादन गर्नुहोस्':'नयाँ प्रोफाइल बनाउनुहोस्ख';?></a></li>
      </ol>
    </nav>
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
        <form action ="<?php echo base_url()?>BusinessProfile/Save" method="post" class="save_post">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <div class="row">
            <div class="col-md-12">
              <section class="card">
                <div class="valid_errors"></div>
                <header class="card-header" style="background: #1b5693;color:#FFF">
                  घर जग्गा व्यत्तिगत अभिलेख
                  <div class="col-md-2 pull-right">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar" style="color:#1b5693"></i></button>
                      </div>
                      <input type="text" name="form_filler_date" class="form-control" value="<?php echo convertDate(date('Y-m-d'))?>" readonly>
                      <input type="hidden" name="id" class="form-control" value="<?php echo !empty($row)?$row['id']:''?>" readonly>
                  </div>
                </header>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गाको स्वामित्वको किसिम</label>
                        <input type="text" name="" value="उद्योग" readonly="readonly" class="form-control">
                        <input type="hidden" name="land_own_type" value="1" readonly="readonly" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>संस्थाको नाम<span style="color:red">*</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                          </div>
                          <input type="text" class="form-control" id="land_owner_name_np" placeholder=""  name="land_owner_name_np" required="required" value="<?php echo !empty($row)?$row['land_owner_name_np']:''?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>संस्थाको  नाम  (अंग्रेजी)<span style="color:red">*</span></label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder=""  name="land_owner_name_en" required="required" id="land_owner_name_en" value="<?php echo !empty($row)?$row['land_owner_name_en']:''?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>संस्थाको दर्ता न <span style="color:red">*</span></label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder=""  name="lo_czn_no" required="required" id="" value="<?php echo !empty($row)?$row['lo_czn_no']:''?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>पान न <span style="color:red">*</span>
                        </label>
                        <input type="text" class="form-control" placeholder=""  name="lo_pan_no" required="required" value="<?php echo !empty($row)?$row['lo_pan_no']:''?>">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <!-- <div class="form-group">
                        <label>दर्ता मिति <span style="color:red">*</span>
                        </label>
                        <input type="text" class="form-control nepaliDate5" placeholder=""  name="land_owner_grandpa_name" required="required" value="">
                      </div> -->
                      <div class="form-group">
                        <label>दर्ता मिती<span style="color: red"> **:</span></label>
                        <div class="input-group">
                          <input type="text" id="nepaliDateD" name="land_owner_grandpa_name" class="form-control nepali-calendar" value="<?php echo !empty($row)?$row['land_owner_grandpa_name']:''?>"/>
                          <div class="input-group-prepend">
                            <button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>संस्थाको किसिम  <span style="color:red">*</span>
                        </label>
                        <select name="land_owner_occupation" class="form-control dd_select" required>
                          <option value="">छान्नुहोस् </option>
                          <?php if(!empty($occupation)) :
                          foreach($occupation as $data): ?>
                            <option value="<?php echo  $data['id'] ?>" 
                            <?php
                             if(!empty($row) && $row['land_owner_occupation'] == $data['id']){echo 'selected';}
                             ?>><?php echo  $data['name'] ?></option>
                          <?php endforeach; endif; ?>    
                        </select>
                      </div>
                    </div>

                    <!-- संस्थाको संचालकको  नाम र थर -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>संस्थाको संचालकको  नाम र थर<span style="color:red">*</span>
                        </label>
                        <input type = "text" name="land_owner_father_name" class="form-control" value="<?php echo !empty($row)?$row['land_owner_father_name']:''?>">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>इमेल ठेगाना
                        </label>
                        <input type="email" class="form-control" placeholder=""  name="land_owner_email" value="<?php echo !empty($row)?$row['land_owner_email']:''?>">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>सम्पर्क फोन नं.<span style="color:red">*</span>
                        </label>
                        <input type="number" class="form-control contact_number" placeholder=""  name="land_owner_contact_no" required="required" value="<?php echo !empty($row)?$row['land_owner_contact_no']:''?>">
                        <span class="du_mobile"></span>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>अन्य विवरण/कैफियत</label>
                        <input type="text" class="form-control" placeholder=""  name="land_owner_remarks" value="<?php echo !empty($row)?$row['remarks']:''?>">
                      </div>
                    </div>
                  </div>
                </div><!--end of card body-->
              </section>
            </div>
            <div class="col-md-12">
              <section class="card">
                <header class="card-header" style="background: #1b5693;color:#FFF">ठेगाना</header>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>प्रदेश<span style="color:red">*</span>
                        </label>
                        <select class="form-control dd_select npl_state" name="lo_province" required id="province">
                          <option value="">छान्नुहोस्</option>
                          <?php if(!empty($provinces)) : 
                              foreach ($provinces as $key => $p) : ?>
                                <option value="<?php echo $p['ID']?>" <?php if(!empty($row))
                                { if($p['ID'] == $row['lo_state']) {echo 'selected';} } else { if($p['ID'] == STATE){ echo 'selected';} } ?>><?php echo $p['Title']?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div> 

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>जिल्ला<span style="color:red">*</span>
                        </label>
                        <select class="form-control dd_select npl_districts" id="district" required name="lo_district" >
                          <option value=""></option>
                          <?php if(!empty($districts)) : 
                              foreach($districts as $d) :?>
                                <option value="<?php echo $d['id']?>" <?php 
                                if(!empty($row)){
                                  if($d['id'] == $row['lo_district']) {echo 'selected';}
                                } else {
                                    if($d['id'] == DID) {
                                        echo 'selected';
                                    }
                                }?>
                                
                                >
                                <?php echo $d['name']?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>गा पा / न पा <span style="color:red">*</span>
                        </label>
                       
                        <select class="form-control dd_select lo_gapanapa" name="gpana" id="metro" required>
                          <?php if(!empty($gapana)) :
                            foreach ($gapana as $key => $gp) : ?>
                              <option value="<?php echo $gp['id']?>"
                                <?php if(!empty($row)) {
                                  if($gp['name'] ==  $row['lo_temp_gapanapa']) {
                                    echo 'selected';
                                  }
                                } if($gp['id'] == GID){
                                  echo 'selected';
                                }?>
                                ><?php echo $gp['name']?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>वडा नं<span style="color:red">*</span>
                        </label>
                        <select name="lo_address_ward" class="form-control p_address_ward dd_select " id="address_ward" required>
                          <option value="">छान्नुहोस्</option>
                          <?php if(!empty($ward)) :
                            foreach ($ward as $key => $w) : ?>
                              <option value="<?php echo $w['name']?>"
                                <?php 
                                if(!empty($row)){
                                  if($w['name'] == $row['lo_ward']) {echo 'selected';}
                                } else {
                                    if($w['name'] == WARD ){echo 'selected';}
                                }?>

                                ><?php echo 'वडा नं-'.$this->mylibrary->convertedcit($w['name'])?></option>
                          <?php endforeach;endif;?>
                                      
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>जग्गा रहेको वडा नं<span style="color:red">*</span>
                        </label>
                        <select name="lo_land_ward" class="form-control dd_select" id="land_ward" required>
                          <option value="">छान्नुहोस्</option>
                          <?php if(!empty($ward)) :
                            foreach ($ward as $key => $w) : ?>
                              <option value="<?php echo $w['name']?>"
                                <?php 
                                if(!empty($row)){
                                  if($w['name'] == $row['lo_land_lac_ward']) {echo 'selected';}
                                } else {
                                    if($w['name'] == WARD){echo 'selected';}
                                }?>

                                ><?php echo 'वडा नं-'.$this->mylibrary->convertedcit($w['name'])?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>टोल/ठाउँ<span style="color:red">*</span>
                        </label>
                        <input type="text" class="form-control per_tol" placeholder=""  name="lo_tol" required="required" value="<?php echo !empty($row)?$row['lo_tol']:''?>">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>घर नम्बर<span style="color:red">*</span>
                        </label>
                        <input type="text" class="form-control per_house_no" placeholder=""  name="lo_house_no" value="<?php echo !empty($row)?$row['lo_house_no']:''?>">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                         <label>करदाताको क्र.स नम्बर<span style="color:red">*</span>
                          </label>
                          <input type="text" name="lo_file_no" required class="form-control" id="lo_owner_symbol" readonly="true" value="<?php echo !empty($row)?$row['file_no']:''?>">
                      </div>
                    </div>

                  </div>
                </div>
              </section>
            </div>

             <div class="col-md-12">
              <section class="card">
                <header class="card-header" style="background: #1b5693;color:#FFF">जग्गाधनिको ठेगाना(अस्थायी) </header>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>प्रदेश<span style="color:red">*</span>
                        </label>
                        <select class="form-control dd_select npl_temp_state" name="lo_temp_state" required id="province">
                          <option value="">छान्नुहोस्</option>
                          <?php if(!empty($provinces)) : 
                              foreach ($provinces as $key => $p) : ?>
                                <option value="<?php echo $p['ID']?>" <?php
                                  if(!empty($row)) {
                                    if($p['ID'] == $row['lo_temp_state']) {echo 'selected';}
                                  } else{if($p['ID'] == STATE){ echo 'selected';}}?>
                                 ><?php echo $p['Title']?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div> 

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जिल्ला<span style="color:red">*</span>
                        </label>
                        <select class="form-control dd_select npl_temp_districts" id="lo_temp_district" required name="lo_temp_district" >
                          <option value=""></option>
                          <?php if(!empty($districts)) : 
                              foreach($districts as $d) :?>
                                <option value="<?php echo $d['id']?>" <?php
                                if(!empty($row)) {
                                   if($d['id'] == $row['lo_temp_dis']) {echo 'selected';}
                                } else {
                                    if($d['id'] == DID){echo 'selected';}
                                }
                               ?>><?php echo $d['name']?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>गा पा / न पा <span style="color:red">*</span>
                        </label>
                        <select class="form-control npl_temp_gapana dd_select lo_temp_gapanapa" name="lo_temp_gapanapa" id="metro" required>
                          <?php if(!empty($gapana)) :
                            foreach ($gapana as $key => $gp) : ?>
                              <option value="<?php echo $gp['id']?>"
                                <?php if(!empty($row)) {
                                  if($gp['id'] ==  $row['lo_temp_gapanapa']) {
                                    echo 'selected';
                                  }
                                } else {
                                    if($gp['id'] == GID){echo 'selected';}
                                } ?>
                                ><?php echo $gp['name']?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>वडा नं<span style="color:red">*</span>
                        </label>
                        <select name="lo_temp_ward" class="form-control dd_select" id="temp_address_ward" required>
                          <option value="">छान्नुहोस्</option>
                          <?php if(!empty($ward)) :
                            foreach ($ward as $key => $w) : ?>
                              <option value="<?php echo $w['name']?>"
                                <?php if(!empty($row)) {
                                  if($w['name'] == $row['lo_temp_ward']) {
                                    echo 'selected';
                                  }
                                } else {if($w['name'] == WARD){echo 'selected';}  }?>><?php echo 'वडा नं-'.$this->mylibrary->convertedcit($w['name'])?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>टोल/ठाउँ<span style="color:red">*</span>
                        </label>
                        <input type="text" class="form-control tem_tol" placeholder=""  name="lo_temp_tol" required="required" value="<?php echo !empty($row)?$row['lo_temp_tol']:''?>">
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group">
                        <label>घर नम्बर<span style="color:red">*</span>
                        </label>
                        <input type="text" class="form-control tem_house_no" placeholder=""  name="lo_temp_house_no" value="<?php echo !empty($row)?$row['lo_temp_house_no']:''?>">
                      </div>
                    </div>
                    
                  </div>
                </div>
              </section>
            </div>
            
            <div class="col-md-12">
              <section class="card">
                <header class="card-header" style="background: #1b5693;color:#FFF">सुचकको विवरण </header>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>प्रदेश<span style="color:red">*</span>
                        </label>
                        <select class="form-control dd_select" name="suchak_state" required>
                          <option value="">छान्नुहोस्</option>
                          <?php if(!empty($provinces)) : 
                              foreach ($provinces as $key => $p) : ?>
                                <option value="<?php echo $p['ID']?>" <?php
                                  if(!empty($row)) {
                                    if($p['ID'] == $row['suchak_state']) {echo 'selected';}
                                  }
                                  else {
                                    if($p['ID'] == STATE) {echo 'selected';}
                                  }
                                  ?>
                                 ><?php echo $p['Title']?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div> 

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जिल्ला<span style="color:red">*</span>
                        </label>
                        <select class="form-control dd_select" id="suchak_district" required name="suchak_district" >
                          <option value=""></option>
                          <?php if(!empty($districts)) : 
                              foreach($districts as $d) :?>
                                <option value="<?php echo $d['id']?>" <?php
                                if(!empty($row)) {
                                   if($d['id'] == $row['suchak_district']) {echo 'selected';}
                                } else {
                                    if($d['id'] == DID){echo 'selected';}
                                }
                               ?>><?php echo $d['name']?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>गा पा / न पा <span style="color:red">*</span>
                        </label>
                        <select class="form-control npl_temp_gapana dd_select" name="suchak_gapanapa" id="metro" required>
                          <?php if(!empty($gapana)) :
                            foreach ($gapana as $key => $gp) : ?>
                              <option value="<?php echo $gp['id']?>"
                                <?php if(!empty($row)) {
                                  if($gp['id'] ==  $row['suchak_gapanapa']) {
                                    echo 'selected';
                                  }
                                } else {
                                    if($gp['id'] == GID){echo 'selected';}
                                } ?>
                                ><?php echo $gp['name']?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>वडा नं<span style="color:red">*</span>
                        </label>
                        <select name="suchak_ward" class="form-control dd_select" required>
                          <option value="">छान्नुहोस्</option>
                          <?php if(!empty($ward)) :
                            foreach ($ward as $key => $w) : ?>
                              <option value="<?php echo $w['name']?>"
                                <?php if(!empty($row)) {
                                  if($w['name'] == $row['suchak_ward']) {
                                    echo 'selected';
                                  }
                                } else{ if($w['name'] == WARD){echo 'selected';}}?>><?php echo 'वडा नं-'.$this->mylibrary->convertedcit($w['name'])?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>सुचकको नाम<span style="color:red">*</span>
                        </label>
                        <input type="text" class="form-control" placeholder=""  name="suchak_name" required="required" value="<?php echo !empty($row)?$row['suchak_name']:''?>">
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गाधनी संगको नाता<span style="color:red">*</span>
                        </label>
                        <input type="text" class="form-control" placeholder=""  name="suchak_relation" value="<?php echo !empty($row)?$row['suchak_relation']:''?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label><p class="label label-warning"><b>सम्पति धनी व्यक्ति भएमा</b></p></label>
                        <input type="checkbox" class="has_owner" value="1">
                        </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
            
            <div class="col-md-12" id="dates">
              <section class="card">
                <header class="card-header" style="background: #1b5693;color:#FFF">सम्पति धनी व्यक्ति भएमा </header>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>जग्गाको  सम्पती धनीको नाम
                        </label>
                        <input type="text" name="lo_fi_state" class="form-control" value="<?php echo !empty($row)?$row['lo_fi_state']:''?>">
                      </div>
                    </div> 

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>बुवा/पतिको नाम
                        </label>
                        <input type="text" name="lo_fi_district" class="form-control" value="<?php echo !empty($row)?$row['lo_fi_district']:''?>">
                      </div>
                    </div> 

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>बजे/ससुराको नाम
                        </label>
                        <input type="text" name="lo_fi_gapa_napa" class="form-control" value="<?php echo !empty($row)?$row['lo_fi_gapa_napa']:''?>">
                      </div>
                    </div> 

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>राष्ट्रियता
                          </label>
                          <input type="text" name="lo_fi_relation" class="form-control" value="<?php echo !empty($row)?$row['lo_fi_relation']:''?>">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>पेसा
                          </label>
                          <input type="text" name="lo_fi_ward" class="form-control" value="<?php echo !empty($row)?$row['lo_fi_ward']:''?>">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>लिङ्ग
                          </label>
                          <input type="text" name="lo_fi_name" class="form-control" value="<?php echo !empty($row)?$row['lo_fi_name']:''?>" >
                        </div>
                      </div>
                      
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>सम्पर्क न
                          </label>
                          <input type="text" name="lo_fi_date" class="form-control" value="<?php echo !empty($row)?$row['lo_fi_date']:''?>">
                        </div>
                      </div>
                      
                    </div>
                  </div>
                
              </section>
            </div>
            </div>
            <hr>
            <div class="col-md-12 text-center">
              <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Save"> सेभ गर्नुहोस्</button>
              <a href="<?php echo base_url()?>BusinessProfile" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
            </div>
        </form>
      </div>
    </div>

    
  </section>
</section>
<script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/nepali_datepicker/nepali.datepicker.v2.2.min.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#dates').hide();
    // $('.has_owner').change(function () {                
    //     $('#dates').toggle(!this.checked);
    //   }).change(); //ensure visible state matches initially

    $(".has_owner").click(function(){
      if ($(this).prop("checked")) {
        $("#dates").show();
      } else {
        $("#dates").hide();
      }
    });


    $('.dd_select').select2();
    $('.nepali-calendar').nepaliDatePicker();
    //on change get distrist 
    $(document).on('change', '.npl_state', function() {
      obj = $(this);
      var state = obj.val();
      var name = $('#land_owner_name_en').val();
      var ganapa = $('.lo_gapanapa').val();
      var ward = $('.address_ward').val();
      $.ajax({
        url:base_url+'BusinessProfile/getDistrictByState',
        method:"POST",
        data:{state:state, name:name,gapana:ward,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          if(resp.status == 'success') {
            $('.npl_districts').html(resp.option);
          }
        }
      });
    });

    //onchange generate file no
    $(document).on('change','#address_ward', function() {
      obj = $(this);
      var address_ward = obj.val();
      var name = $('#land_owner_name_en').val();
      var ganapa = $('.lo_gapanapa').val();
      if(name == '') {
        alert('जग्गाधनिको नाम (अंग्रेजी)');
        return;
      }
      $.ajax({
        url:base_url+'BusinessProfile/generateCode',
        method:"POST",
        data:{address_ward:address_ward,name:name,ganapa:ganapa,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          $("#lo_owner_symbol").val(resp);
        }
      });
    });

    $(document).on('input','#land_owner_name_en', function() {
      obj = $(this);
      var name = obj.val();
      if(name == '') {
        alert('जग्गाधनिको नाम (अंग्रेजी)');
        return;
      }
      var address_ward = $('#address_ward').val();
      var ganapa = $('.lo_gapanapa').val();
      $.ajax({
        url:base_url+'BusinessProfile/generateCode',
        method:"POST",
        data:{address_ward:address_ward,name:name,ganapa:ganapa,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          $("#lo_owner_symbol").val(resp);
        }
      });
    });

    $(document).on('change','.lo_gapanapa',function(){
      var ganapa = $(this).val();
      var address_ward = $('#address_ward').val();
      var name = $('#land_owner_name_en').val();
      if(name == '') {
        alert('जग्गाधनिको नाम (अंग्रेजी)');
        return;
      }
      $.ajax({
        url:base_url+'BusinessProfile/generateCode',
        method:"POST",
        data:{address_ward:address_ward,name:name,ganapa:ganapa,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          $("#lo_owner_symbol").val(resp);
        }
      });
    });

    $(document).on('change', '.npl_districts', function() {
      obj = $(this);
      var district = obj.val();
      $.ajax({
        url:base_url+'BusinessProfile/getGapanapaByDistricts',
        method:"POST",
        data:{district:district,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          if(resp.status == 'success') {
            $('.npl_gapana').html(resp.option);
            $('#lo_owner_symbol').val('');
          }
        }
      });
    });

    // --------------------------------------------//
    $(document).on('change', '.bi_state', function() {
      obj = $(this);
      var state = obj.val();
      $.ajax({
        url:base_url+'BusinessProfile/getDistrictByState',
        method:"POST",
        data:{state:state,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          if(resp.status == 'success') {
            $('.bi_districts').html(resp.option);
          }
        }
      });
    });

    $(document).on('change', '.bi_districts', function() {
      obj = $(this);
      var district = obj.val();
      $.ajax({
        url:base_url+'BusinessProfile/getGapanapaByDistricts',
        method:"POST",
        data:{district:district,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          if(resp.status == 'success') {
            console.log(resp.option);
            $('.bi_gapana').html(resp.option);
          }
        }
      });
    });

    $(document).on('input blur','.citizenship_no', function(){
      obj = $(this);
      var citizenship_no = obj.val();
      $.ajax({
        url: base_url + 'BusinessProfile/getUniqueCitizenNo',
        method:"POST",
        data:{citizenship_no:citizenship_no,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success: function(resp) {
          if(resp.status == 'success') {
            $(".du_error").html(resp.data);
          } else {
            $(".du_error").html('');
          }
        },
      });
    });

    // $(document).on('input blur','', function(){
    //   obj = $(this);
    //   var mobile = obj.val();
    //   $.ajax({
    //     url: base_url + 'Profile/getUniqueMobileNo',
    //     method:"POST",
    //     data:{mobile:mobile},
    //     success: function(resp) {
    //       if(resp.status == 'success') {
    //         $(".du_mobile").html(resp.data);
    //       } else {
    //         $(".du_mobile").html('');
    //       }
    //     },
    //   });
    // });

    $(document).on('input', '.per_tol', function(){
      var per_tol = $(this).val();
      $('.tem_tol').val(per_tol);
    });

    //per_house_no
    $(document).on('input', '.per_house_no', function(){
      var per_house_no = $(this).val();
      $('.tem_house_no').val(per_house_no);
    });

    $(document).on('click','#suchak_details', function(){
      var name = $('#land_owner_name_np').val();
      var ward = $('.p_address_ward').val();
     
      $('.form_filler_name').val(name);

      $("#app_relation option").each(function () {
        if ($(this).html() == "आफै") {
            $(this).attr("selected", "selected");
            return;
        }
      });

      $("#app_ward_no option").each(function () {
        if ($(this).html() == 3) {
            $(this).attr("selected", "selected");
            return;
        }
      });
    });

    $(document).on('input', '#land_owner_name_np', function(){
        var name = $(this).val();
        $('#family_name_1').val(name);
    });
  });//end of dom
</script>
