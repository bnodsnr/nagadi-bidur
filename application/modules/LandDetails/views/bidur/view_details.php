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
           <header class="card-header">
             <div class="mail-option">
               <div class="btn-group hidden-phone">
                 <input type="text" class="form-control" id="kitta_no" placeholder="कि.नं" style="width: 270px;">
               </div>
               <div class="btn-group hidden-phone">
                 <div class="">
                   <button type="button" class="btn btn-warning" title="खोजी गर्नुहोस्" id="filter"><i class="fa fa-search"></i> खोजी गर्नुहोस्</button>
                 </div>
               </div>

               <?php //if(empty($has_bill)) {
                ?>

               <div class="float-right position">
                 <a class="btn btn-primary " href="<?php echo base_url() ?>LandDetails/AddLandDetails/<?php echo $this->uri->segment(3) ?>" style="color:#FFF;margin-top: 2px;"><i class="fa  fa-plus-circle"></i> नयाँ थप्नुहोस् </a>



                 <?php if ($land_owner['current_flag'] != 1) { ?>
                   <a class="btn btn-success " href="<?php echo base_url() ?>SanrachanaDetails/AddDetails/<?php echo $land_owner['file_no'] ?>" target="_blank" style="color:#FFF;margin-top: 2px;"><i class="fa  fa-plus-circle"></i> भोतिक संरचनाको विवरण थप्नुहोस् </a>
                 <?php } ?>

                 <?php if ($land_owner['current_flag'] != 1) { ?>
                   <a class="btn btn-warning " href="<?php echo base_url() ?>SampatiKarRasid/CreateBills/<?php echo $land_owner['file_no'] ?>" target="_blank" style="color:#FFF;margin-top: 2px;"><i class="fa fa-file-text"></i> रशिद काट्नुहोस </a>
                 <?php } ?>
               </div>
               <?php //} 
                ?>
             </div>
             </span>
           </header>
           <div class="card-body">
             <div class="row">
               <div class="col-lg-4 col-sm-4 ">
                 <!-- <h4>उद्योगहरु अभिलेख</h4> -->
                 <p class="alert alert-primary"><b>
                     क्र.स नम्बर: <?php echo $this->mylibrary->convertedcit($land_owner['file_no']) ?> <br>
                     जग्गाधनिको नाम: <?php echo $land_owner['land_owner_name_np'] ?><br>
                   </b>
                 </p>
               </div>
               <div class="col-lg-4 col-sm-4">
                 <!-- <h4>उद्योगहरु अभिलेख</h4> -->
                 <p class="alert alert-primary"><b>
                     नगरिकता नं : <?php echo $this->mylibrary->convertedcit($land_owner['lo_czn_no']) ?> <br>
                     सम्पर्क फोन नं. न: <?php echo $this->mylibrary->convertedcit($land_owner['land_owner_contact_no']) ?><br>
                   </b>
                 </p>
               </div>
               <div class="col-lg-4 col-sm-4">
                 <!-- <h4>उद्योगहरु अभिलेख</h4> -->
                 <p class="alert alert-primary"><b>
                     जग्गा रहेको वडा नं: <?php echo $this->mylibrary->convertedcit($land_owner['lo_land_lac_ward']) ?><br>
                     ठेगाना: <?php echo $land_owner['name'] . '-' . $this->mylibrary->convertedcit($land_owner['lo_ward']) . ' ' . $land_owner['district']; ?> <br>
                   </b>
                 </p>
               </div>


             </div>

             <hr>

             <?php if (!empty($land_owner['transfer_fileno'])) : ?>

               <div class="col-lg-6 col-sm-6">

                 <a href="" class="btn btn-info"><?php echo $this->mylibrary->convertedcit($land_owner['transfer_fileno']) ?> बाट आयात गरियको प्रोफाइल</a>
                 <a class="btn btn-secondary " href="<?php echo base_url() ?>LandDetails/transerLandDetails/<?php echo $land_owner['file_no'] ?>" style="color:#FFF;margin-top: 2px;"> जग्गा आयात गर्नुहोस</a>

               </div>
             <?php endif; ?>

             <!-- <div class="table-responsive"> -->
             <table class="table table-bordered table-stripe print_table" id="">
               <thead style="background:#1b5693;color:#fff">
                 <tr>
                   <th>#</th>
                   <th>सम्पादन कार्य</th>
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
                   <th>कर ?</th>
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

                       <td><?php echo $this->mylibrary->convertedcit($i++) ?></td>
                       <td>
                         <?php if (empty($post->current_voucher_id)) { ?>
                           <?php if ($post->buy_sell_status != 2) { ?>
                             <div class="dropdown">
                               <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">सम्पादन कार्य</button>
                               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                 <a class="dropdown-item" href="<?php echo base_url() . 'LandDetails/EditLandDetails/' . $post->id ?>">सम्पादन गर्नुहोस्
                                   <a class="dropdown-item" data-toggle="modal" href="#editModel" data-url="<?php echo base_url() ?>LandDetails/removeKitta" data-id="<?php echo $post->id ?>">कित्ता बदर गर्नुहोस्</a>
                               </div>
                             </div>
                           <?php } else { ?>
                             <a class="btn btn-warning btn-sm" data-toggle="modal" href="#editModel" data-url="<?php echo base_url() ?>LandDetails/viewBadarReason" data-id="<?php echo $post->id ?>">बदर गर्नुको कारण
                             <?php } ?>
                           <?php } else {  ?>
                             <?php if ($post->buy_sell_status == 2) { ?>
                               <a class="btn btn-warning btn-sm" data-toggle="modal" href="#editModel" data-url="<?php echo base_url() ?>LandDetails/viewBadarReason" data-id="<?php echo $post->id ?>">बदर गर्नुको कारण
                               <?php } else { ?>
                                 <p class="badge badge-danger">कार्य उपलब्ध छैन</p>
                             <?php }
                            } ?>
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
                       <td>

                         <?php
                          if ($post->buy_sell_status == 2) { ?>
                           <p>कित्ता बदर भएको</p>
                         <?php } else {
                            if (!empty($post->current_voucher_id)) {

                              echo '<p class = "badge badge-success"><i class="fa fa-check-circle"></i></p>';
                            } else {
                              echo '<p class = "badge badge-danger"><i class = "fa fa-times-circle"></i></p>';
                            }
                          }
                          ?>
                       </td>
                     </tr>
                 <?php endforeach;
                  endif; ?>
               </tbody>
             </table>

           </div>
         </section>
       </div>
     </div>
     <!-- page end-->
   </section>
 </section>
 <script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>
 <script type="text/javascript">
   $(document).ready(function() {

     fetch_all_data();

     function fetch_all_data(kitta_no = '') {
       var file_no = '<?php echo $this->uri->segment(3); ?>';
       var oTable = $('#listtable').DataTable({
         "order": [
           [0, "desc"]
         ],
         "searching": false,
         'lengthChange': false,
         "processing": true,
         "serverSide": true,
         //"scrollX": true,
         // "scrollY": 200,
         'language': {
           'loadingRecords': '&nbsp;',
           'processing': '<div class="spinner"></div>',
           "emptyTable": "जग्गाको विवरण धकिला गरिएको छैन!!"
         },


         "ajax": {
           "url": "<?php echo base_url() ?>" + 'LandDetails/GetLandLists',
           "dataType": "json",
           "type": "POST",
           "data": {
             '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
             file_no: file_no,
             kitta_no: kitta_no
           }
         },
         "columns": [{
             "data": "sn"
           },
           {
             "data": "update"
           },
           {
             "data": "k_number"
           },
           {
             "data": "sabik"
           },
           {
             "data": "present"
           },
           {
             "data": "road_name"
           },
           {
             "data": "land_area_type"
           },
           <?php if (MODULE == 2) { ?> {
               "data": "land_category"
             },
           <?php } ?> {
             "data": "nn_number"
           },

           {
             "data": "total_area"
           },
           <?php if (MODULE != 3) { ?> {
               "data": "min_land_rate"
             },
             {
               "data": "k_land_rate"
             },
             {
               "data": "t_rate"
             },
             {
               "data": 'fiscal_year'
             },
             {
               "data": "kar"
             },

           <?php } ?>
         ],
       });
     }

     $('#filter').click(function() {
       var kitta_no = $('#kitta_no').val();
       $('#listtable').DataTable().destroy();
       fetch_all_data(kitta_no);
     });

     $(document).on('click', '.btn-delete', function(e) {
       //e.preventDefault();
       var id = $(this).data('id'); //Fetch id from modal trigger button
       var kitta = $(this).data('kitta'); //Fetch id from modal trigger button

       var kitta = $(this).data('kitta');
       if (confirm("Are you sure want to delete?") == true) {
         $.ajax({
           type: 'POST',
           url: "<?php echo base_url() ?>" + 'LandDetails/delete', //Here you will fetch records 
           data: {
             id: id,
             kitta: kitta,
             '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
           }, //Pass $id
           success: function(resp) {

             if (resp.status == 'success') {
               toastr.options = {
                 "closeButton": true,
                 "debug": true,
                 "progressBar": true,
                 "positionClass": "toast-top-right",
                 "showDuration": "200",
                 "hideDuration": "1000",
                 "timeOut": "3000",
                 "extendedTimeOut": "1000",
                 "showEasing": "swing",
                 "hideEasing": "linear",
                 "showMethod": "fadeIn",
                 "hideMethod": "fadeOut"
               };
               toastr.success(resp.data);
               setTimeout(function() {
                 location.reload();
               }, 2000);
             } else {
               toastr.options = {
                 "closeButton": true,
                 "debug": true,
                 "progressBar": true,
                 "positionClass": "toast-top-right",
                 "showDuration": "300",
                 "hideDuration": "1000",
                 "timeOut": "5000",
                 "extendedTimeOut": "1000",
                 "showEasing": "swing",
                 "hideEasing": "linear",
                 "showMethod": "fadeIn",
                 "hideMethod": "fadeOut"
               };
               toastr.error(resp.data);
               setTimeout(function() {
                 location.reload();
               }, 2000);
             }
           }
         });
       } else {
         return false;
       }
     });
   });
 </script>