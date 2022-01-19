<section id="main-content">
    <section class="wrapper site-min-height">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item" ><a href="<?php echo base_url()?>SetTitle" > नगदी रशिद</a></li>
        </ol>
      </nav>
        <!-- page start-->
        <div class="row">
          <div class="col-sm-12">
            <?php $success_message = $this->session->flashdata("MSG_VALIDATION");
                if(!empty($success_message)) { ?>
                <div class="alert alert-success">
                    <button class="close" data-close="alert"></button>
                    <span> <?php echo $success_message;?> </span>
                </div>
              <?php } ?>
            <section class="card">
              <header class="card-header">
              नगदी रशिद सूची
              <span class="tools">
                <?php if($this->authlibrary->HasModulePermission('NAGADI-RASID', "ADD")) { ?>
                <a class="btn btn-primary btn-sm pull-right" style="color:#FFF"  href="<?php echo base_url()?>NagadiRasid/addBill"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                <?php } ?>
              </span>
              </header>
              <div class="card-body">
                <div class="adv-table">
                  <table  class="display table table-bordered table-striped" id="">
                    <thead style="background: #1b5693; color:#fff">
                        <tr>
                          <th style="width:50px;">#</th> 
                          <th>आर्थिक वर्ष</th>
                          <th> मिति </th>
                          
                          
                          <th>करदाताको नाम.</th>
                          <th>रशिद.</th>
                          <?php if($this->session->userdata('PRJ_USER_ID')== 1) { ?>
                            <th>रशिद काट्ने नाम</th>
                          <?php } ?>
                          <?php if($this->authlibrary->HasModulePermission('NAGADI-RASID', "VIEW") || $this->authlibrary->HasModulePermission('NAGADI-RASID', "EDIT")) { ?>
                            <th class="hidden-phone"></th>
                          <?php } ?>
                          
                        </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($rasaidDetails)) :
                        $i = 1;
                        foreach($rasaidDetails as $key => $value) : ?>
                        <tr <?php if($value['status'] != 1){?> style="background: #e40d0d;" <?php }?>>
                            <td style="width:50px;"><?php echo $this->mylibrary->convertedcit($i++)?></td>
                            <td><p class="badge badge-sm badge-info"><?php echo $this->mylibrary->convertedcit($value['fiscal_year'])?></p></td>
                            <td><p class="">
                          
                            <?php if($this->session->userdata('PRJ_USER_ID')== 1) { 
                            echo $this->mylibrary->convertedcit($value['added_on']);
                            } else {
                                echo $this->mylibrary->convertedcit($value['date']);
                            }
                            
                            ?>
                            
                            </p></td>
                            
                            
                            <td><?php echo $value['customer_name']?></td>
                            <td><?php echo $this->mylibrary->convertedcit($value['bill_no'])?></td>
                            <?php if($this->session->userdata('PRJ_USER_ID')== 1) { ?>
                              <td><?php
                                $user = $this->CommonModel->getCurrentUser($value['added_by']);
                                echo $user['name'];
                               ?></td>
                            <?php } ?>
                            <?php if($this->authlibrary->HasModulePermission('NAGADI-RASID', "EDIT") || $this->authlibrary->HasModulePermission('NAGADI-RASID', "DELETE") ) { ?>
                              <td>
                                <?php if($this->authlibrary->HasModulePermission('NAGADI-RASID', "EDIT") ) { ?>
                                  <?php $added_date = $value['added_on'];
                                    $a = explode(" ",$added_date);
                                    $current_date = convertDate(date('Y-m-d'));
                                    if($a[0] == $current_date) { ?>
                                      <?php if($value['status'] == 1) { ?>
                                        <a href="<?php echo base_url()?>NagadiRasid/edit/<?php echo $value['id']?>" class="btn btn-primary"><i class="fa fa-pencil"></i> सम्पादन गर्नुहोस्</a>
                                      <?php } ?>
                                  <?php } ?>
                                <?php } ?>
                                <?php if($this->authlibrary->HasModulePermission('NAGADI-RASID', "VIEW") ) { ?>
                                  <a href="<?php echo base_url()?>NagadiRasid/view/<?php echo $value['id']?>" class="btn btn-warning"><i class="fa fa-eye"></i> रदिद हेर्नुहोस</a>
                                <?php } ?>

                                <?php if($this->authlibrary->HasModulePermission('NAGADI-RASID', "DELETE") ) { ?>
                                   <?php if($value['status'] == 1) { ?>
                                   <button type="button" data-toggle="modal" class="btn btn-danger" href="#editModel" title="शिर्षक सम्पादन गर्नुहोस्" data-url="<?php echo base_url()?>NagadiRasid/cancleNagadiBill" data-id = "<?php echo $value['id']?>"><i class="fa fa-times"></i> रद्द गर्नुहोस्</button>
                                  <!--<a href="<?php echo base_url()?>NagadiRasid/DeleteBill/<?php echo $value['id']?>" class="btn btn-danger"><i class="fa fa-times"></i> रद्द गर्नुहोस्</a>-->
                                <?php } ?>
                                <?php } ?>
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
<script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#dynamic-table').DataTable({
      "language": {
        "search": "खोज्नुहोस"
      },
      'order': false,
    });
  })
</script>