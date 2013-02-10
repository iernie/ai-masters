function get_projects() {
    $.ajax({
        type: "POST",
        url: "database.php",
        data: { action: "get" }
    }).done(function( msg ) {
        alert( "Data Saved: " + msg );
    });
}

function add_project() {
    var name = $("#projectName").val();
    var participants = $("#participants").val();
    var description = $("#description").val();

    $.ajax({
        type: "POST",
        url: "database.php",
        data: { action: "add", name: name, participants: participants, description: description }
    }).done(function( msg ) {
        alert( "Data Saved: " + msg );
        get_projects();
    });
}

$(document).ready(function(){
    get_projects();

    $("#addProject").on("click", function(e) {
        e.preventDefault();
        add_project();
    });
});