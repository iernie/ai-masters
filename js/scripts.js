function get_projects() {
    $.ajax({
        type: "POST",
        url: "database.php",
        data: { "action": "get" }
    }).always(function( msg ) {
        console.log("got", msg);
    });

}

function add_project() {
    var inputname = $("#projectName").val();
    var inputparticipants = $("#participants").val();
    var inputdescription = $("#description").val();

    $.ajax({
        type: "POST",
        url: "database.php",
        data: { action: "add", name: inputname, participants: inputparticipants, description: inputdescription }
    }).always(function( msg ) {
        console.log("added", msg);
        get_projects();
    });
}

$(document).ready(function(){
    get_projects();

    $("#submit").on("click", function() {
        add_project();
    });
});