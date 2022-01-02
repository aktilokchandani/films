const $baseUrl = `${location.origin}`;
const $userLogin = $('meta[name="authorization"]').attr('content')

function getRecord($url, $target_container = "", $method = 'GET') {
    $.ajax({
        type: $method,
        url: $url,
        success: function ($response) {
            // set record
            setRecord($response);
            // paginate
            getPaginate($response, $target_container);

            if ($response.data.length > 0) {
                $.each($response.data, function ($key, $record) {
                    try {
                        listHtmlView($record)
                    } catch (error) {
                        console.log(error.message)
                    }
                })
            }
        }
    })
}


function submitForm($url, $target_container = "", $method = 'POST') {
    $.ajax({
        type: $method,
        url: $url,
        success: function ($response) {
            // set record
            setRecord($response);
        }
    })
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'authorization': $('meta[name="authorization"]').attr('content')
    }
});

function getPaginate($response, $target_container) {
    console.log("$target_container", $target_container)
    $.each($response.pagination.links, function (index, value) {
        if ($response.pagination.links[index] != null) {
            $("." + $target_container).find(`.custom_pagination`).removeClass("d-none")
            $("." + $target_container).find(`#${index}-record`).removeClass("d-none");
            $("." + $target_container).find(`#${index}-record`).attr("data-action", value)
        } else {
            $("." + $target_container).find(`#${index}-record`).addClass("d-none");
            $("." + $target_container).find(`#${index}-record`).removeAttr("data-action")
        }
    })
}


$("form.ajax-form").submit(function (e) {
    var $action = $(this).attr("data-action");
    var $redirectTo = $(this).attr("data-redirect");
    var $method = $(this).prop("method");

    $.ajax({
        url: $action,
        type: $method,
        beforeSend: showSpinner(),
        redirect: true,
        data: new FormData( this ),
        processData: false,
        contentType: false,
        success: function ($response) {

            hideSpinner();
            serverResponse($response, $redirectTo, $method);
        }
    }).fail(function ($response) {
        hideSpinner();
        var $errors = $response.responseJSON.data;
        $.each($errors, function ($errorKey, $errorValue) {
            $("#" + $errorKey).addClass("is-invalid");
            $("#" + $errorKey).siblings("span.invalid-feedback").html("<strong>" + $errorValue + "</strong>");
        });
    });
});


function showSpinner() {
    $(".own-spinner").removeClass("d-none");
    $("button[type=submit]").prop("disabled", true);
}

function hideSpinner() {
    $(".own-spinner").addClass("d-none");
    $("button[type=submit]").prop("disabled", false);
}

function serverResponse($response, $redirectTo, $method) {
    switch ($response.code) {
        case 200: {
            if (typeof $response.identifier != "undefined" && typeof $response.data.id != "undefined") {
                localStorage.setItem($response.identifier, JSON.stringify($response.data))
            }

            if (typeof $redirectTo != "undefined") {
                window.location.href = $redirectTo;
            }

            try {
                postHtmlView($response, $method)
            } catch (err) {
                console.log(err.message); // Error: "printMessage is not defined"
            }

            $("form.ajax-form")[0].reset();
            break;
        }
        case 401: {
            serverMessageHtml("alert-warning", $response)
            break;
        }
        case 400: {
            console.log($response.data)
            serverMessageHtml("alert-warning", $response)
            break;
        }
        case 422: {
            serverMessageHtml("alert-danger", $response)
            break;
        }
        case 429: {
            serverMessageHtml("alert-warning", $response)
            break;
        }
        default: {
            break;
        }
    }
}