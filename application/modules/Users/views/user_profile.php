<section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="card">
                          <div class="user-heading round">
                              <a href="#">
                                  <img src="<?php echo base_url()?>assets/img/defaul_a.png" alt="">
                              </a>
                              <h1>प्रयोगकर्ता प्रोफाइल</h1>
                              <p><?php echo $query->name?></p>
                          </div>
                          <ul class="nav nav-pills nav-stacked">
                            <?php if($this->session->userdata('PRJ_USER_ID') == 1) { ?>
                              <li class="nav-item"><a class="nav-link" href="profile-activity.html"> <i class="fa fa-cog"></i> भर्खरका गतिविधिहरू</a></li>
                              <li class="nav-item"><a class="nav-link" href="profile-edit.html"> <i class="fa fa-cog"></i> विवरण सम्पादन गर्नुहोस्</a></li>
                              <li class="nav-item"><a class="nav-link" href="profile-edit.html"> <i class="fa fa-cog"></i> निस्क्रिय गर्नुहोस्</a></li>
                            <?php } ?>
                              
                              <li class="nav-item"><a class="nav-link" href="<?php echo base_url()?>Users/demandForm/<?php echo $query->userid?>"> <i class="fa fa-cog"></i> पहुँच तह Access level माग फाराम</a></li>
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
                                    <div class="card-header bg-info text-light">विवरण</div>
                                    <div class="card-body">
                                     <table class="table table-bordered">
                                      <tbody>
                                        <tr> 
                                          <td>प्रयोगकर्ता कर्मचारीको नाम</td>
                                          <td><?php echo $query->name?></td>
                                        </tr>
                                        <tr> 
                                          <td>संकेत नं. </td>
                                          <td><?php echo $query->symbol_no?></td>
                                        </tr>
                                        <tr> 
                                          <td>पद</td>
                                          <td><?php echo $query->designation?></td>
                                        </tr>
                                        <tr> 
                                          <td>शाखा</td>
                                          <td><?php echo $query->branch_name?></td>
                                        </tr>
                                        <tr> 
                                          <td>प्रयोजन</td>
                                          <td><?php echo $query->designation?></td>
                                        </tr>
                                        <tr> 
                                          <td>सफ्टवेयर/प्रणालीको नाम</td>
                                          <td><?php echo $query->designation?></td>
                                        </tr>
                                        <tr> 
                                          <td>सफ्टवेयर विवरण</td>
                                          <td><?php echo $query->designation?></td>
                                        </tr>
                                        <tr> 
                                          <td>पहुँच तह Access level</td>
                                          <td><?php echo $query->user_group?></td>
                                        </tr>
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