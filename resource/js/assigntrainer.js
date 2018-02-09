
$(function () {
    $('#btn_save').click(function () {
        if($('#action_status').val() == 'normal')
            $('#action_status').val('save');
        return true;
    });

    $('[btn_delete]').click(function(){
        return confirm("Are you sure you wish to remove this assigning trainer? This cannot be undone.");
    });
});
