<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item" ><a href="<?php echo base_url()?>RajasowTitle/" > राजश्व आम्दानी शिर्षक</a></li>
      </ol>
    </nav>
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
        <section class="card">
         
          <div class="card-body">
            <strong> <h1 class="text-center"><?php echo !empty($title)?$title['topic_name'].'-'.$this->mylibrary->convertedcit($title['topic_id']):'';?> </h1></strong>
            <div class="row">
              <?php if(!empty($sub_topics)) :?>
                 <div class="card-body">
                      <table class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th></th>
                            <th>शिर्षक</th>
                            <th>दर</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $i=1;
                           foreach($sub_topics as $item) : ?>
                            <tr>
                              <td>
                                <?php echo $this->mylibrary->convertedcit($i++)?>
                              </td>
                              <td><i class="fa fa-check-circle" style="color:green"></i> <?php echo $item['topic_title']?> </td>
                              <td><?php echo $this->mylibrary->convertedcit($item['rate'])?></td>
                            </tr>
                          <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
              
              <?php endif;?>
            </div>
          </div>
          <?php echo form_close()?>
        </section>
      </div>
    </div>
    <!-- page end-->
  </section>
</section>
<script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('.select_option').select2();
  });
</script>