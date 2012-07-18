$('.radio input').hide();

$('.radio label').click(function () {
    $(this).siblings('label').children('img').removeClass('active');
    $(this).children('img').addClass('active');
});