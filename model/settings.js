$(document).ready(function(){
    $("#changeUser").click(function(){
        $("#changeUserForm").toggleClass('d-none');
    });
    $("#changePass").click(function(){
        $("#changePassForm").toggleClass('d-none');
    });
    $("#changeIcon").click(function(){
        $("#taskIconForm").toggleClass("d-none");
    });
    $("#changeTaskColor").click(function(){
        $("#changeTaskColorForm").toggleClass("d-none");
    });
    
});
//Returns true and sends to php if everything is valid
function changePasswordCheck(){
    var errorCheck = 0;
    if($("#password").val()===""){
        $("#password").addClass('is-invalid');
        $("#password").removeClass('is-valid');
        errorCheck++;
    }
    if($("#confPassword").val()!=$("#password").val() || $("#confPassword").val()===""){
        $("#confPassword").addClass('is-invalid');
        $("#confPassword").removeClass('is-valid');
        errorCheck++;
      }
  if(errorCheck>0){
    return false;
    }
    else{ return true; }
}



