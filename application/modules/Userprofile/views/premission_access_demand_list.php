<section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="card">
                          <div class="user-heading round">
                              <a href="#">
                                  <img src="<?php echo base_url()?>assets/img/npl.png" alt="">
                              </a>
                              <h1>प्रयोगकर्ता प्रोफाइल</h1>
                              <p><?php echo $query->name?></p>
                          </div>
                          <ul class="nav nav-pills nav-stacked">
                              <!-- <li class="nav-item"><a class="nav-link" href="profile-activity.html"> <i class="fa fa-cog"></i> भर्खरका गतिविधिहरू</a></li>
                              <li class="nav-item"><a class="nav-link" href="profile-edit.html"> <i class="fa fa-cog"></i> विवरण सम्पादन गर्नुहोस्</a></li>
                              <li class="nav-item"><a class="nav-link" href="profile-edit.html"> <i class="fa fa-cog"></i> निस्क्रिय गर्नुहोस्</a></li> -->
                              <li class="nav-item"><a class="nav-link" href="<?php echo base_url()?>Userprofile/demandForm/<?php echo $query->userid?>"> <i class="fa fa-cog"></i> पहुँच तह Access level माग फाराम</a></li>
                          </ul>
                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="card">
                          <div class="card-body bio-graph-info">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="">
                                  <div class="card ui-sortable-handle" >
                                    <div class="card-header bg-info text-light"> पहँच तह(Access Level) सूची
                                      <a href="<?php echo base_url()?>Userprofile/demandAddForm/<?php echo $id;?>" class="btn btn-sm btn-info">पहँच तह(Access Level) माग फारम </a>
                                    </div>
                                    <div class="card-body">
                                     <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>माग गर्नुपर्ने कारण</th>
                                          <th></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php 
                                          if(!empty($permission_access_request)) :
                                            foreach ($permission_access_request as $key => $v) : ?>
                                              <tr>
                                                <td><?php echo $v->reason_for_access?></td>
                                                <td>
                                                  <a href="<?php echo base_url()?>Users/generatePermissionDemand/<?php echo $v->id?>" class="btn btn-warning"><i class="fa fa-print"></i> प्रिन्ट गर्नुहोस्</a>
                                                </td>
                                              </tr>
                                          <?php endforeach;endif;?>
                                      </tbody>
                                     </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </section>
                  </aside>
              </div>

              <!-- page end-->
          </section>
      </section>