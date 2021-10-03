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
            <?php $success_message = $this->session->flashdata("MSG_SUCCESS");
                if(!empty($success_message)) { ?>
                <div class="alert alert-success">
                    <button class="close" data-close="alert"></button>
                    <span> <?php echo $success_message;?> </span>
                </div>
              <?php } ?>
        
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
                          <th text-aligh="right">#</th> 
                          <th>Menu Name </th>
                            <th class="hidden-phone">.....</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($menus)) :
                        $i = 1;
                        foreach($menus as $key => $menu) : ?>
                        <tr class="gradeX">
                            
                             <td><?php echo $menu['menu_name']?></td>
                             <td><?php  if($menu['status'] == 1) {
                                echo '<i class="fa fa-circle text-success"></i> Active';
                             } else{
                              echo '<i class="fa fa-circle text-danger"></i> Inactive';
                             }?></td>
                              <td>
                              <button type="button" data-toggle="modal" href="#editModel" class="btn-primary btn-sm" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>PresentOld/add" data-id = "<?php echo $menu['menuid']?>"><i class="fa fa-edit"></i></button>
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
