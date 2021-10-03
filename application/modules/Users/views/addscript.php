<script type="text/javascript">
    $('#save_button').on('click', function () {
        // var changepassword = $('.changepassword').val();
        // if(changepassword == 'Yes'){
        //     var password = $('#Password').val();
        //     var confirmpassword = $('#CPassword').val();
        //     if(password == confirmpassword){
        //         $('#Submit').click();
        //     }else{
        //         alert('Password and Confirm Password do not match. Please try again');
        //     }
        // }else{
        //     $('#Submit').click();
        // }
    });

    $('#cancel_button').on('click', function () {
        window.location.assign('<?php echo base_url()?>Users/ListAll');
    });
    $('#savegroup_button').on('click',function(){
        $('#AddGroup').submit();
    });
    $('#savegroupperm_button').on('click',function(){
        $('#EditGroupPerm').submit();
    });
    $('#saveperm_button').on('click',function(){
        $('#EditUserPerm').submit();
    });
    $('#cancelgroup_button').on('click', function () {
        window.location.assign('<?php echo base_url()?>Users/ListGroup');
    });
    // $('.password , .cpassword').on('keyup',function(){
    //     $('.save_button').attr('disabled', 'disabled');
    //     var password = $('.password').val();
    //     var cpassword = $('.cpassword').val();
    //     if(password === cpassword)
    //     {
    //         $('.save_button').removeAttr('disabled');
    //     }
    // });

    /* Ajax User Information */
    $('#Employee').on('change',function(){
        var employee = $(this).val();
        $.ajax({
            url: '<?php echo base_url()?>Users/GetEmployeeData',
            type: 'GET',
            data: {employee: employee},
            success : function(msg)
            {
                msgs = $.parseJSON(msg);
                var name = msgs.fullname;
                $('#Name').val(name);
                $('#Email').val(msgs.email);
            }
        });
        
    });

    $('.changepassword').on('click',function(){
        var checked = $('.changepassword:checked').val();
        console.log(checked);
        if(checked == 'No'){
            $('.changepasswordform').addClass('hidden');
        }
        else
        {
            $('.changepasswordform').removeClass('hidden');
        }
    });
     $('[data-id^="group-select-"]').on('click',function(){
        var type = $(this).data('type');
        var id = $(this).data('id');
        if(type=='all'){
            $('.'+id).prop('checked','checked');
        } else if(type=='none'){
            $('.'+id).prop('checked','');
        }
    });
    
    $('[data-id^="module-select-"]').on('click',function(){
        var type = $(this).data('type');
        var id = $(this).data('id');
        if(type=='all'){
            $('.'+id).prop('checked','checked');
        } else if(type=='none'){
            $('.'+id).prop('checked','');
        }
    });
</script>