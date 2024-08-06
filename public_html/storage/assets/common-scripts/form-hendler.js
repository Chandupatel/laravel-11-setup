
function checkFormValidation(form_id) {
    let is_valid_form = 1;
    $('.error-span').text('');
    $('.form-control').removeClass('is-invalid');

    $(form_id).find('.form-control').each(function () {
        let input_name = $(this).attr('name');
        input_name = input_name.replace("_", " ");

        if (!checkRequiredValidation($(this))) {
            is_valid_form = 0;
            $(this).addClass('is-invalid');
            $('#error_' + $(this).attr('name')).text('The ' + input_name + ' field is required.');
            return true;
        }
        
        let valiInputRes = checkValidInputValidation($(this))
        if (!valiInputRes.status) {
            is_valid_form = 0;
            $(this).addClass('is-invalid');
            $('#error_' + $(this).attr('name')).text(valiInputRes.message);
            return true;
        }
    })
    return is_valid_form;
}

function checkRequiredValidation(input) {
    let is_valid = 1;
    let required = input.attr('required');
    if (typeof required !== typeof undefined && required !== false) {
        if (!input.val()) {
            is_valid = 0;
        }
    }
    return is_valid;
}

function checkValidInputValidation(input) {
    let input_name = input.attr('name');
    let res = {
        status: true,
        message: ""
    }
    if (input_name == "email") {
        let email = input.val().trim();
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            input_name = input_name.replace("_", " ");
            res = {
                status: false,
                message: `The ${input_name} is  Invalid.`
            }
        }
    }

    if (input_name == "password" || input_name == 'confirm_password') {
        let password = input.val().trim();
        const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
        if (!pattern.test(password)) {
            input_name = input_name.replace("_", " ");
            res = {
                status: false,
                message: `The ${input_name} should be a minimum of 8 characters long, containing at least one lowercase letter, one uppercase letter, and one special character (excluding spaces).`
            }
        }
    }

    return res;
}


function openFormModal(modal_id, modal_content_section, response) {
    if (response.status == true) {
        $(modal_content_section).html(response.html);
        $(modal_id).modal({
            backdrop: 'static',
            keyboard: false
        });
        $(modal_id).modal('show');
        $(".select2").select2();
    } else {
        toastr.error('Error', response.message, {
            timeOut: 5000
        });
    }
}

function hendalFormResponse(form_id, response, modal_id = "", dataTableId = "", redirect_url = "", reload_page = 0) {

    if (response.status == true) {
        $(form_id).trigger("reset");
        toastr.success('Success', response.message, {
            timeOut: 5000
        });
        if (modal_id) {
            $(modal_id).modal('hide');
        }

        if (dataTableId) {
            filterDataTable(dataTableId);
        }

        if (redirect_url) {
            setTimeout(() => {
                window.location.href = redirect_url;
            }, 2000);
        } else if (reload_page == 1) {
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        }
    } else if (response.status == 'validator_error') {
        $.each(response.errors, function (index, html) {
            $(form_id).find('input[name="' + index + '"]').addClass('is-invalid');
            $('#error_' + index).text(html[0]);
        });
    } else {
        toastr.error('Error', response.message, {
            timeOut: 5000
        });
    }
}


$(document).on('change', '.statusButton', function (event) {
    event.preventDefault();
    let url = $(this).attr('action-url');
    callPostRequest(url, [], function (response) {
        if (response.status == true) {
            toastr.success(response.message, {
                timeOut: 5000
            });
        } else {
            toastr.error(response.message, {
                timeOut: 5000
            });
        }
    })
});

$(document).on('click', '.deleteButton', function (event) {
    event.preventDefault();
    let url = $(this).attr('action-url');
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to delete this!",
        icon: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        customClass: { confirmButton: "btn btn-danger mt-2", cancelButton: "btn btn-secondary ms-2 mt-2" },
        buttonsStyling: !1,
    }).then(function (t) {
        if (!t.dismiss) {
            callDeleteRequest(url, [], function (response) {
                if (response.status == true) {
                    toastr.success(response.message, {
                        timeOut: 5000
                    });
                } else {
                    toastr.error(response.message, {
                        timeOut: 5000
                    });
                }
            })
        }
    });
});