 <style type="text/css">
   table,
   th,
   td {
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
         <li class="breadcrumb-item"><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>
         </li>
         <li class="breadcrumb-item"><a href="<?php echo base_url() ?>PersonalProfile">व्यक्तिगत अभिलेख</a></li>
         <li class="breadcrumb-item"><a href="javascript:;">
             जग्गाको विवरण</a></li>
       </ol>
     </nav>
     <!-- page start-->
     <div class="row">
       <div class="col-sm-12">
         <?php $success_message = $this->session->flashdata("MSG_SUCCESS");
          if (!empty($success_message)) { ?>
           <div class="alert alert-success">
             <button class="close" data-close="alert"></button>
             <span> <?php echo $success_message; ?> </span>
           </div>
         <?php } ?>

         <?php $MSG_ACCESS = $this->session->flashdata("MSG_ACCESS");
          if (!empty($MSG_ACCESS)) { ?>
           <div class="alert alert-danger">
             <button class="close" data-close="alert"></button>
             <span> <?php echo $MSG_ACCESS; ?> </span>
           </div>
         <?php } ?>

         <section class="card">
           <form action="<?php echo base_url() ?>LandDetails/saveTranserLands" method="post">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
             <input type="hidden" name="old_file_no" value="<?php echo $transfer_profile['file_no'] ?>">
             <input type="hidden" name="ld_file_no" value="<?php echo $land_owner['file_no'] ?>">
             <div class="card-body">
               <div class="row">
                 <div class="col-lg-4 col-sm-4 ">
                   <p class="alert alert-primary"><b>
                       क्र.स नम्बर: <?php echo $this->mylibrary->convertedcit($land_owner['file_no']) ?> <br>
                       जग्गाधनिको नाम: <?php echo $land_owner['land_owner_name_np'] ?><br>
                     </b>
                   </p>
                 </div>
                 <div class="col-lg-4 col-sm-4">
                   <p class="alert alert-primary"><b>
                       नगरिकता नं : <?php echo $this->mylibrary->convertedcit($land_owner['lo_czn_no']) ?> <br>
                       सम्पर्क फोन नं. न: <?php echo $this->mylibrary->convertedcit($land_owner['land_owner_contact_no']) ?><br>
                     </b>
                   </p>
                 </div>
                 <div class="col-lg-4 col-sm-4">
                   <p class="alert alert-primary"><b>
                       जग्गा रहेको वडा नं: <?php echo $this->mylibrary->convertedcit($land_owner['lo_land_lac_ward']) ?><br>
                       ठेगाना: <?php echo $land_owner['name'] . '-' . $this->mylibrary->convertedcit($land_owner['lo_ward']) . ' ' . $land_owner['district']; ?> <br>
                     </b>
                   </p>
                 </div>
               </div>
               <hr>

               <div class="row">
                 <div class="col-md-12">
                   <div class="alert alert-success">जग्गा नामसारी गरिने प्रोफाइलको विवरण</div>
                 </div>
                 <div class="col-lg-4 col-sm-4 ">
                   <p class="alert alert-primary"><b>
                       क्र.स नम्बर: <?php echo $this->mylibrary->convertedcit($transfer_profile['file_no']) ?> <br>
                       जग्गाधनिको नाम: <?php echo $transfer_profile['land_owner_name_np'] ?><br>
                     </b>
                   </p>
                 </div>
                 <div class="col-lg-4 col-sm-4">
                   <p class="alert alert-primary"><b>
                       नगरिकता नं : <?php echo $this->mylibrary->convertedcit($transfer_profile['lo_czn_no']) ?> <br>
                       सम्पर्क फोन नं. न: <?php echo $this->mylibrary->convertedcit($transfer_profile['land_owner_contact_no']) ?><br>
                     </b>
                   </p>
                 </div>
                 <div class="col-lg-4 col-sm-4">
                   <p class="alert alert-primary"><b>
                       जग्गा रहेको वडा नं: <?php echo $this->mylibrary->convertedcit($transfer_profile['lo_land_lac_ward']) ?><br>
                       ठेगाना: <?php echo $transfer_profile['name'] . '-' . $this->mylibrary->convertedcit($transfer_profile['lo_ward']) . ' ' . $transfer_profile['district']; ?> <br>
                     </b>
                   </p>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-12">
                   <?php if (!empty($lands)) { ?>
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

                                 <td>
                                   <?php if($post->buy_sell_status !=2 ) : ?>
                                   <input type="checkbox" name="land_id[]" value="<?php echo $post->id ?>">
                                  <?php else : ?>
                                    <i class="fa fa-check"></i>
                                  <?php endif;?>
                                  </td>

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
                        कैफियत
                        <textarea name="remarks" class="form-control" placeholder="कैफियत लेख्नुहोस*" required="true"></textarea>
                     
                       <div class="col-md-12 text-center">

                         <hr>

                         <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Save"> सेभ
                           गर्नुहोस्</button>
                       </div>
                     </form>
                   <?php } else { ?>
                     <div class="alert alert-danger">जग्गा दाखिला गरिएको छैन !!</div>
                   <?php } ?>
                 </div>
                 
               </div>
             </div>
           </form>
         </section>
       </div>
     </div>
     <!-- page end-->
   </section>
 </section>
 <script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>
 <script type="text/javascript">
   $(document).ready(function() {
     $('#search_file_no').click(function() {
       var file_no = $('#file_no').val();
       $.ajax({
         method: "POST",
         url: base_url + "LandDetails/getLandDetailsByFileNo",
         data: {
           file_no: file_no,
           '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
         },
         success: function(resp) {
           if (resp.status = 'success') {
             //console.log(resp);
             $('.show_view').empty().html(resp.data);
           }
         }
       });
     });
   });
 </script>