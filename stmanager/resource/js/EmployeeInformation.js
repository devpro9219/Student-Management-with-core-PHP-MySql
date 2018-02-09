$('#btn_save').click(function(){
    if(checkVaild('input')){
        if($('#action_status').val() == 'normal')
            $('#action_status').val('save');
        $('#emp_form').submit();
    }
});

$('[btn_delete]').click(function(){
    return confirm("Are you really delete this employee?");
});