$( document ).ready(function() {
    $("#profile-edit").hide();
});
function showEdit() {
	$("#profile-view").hide();
    $("#profile-edit").toggle(400);
}