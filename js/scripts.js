function get_projects() {
    $.ajax({
        type: "POST",
        url: "php/query.php",
        data: { "action": "get" }
    }).always(function( msg ) {
        console.log("got", msg)
        $("#projects").html(msg);
    });

}

function add_project() {
    var name = $("#projectName").val();
    var participants = $("#participants").val();
    var description = $("#description").val();

    $.ajax({
        type: "POST",
        url: "php/query.php",
        data: { "action": "add", "name": name, "participants": participants, "description": description }
    }).always(function( msg ) {
        console.log("add", msg);
        get_projects();
    });
}

$(document).ready(function(){
    get_projects();

    $("#submit").on("click", function() {
        add_project();
    });
});