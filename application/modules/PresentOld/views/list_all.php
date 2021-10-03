<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">हाल साबिक</a></li>
        </ol>
      </nav>
        <!-- page start-->
        <div class="row">
          <div class="col-sm-12">
                
            <section class="card" style="margin-bottom: -25px;">
              <header class="card-header">
               हाल साबिक
                  <span class="tools">
                  <?php if($this->authlibrary->HasModulePermission('PRESENT-OLD', "ADD")) { ?>
                    <button type="button" data-toggle="modal" href="#addModel" class="btn-primary btn-sm pull-right" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>PresentOld/add">नयाँ थप्नुहोस्</button>
                  <?php } ?>
                </span>
              </header>
              <div class="card-body">
                <div class="adv-table">
                  <table  class="table table-inbox table-bordered table-striped">
                    <thead style="background: #1b5693; color:#fff">
                        <tr>
                          <th>#</th>
                          <th>साबिक गा.पा/न.पा</th>
                          <th>साबिक वडा नं</th>
                           <th>हाल गा.पा/न.पा </th>
                          <th>हाल वडा नं </th>
                          <?php if($this->authlibrary->HasModulePermission('PRESENT-OLD','EDIT') && $this->authlibrary->HasModulePermission('PRESENT-OLD', 'DELETE')) { ?>
                            <th class="hidden-phone">.....</th>
                          <?php } ?>
                                                          
                        </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($datas)) :
                        $i = 1;
                        foreach($datas as $key => $value) : ?>
                        <tr class="gradeX">
                            <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                             <td><?php echo $this->mylibrary->convertedcit($value['old_name'])?></td>
                             <td><?php echo $this->mylibrary->convertedcit($value['old_ward'])?></td>
                             <td><?php echo $this->mylibrary->convertedcit($value['present_name'])?></td>
                             <td><?php echo $this->mylibrary->convertedcit($value['present_ward'])?></td>
                            

                            <?php if($this->authlibrary->HasModulePermission('PRESENT-OLD','EDIT') && $this->authlibrary->HasModulePermission('PRESENT-OLD', 'DELETE')) { ?>
                                <td class="center hidden-phone">
                                  <?php if($this->authlibrary->HasModulePermission('PRESENT-OLD', "EDIT")) { ?>
                                      <button type="button" data-toggle="modal" href="#editModel" class="btn btn-primary btn-sm" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>PresentOld/add" data-id = "<?php echo $value['id']?>"><i class="fa fa-edit"></i></button>
                                  <?php } ?>

                                  <?php if($this->authlibrary->HasModulePermission('PRESENT-OLD', "DELETE")) { ?>
                                    <button data-url = "<?php echo base_url()?>PresentOld/delete" data-id = "<?php echo $value['id']?>" class="btn btn-danger btn-sm delete_data"><i class="fa fa-trash-o"></i></button>
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
