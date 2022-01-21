 <!--main content start-->
 <section id="main-content">
   <section class="wrapper site-min-height">
     <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i>गृहपृष्ठ</a></li>
         <li class="breadcrumb-item"><a href="<?php echo base_url() ?>PersonalProfile">व्यक्तिगत अभिलेखलेख</a></li>
         <li class="breadcrumb-item"><a href="">भोतिक संरचनाको विवरण </a></li>
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
         <section class="card">
           <header class="card-header">
             <div class="mail-option">
               <div class="btn-group hidden-phone">
                 <input type="text" class="form-control" id="kitta_no" placeholder="कि.नं" style="width: 270px;">
               </div>
               <div class="btn-group hidden-phone">
                 <div class="">
                   <button type="button" class="btn btn-warning" title="खोजी गर्नुहोस्" id="filter">खोजी गर्नुहोस्</button>
                 </div>
               </div>
               <?php if ($this->authlibrary->HasModulePermission('PERSONAL-PROFILE', "ADD")) { ?>
                 <?php if (empty($has_bill)) { ?>
                   <div class="float-right position">
                     <a class="btn btn-primary " href="<?php echo base_url() ?>SanrachanaDetails/AddDetails/<?php echo $this->uri->segment(3) ?>" style="color:#FFF;margin-top: 2px;"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>

                     <a class="btn btn-warning " href="<?php echo base_url() ?>SampatiKarRasid/CreateBills/<?php echo $land_owner['file_no'] ?>" target="_blank" style="color:#FFF;margin-top: 2px;"> रशिद काट्नुहोस </a>

                   </div>
                 <?php   } else { ?>
                   <a class="btn btn-primary " href="<?php echo base_url() ?>SanrachanaDetails/AddDetails/<?php echo $this->uri->segment(3) ?>" style="color:#FFF;margin-top: 2px;"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
               <?php }
                } ?>
             </div>
             </span>
           </header>

           <div class="card-body">
             <div class="row">
               <div class="col-lg-4 col-sm-4 ">
                 <p class="alert alert-primary"><b>
                     क्र.स नम्बर: <?php echo $this->mylibrary->convertedcit($land_owner['file_no']) ?> <br>
                     संस्थाको नाम: <?php echo $land_owner['land_owner_name_np'] ?><br>
                   </b>
                 </p>
               </div>
               <div class="col-lg-4 col-sm-4">
                 <p class="alert alert-primary"><b>
                     दर्ता न: <?php echo $this->mylibrary->convertedcit($land_owner['lo_czn_no']) ?> <br>
                     पान न: <?php echo $this->mylibrary->convertedcit($land_owner['lo_pan_no']) ?><br>
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

             <!-- <div class="table-responsive">  -->
             <table class=" table table-bordered table-striped print_table table-responsive">
               <thead style="background: #1b5693;color:#FFF">
                 <tr>
                   <th></th>
                   <th> # </th>
                   <th>कि.नं</th>
                   <th style="width:250px;">संरचना रहेको जग्गाको क्षेत्रफल</th>
                   <th style="width:250px;">संरचना रहेको जग्गाको क्षेत्रफल(व फु)</th>
                   <th style="width:250px;"> जग्गाको नु. मूल्य(प्रति रोपनी ) </th>
                   <!--  <th> जग्गाको कर लाग्ने मुल्य </th> -->
                   <th style="width:250px;">संरचना रहेको न.नं</th>
                   <th style="width:250px;">संरचनाको प्रकार</th>
                   <th style="width:250px;">संरचनाको बनौटको किसिम </th>
                   <th style="width:250px;">संरचनाको प्रयोगको किसिम </th>
                   <th style="width:250px;">संरचनाको तला </th>
                   <th> संरचनाको प्लिन्थलेभलको विवरण </th>
                   <th style="width:250px;">संरचनाको क्षेत्रफल जम्मा वर्गफुट </th>
                   <th style="width:250px;">बनेको साल </th>
                   <th style="width:250px;">संरचनाको ह्रासकट्टी प्रतिशत </th>
                   <th style="width:250px;">संरचनाको तोकिएको न्युनतम मुल्य </th>
                   <th>संरचनाको कवोल गरेको कुल मुल्य </th>
                   <th style="width:250px;">संरचनाको खुद कायम मुल्य </th>

                   <!-- <th style="width:250px;">संरचनाले चर्चेकाे जग्गाको क्षेत्रफल(रोपनी)</th> -->
                   <th style="width:250px;">संरचनाले चर्चेकाे जग्गाको क्षेत्रफल(व फु)</th>
                   <th style="width:300px;">संरचनाले चर्चेकाे जग्गाको कर लाग्ने मुल्य
                   </th>
                   <th style="width:250px;">सम्पति मूल्याङ्कन जम्मा मुल्य </th>
                   <th style="width:300px;">चर्चेकाे बाहेक भूमिकर जग्गाको क्षेत्रफल</th>
                   <th style="width:300px;">चर्चेकाे बाहेक जग्गाको भूमिकर मूल्याङ्कन</th>
                 </tr>
               </thead>
               <tbody>
                 <?php $i = 1;
                  if (!empty($lists)) : foreach ($lists as $list) : ?>
                     <tr>
                       <td>
                         <?php if ($has_bill != 1) { ?>
                           <div class="dropdown">
                             <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">सम्पादन कार्य</button>
                             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               <a class="dropdown-item" href="<?php echo base_url() . 'SanrachanaDetails/EditDetails/' . $list['id'] ?>">सम्पादन गर्नुहोस्

                             </div>
                           </div>
                         <?php } else { ?>
                           <p class="label label-danger">कार्य उपलब्ध छैन</p>
                         <?php } ?>

                       </td>
                       <td><?php echo $this->mylibrary->convertedcit($i++) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['k_no']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['toal_land_area']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['total_land_area_sqft']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['total_land_min_amount']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['sanrachana_n_no']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['architect_type']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['st']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['sanrachana_usages']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['sanrachana_floor']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['sanrachana_ground_lenth']) ?> * <?php echo $this->mylibrary->convertedcit($list['sanrachana_ground_width']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['sanrachana_ground_area_sqft']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['contructed_year']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['sanrachana_dep_rate']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['sanrachana_min_amount']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['sanrachana_kubul_amount']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['sanrachana_khud_amount']) ?></td>
                       <!-- <td><?php //echo $this->mylibrary->convertedcit($list['sanrachana_ground_area_ropani'])
                                ?></td> -->
                       <td><?php
                            $sqfeet = $list['sanrachana_ground_area_ropani'];
                            echo $this->mylibrary->convertedcit($sqfeet) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['sanrachana_land_tax_amount']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['net_tax_amount']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['r_bhumi_area']) ?></td>
                       <td><?php echo $this->mylibrary->convertedcit($list['r_bhumi_kar']) ?></td>
                     </tr>
                   <?php endforeach;
                  else : ?>
                   <td colspan="23">
                     <p class="alert alert-danger">संरचना धखिला गरिएको छैन</p>
                   </td>
                 <?php endif; ?>
               </tbody>
             </table>
             <!-- </div> -->
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
         "scrollX": true,
         "scrollY": 200,
         'language': {
           'loadingRecords': '&nbsp;',
           'processing': '<div class="spinner"></div>'
         },
         "ajax": {
           "url": "<?php echo base_url() ?>" + 'SanrachanaDetails/GetSanrachanaDetailsLists',
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
             "data": "",
             render: function(data, type, row) {
               var res = '<div class="btn-group">' +
                 '<button type="button" class="btn btn-warning btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                 'सम्पादन गर्नुहोस् </button>' +
                 '<div class="dropdown-menu">';

               <?php if ($this->authlibrary->HasModulePermission('PERSONAL-PROFILE', 'EDIT')) { ?>
                 res += '<a class="dropdown-item" href="<?php echo base_url() ?>SanrachanaDetails/EditDetails/' + row.id + '"><i class="fa  fa-pencil"></i> विवरण सम्पादन गर्नुहोस्</a>';
               <?php } ?>
               <?php if ($this->authlibrary->HasModulePermission('BUSINESS-PROFILE', 'DELETE')) { ?>
                 res += '<button class="dropdown-item btn-delete btn-danger" data-url="<?php echo base_url() ?>SanrachanaDetails/Delete/" data-id = "' + row.id + '"><i class="fa fa-trash-o"></i> जग्गा हटाउनुहोस्</button>';
               <?php } ?>
               res += '</div"></div>';

               return res;
             },
             "bVisible": true,
             "bSearchable": false,
             "bSortable": false
           },

           {
             "data": "k_no"
           },
           {
             "data": "toal_land_area"
           },

           {
             "data": "total_land_tax_amount"
           },
           {
             "data": "sanrachana_n_no"
           },
           {
             "data": "architect_type"
           },
           {
             "data": "st"
           },
           {
             "data": "sanrachana_usages"
           },
           {
             "data": "floor"
           },
           {
             "data": "sanrachana_ground_housing_area_sqft"
           },
           {
             "data": "contructed_year"
           },
           {
             "data": "sanrachana_dep_rate"
           },
           {
             "data": "sanrachana_min_amount"
           },
           {
             "data": "sanrachana_khud_amount"
           },
           {
             "data": "sanrachana_land_tax_amount"
           },
           {
             "data": "sampati_mullyankan"
           },
           {
             "data": "r_bhumi_area"
           },
           {
             "data": "r_bhumi_kar"
           },
         ]
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
       var url = $(this).data('url');

       if (confirm("Are you sure want to delete?") == true) {
         $.ajax({
           type: 'POST',
           url: url, //Here you will fetch records 
           data: {
             id: id,
             '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
           }, //Pass $id
           success: function(resp) {
             console.log(resp);
             //   return;
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
               toastr.success(resp.data);
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