$(document).ready(function(){
	// Scroll to Up
	$.scrollUp();

	// Disable anchor tag
	$("a[href='#']").click(function (e) { e.preventDefault(); });
});

$(document).on('click', "a[href='#']", function(e) { e.preventDefault(); })


// Top fixed nav
$(window).scroll(function () {
    var scrollTop = $(window).scrollTop();
    if (fixed_header && scrollTop > 120) {
        $('.main_header').addClass('fixed_main_header');
    }else {
        $('.main_header').removeClass('fixed_main_header');
    }

    let slider_content_scroll = 0 - scrollTop;
    $('.slider_section .slideshow_container .slider_content').css('margin-top', slider_content_scroll);
});


// Alert Script
const Toast = Swal.mixin({
    toast: true,
    position: 'center-center',
    showConfirmButton: false,
    background: '#E5F3FE',
    timer: 4000
});
function cAlert(type, text){
    Toast.fire({
        icon: type,
        title: text
    });
}

// Custom loader
function cLoader(type = 'show'){
    if(type == 'show'){
        $('.loader').show();
    }else{
        $('.loader').hide();
    }
}

// Right Side Cart Section
$('.top_cart').click(function () {
    $('.side_cart_section').addClass('show_sc');
});
$('.close_sc').click(function () {
    $('.show_sc').removeClass('show_sc');
});
$(document).click(function (e) {
	if ($(e.target).parents(".side_cart_section").length === 0 && $(e.target).parents(".top_cart").length === 0) {
		$('.show_sc').removeClass('show_sc');
	}
});
function appendRightCart(item, cart_total, item_count){
    $('.side_cart_section').addClass('show_sc');
    $('.cart_have_items').show();
    $('.sc_empty').hide();
    $('.sc_amount span').html(cart_total);
    $('.sc_count').html(item_count);
    $('.scp_list').prepend(item);
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
