const popupCart = document.querySelector('#popup-cart');
const cartCont = document.querySelector('#cart-contt');

const popupCartCon = document.querySelector('#cart-conn');
const popupHistoryCon = document.querySelector('#history-conn');
const sumCon = document.querySelector('#summ-con');
const hisSumCon = document.querySelector('#history-summ-con');
const hisItemCon = document.querySelector('#history-item-con');
const hisDate = document.querySelector('#history-date');
const hisOrCon = document.querySelector('#history-oder-con');

const cartButton = document.querySelector('#cart-buttonn');
const historyButton = document.querySelector('#history-buttonn');

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

historyButton.addEventListener('click', () => {
    if (popupHistoryCon.style.display !== 'block') {
        popupHistoryCon.style.display = 'block';
        popupCartCon.style.display = 'none';
        historyButton.style.backgroundColor = '#165853';
        historyButton.style.color = '#ffffff';
        cartButton.style.backgroundColor = 'transparent';
        cartButton.style.color = '#165853';
        sumCon.style.display = 'none';
        hisSumCon.style.display = 'none';
        hisItemCon.style.display = 'none';
        hisDate.style.display = 'none';
        hisOrCon.style.display = 'block';
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
        hisSumCon.style.display = 'none';
    }
});

hisOrCon.addEventListener('click', () => {
    hisSumCon.style.display = 'block';
    hisItemCon.style.display = 'block';
    hisDate.style.display = 'flex';
    hisOrCon.style.display = 'none';
})