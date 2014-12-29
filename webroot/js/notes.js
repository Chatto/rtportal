$( document ).ready(function() {
    $('.hide').hide();
});
function showOne(id) {
	$('.hide').not('#content-id-' + id).hide();
    $('#content-id-' + id).toggle(400);
}