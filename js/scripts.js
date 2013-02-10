function get_projects() {
    $.ajax({
    type: "POST",
        url: "database.php",
        data: "action=get",
        success: function(msg){
            alert(msg);
        }
    });
}

function add_project() {
    var name = $("#projectName").val();
    var participants = $("#participants").val();
    var description = $("#description").val();

    $.ajax({
    type: "POST",
        url: "database.php",
        data: "action=add&name=" + name + "&participants=" + participants + "&description=" + description,
        success: function(msg){
            alert(msg);
            get_projects();
        }
    });
}

$(document).ready(function(){
    get_projects();

    $("#addProject").click(function(e) {
        e.preventDefault();
        add_project();
    });
});