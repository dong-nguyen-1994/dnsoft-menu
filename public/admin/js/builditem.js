$(document).ready(function () {
    "use strict";

    var labelValChange = false;

    $('#label').on('keyup', function () {
        labelValChange = true;
    }).on('change', function () {
        if (!$(this).val()) {
            labelValChange = false;
        }
    });

    $('#menu_builder_class').on('change', function () {
        let classId = $(this).val().replace(/\\/g, '');
        let builderType = ['category', 'page', 'url'];
        for(let i = 0; i < builderType.length; i ++) {
            if (builderType[i] === classId) {
                $('.menu-builder-wrap-' + classId).css('display', 'block');
            } else {
                $('.menu-builder-wrap-' + builderType[i]).css('display', 'none');
            }
        }
        // var classId = $(this).val().replace(/\\/g, '');

        // $('.menu-item-panel').hide();
        // $('.menu-item-panel').find('input,textarea,select').prop('disabled', true);
        // $(`[data-class-name="${classId}"]`).show();
        // $(`[data-class-name="${classId}"]`).find('input,textarea,select').prop('disabled', false);
    });

    $('.menu-builder-wrap').on('change', '.menu-item-panel:visible select[name^="menu_builder_args"]', function (e) {
        if (!labelValChange || !$('#label').val()) {
            $('#label').val($(this).find('option:selected').text().replace(/[-]+/g, '').trim());
        }
    });

    setTimeout(function () {
        $('#menu_builder_class').trigger('change');
    }, 100);
});
