
<!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item" ><a href="<?php echo base_url()?>SetTitle/" > आर्थिक वर्ष</a></li>
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
                    आर्थिक वर्षको सूची
                      <span class="tools">
                        <?php if($this->authlibrary->HasModulePermission('FISCAL-YEAR', "ADD")) { ?>
                         <button type="button" data-toggle="modal" class="btn btn-primary btn-sm pull-right" href="#addModel" data-url="<?php echo base_url()?>FiscalYear/add" data-id = "">नयाँ थप्नुहोस्</button>
                        <?php } ?>
                       </span>
                    </header>
                    <div class="card-body">
                      <div class="adv-table">
                        <table  class="table table-inbox table-bordered table-striped">
                          <thead style="background: #1b5693; color:#fff">
                              <tr>
                                <th text-aligh="right">#</th> 
                                <th>आर्थिक वर्ष</th>
                                <th>चालू आर्थिक वर्ष</th>
                                <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php if(!empty($fiscal_year)) :
                              $i = 1;
                              foreach($fiscal_year as $key => $value) : ?>
                              <tr class="gradeX">
                                  <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                                <td><p class="badge badge-sm badge-info"><?php echo $this->mylibrary->convertedcit($value['year'])?></p></td>
                                  <td><?php 
                                    if($value['is_current'] == 1){ ?>
                                      <p class=""><i class=" fa fa-check" style="color:green"></i></p>
                                   <?php } else { ?>
                                      <p class=""><i class=" fa fa-times " style="color:red"></i></p>
                                   <?php  } ?>
                                 </td>
                                  
                                  <?php if($this->authlibrary->HasModulePermission('FISCAL-YEAR', "EDIT") || $this->authlibrary->HasModulePermission('FISCAL-YEAR', "DELETE") ) { ?>
                                  <td class="center hidden-phone">
                                    <?php if($this->authlibrary->HasModulePermission('FISCAL-YEAR', "EDIT")) { ?>
                                        <button type="button" data-toggle="modal" href="#editModel" class="btn-primary btn-sm" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>FiscalYear/edit" data-id = "<?php echo $value['id']?>"><i class="fa fa-edit"></i></button>
                                      <?php } ?>
                                        <?php //if($this->authlibrary->HasModulePermission('FISCAL-YEAR', "DELETE") ) { ?>
                                           <!-- <button data-url = "<?php //echo base_url()?>LandAreaType/delete" data-id = "<?php //echo $value['id']?>" class="btn btn-danger btn-sm delete_data"><i class="fa fa-trash-o"></i></button> -->
                                      <?php //} ?>
                                  </td>
                                <?php } ?>
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

    <script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>
    <script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#listtable').DataTable({
           'order': false,
        });
      })
    </script>
