<script type="text/javascript">
    $('#save_button').on('click', function () {
        $('#Submit').click();
    });

    $('#cancel_button').on('click', function () {
        window.location.assign('<?php echo base_url()?>Groups/ListAll');
    });
    $('#savegroup_button').on('click',function(){
        if($("#FirstName").val() != ''){
        $('#AddGroup').submit();
        }else{
            alert("Role name should not be empty");
            $("#FirstName").focus();
        }
    });
    $('#savegroupperm_button').on('click',function(){
        $('#EditGroupPerm').submit();
    });
    $('#saveperm_button').on('click',function(){
        $('#EditUserPerm').submit();
    });
    $('#cancelgroup_button').on('click', function () {
        window.location.assign('<?php echo base_url()?>Groups/');
    });
    $('.password , .cpassword').on('keyup',function(){
        $('.save_button').attr('disabled', 'disabled');
        var password = $('.password').val();
        var cpassword = $('.cpassword').val();
        if(password === cpassword)
        {
            $('.save_button').removeAttr('disabled');
        }
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
