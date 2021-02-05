function getFavouriteGoods(){
    if(elements = localStorage.getItem('fav')){
        arr = elements.split('&');
        var line = '';
        arr.forEach(element => {
            let arr = element.split(' ');
            let a = arr.join('_');
            line += `<div class="favourite-container"><div class="good-descr">
                        <img src="img/` + a + `.jpg" alt="`+ element + ` photo">
                        <p>` + element + `</p>
                        <a class="buy good-a" href="`+ a +`.html">More</a>
                    </div></div>
            `;
        });
        return line;
    }else if(!elements || elements.length == 0){  
        return `<p>You don't have favourite goods(</p>`;
    }
}

$('main').delegate('.wishlist', 'click' ,function (event){
    target = event.target;
    if($(target).hasClass('far') || $(target).hasClass('fas')){
        $(target).toggleClass("far fas");
        let favourite = localStorage.getItem('fav');
        var itAlreadyWas = false;
        if(!favourite || favourite.length == 0){
            localStorage.setItem('fav', $(this).parent().parent().children('.good-descr').children('p').text() ? $(this).parent().parent().children('.good-descr').children('p').text() : $('h1').text());
        }else{
            let text = $(this).parent().parent().children('.good-descr').children('p').text() ? $(this).parent().parent().children('.good-descr').children('p').text() : $('h1').text();
            let favs = favourite.split('&');
            for(let i = 0; i < favs.length; i++){
                if(favs[i] == text){
                    favs.splice(i, 1);
                    itAlreadyWas = true;
                }
            }
            if(!itAlreadyWas){
                favourite += '&'+text;
                localStorage.setItem('fav', favourite);
            }else{
                favourite = favs.join('&');
                localStorage.setItem('fav', favourite);
            }
        }
    }
})

$('nav').click(function(event){
    target = event.target;
    if(target.className == 'far fa-times fa-2x'){
        authHandler(event);
    }else if(target.id == 'favourite'){
        if($(target).next().hasClass('dialog')){
            dialog = $(target).next('.dialog');
            dialog.append(getFavouriteGoods);
            dialog.dialog();
        }else{
            $(target).after(`<div class="dialog" title="Favourite goods" style="display: none">` + `</div>`);
            dialog = $(target).next('.dialog');
            dialog.append(getFavouriteGoods);
            dialog.dialog();
        }
    }
})

function displayWishlistButtonsIndex(arr, ordered){
    goods.forEach(elem => {
        if(ordered){
            let itIsInCart = false;
            arr.forEach(element => {
                el = element.split('*')[0];
                if(el == $(elem).children('.good-descr').children('p').text()){
                    itIsInCart = true;
                }
            });
            if(itIsInCart){
                setTimeout(() => $(elem).children('.good-buttons').children('.add-to-cart').after(`<button class="wishlist" title="Add to favourites"><i style="color: red;" class="fas fa-heart fa-2x"></i></button>`), 50);
            }else{
                setTimeout(() => $(elem).children('.good-buttons').children('.add-to-cart').after(`<button class="wishlist" title="Add to favourites"><i style="color: red;" class="far fa-heart fa-2x"></i></button>`), 50);
            }
        }else{
            setTimeout(() => $(elem).children('.good-buttons').children('.add-to-cart').after(`<button class="wishlist" title="Add to favourites"><i style="color: red;" class="far fa-heart fa-2x"></i></button>`), 50);
        }
        $(elem).children('.good-buttons').children('.buy').css('margin', '0');
        $(elem).children('.good-buttons').children('.buy').css('margin-right', 'auto');
    });
}

function displayWishlistButtonsSingle(arr, ordered){
    if(ordered){
        let itIsInCart = false;
        arr.forEach(element => {
            el = element.split('*')[0];
            if(el == $('h1').text()){
                itIsInCart = true;
            }
        });
        if(itIsInCart){
            $('#good-order').append(`<button class="wishlist" title="Add to favourites"><i style="color: red;" class="fas fa-heart fa-5x"></i></button>`)
        }else{
            $('#good-order').append(`<button class="wishlist" title="Add to favourites"><i style="color: red;" class="far fa-heart fa-5x"></i></button>`);
        }   
    }else{
        $('#good-order').append(`<button class="wishlist" title="Add to favourites"><i style="color: red;" class="far fa-heart fa-5x"></i></button>`);
    }
}

function addWishlistButtons(){
    let ordered = localStorage.getItem('fav');
    if(ordered){
        let arr = ordered.split('&');
        displayWishlistButtonsIndex(arr, true);
        displayWishlistButtonsSingle(arr, true);
    }else{
        let arr = [];
        displayWishlistButtonsIndex(arr, false);
        displayWishlistButtonsSingle(arr, false);
    }
}

// $(document).ready(function(){
//     addWishlistButtons();

//     if($('#links').css('display') == 'block'){
//         $(`<button class="sign-in" id="favourite">Favourite</button>
//             <div class="dialog" title="Favourite goods" style="display: none">
//             </div>`).appendTo('#links');
//         $('.form-container').css('justify-content', 'space-around');
//     }else{
//         $(`
//             <div id="links"><button class="sign-in" id="favourite">Favourite</button>
//             <div class="dialog" title="Favourite goods" style="display: none">
//             </div></div>`).appendTo('.form-container');
//         $('.form-container').css('justify-content', 'space-around');
//     }
// })