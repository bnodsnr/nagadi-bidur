<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url();?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
var TableDatatablesFixedHeader = function () {

var initTable1 = function () {
var table = $('#groupslist');

var fixedHeaderOffset = 0;
if (App.getViewPort().width < App.getResponsiveBreakpoint('md')) {
if ($('.page-header').hasClass('page-header-fixed-mobile')) {
fixedHeaderOffset = $('.page-header').outerHeight(true);
}
} else if ($('.page-header').hasClass('navbar-fixed-top')) {
fixedHeaderOffset = $('.page-header').outerHeight(true);
}

var oTable = table.dataTable({

// Internationalisation. For more info refer to http://datatables.net/manual/i18n
"language": {
"aria": {
"sortAscending": ": activate to sort column ascending",
"sortDescending": ": activate to sort column descending"
},
"emptyTable": "No data available in table",
"info": "Showing _START_ to _END_ of _TOTAL_ entries",
"infoEmpty": "No entries found",
"infoFiltered": "(filtered1 from _MAX_ total entries)",
"lengthMenu": "_MENU_ entries",
"search": "Search:",
"zeroRecords": "No matching records found"
},

// Or you can use remote translation file
//"language": {
//   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
//},

// setup rowreorder extension: http://datatables.net/extensions/fixedheader/
fixedHeader: {
header: true,
headerOffset: fixedHeaderOffset
},

"order": [
[0, 'asc']
],

"lengthMenu": [
[5, 10, 15, 20, -1],
[5, 10, 15, 20, "All"] // change per page values here
],
// set the initial value
"pageLength": 20,

// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
// So when dropdowns used the scrollable div should be removed.
//"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
});
}

return {

//main function to initiate the module
init: function () {

if (!jQuery().dataTable) {
return;
}

initTable1();
}

};

}();

jQuery(document).ready(function() {
TableDatatablesFixedHeader.init();
});
var UIAlertsApi = function () {

    var handleDemo = function() {
        <?php
        if($this->session->flashdata('MSG_SUC_ADD') != ''){
        ?>
            App.alert({
                //container: $('#alert_container').val(), // alerts parent container(by default placed after the page breadcrumbs)
                //place: $('#alert_place').val(), // append or prepent in container
                type: 'success',  // alert's type
                message: '<?php echo $this->session->flashdata('MSG_SUC_ADD');?>',  // alert's message
                //close: $('#alert_close').is(":checked"), // make alert closable
                //reset: $('#alert_reset').is(":checked"), // close all previouse alerts first
                //focus: $('#alert_focus').is(":checked"), // auto scroll to the alert after shown
                //closeInSeconds: $('#alert_close_in_seconds').val(), // auto close after defined seconds
                //icon: $('#alert_icon').val() // put icon before the message
            });
        <?php }
        if($this->session->flashdata('MSG_ERR_INVALID_DATA') != ''){
            ?>
            App.alert({
                //container: $('#alert_container').val(), // alerts parent container(by default placed after the page breadcrumbs)
                //place: $('#alert_place').val(), // append or prepent in container
                type: 'warning',  // alert's type
                message: '<?php echo $this->session->flashdata('MSG_ERR_INVALID_DATA');?>',  // alert's message
                //close: $('#alert_close').is(":checked"), // make alert closable
                //reset: $('#alert_reset').is(":checked"), // close all previouse alerts first
                //focus: $('#alert_focus').is(":checked"), // auto scroll to the alert after shown
                //closeInSeconds: $('#alert_close_in_seconds').val(), // auto close after defined seconds
                //icon: $('#alert_icon').val() // put icon before the message
            });
            <?php
        }
        ?>
    }

    return {

        //main function to initiate the module
        init: function () {
            handleDemo();
        }
    };

}();

jQuery(document).ready(function() {
    UIAlertsApi.init();
});

</script>