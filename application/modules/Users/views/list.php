 <!--dynamic table-->

    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />

    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.css" />



<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/jscofirm/css/jquery-confirm.css"/>

<script type="text/javascript" src="<?php echo base_url()?>assets/jscofirm/js/jquery-confirm.js"></script>



    <style>

      ::-webkit-input-placeholder { /* Edge */

        color: red;

      }



      :-ms-input-placeholder { /* Internet Explorer */

        color: red;

      }



      ::placeholder {

        color: red;

      }

      .error li {

        color:red;

      }

    </style>

<!--main content start-->

      <section id="main-content">

          <section class="wrapper site-min-height">

            <nav aria-label="breadcrumb">

              <ol class="breadcrumb">

                  <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>

                  <li class="breadcrumb-item"><a href="javascript:;">प्रयोगकर्ताहरूको सूची</a></li>

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

              

                  <section class="card" style="margin-bottom: -25px;">

                    <header class="card-header">

                     प्रयोगकर्ताहरूको सूची

                        <span class="tools">

                        <a class="btn btn-info btn-success pull-right" href="<?php echo base_url()?>Users/Add"style="color:#FFF"> नयाँ थप्नुहोस् </a>

                      </span>

                    </header>

                    <div class="card-body">

                      <div class="adv-table">

                        <table  class="display table table-bordered table-striped" id="dynamic-table">

                          <thead style="background: #1b5693; color:#fff">

                              <tr>

                                <th text-aligh="right">#</th>

                                <th>कर्मचारीको नाम</th>

                                <th>संकेत नं.</th>

                                <th>पद</th>

                                <th>शाखा</th>

                                <th>कार्यलयमा हाजिर मिति</th>

                                <th>Ward No</th>

                                <th>user name</th>

                                <th class="hidden-phone">.....</th>

                              </tr>

                          </thead>

                          <tbody>

                           <?php 

                           $i =1;

                           if($users->num_rows()>0): 

                                foreach($users->result_array() as $value): 

                                    ?>

                              <tr class="gradeX">

                                  <td><?php echo $this->mylibrary->convertedcit($i++)?></td>

                                  <td><?php echo $this->mylibrary->convertedcit($value['name'])?></td>

                                  <td><?php echo $this->mylibrary->convertedcit($value['employee_id'])?></td>

                                  <td><?php echo $this->mylibrary->convertedcit($value['designation'])?></td>

                                   <td><?php echo $this->mylibrary->convertedcit($value['branch_name'])?></td>

                                    <td><?php echo $this->mylibrary->convertedcit($value['office_join_date'])?></td>

                                    <td><?php echo $this->mylibrary->convertedcit($value['ward'])?></td>

                                    <td><?php echo $this->mylibrary->convertedcit($value['user_name'])?></td>

                                  <td class="center hidden-phone">

                                    <a class="btn btn-primary btn-sm" href="<?php echo base_url()?>Users/EditUser/<?php echo $value['userid']?>" data-toggle="tooltip" title="विवरण सम्पादन गर्नुहोस्"><i class="fa fa-pencil"></i></a>

                                    <a href = "<?php echo base_url()?>Users/EditUserPerm/<?php echo $value['userid']?>" class="btn btn-success btn-sm" data-toggle="tooltip" title="अनुमति सम्पादन गर्नुहोस्" ><i class="fa fa-exclamation-triangle"></i></a>

                                    <a href = "<?php echo base_url()?>Users/deleteUser/<?php echo $value['userid']?>" class="btn btn-warning btn-sm deactive_users" data-toggle="tooltip" title="प्रयोगकर्ताहरू निस्क्रिय गर्नुहोस्" ><i class="fa fa-key"></i></a>



                                    <!-- <a class="btn btn-warning" data-toggle="modal" href="#myModal2">

                                  Confirm

                              </a> -->



                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" title="प्रयोगकर्ताहरू हटाउनुहोस्" data-toggle ="modal" data-target =""><i class="fa fa-trash-o"></i></button>

                                  </td>

                              </tr>

                              <?php endforeach;endif; ?>

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



    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>

    <script type="text/javascript" src="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.js"></script>

    <script type="text/javascript">

      $('.deactive').on('click' function(){

        $.confirm({

    title: 'Title',

    content: 'url:text.txt',

    onContentReady: function () {

        var self = this;

        this.setContentPrepend('<div>Prepended text</div>');

        setTimeout(function () {

            self.setContentAppend('<div>Appended text after 2 seconds</div>');

        }, 2000);

    },

    columnClass: 'medium',

});

      });

      $('#dynamic-table').dataTable( {

        // "aaSorting": [[ 4, "desc" ]]

      });



      // $(document).ready(function(){

      //   $('[data-toggle="tooltip"]').tooltip();   

      // });



      //pop up edit modal

      //$('#editModel').on('shown.bs.modal', function (e) { //Modal Event



      //$('#editModel').on('shown.bs.modal', function (e) { //Modal Event

        $(document).on('show.bs.modal','#editModel', function (e) {

        var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button

        $.ajax({

          type : 'POST',

          url : '<?php echo base_url()?>Setting/addRoadType', //Here you will fetch records 

          data: {updateID:id}, //Pass $id

          success : function(data){

            //if (resp.status == "success") {

              $("#editModel").find('.modal-view').html(data);



           // }

            // $('modal_view').html(data);

           // $('.form-data').html(data);//Show fetched data from database

          }

        });

      });

    </script>

   