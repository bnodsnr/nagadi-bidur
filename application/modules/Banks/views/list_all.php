
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item" ><a href="<?php echo base_url()?>SetTitle/" > बैंक खाता</a></li>
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
            बैंक खाता सुची
            <span class="tools">
              <?php if($this->authlibrary->HasModulePermission('FISCAL-YEAR', "ADD")) { ?>
               <button type="button" data-toggle="modal" class="btn btn-primary btn-sm pull-right" href="#addModel" data-url="<?php echo base_url()?>Banks/add" data-id = "">नयाँ थप्नुहोस्</button>
             <?php } ?>
           </span>
         </header>
         <div class="card-body">
          <div class="adv-table">
            <table  class="table table-inbox table-bordered table-striped">
              <thead style="background: #1b5693; color:#fff">
                <tr>
                  <th text-aligh="right">#</th> 
                  <th>बैंकको नाम</th>
                  <th>खाता नं</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($banks)) :
                  $i = 1;
                  foreach($banks as $key => $value) : ?>
                    <tr class="gradeX">
                      <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                      <td><?php echo $this->mylibrary->convertedcit($value['name'])?></p></td>
                      <td><?php echo $this->mylibrary->convertedcit($value['acc_no'])?></p></td>
                      
                      
                      <?php if($this->authlibrary->HasModulePermission('BANKS', "EDIT") || $this->authlibrary->HasModulePermission('BANKS', "DELETE") ) { ?>
                        <td class="center hidden-phone">
                          <?php if($this->authlibrary->HasModulePermission('BANKS', "EDIT")) { ?>
                            <button type="button" data-toggle="modal" href="#editModel" class="btn btn-primary" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>Banks/edit" data-id = "<?php echo $value['id']?>"><i class="fa fa-edit"></i></button>
                          <?php } ?>
                          <?php if($this->authlibrary->HasModulePermission('BANKS', "DELETE") ) { ?>
                            <a href = "<?php echo base_url()?>Banks/delete/<?php echo $value['id']?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a> 
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