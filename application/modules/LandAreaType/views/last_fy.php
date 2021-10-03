<!--main content start-->

<style type="text/css">
 
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">जग्गाको क्षेत्रगत किसिम</a></li>
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

            <!-- <div id="ballsWaveG">
              <div id="ballsWaveG_1" class="ballsWaveG"></div>
              <div id="ballsWaveG_2" class="ballsWaveG"></div>
              <div id="ballsWaveG_3" class="ballsWaveG"></div>
              <div id="ballsWaveG_4" class="ballsWaveG"></div>
              <div id="ballsWaveG_5" class="ballsWaveG"></div>
              <div id="ballsWaveG_6" class="ballsWaveG"></div>
              <div id="ballsWaveG_7" class="ballsWaveG"></div>
              <div id="ballsWaveG_8" class="ballsWaveG"></div>
            </div> -->

            <div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">l</div><div id="fountainTextG_2" class="fountainTextG">o</div><div id="fountainTextG_3" class="fountainTextG">a</div><div id="fountainTextG_4" class="fountainTextG">d</div><div id="fountainTextG_5" class="fountainTextG">i</div><div id="fountainTextG_6" class="fountainTextG">n</div><div id="fountainTextG_7" class="fountainTextG">g</div><div id="fountainTextG_8" class="fountainTextG">.</div><div id="fountainTextG_9" class="fountainTextG">.</div><div id="fountainTextG_10" class="fountainTextG">.</div></div>
            
              <header class="card-header">
                <div class="text-center"><h3>जग्गाको क्षेत्रगत किसिमहरुको सुची</h3></div>
              </header>
              <div class="card-body">
                <div class="adv-table">
                  <table  class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th text-aligh="right">#</th>
                          <th>जग्गाको क्षेत्रगत किसिम</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($landareatype)) :
                        $i = 1;
                        foreach($landareatype as $key => $value) : ?>
                        <tr class="gradeX">
                          <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                          <td><?php echo $this->mylibrary->convertedcit($value['land_area_type'])?></td>
                        </tr>
                      <?php endforeach;endif;?>
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
  $(document).ready(function() {
    $('#dynamic-table').DataTable({
       'order': false,
    });
  })
</script>
