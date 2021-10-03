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
                जग्गा किन बेच
                  <span class="tools">
                  <?php if($this->authlibrary->HasModulePermission('BUY-SELL', "ADD")) { ?>
                    <a href = "<?php echo base_url()?>BuySell/addNew" class=" btn btn-primary btn-sm pull-right" title=""><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                  <?php } ?>
                  
                </span>
              </header>
              <div class="card-body">
                <div class="adv-table">
                  <table  class="display table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>मिति</th>
                          <th>रेजिस्त्रसन नं.</th>
                          <th>जग्गा दिनेको</th>
                          <th>जग्गा लिनेको</th>
                          <th>जग्गाको क्षेत्रफल(वर्ग फुट)</th>
                          <th>घट जग्गा तथा संरचना(वर्ग फुट)</th>
                          <th class="hidden-phone"></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                      if(!empty($list)) :
                        $i = 1;
                        foreach ($list as $key => $bs) : ?>
                          <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                          <td><?php echo $this->mylibrary->convertedcit($bs['added_on'])?></td>
                          <td><?php echo $this->mylibrary->convertedcit($bs['reg_no'])?></td>
                          <td><?php echo $bs['seller_name']?></td>
                            <td><?php echo $bs['buyer_name']?></td>
                            <td><?php echo $this->mylibrary->convertedcit($bs['total_land'])?></td>
                            <td><?php echo $this->mylibrary->convertedcit($bs['n_land_area'])?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url()?>BuySell/ViewDetails/<?php echo $bs['id']?>" target="_blank"><i class="fa fa-eye"></i> विवरण हेर्नुहोस</a>
                            </td>
                           <!--  <td class="center hidden-phone">
                              <a class="btn btn-primary btn-sm" data-toggle="modal" href="#editModel" data-id ="<?php echo $bs['id']?>" data-url="<?php echo base_url()?>WardAddress/updateWardAddress"><i class="fa fa-edit"></i></a>

                              <button class="btn btn-danger btn-sm" data-toggle="tooltip" title="मेटाउनुहोस्" data-toggle ="modal" data-target =""><i class="fa fa-trash-o"></i></button>
                            </td> -->
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

<script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#dynamic-table').DataTable({
      "language": {
        "search": "खोज्नुहोस"
      },
      'order': false,
      "lengthChange": false,
    });
  })
</script>
    
   