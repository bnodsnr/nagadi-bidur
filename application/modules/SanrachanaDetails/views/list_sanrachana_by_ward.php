<section id="main-content">

    <section class="wrapper site-min-height">

      <nav aria-label="breadcrumb">

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>

            <li class="breadcrumb-item"><a href="javascript:;">जिल्ला</a></li>

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
              <div class="card-body">
                <div class="adv-table">
                  <table class="table table-hover table-bordered table-striped">
                    <?php if(!empty($wards)) :foreach($wards as $ward) :?>
                      <tr><td><a href= "<?php echo base_url()?>SanrachanaDetails/ExportSanrachanaDetails/<?php echo $ward['ward']?>" class ="btn btn-secondary btn-block"><?php echo 'वडा नं- '.$this->mylibrary->convertedcit($ward['ward']).' का संरचनाहरुको सुची हेर्नुहोस '?></td></tr>
                    <?php endforeach;endif;?>
                  </table>

                </div>

              </div>

            </section>

          </div>

        </div>

        <!-- page end-->

    </section>

</section>

    

   