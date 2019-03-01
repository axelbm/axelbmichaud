$(document).ready(function(){

    $(".modifLink").click(function(event) {
        // Stop the browser from submitting the form.
        
        event.preventDefault();

        $("#reunionid").val($(this).attr('value'));

        console.log(participations[$("#reunionid").val()])
        $("#statut").val(participations[$("#reunionid").val()]);

        $("#myModal").modal("show");

    })
})