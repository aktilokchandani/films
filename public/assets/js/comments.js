var $url = `${$baseUrl}/api/comments?slug=` + $("#slug").val();
var $target_container = "comment-section"
$(".request-btn").click(function () {
    $url = $(this).attr("data-action");
    getRecord($url, $target_container);
});

getRecord($url, $target_container);

function setRecord($response) {
    if ($response.data) {
        $.each($response.data, function (key, film) {
            $(".cover-image").attr("src", film.cover_image);
            $(".film-title").text(film.name);
            $(".action-url").attr("href", `${$baseUrl}/films/${film.slug}`);
        })
    }
}

function postHtmlView($response, $method = "post") {
    if ($response.code == 200 && $response.data != "") {
        listHtmlView($response.data,"post");
    }
}

function listHtmlView($data , $method = "get") {
    if ($.trim($data) && $data != "") {
        var html = '<div class="col-12 border-bottom pb-lg-3 mt-3">\n' +
            '           <div class="media">\n' +
            '               <img class="mr-3 rounded-circle" alt="Bootstrap Media Preview" src="' + $baseUrl + '/assets/images/1.jpg"/>\n' +
            '                   <div class="media-body">\n' +
            '                       <div class="row">\n' +
            '                           <div class="col-8 d-flex">\n' +
            '                               <h5>' + $data.name + '</h5> <span></span>\n' +
            '                           </div>\n' +
            '                       </div>\n' +
            '                       ' + $data.comment + '\n' +
            '                   </div>\n' +
            '            </div>\n' +
            '</div>';

        if($method == "post"){
            $(".comment-body").prepend(html);
        }

        if ($method == "get"){
            $(".comment-body").append(html);
        }

    }
}