const popupCart = document.querySelector('#popup-cart');
const cartCont = document.querySelector('#cart-contt');

// Toggle cart
popupCart.addEventListener('click', () => {
    if (cartCont.style.display !== 'flex') {
        cartCont.style.display = 'flex';
    } else {
        cartCont.style.display = 'none';
    }
})

// Change the product quantity
$(document).ready(function () {
    $('.count').prop('disabled', true);
    $(document).on('click', '.plus', function () {
        $('.count').val(parseInt($('.count').val()) + 1);
    });
    $(document).on('click', '.minus', function () {
        $('.count').val(parseInt($('.count').val()) - 1);
        if ($('.count').val() == 0) {
            $('.count').val(1);
        }
    });
});