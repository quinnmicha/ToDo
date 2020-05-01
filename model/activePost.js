$(document).ready(function(){
    $(".unactivePost").click(function(e){
        $.post("../ToDo/model/noteActivePost.php", {noteID: $(this).data('noteId'), noteActive: $(this).data('noteActive')});
        alert();
    });
});

