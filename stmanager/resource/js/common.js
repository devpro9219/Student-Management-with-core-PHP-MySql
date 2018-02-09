function checkVaild(fdName){
    $("[Fd-gp='"+fdName+"']").each(function(){
        var me = $(this);
        if(me.attr('Field') == 'String'){
            if(me.val() == ''){
                me.next('span').html('Invalid Field Please input this field');
                return false;
            }else{
                me.next('span').html('');
            }
        }
        if(me.attr('Field') == 'Number'){

            if(!isNaN(me.val())){
                me.next('span').html('Invalid Field Please insert Number');
                return false;
            }else{
                me.next('span').html('');
            }
        }
        if(me.attr('Field') == 'Email'){
            if(me.val() == ''){
                me.next('span').html('Invalid Field Please input this field');
                return false;
            }else{
                me.next('span').html('');
            }
        }
    });

    return true;
}

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
function confirmDelete() {
    if (confirm("You really want to Delete this!")) {
        return true;
    } else {
        return false;
    }
}
