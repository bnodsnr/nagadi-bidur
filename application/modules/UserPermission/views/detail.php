
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
        <h3 class="page-title"> <?php echo $pagetitle; ?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="actions">
                            <?php
                            // if($this->authlibrary->HasModulePermission('EMPSCHEDULE','EDIT')){
                            //     echo anchor('EmpSchedule/Edit/' . $this->uri->segment(3), 'Edit', array('class' => 'btn green'));
                            // }

                            echo '&nbsp;';
                            echo anchor('UserPermission/ListAll', 'Back', array('class' => 'btn red'));
                            ?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form action="" class="form-horizontal">
                            <div class="form-horizontal">
                                <div class="ui-sortable" id="sortable_portlets">

                                    <div style="display: block;" class="portlet portlet-sortable light bordered">
                                        <div class="portlet-body">
                                            <div class="table-responsive">
                                                <table class="table" width="80%" id="leaveslist">
                                                    <thead>
                                                        <th width="5%">#</th>
                                                        <th>Employee Name</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        foreach($result->result() as $result){
                                                            echo '<tr>
                                                            <td>'.$i++.'</td>
                                                            <td>'.$result->employee.'</td>';
                                                            echo '<td><a href="'.base_url('EmpSchedule/Delete/').$result->userid.'/'.$result->ID.'" onclick="return confirm(\'Are you sure?\');" data-toggle="tooltip" title="Delete"><i class="fa fa-bitbucket"></i></a></td>';
                                                        echo '</tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--/row-->

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
