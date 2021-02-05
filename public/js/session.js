$('#search-container').after(`<li class="top-nav-menu-item" id="cart-icon">
<i class="fal fa-shopping-cart fa-2x"></i>
</li>
`);

    $(`<section id="cart-container">
    <div id="cart-wrapper">
        <button class="login-close"><i style="color: rgba(255, 255, 255, 0.233)" class="far fa-times fa-2x"></i></button>
        <div id="table-wrapper" data-simplebar >
            <table>
                <tr>
                    <th>Goods</th>
                    <th>Price</th>
                    <th>Total</th>    
                </tr>
            </table>
        </div>
        <div id="total-sum"></div>
    </div>
</section>`).prependTo(`nav`);

function getLastSeenGoods(){
    if(elements = sessionStorage.getItem('ls')){
        arr = elements.split('&');
        var line = '';
        arr.forEach(element => {
            let arr = element.split(' ');
            let a = arr.join('_');
            line += `<div class="lastseen-container">
                        <img src="img/` + a + `.jpg" alt="`+ element + ` photo">
                        <p>` + element + `</p>
                        <a class="buy" href="`+ a +`.html">More</a>
                    </div>
                `;
        });
        return line;
    }else if(!elements || elements.length == 0){  
        return `<p>You haven't seen any goods yet</p>`;
    }
}    
function calcCartSum(n){
    let sum = 0
    for(i = 2; i < n+2; i++){
        sum += $(`table tr:nth-child(${i}) td:nth-child(2) p`).text() * $(`table tr:nth-child(${i}) td:nth-child(2) .good-amount .amount-field`).val();
    }
    return sum + ' USD';
}

goods.forEach(elem => {
    ordered = sessionStorage.getItem('ordered');
    let itIsInCart = false;
    if(ordered){
        arr = ordered.split('&');
        arr.forEach(element => {
            el = element.split('*')[0];
            if(el == $(elem).children('.good-descr').children('p').text()){
                itIsInCart = true;
            }
        });
    }
    if(itIsInCart){
        $(elem).children('.good-buttons').append(`<button class="add-to-cart" title="Add to cart" disabled="true"><i style="color: #000" class="fas fa-shopping-cart fa-2x"></i></button>`)
    }else{
        $(elem).children('.good-buttons').append(`<button class="add-to-cart" title="Add to cart"><i class="far fa-shopping-cart fa-2x"></i></button>`);
    }
    $(elem).children('.good-buttons').children('.buy').css('margin', '0');
    $(elem).children('.good-buttons').children('.buy').css('margin-right', 'auto');
});
    
$('nav').on('click', '.amount-plus', function(){
    currentValue = $(this).parent().parent().children('.amount-field').val();
    $(this).parent().
    parent().children('.amount-field').val(++currentValue);
    let prices = sessionStorage.getItem('prices').split('&');
    $('table tr:nth-child(2) td:last').text(calcCartSum(prices.length));
    $('#total-sum').text('Total: ' + calcCartSum(prices.length));

    let goodsWithAmount = sessionStorage.getItem('ordered').split('&');
    let goodsNames = [];
    let goodsAmounts = [];
    for(i = 0; i < goodsWithAmount.length; i++){
        let arr = goodsWithAmount[i].split('*');
        goodsNames[i] = arr[0];
        goodsAmounts[i] = arr[1];
    }
    for(i = 0; i< goodsNames.length; i++){
        if($(this).parent().parent().parent().parent().children('td:first').text() == goodsNames[i]){
            goodsAmounts[i] = currentValue;
        }
    }
    let goods = '';
    for(i = 0; i < goodsAmounts.length; i++){
        if(i == 0){
            goods = goodsNames[i] + '*' + goodsAmounts[i];
        }else if(i >= 1){
            goods += '&' + goodsNames[i] + '*' + goodsAmounts[i];
        }
    }
    sessionStorage.setItem('ordered', goods);
})

$('nav').on('click', '.amount-minus', function(){
    currentValue = $(this).parent().parent().children('.amount-field').val();
    let goodsWithAmount = sessionStorage.getItem('ordered').split('&');
    let goodsNames = [];
    let goodsAmounts = [];
    let prices = sessionStorage.getItem('prices').split('&');
    for(i = 0; i < goodsWithAmount.length; i++){
        let arr = goodsWithAmount[i].split('*');
        goodsNames[i] = arr[0];
        goodsAmounts[i] = arr[1];
    }
    if(currentValue > 1){
        $(this).parent().
        parent().children('.amount-field').val(--currentValue);
        for(i = 0; i< goodsNames.length; i++){
            if($(this).parent().parent().parent().parent().children('td:first').text() == goodsNames[i]){
                goodsAmounts[i] = currentValue;
            }
        }
    }else{
        if($('tr').toArray().length - 1 == 1){
            $('#final-order').parent().append('<p id="not-ordered-text">You removed everything</p>');
            $('#final-order').remove();
        }
        for(i = 0; i< goodsNames.length; i++){
            if($(this).parent().parent().parent().parent().children('td:first').text() == goodsNames[i]){
                goodsAmounts.splice(i, 1);
                goodsNames.splice(i, 1)
                prices.splice(i, 1);
            }
        }
        let priceLine = '';
        for(i = 0; i < prices.length; i++){
            if(i == 0){
                priceLine = prices[i];
            }else if(i >= 1){
                priceLine += '&' + prices[i];
            }
        }
        sessionStorage.setItem('prices', priceLine);
        $(this).parent().parent().parent().parent().remove();
    }

    let goodsLine = '';
        for(i = 0; i < goodsAmounts.length; i++){
            if(i == 0){
                goodsLine = goodsNames[i] + '*' + goodsAmounts[i];
            }else if(i >= 1){
                goodsLine += '&' + goodsNames[i] + '*' + goodsAmounts[i];
            }
        }
        sessionStorage.setItem('ordered', goodsLine);   
    $('table tr:nth-child(2) td:last').text(calcCartSum(prices.length));
    $('#total-sum').text('Total: ' + calcCartSum(prices.length));
})

$('nav').click(function(event){
    target = event.target;
    if(target.className == 'far fa-times fa-2x' || target.className == 'login-close'){
        if($(target).parent().parent('#cart-container') || $(target).parent().parent().parent('#cart-container')){
            ordered = sessionStorage.getItem('ordered');
            goods.forEach(elem => {
                var itIsInCart = false;
                if(ordered){
                    arr = ordered.split('&');
                    arr.forEach(element => {
                        el = element.split('*')[0];
                        if(el == $(elem).children('.good-descr').children('p').text()){
                            itIsInCart = true;
                        }
                    });
                }
                if(!itIsInCart){
                    if($(elem).children('.good-buttons').children('.add-to-cart').children('i').hasClass('fas')){
                        $(elem).children('.good-buttons').children('.add-to-cart').children('i').removeClass('fas');
                        $(elem).children('.good-buttons').children('.add-to-cart').children('i').addClass('far');
                    }
                }
            });
            var itIsInCart = false;
            if(ordered){
                arr = ordered.split('&');
                arr.forEach(element => {
                    el = element.split('*')[0];
                    if(el == $('h1').text()){
                        itIsInCart = true;
                    }
                });
            }
            if(!itIsInCart){
                if($('#buy').text() == 'Added'){
                    $('#buy').text('Add to cart')
                    $('#buy').css('background', '#000');
                    $('#buy').css('color', '#fff');
                    $('#buy').css('cursor', 'pointer');
                    $('#buy').css('margin-right', '20px');
                    $('#buy').next().css('display', 'flex');
                    $('#buy').next().children('#amount-field').val('1');
                    $('#not-ordered-text').remove();
                    $('#buy').removeAttr('disabled');
                }
            }
        }
        $("body").css('overflow', 'visible');
    }
})

function displayCart(){
    let goods = sessionStorage.getItem('ordered');
    if(goods){
        let goodsWithAmount = sessionStorage.getItem('ordered').split('&');
        let prices = sessionStorage.getItem('prices').split('&');
        let goodsNames = [];
        let goodsAmounts = [];
        for(i = 0; i < goodsWithAmount.length; i++){
            let arr = goodsWithAmount[i].split('*');
            goodsNames[i] = arr[0];
            goodsAmounts[i] = arr[1];
        }
        for(i = 0; i<goodsWithAmount.length; i++){
            $('#cart-wrapper table > tbody:last-child').append(`<tr>
            <td>${goodsNames[i]}</td>
            <td class="table-price"><p>${prices[i]}</p>
            <div class="good-amount">
                <input type="number" name="amount" min="1" class="amount-field" value="${goodsAmounts[i]}">
                <div class="amount-buttons">
                    <button class="amount-plus">+</button>
                    <button class="amount-minus">-</button>
                </div>
            </div></td>
            <td></tr>`);
        }
        $('#cart-wrapper').append('<button id="final-order">Order</button>');
        $('table tr:nth-child(2) td:last').attr('rowspan', goodsWithAmount.length);
        $('table tr:nth-child(2) td:last').text(calcCartSum(goodsWithAmount.length));
        $('#total-sum').text('Total: ' + calcCartSum(goodsWithAmount.length));
    }else{
        $('#cart-wrapper table > tbody:last-child').append(`<tr>
            <td colspan="3"><p id="not-ordered-text">You haven't ordered anything yet</p></td>
        </tr>
        `)
    }
}

$('main').delegate('.add-to-cart', 'click', function(){
    ordered = sessionStorage.getItem('ordered');
    prices = sessionStorage.getItem('prices');
    nameLine = '';
    priceLine = '';
    if(ordered){
        nameLine = ordered;
        priceLine = prices;
        nameLine += "&" + $(this).parent().parent().children('.good-descr').children('p').text() + "*1";
        let priceArr = $(this).parent().parent().children('.good-price').text() ? $(this).parent().parent().children('.good-price').text().split(' ') : $(this).parent().parent().children('.changed-price').children('.good-price').text().split(' ');
        priceArr.forEach(element => {
            if(parseInt(element)){
                price = element;
            }
        });
        priceLine += "&"+price;
    }else {
        nameLine = $(this).parent().parent().children('.good-descr').children('p').text() + "*1";
        let priceArr = $(this).parent().parent().children('.good-price').text() ? $(this).parent().parent().children('.good-price').text().split(' ') : $(this).parent().parent().children('.changed-price').children('.good-price').text().split(' ');
        priceArr.forEach(element => {
            if(parseInt(element)){
                price = element;
            }
        });
        priceLine = price;
    }
    sessionStorage.setItem('ordered', nameLine);
    sessionStorage.setItem('prices', priceLine);
    $(this).children('i').toggleClass('far fas');
    $(this).children('i').css('color', '#000');
    $(this).children('i').css('cursor', 'default')
    this.setAttribute('disabled', 'true');
})

$('body').delegate('.good-a', 'click' , function (event){
    event.preventDefault();
    let lastSeen = sessionStorage.getItem('ls');
    if(!lastSeen || lastSeen.length == 0){
        sessionStorage.setItem('ls', $(this).parent().parent().children('.good-descr').children('p').text());
    }else{
        let text =  $(this).parent().parent().children('.good-descr').children('p').text();
        let ls = lastSeen.split('&');
        let itAlreadyWas = false;
        for(let i = 0; i < ls.length; i++){
            if(ls[i] == text){
                itAlreadyWas = true;
            }
        }
        if(!itAlreadyWas){
            lastSeen += '&'+text;
            sessionStorage.setItem('ls', lastSeen);
        }else{
            lastSeen = ls.join('&');
            sessionStorage.setItem('ls', lastSeen);
        }
    }
    window.location.href = $(this).attr('href');
})

$(`#top-nav-menu`).click(function(event){
    target = event.target;
    if(target.className == 'fal fa-shopping-cart fa-2x'){
        $('#cart-container').css('display', 'block');
        $("body").css('overflow', 'hidden');
        displayCart();
    }
}) 

$('nav').click(function(event){
    target = event.target;
    if(target.id == 'last-seen'){
        if($(target).next().hasClass('dialog')){
            dialog = $(target).next('.dialog'); 
            dialog.append(getLastSeenGoods);
            dialog.dialog();
        }else{
            $(target).after(`<div class="dialog" title="Last seen goods" style="display: none">
            </div>`);
            dialog = $(target).next('.dialog');
            dialog.append(getLastSeenGoods);
            dialog.dialog();
        }
    }
})


ordered = sessionStorage.getItem('ordered');
let itAlreadyWas = false;
if(ordered){
    arr = ordered.split('&');
    arr.forEach(element => {
        el = element.split('*')[0];
        if(el == $('h1').text()){
            itAlreadyWas = true;
        } 
    });
}

$('#buy-form *').click(function(e){
    e.preventDefault();
})

if(itAlreadyWas){
    $('#good-order>div').remove();
    $(`<button id="buy" disabled="true">Added</button>`).prependTo('#good-order');
    $('#buy').css('background', '#fff');
    $('#buy').css('color', '#000');
    $('#buy').css('cursor', 'default');
}else{
    $('#buy').text('Add to cart');
}


$('main').on('click', '#buy', function(){
    sessionStorage = window.sessionStorage;
    ordered = sessionStorage.getItem('ordered');
    prices = sessionStorage.getItem('prices');
    nameLine = '';
    priceLine = '';
    if(ordered){
        nameLine = ordered;
        let currentPrice = 0;
        priceLine = prices;
        nameLine += "&" + $('h1').text() + "*" + $(this).next('#good-amount').children('#amount-field').val();
        let priceArr = $(this).parent().parent().parent().parent().children('p').text() ? $(this).parent().parent().parent().parent().children('p').text().split(' ') : $(this).parent().parent().parent().parent().children('#price').children('#changed-price').children('#new-price').text().split(' ');
        priceArr.forEach(element => {
            if(parseInt(element)){
                currentPrice = element;
            }
        });
        priceLine += ("&" + currentPrice);
    }else {
        nameLine = $('h1').text() + "*" + $(this).next('#good-amount').children('#amount-field').val();
        let priceArr = $(this).parent().parent().parent().parent().children('p').text() ? $(this).parent().parent().parent().parent().children('p').text().split(' ') : $(this).parent().parent().parent().parent().children('#price').children('#changed-price').children('#new-price').text().split(' ');
        priceArr.forEach(element => {
            if(parseInt(element)){
                price = element;
            }
        });
        priceLine = price;
    }

    sessionStorage.setItem('ordered', nameLine);
    sessionStorage.setItem('prices', priceLine);
    $(this).text('Added');
    $(this).css('background' , "#fff");
    $(this).css('color', '#000');
    $(this).css('cursor', 'default');
    $(this).css('margin', '0 auto');
    $(this).next().css('display', 'none');
    this.setAttribute('disabled', 'true');
})

$('main').on('click', '#amount-plus', function(){
    currentValue = $('#amount-field').val();
    $('#amount-field').val(++currentValue);
})

$('main').on('click', '#amount-minus', function(){
    currentValue = $('#amount-field').val();
    if(currentValue > 1){
    $('#amount-field').val(--currentValue);
    }
})

// $(document).ready(function(){
//     if($('#links').css('display') == 'block'){
//         $(`<button class="sign-in" id="last-seen">Last seen</button>
//         <div class="dialog" title="Last seen goods" style="display: none">
//         </div>`).appendTo('#links');
//         $('.form-container').css('justify-content', 'space-around');
//     }else{
//         $(`
//         <div id="links"><button class="sign-in" id="last-seen">Last seen</button>
//         <div class="dialog" title="Last seen goods" style="display: none">
//         </div></div>`).appendTo('.form-container');
//         $('.form-container').css('justify-content', 'space-around');
//     }
// })