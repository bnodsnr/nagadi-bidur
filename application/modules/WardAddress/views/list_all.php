 <!--dynamic table-->
    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.css" />

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
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item"><a href="javascript:;">वार्ड ठेगाना</a></li>
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
                    <header class="card-header">
                      वार्ड ठेगाना
                        <span class="tools">
                        <?php if($this->authlibrary->HasModulePermission('ROAD', "ADD")) { ?>
                          <!-- <a class="btn btn-primary tbl-sm pull-right" href="<?php echo base_url()?>WardAddress/addwardaddress" style="color:#FFF"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a> -->

                          <button type="button" data-toggle="modal" href="#editModel" class=" btn btn-primary btn-sm pull-right" title="" data-url="<?php echo base_url()?>WardAddress/addwardaddress"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </button>
                        <?php } ?>
                        
                      </span>
                    </header>
                    <div class="card-body">
                      <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                          <thead style="background: #1b5693; color:#fff">
                              <tr>
                                <th>वार्ड नं.</th>
                                <th>वार्ड ठेगाना</th>
                                <th class="hidden-phone">.....</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php 
                            if(!empty($wardaddress)) :
                              foreach ($wardaddress as $key => $wa) : ?>
                                <td><?php echo $wa['ward']?></td>
                                  <td><?php echo $wa['address']?></td>

                                  <td class="center hidden-phone">
                                    <a class="btn btn-primary btn-sm" data-toggle="modal" href="#editModel" data-id ="<?php echo $wa['id']?>" data-url="<?php echo base_url()?>WardAddress/updateWardAddress"><i class="fa fa-edit"></i></a>

                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" title="मेटाउनुहोस्" data-toggle ="modal" data-target =""><i class="fa fa-trash-o"></i></button>
                                  </td>
                                </tr>
                           <?php endforeach; endif;?> 
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
    
   