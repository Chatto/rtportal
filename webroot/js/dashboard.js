$( document ).ready(function() {
    $('.hide').hide();
});
function showAnnouncement(id) {
    $('#announcement-id-' + id).slideToggle(400);
}