const popupCart = document.querySelector('#popup-cart');
const cartCont = document.querySelector('#cart-contt');

const popupCartCon = document.querySelector('#cart-conn');
const popupHistoryCon = document.querySelector('#history-conn');
const sumCon = document.querySelector('#summ-con');

const cartButton = document.querySelector('#cart-buttonn');
const historyButton = document.querySelector('#history-buttonn');

// Toggle cart
popupCart.addEventListener('click', () => {
    if (cartCont.style.display !== 'flex') {
        cartCont.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    } else {
        cartCont.style.display = 'none';
        document.body.style.overflow = 'scroll';
    }
})

// Change the product quantity
$(document).ready(function () {
    $('.count').prop('disabled', true);
    $(document).on('click', '.plus', function () {
        $('.count').val(parseInt($('.count').val()) + 1);
        if ($('.count').val() == 11) {
            $('.count').val(10);
        }
    });
    $(document).on('click', '.minus', function () {
        $('.count').val(parseInt($('.count').val()) - 1);
        if ($('.count').val() == 0) {
            $('.count').val(1);
        }
    });
});

historyButton.addEventListener('click', () => {
    if (popupHistoryCon.style.display !== 'block') {
        popupHistoryCon.style.display = 'block';
        popupCartCon.style.display = 'none';
        historyButton.style.backgroundColor = '#165853';
        historyButton.style.color = '#ffffff';
        cartButton.style.backgroundColor = 'transparent';
        cartButton.style.color = '#165853';
        sumCon.style.display = 'none';
    }
});

cartButton.addEventListener('click', () => {
    if (popupCartCon.style.display !== 'block') {
        popupHistoryCon.style.display = 'none';
        popupCartCon.style.display = 'block';
        historyButton.style.backgroundColor = 'transparent';
        historyButton.style.color = '#165853';
        cartButton.style.backgroundColor = '#165853';
        cartButton.style.color = '#ffffff';
        sumCon.style.display = 'block';
    }
});