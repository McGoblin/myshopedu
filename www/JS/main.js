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
                $('#addtocart_'+itemID).hide();
                $('#removecart_'+itemID).show();
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
        url: "/www/cart/remfromcartAction/" + itemId + '/',
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

function regUser() {
    var postData = {};
    postData["email"] = $('#email').val();
    postData["pass"]  = $('#pass').val();
    postData["pass2"] = $('#pass2').val();
    if (!postData["pass2"]) {
        $('#passconf').show();
        exit();
    }
    console.log(postData);
    $.ajax({
        type: 'POST',
        async: false,
        url: "/user/register/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            if (data['success']) {
                $('#regBox').hide();
                $('#userBox').show();
                $('#userName').html(data['userName']);
            }
            alert(data['message']);
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



function login(redirPath) {
    var postData = {};
    postData["email"] = $('#email').val();
    postData["pass"]  = $('#pass').val();
    $.ajax({
        type: 'POST',
        async: false,
        url: "/user/login/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            if (data['success']) {
                if (redirPath) {
                    console.log(redirPath);
                    document.location.href = redirPath;
                } else {
                    $('#regBox').hide();
                    $('#userBox').show();
                    $('#userName').html(data['userName']);
                    $('#email').val('');
                    $('#pass').val('');
                }
            } else {
                alert(data['message']);
            }
        }
    });
}

function logout(redirPath) {
    $.ajax({
        url: "/user/logout/"
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

function save() {
    var postData = {};
    postData["name"]      = $('#name').val();
    postData["phone"]     = $('#phone').val();
    postData["postindex"] = $('#postindex').val();
    postData["city"]      = $('#city').val();
    postData["address"]   = $('#address').val();
    postData["pass"]      = $('#pass').val();
    postData["newpass"]   = $('#newpass').val();
    postData["pass2"]     = $('#pass2').val();
    $.ajax({
        type: 'POST',
        async: false,
        url: "/user/save/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            if (data['success']) {
                $('#userName').html(data['userName']);
            }
            alert(data['message']);
        }
    });
    document.location.href = "/";
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

function strToInt(sval) {
    return Number(sval.replace(/,/g, ""));
}

function getData(form) {
    var data = {};
    $('input, textarea, select', form).each(function() {
        if (this.name && this.name != '') {
            data[this.name] = this.value;
            console.log('data[' + this.name + '] = ' + data[this.name]);
        }
    });
    return data;}
    */