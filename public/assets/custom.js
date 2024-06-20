$(document).ready(function(){

    $('.nationality').select2({
        placeholder: 'Select nationality...',
    });
    $('.country').select2({
        placeholder: 'Select Countries...',
    });
    var cloneCount = 1;

    $(".clone-btn").click(function (event) {
        event.preventDefault();
        $(this).prev(".clone-cnt").clone().attr('id', 'id'+ cloneCount++).insertBefore(this);
        var currId = cloneCount - 1;
        $('#id'+ currId + ' .form-control').val('');
        setTimeout( () => {
            $('#id'+ currId +' .nationality').next(".select2").remove();
            $('#id'+ currId +' .country').next(".select2").remove();
            $('#id'+ currId +' .nationality').select2({
                placeholder: 'Select nationality...',
            });
            $('#id'+ currId +' .country').select2({
                placeholder: 'Select Countries...',
            });
        }, 500);
    });    
   
});