/**
 * Created by NEV on 27.05.2017.
 */
/**
 * фФункция принимает значение id товара и добавляет ее в корзину
 * пока что то не работает
 * @param itemID
 */
function addtocart(itemID) {
    console.log("js-addToCart()");
    $.ajax({
        type: 'GET',
        async: false,
        url: "/www/Cart/addtocart/" + itemID + "/",
        dataType: 'json',
        success: function (data) {
            if (data['success']){
                $('#cartCntItems').html(data['cntItems']);
                $('#addtocart_' + itemID).hide();
                $('#removecart_' + itemID).show();
            }
        }
    });
}
/**
 * Функция удаляет товар из корзины
 * @param itemId
 * @param itemNum
 */
function remfromcart(itemId) {
    console.log("js - remFromCrate(" + itemId + ")");
    $.ajax({
        type: 'POST',
        async: false,
        url: "/www/cart/remfromcart/" + itemId + '/',
        dataType: 'json',
        success: function(data) {
            if(data['success']){
                $('#cartCntItems').html(data['cntItems']);
                $('#addtocart_' + itemId).show();
                $('#removecart_' + itemId).hide();
            }
        }
    });
}



function strToInt(sval) {
    return Number(sval.replace(/,/g, ""));
}
/**
 * Функция расчитывает сумму, которую должен заплотить человек за товары
 * @param itemId
 */
function convPrice(itemId) {

    var newCnt = $('#itemCnt_' + itemId).val();
    var itemPrice = $('#itemPrice_' + itemId).attr('value');
    var itemSum = newCnt * strToInt(itemPrice);

    $('#itemTotal').html(itemSum);
}
/**
 * получение информации из формы в массив
 * @param form
 * @returns {{}}
 */
function getData(obj_form) {
    var data = {};
    $('input, textarea, select', obj_form).each(function() {
        if (this.name && this.name != '') {
            data[this.name] = this.value;
            console.log('data[' + this.name + '] = ' + data[this.name]);
        }
    });
    return data;
}


/**
 * регистрация новго пользователя
 */
function registerNewUser() {
    var postData = getData('#registerBox');
    console.log(postData);
    $.ajax({
        type: 'POST',
        async: false,
        url: "/www/user/register/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            if (data['success']) {
                alert('Регистрация прошла успешно');
                $('#registerBox').hide();
                $('#userLink').attr('href', '/user/');
                $('#userLink').html(data['userName']);
                $('#userBox').show();

            }
            alert(data['message']);
        }
    });
}
/**
 * выход из профиля
 * @param redirPath
 */
function logout(redirPath) {
    $.ajax({
        url: "/www/user/logout/"
    });
    if (redirPath) {
        console.log(redirPath);
        document.location.href = redirPath;
    } else {
        $('#userBox').hide();
        $('#regBox').show();
        $('#userName').html('');
    }
}
/**
 * авторизация
 * @param redirPath
 */
function login() {
    var email = $('#loginEmail').val();
    var pwd = $('#loginPwd').val();

    var postData = "email="+email+"&pwd="+pwd;
    $.ajax({
        type: 'POST',
        async: false,
        url: "/www/user/login/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            if (data['success']) {

                $('#registerBox').hide();
                $('#loginBox').hide();
                $('#userLink').attr('href', '/www/user/');
                $('#userLink').html(data['displayName']);
                $('#userBox').show();

            } else {
                alert(data['message']);
            }
        }
    });
}

function saveUserData() {
    var postData = {};
    postData["name"]     = $('#newName').val();
    postData["phone"]    = $('#newPhone').val();
    postData["adress"]   = $('#newAdress').val();
    postData["pwd1"]      = $('#newPwd').val();
    postData["pwd2"]     = $('#newPwd2').val();
    postData["curPwd"]      = $('#curPwd').val();
    $.ajax({
        type: 'POST',
        async: false,
        url: "/www/user/update/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            if (data['success']) {
                $('#userLink').html(data['userName']);
                alert(data['message']);
            } else {
                alert(data['message']);
            }
        }
    });
}

/*
function movToCart(itemId, itemNum) {
//  console.log("js - addToCrate(" + itemId + ", " + itemNum + ")");
    $.ajax({
        type: 'POST',
        async: false,
        url: "/www/cart/moveToCart/" + itemId + '/' + itemNum + '/',
        dataType: 'json',
        success: function(data) {
            if(data['success']){
                $('#crateCntItems').html(data['cntItems']);
                $('#resCrate_' + itemId).hide();
                $('#remCrate_' + itemId).show();
            }
        }
    });
}




function chNum(itemId) {
    console.log('chNum ' + itemId);
    var newCnt = parseInt($('#itemCnt_' + itemId).val());
    console.log(typeof(newCnt) + ' ' +  newCnt);
    var numCrate = parseInt($('#numCrate_' + itemId).attr('value'));
    console.log(typeof(numCrate) + ' ' + numCrate);
    // если неверный ввод, то число = 0
    if (!newCnt || newCnt < 0) {
        newCnt = 0;
    }
    // если число больше, чем в корзине, то выравнивается
    if (newCnt > numCrate) {
        newCnt = numCrate;
    }
    $('#itemCnt_' + itemId).val(newCnt);
    var itemPrice = $('#itemPrice_' + itemId).attr('value');
    var itemSum = newCnt * strToInt(itemPrice);
    itemSum = intToStr(itemSum);
    $('#itemSum_' + itemId).html(itemSum);
    var div = document.getElementById('table');
    var elems = div.getElementsByTagName('*');
    var a = [];
    for (var key in elems) {
        if (!!elems[key].id && !!elems[key].textContent && elems[key].id.substr(0, 7) === 'itemSum'
            && a.indexOf(elems[key]) === -1 ) {
            a.push(elems[key]);
        }
    }
    var sum = 0;
    for (key in a) { sum += strToInt(a[key].textContent); }
    sum = intToStr(sum);
    $('#itemTotal').html(sum);
//  movToCrate(itemId, newCnt);
}








function buy() {
    var postData = getData('form');
    $.ajax({
        type: 'POST',
        async: false,
        url: "/buy/save/",
        data: postData,
        dataType: 'json',
        success: function(data) {
//      console.log(data);
            if (data['success'] && data['buyid']) {
                document.location.href = "/buy/pay/" + data['buyid'] + '/';
            } else {
                alert(data['message']);
            }
        }
    });
}

function showItems(buyId) {
    var itemRow = $('#buyItems_' + buyId);
    var rowVis = itemRow.is(':visible');
//  console.log(itemRow);
    if (rowVis) {
        itemRow.hide();
    } else {
        itemRow.show();
    }
}

function saveCard() {
    var postData = {};
    postData["id"]    = $('#id').attr('value');
    postData["owner"] = $('#owner').val();
    postData["pass"]  = $('#pass').val();
    postData["pass2"] = $('#pass2').val();
    postData["sum"]   = $('#sum').val();
    $.ajax({
        type: 'POST',
        async: false,
        url: "/payment/new/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            alert(data['message']);
            if (data['success']) {
                document.location.href = "..";
            }
        }
    });
}

function editCard(cardId) {
    var cardOwner = $('#owner_' + cardId).html();
    var cardSum = strToInt($('#sum_' + cardId).html());
    $('#cardid').html(cardId);
    $('#cardowner').val(cardOwner);
    $('#cardsum').val(cardSum);
    $('#editCard').show();
}

function cancelUpdate() {
    $('#editCard').hide();
    $('#cardid').html('');
    $('#cardowner').val('');
    $('#cardsum').val('');
    $('#cardpass').val('');
    $('#cardpass2').val('');
}

function updateCard() {
    var postData = {};
    postData["id"]      = $('#cardid').html();
    postData["owner"]   = $('#cardowner').val();
    postData["pass"]    = $('#cardpass').val();
    postData["pass2"]   = $('#cardpass2').val();
    postData["sum"]     = $('#cardsum').val();
    $.ajax({
        type: 'POST',
        async: false,
        url: "/payment/update/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            alert(data['message']);
            if (data['success']) {
                document.location.href = ".";
            }
        }
    });
}

function deleteCard(cardId) {
    var confDel = confirm("Удалить карту " + cardId + "?");
    if (confDel) {
        $.ajax({
            type: 'POST',
            async: false,
            url: "/payment/delete/" + cardId + "/",
            dataType: 'json',
            success: function(data) {
                if (data['success']) {
                    document.location.href = ".";
                } else {
                    alert(data['message']);
                }
            }
        });
    }
}

function payBuy(buyId) {
    var postData = {};
    postData['cardId']   = $('#cardid').val();
    postData['cardPass'] = $('#cardpass').val();
    postData['buyId'] = buyId;
    $.ajax({
        type: 'POST',
        async: false,
        url: "/buy/sendpay/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            alert(data['message']);
            if (data['success']) {
                document.location.href = "/user/";
            }
        }
    });
}

//дополнительные модули

function intToStr(ival) {
    if (!ival) return '0.00';
    var s = String(ival * 100);
    var l = s.length;
    var n = ((l - 3) - (l - 3) % 3) / 3;
    s = s.substr(0, l - 2) + "." + s.substr(l - 2, l);
    for (var i = 0; i < n; i++) {
        l++;
        s = s.substr(0, l - i * 4 - 6) + "," + s.substr(l - i * 4 - 6);
    }
    return s;
}



    */