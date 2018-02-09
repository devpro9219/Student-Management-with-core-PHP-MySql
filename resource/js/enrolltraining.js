
$(function () {
    $('#course_id').change(function(){
        var course_id = $('#course_id').val();
        $.ajax({
            type: 'post'
            , dataType: 'json'
            , async: true
            , url: '../../module/ajax/getStudentTrainingFromCourse.php'
            , data: "course_id=" + course_id
            , success: function(response){

                $('#student_id').html('<option value="">Select</option>');
                $('#training_id').html('<option value="">Select</option>');
                if(response.student == '' || response.training == '')
                    return;

                var studentList = response.student;

                for(var i=0; i<studentList.length; i++){
                    $('#student_id').append('<option value="'+studentList[i]['_id']+'">'+studentList[i]['stu_surname']+' '+studentList[i]['stu_name']+'</option>')
                }

                var trainingList = response.training;

                for(var i=0; i<trainingList.length; i++){
                    $('#training_id').append('<option value="'+trainingList[i]['_id']+'">'+trainingList[i]['tran_name']+'</option>')
                }
            }
            ,error:function(data, status, err){
                alert('Server Not Found');
            }
        });
    });

    $('#btn_save').click(function () {
        if($('#action_status').val() == 'normal')
            $('#action_status').val('save');
        return true;
    });

    $('[btn_delete]').click(function(){
        return confirm("Are you sure you wish to remove this enrolling training? This cannot be undone.");
    });
});


