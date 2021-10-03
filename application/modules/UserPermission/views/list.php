<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <?php echo $breadcrumb;?>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> <?php echo $pagetitle;?> &nbsp;
            <?php
            if($this->authlibrary->HasModulePermission('USERPERMISSION','ADD')){
                echo anchor('UserPermission/Add','<i class="fa fa-plus"></i> Add New Users', array('class'=>'btn green pull-right'));
            }
            ?>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-header-fixed" id="leaveslist">
                            <thead>
                            <tr class="">
                                <td width="2%"></td>
								<td>User Name</td>
								<td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
									$datalist = '';
									if(isset($query) && $query->num_rows()>0)
									{
										$id='';
                                        $count = 1;
										foreach($query->result() as $row){
											if($row->userid!=$id)
											{
												$datalist .= '<tr> <td>'.$count++.'</td>
																	<td>'.$row->employee.'</td>
                                  <td><a href="'.base_url('UserPermission/Delete/').$row->userid.'/'.$row->ID.'" onclick="return confirm(\'Are you sure?\');" data-toggle="tooltip" title="Delete"><i class="fa fa-bitbucket"></i></a></td>
															  </tr>';
												$id= $row->userid;
											}
										}
									}
									echo $datalist;
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
