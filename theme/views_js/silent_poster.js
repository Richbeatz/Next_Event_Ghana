$(document).on('click', '.comment_btn', function(e) {
    action_type = $(this).attr('action_type');

    if (action_type === 'DECLINE') {
        $("#decline-main").remove();
        $("#decline-selector").append(
            '<div id="decline-main" class="form-group">' +
            '<select name="decline_type" class="form-control custom-select select2" required>' +
            '<option selected value="">Select Decline Type</option>' +
            '<option value="AMENDMENT">Reject For Amendment</option>' +
            '<option value="DECLINE">Decline Request</option>' +
            '</select>' +
            '</div>');

        $('.comment_title').text('Decline Request (Add a comment if any)');
    }
    if (action_type === 'APPROVE') {
        $("#decline-main").remove();
        $("#decline-selector").append(
            '<div id="decline-main" class="form-group">' +
            '<select name="approval_status" class="form-control custom-select select2" required>' +
            '<option selected value="APPROVED">APPROVE REQUEST</option>' +
            '</select>' +
            '</div>');
        $('.comment_title').text('Approve Request (Add a comment if any)');
    }

    $('#commentModal').modal('show');
});





