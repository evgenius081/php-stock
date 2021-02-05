function eventsList(element) {
    var events = element.data('events');
    if (events !== undefined) return events;

    events = $.data(element, 'events');
    if (events !== undefined) return events;

    events = $._data(element, 'events');
    if (events !== undefined) return events;

    events = $._data(element[0], 'events');
    if (events !== undefined) return events;

    return false;
}

function checkEvent(element, eventname) {
    var events,
    ret = false;
    events = eventsList(element);
    if (events) {
        $.each(events, function(evName, e) {
            if (evName == eventname) {
                ret = true;
            }
        });
    }
    return ret;
}

function include(url) {
    var script = document.createElement('script');
    script.src = url;
    document.getElementsByTagName('head')[0].appendChild(script);
}

function authHandler(e){
        $('#cart-container').css('display', 'none');
        $('table tbody').empty();
        $('#final-order').remove();
        $('table tbody').append('<tr><th>Goods</th><th>Price</th><th>Total</th></tr>');
        $("body").css('overflow', 'visible');
};

const goods = $('.good').toArray();
var displayedGoogs = goods.slice();

function clearGoods(n){
    if(parseInt(n)){
        displayedGoogs = goods.slice();
        $('#goods').empty();
        for(i = 0; i < goods.length; i++){
            if(i >= n){
                displayedGoogs.pop(i, 1);
            }
        }
        for(i  = 0; i < displayedGoogs.length; i++){
            $(displayedGoogs[i]).appendTo('#goods');
        }
    }else if(!n){
        $('#goods').empty();
    }
}

function sortGoods(str){
    $('#goods').empty();
    let prices = [];
    let names = [];
    switch (str){
        case 'A - Z':
            for(i = 0; i < displayedGoogs.length; i++){
                names[i] = $(displayedGoogs[i]).children('.good-descr').children('p').text();
            }
            names.sort();
            for(i = 0; i < displayedGoogs.length; i++){
                for(j = 0; j < displayedGoogs.length; j++){
                    if(names[i] == $(displayedGoogs[j]).children('.good-descr').children('p').text()){
                        $(displayedGoogs[j]).appendTo('#goods');
                    }
                }
            }
            break;
        case 'Z - A':
            for(i = 0; i < displayedGoogs.length; i++){
                names[i] = $(displayedGoogs[i]).children('.good-descr').children('p').text();
            }
            names.sort();
            names.reverse();
            for(i = 0; i < displayedGoogs.length; i++){
                for(j = 0; j < displayedGoogs.length; j++){
                    if(names[i] == $(displayedGoogs[j]).children('.good-descr').children('p').text()){
                        $(displayedGoogs[j]).appendTo('#goods');
                    }
                }
            }
            break;
        case "Expensive":
            for(i = 0; i < displayedGoogs.length; i++){
                prices[i] = parseInt($(displayedGoogs[i]).children('.good-price').text().split(' ')[0]) ? parseInt($(displayedGoogs[i]).children('.good-price').text().split(' ')[0]) : parseInt($(displayedGoogs[i]).children().children('.good-price').text().split(' ')[0]);
            }
            prices.sort(function(a, b){return b - a});
            for(i = 0; i < displayedGoogs.length; i++){
                for(j = 0; j < displayedGoogs.length; j++){
                    if(prices[i] == parseInt($(displayedGoogs[j]).children('.good-price').text().split(' ')[0]) || prices[i] == parseInt($(displayedGoogs[j]).children().children('.good-price').text().split(' ')[0])){
                        $(displayedGoogs[j]).appendTo('#goods');
                    }
                }
            }
            break;
        case "Cheap":
            for(i = 0; i < displayedGoogs.length; i++){
                prices[i] = parseInt($(displayedGoogs[i]).children('.good-price').text().split(' ')[0]) ? parseInt($(displayedGoogs[i]).children('.good-price').text().split(' ')[0]) : parseInt($(displayedGoogs[i]).children().children('.good-price').text().split(' ')[0]);
            }
            prices.sort(function(a, b){return a - b});
            for(i = 0; i < displayedGoogs.length; i++){
                for(j = 0; j < displayedGoogs.length; j++){
                    if(prices[i] == parseInt($(displayedGoogs[j]).children('.good-price').text().split(' ')[0]) || prices[i] == parseInt($(displayedGoogs[j]).children().children('.good-price').text().split(' ')[0])){
                        $(displayedGoogs[j]).appendTo('#goods');
                    }
                }
            }
            break;
        case 'No sorting':
            for(i  = 0; i < displayedGoogs.length; i++){
                $(displayedGoogs[i]).appendTo('#goods');
            }
    }
}

$(document).ready(function(){  

    
    $('#subm').css('display' , 'none');

    $( function() {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 24000,
            values: [ 0, 24000 ],
            slide: function( event, ui ) {
                $( "#min-amount" ).val( ui.values[ 0 ] );
                $( "#max-amount" ).val( ui.values[ 1 ] );
            }
        });
        $( "#min-amount" ).val( $( "#slider-range" ).slider( "values", 0 ));
        $( "#max-amount" ).val( $( "#slider-range" ).slider( "values", 1 ));
    });

    $('#top-nav-menu').click(function(event){
        target = event.target;
        if(target.className == 'fal fa-user fa-2x'){
            $('#popup-container').css('display', 'block');
            $("body").css('overflow', 'hidden');
        }
    }) 

    $('nav').click(function(event){
        target = event.target;
        if(target.className == 'far fa-times fa-2x' || target.className == 'login-close'){
            $('#cart-container').css('display', 'none');
            $('table tbody').empty();
            $('#final-order').remove();
            $('table tbody').append('<tr><th>Goods</th><th>Price</th><th>Total</th></tr>');
            $("body").css('overflow', 'visible');
        }
    })

    if($('#goods').length){
        $('<section id="goods-filters"><div><div><i class="fal fa-sort-amount-up"></i><p>Sort by:</p></div><div class="dropdown-container"><p id="dropdown-container-sorting">No sorting</p><ul class="dropdown"><li>No sorting</li><li>A - Z</li><li>Z - A</li><li>Expensive</li><li>Cheap</li></ul></div></div><div><div><p>Per page: </p></div><div class="dropdown-container" id="goods-number"><p id="dropdown-container-amount">9</p><ul class="dropdown"><li>3</li><li>6</li><li>9</li><li>12</li></ul></div></div></section>').prependTo('#main');

    }

    $('<i class="fas fa-chevron-down more"></i>').insertAfter('.filter-header-wrapper');
    $('#filters-submit').remove();

    $(".filter-var-container").hide();
    $(".more").click(function () {
        $(this).next().slideToggle("slow").siblings(".more > .filter-var-container").slideUp("slow");
        $(this).toggleClass('fa-chevron-down fa-chevron-up')
    });

    canRegister= [0,0,0,0];
    function minus(id){
        if(canRegister[id] != 0){
            canRegister[id] = 0;
        }
        ableButton();
    }

    function plus(id){
        if(canRegister[id] != 1){
            canRegister[id] = 1;
            ableButton();
        }
    }
    function ableButton(){
        can = true;
        canRegister.forEach(element => {
            if(element == 0){
                can = false;
            }
        });
        if(can){
            $('.sign-in').prop('disabled', false);
        }else{
            $('.sign-in').attr('disabled', true);
        }
    }

    $('#reg-email').keyup(function(e){
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!re.test(String($('#reg-email').val()))){
            $('#reg-email').css('border-bottom', '3px solid #c62828');
            $('.password').attr('title', 'Incorrect email');
            minus(0);
        }else{
            $('#reg-email').css('border-color', 'rgba(255, 255, 255, 0.23) rgba(255, 255, 255, 0.23) rgb(124, 179, 66)');  
            $('#reg-email').css('border-bottom', '2px solid rgb(124, 179, 66)'); 
            plus(0);
        }
    });
    
    $('#reg-password').keyup(function(e){
        if(this.value.length < 8){
            $('#reg-password').css('border-bottom', '3px solid #c62828');
            $('#reg-password').attr('title', 'Too short password');
            minus(1);
        }else if(!this.value.match(/\d/g)){
            $('#reg-password').css('border-bottom', '3px solid #c62828');
            $('#reg-password').attr('title', 'There must be digits in your password');
            minus(1);
        }else{
            $('#reg-password').css('border-color', 'rgba(255, 255, 255, 0.23) rgba(255, 255, 255, 0.23) rgb(124, 179, 66)');
            $('#reg-password').css('border-bottom', '2px solid rgb(124, 179, 66)');
            plus(1);
        }
    });

    $('#confirm-password').keyup(function(e){
        if(this.value == $('#reg-password').val()){
            $('#confirm-password').css('border-color', 'rgba(255, 255, 255, 0.23) rgba(255, 255, 255, 0.23) rgb(124, 179, 66)');   
            $('#confirm-password').css('border-bottom', '2px solid rgb(124, 179, 66)');
            plus(2);
        }else{
            $('#confirm-password').css('border-bottom', '3px solid #c62828');
            $('#confirm-password').attr('title', 'Passwords doesn`t match');
            minus(2);
        }
    })
    
    $('#reg-login').keyup(function(e){
        if(this.value.length < 4){
            $('#reg-login').css('border-bottom', '3px solid #c62828');
            $('#reg-login').attr('title', 'Too short login');
            minus(3);
        }else{
            $('#reg-login').css('border-color', 'rgba(255, 255, 255, 0.23) rgba(255, 255, 255, 0.23) rgb(124, 179, 66)');   
            $('#reg-login').css('border-bottom', '2px solid rgb(124, 179, 66)');
            plus(3);
        }
    });

    $('.fa-times').click(function(){
		$(this).parent().css('display', 'none');
	});

    $('nav').on('click', '#final-order', function(){
        alert('I don`t have a server!');
    })
})

$(window).load(function(){

    $('main').delegate('.dropdown li', 'click', function(){
        if($(this).parent().parent().children('p').text() != $(this).text()){
            $(this).parent().parent().children('p').text($(this).text());
            if(parseInt($(this).text())){
                clearGoods($(this).text());
                sortGoods($("#dropdown-container-sorting").text())
            }else{
                clearGoods($("#dropdown-container-amount").text());
                sortGoods($(this).text());
            }
        }
    })

    clearGoods(9);

    scroll_button = document.createElement('div');
    scroll_button.id = "scroll-up-button";
    scroll_button.innerHTML = '<i class="fal fa-arrow-circle-up fa-2x"></i>';
    document.getElementById('main').appendChild(scroll_button);

    var scrollUp = $('#scroll-up-button');
    var screenHeight = document.documentElement.clientHeight;
    var screenWidth = document.documentElement.clientWidth;
    var scrollHeight = Math.max(
        document.body.scrollHeight, document.documentElement.scrollHeight,
        document.body.offsetHeight, document.documentElement.offsetHeight,
        document.body.clientHeight, document.documentElement.clientHeight
    );
    if ( window.pageYOffset >= screenHeight && window.pageYOffset +  screenHeight - (screenWidth + 17) * 0.055 < scrollHeight - 300) {
        scrollUp.css('display', 'block');
        $('#scroll-up-button i').css('color', '#000');
    }else if(window.pageYOffset +  screenHeight - (screenWidth + 17) * 0.055 >= scrollHeight - 300){
        $('#scroll-up-button i').css('color', '#fff');
    }else  {
        scrollUp.css('display', 'none');
    }

    scrollUp.on('click', function() {
        $('html, body').stop().animate({scrollTop: 0}, 777);
    });

    if($('#contacts-container').length){
        $('<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2183.27794257833!2d18.568610315772965!3d54.40328618021408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46fd752e9232141b%3A0x8b712d91f896657d!2sOlivia%20Business%20Centre!5e1!3m2!1spl!2spl!4v1603807421883!5m2!1spl!2spl" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>').prependTo('#main');
    }

    window.onscroll = function () {
        var screenHeight = document.documentElement.clientHeight;
        var screenWidth = document.documentElement.clientWidth;
        var scrollHeight = Math.max(
            document.body.scrollHeight, document.documentElement.scrollHeight,
            document.body.offsetHeight, document.documentElement.offsetHeight,
            document.body.clientHeight, document.documentElement.clientHeight
        );
        if ( window.pageYOffset >= screenHeight && window.pageYOffset +  screenHeight - (screenWidth + 17) * 0.055 < scrollHeight - 300) {
            scrollUp.css('display', 'block');
            $('#scroll-up-button i').css('color', '#000');
        }else if(window.pageYOffset +  screenHeight - (screenWidth + 17) * 0.055 >= scrollHeight - 300){
            scrollUp.css('display', 'block');
            $('#scroll-up-button i').css('color', '#fff');
        }else  {
            scrollUp.css('display', 'none');
        }
    };
    try{
        var localStorage = window.localStorage;
        var sessionStorage = window.sessionStorage;
    }catch(e){
        alert("Unfortunately, Your browser doesn`t support session and localc storages(");
    }
    if(sessionStorage){
        include('/js/session.js');
    }
    if(localStorage){
        include('/js/local.js');
    }

        var userAgent = navigator.userAgent.toLowerCase();
        var InternetExplorer = false;
        if((/mozilla/.test(userAgent) && !/firefox/.test(userAgent) && !/chrome/.test(userAgent) && !/safari/.test(userAgent) && !/opera/.test(userAgent)) || /msie/.test(userAgent))
            InternetExplorer = true;

        if(InternetExplorer){
            $("link[href='/css/jquery-ui.theme.css']").after('<link rel="stylesheet" type="text/css" href="/css/ie.css">');
        }
});