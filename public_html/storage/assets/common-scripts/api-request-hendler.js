function callGetRequest(url, data, callBack) {
    $.ajax({
        url: url,
        method: 'GET',
        data: data,
        beforeSend: function () {
            $("#preloader").show();
        },
        //cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#preloader').hide();
            callBack(response);
        }
    });
}

function callPostRequest(url, data, callBack) {
    $.ajax({
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'post',
        data: data,
        beforeSend: function () {
            $("#preloader").show();
        },
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#preloader').hide();
            callBack(response);
        }
    });
}

function callDeleteRequest(url, data, callBack) {
    $.ajax({
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'DELETE',
        data: data,
        beforeSend: function () {
            $("#preloader").show();
        },
        cache: false,
        success: function (response) {
            $('#preloader').hide();
            callBack(response);
        }
    });
}

