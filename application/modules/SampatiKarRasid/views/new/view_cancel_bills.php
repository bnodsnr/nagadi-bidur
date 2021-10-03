

 <!--main content start-->

 <section id="main-content">

  <section class="wrapper site-min-height">

    <nav aria-label="breadcrumb">

      <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>

        </li>

         <li class="breadcrumb-item"><a href="<?php echo base_url()?>SampatiKarRasid/viewBills">सम्पति/भुमि कर रसिद सुची</a></li>

        <li class="breadcrumb-item"><a href="javascript:;">रद्ध गरिएको  रसिद सुची</a></li>

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

            रद्ध गरिएको रसिद सुची

          </header>

          <div class="card-body">

            <div class="adv-table ">

              <table class=" table table-bordered table-striped" id="nagadilist">

                <thead>

                  <tr>

                    <th text-aligh="right">#</th>

                    <th>मिति</th>

                    <th style="width: 50px;">रसिद नम्बर</th>

                    <th>क् संख्या नं</th>

                    <th>करदाता को नाम</th>

                    <th>रद्ध गरिएको कारण </th>

                    <th>रशिद काट्ने नाम</th>

                    <th>रद्ध  गर्नेको नाम</th>

                  </tr>

                </thead>

                <tbody>

                  <?php $i =1;if(!empty($lists)) :

                    foreach($lists as $list) : ?>

                      <tr>

                        <td><?php echo $this->mylibrary->convertedcit($i++)?></td>

                        <td><?php echo $this->mylibrary->convertedcit($list['date'])?></td>

                        

                         <td><a href="<?php echo base_url()?>SampatiKarRasid/previewCancelBill/<?php echo $list['bill_no']?>" target="_blank"><p class="badge badge-warning"><i class="fa fa-eye"></i> <?php echo $this->mylibrary->convertedcit($list['bill_no'])?></p></a></td>

                         <td><?php echo $this->mylibrary->convertedcit($list['nb_file_no'])?></td>

                        <td><?php echo $list['land_owner_name_np']?></td>

                        <td><?php echo $list['reason']?></td>

                        <td><?php echo $list['name']?></td>

                        <td><?php echo $list['canname']?></td>

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