
$(function () {
    $('#btn_save').click(function () {
        if($('#action_status').val() == 'normal')
            $('#action_status').val('save');
        return true;
    });
});
