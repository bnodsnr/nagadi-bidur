 <!--dynamic table-->
    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.css" />

    <style>
      ::-webkit-input-placeholder { /* Edge */
        color: red;
      }

      :-ms-input-placeholder { /* Internet Explorer */
        color: red;
      }

      ::placeholder {
        color: red;
      }
      .error li {
        color:red;
      }
    </style>
<!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item"><a href="javascript:;">राष्ट्रियता</a></li>
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
                     राष्ट्रियताको किसिम  
                        <span class="tools">
                        <?php if($this->authlibrary->HasModulePermission('ROAD', "ADD")) { ?>
                          <a class="btn btn-primary tbl-sm pull-right" href="<?php echo base_url()?>Road/addSadakKoKisim" style="color:#FFF"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                        <?php } ?>
                        
                      </span>
                    </header>
                    <div class="card-body">
                      <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                          <thead style="background: #1b5693; color:#fff">
                              <tr>
                              <th>राष्ट्रियताको नाम</th>
                              </tr>
                          </thead>
                          <tbody>
                            <td></td>
                           <?php 
                            if(!empty($nationality)) : 
                              foreach($nationality as $key => $n) : ?>
                                <tr>
                                  <td><?php echo $n['name']?></td
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
    
   