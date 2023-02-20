function destroy(event) {
    event.preventDefault();

    $('#delete-modal').modal('show');

    $("#confirm-delete").on("click", function() {
        const confirmButton = $(this);
        confirmButton.prop("disabled", true);

        $.ajax({
            url: event.target.action,
            type: event.target.method,
            data: $(event.target).serialize()
        }).done(function (res) {
            userDatatable.ajax.reload();
            $('#delete-modal').modal('hide');
            confirmButton.prop("disabled", false);
        }).fail(function (err) {
            confirmButton.prop("disabled", false);
        });
    })

}

$(document).ready(function() {
    $(".close-modal").click(function() {
        $('#delete-modal').modal('hide');
    })
})