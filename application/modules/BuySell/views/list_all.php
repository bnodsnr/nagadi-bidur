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

                        <th>क्र.सं</th>
                        <!-- <th style="width:180px;">मिति</th> -->

                        <th style="width:180px;">नाम</th>
                        <th style="width:180px;">क्र.स नं </th>

                        <th style="width:180px;">कित्ता नं</th>

                        <th style="width:180px;">रोपनी </th>
                        <th style="width:180px;">आना </th>
                        <th style="width:180px;">पैसा </th>
                        <th style="width:180px;">दाम </th>
                        <th style="width:180px;">वर्ग फुट</th>
                        <th style="width:180px;">वर्ग मिटर </th>
                        <th style="width:180px;">मु. रकम  </th>

                      </tr>
                        <!-- <tr>
                          <th>#</th>
                          <th>मिति</th>
                          <th>रेजिस्त्रसन नं.</th> -->
                         <!--  <th>जग्गा दिनेको क्र.स नम्बर</th>
                          <th> जग्गा दिनेको नाम </th>
                          <th>जग्गाको क्षेत्रफ़ल्</th>
                          <th class="hidden-phone"></th>
                        </tr> -->
                    </thead>
                    <tbody>
                      <?php 
                      if(!empty($list)) :
                        $i = 1;
                        foreach ($list as $key => $bs) : ?>
                          <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                          <!-- <td><?php echo $this->mylibrary->convertedcit($bs['added_on'])?></td> -->
                            <td style="width:300px;"><?php echo $this->mylibrary->convertedcit($bs['seller_name'])?></td>
                            <td><?php echo $this->mylibrary->convertedcit($bs['seller_file_no'])?></td>
                            <td><?php echo $this->mylibrary->convertedcit($bs['jk_no'])?></td>
                            <td><?php echo $this->mylibrary->convertedcit($bs['s_ropani'])?></td>
                            <td><?php echo $this->mylibrary->convertedcit($bs['s_aana'])?></td>
                            <td><?php echo $this->mylibrary->convertedcit($bs['s_paisa'])?></td>
                            <td><?php echo $this->mylibrary->convertedcit($bs['s_dam'])?></td>
                            <td><?php echo $this->mylibrary->convertedcit($bs['total_land'])?></td>
                            <td><?php echo '-'?></td>
                            <td><?php echo $this->mylibrary->convertedcit($bs['tax_amount'])?></td>
                            <td style="width:200px;">
                                <a class="btn btn-warning" href="<?php echo base_url()?>BuySell/ViewDetails/<?php echo $bs['seller_file_no']?>" target="_blank"><i class="fa fa-info-circle"></i> पुरा विवरण हेर्नुहोस</a>
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
    
   