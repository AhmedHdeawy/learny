$(document).on("click", ".side-menu a", function (e) {

    e.preventDefault();

    const linkNum = $(this).data("num"),
     	topSpace = 120;
    
    const element = $('.content-box-desc h5').eq(linkNum);


    $('html, body').animate({
        scrollTop: $(element).offset().top - topSpace
    }, 200);

});
