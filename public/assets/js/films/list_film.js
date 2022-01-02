var $url = `${$baseUrl}/api/films`;
var $target_container = 'film-section';
$(".request-btn").click(function () {
    $url = $(this).attr("data-action");
    getRecord($url,$target_container);
});

getRecord($url,$target_container);

function setRecord($response) {
    if($response.data){
        $.each($response.data,function (key,film) {
            $(".cover-image").attr("src", film.cover_image);
            $(".film-title").text(film.name);
            $(".action-url").attr("href",`${$baseUrl}/films/${film.slug}`);
        })
    }
}