$(document).ready(function(){
    $(".unactivePost").click(function(e){
        $.post("../ToDo/model/noteActivePost.php", {noteIDJS: $(this).data('noteId'), noteActiveJS: $(this).data('noteActive') }, function(data){
            location.reload();
        });
    });
    $(".activePost").click(function(e){
        $.post("../ToDo/model/noteActivePost.php", {noteIDJS: $(this).data('noteId'), noteActiveJS: $(this).data('noteActive') }, function(data){
            location.reload();
        });
    });
});

