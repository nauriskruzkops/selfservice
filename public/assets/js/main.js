$(function () {
    var globalAjaxModal = $('#globalAjaxModal');
    globalAjaxModal.on('show.bs.modal', function(e) {
        var globalAjaxModalUrl = $(e.relatedTarget).attr('href');
        $(this)
            .addClass('modal-scrollfix')
            .find('.modal-content')
            .html('loading...')
            .load(globalAjaxModalUrl, function() {
                globalAjaxModal.removeClass('modal-scrollfix').modal('handleUpdate');
                var globalAjaxModalForm = $("form", globalAjaxModal);
                if (globalAjaxModalForm.length) {
                    $(globalAjaxModalForm, globalAjaxModal).submit(function (e) {
                        $.ajax({
                            type: "POST",
                            url: $(globalAjaxModalForm).attr('action'),
                            data: $(globalAjaxModalForm).serialize(),
                            success: function (data) {
                                globalAjaxModal.modal('hide');
                            }
                        });
                        e.preventDefault();
                    })
                }
            });
    });

});