<link href="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.bs-select').selectpicker();
    
    $('#save_button').on('click', function () {
        $('#Submit').click();
    });

    $('#cancel_button').on('click', function () {
        window.location.assign('<?php echo base_url()?>Home');
    });


    $('.oldpassword').on('change',function(){
        $('.save_button').removeAttr('disabled');
        var oldpassword=($('.oldpassword').val());
       // 
       $.ajax({
            url: '<?php echo base_url();?>User/checkPassword',
            data: {
                oldpassword: oldpassword,
            },
            success: function (data) {
                var returndata = JSON.parse(data);
                if(returndata=='Password Doesnot Matches'){
                    alert('Old password doesnot match');
                    $('.save_button').attr('disabled', 'disabled');
                }
            },
            type: 'POST'
        });
    });

       // 
    
    
    $('.password , .cpassword').on('keyup',function(){
        $('.save_button').attr('disabled', 'disabled');
        var password = $('.password').val();
        var cpassword = $('.cpassword').val();
        if(password === cpassword)
        {
            $('.save_button').removeAttr('disabled');
        }
    });




</script>