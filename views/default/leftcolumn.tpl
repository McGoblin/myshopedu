{* левый столбец *}

<div id="leftColumn">


    <div id="leftMenu">
        <div class="menuCaption">Меню:</div>
        {foreach $rsCategories as $item}
            <a href="/www/?controller=Category&id={$item['id']}">{$item['name']}</a>
            <br>
            {if isset($item['children'])}
                {foreach $item['children'] as $children}
                    <a href="/www/?controller=Category&id={$children['id']}">--{$children['name']}</a>
                    <br>
                {/foreach}
            {/if}
        {/foreach}
    </div>


    <div id="userBox" class="hideme">
        <a href="#" id="userLink"></a></br>
        <a href="/www/user/logout/" onclick="logout();">EXIT</a>
    </div>
    <div id="loginBox" {if $_SESSION['user']} class="hideme" {/if}>
        <div class="menuCaption">Login</div>
        <input type="text" id="loginEmail" name="loginEmail" value=""/>
        Пароль: </br>
        <input type="password" id="loginPwd" name="loginPwd" value=""/>
        <input type="button" onclick="login();" value="Войти"/>
    </div>

    <div id="registerBox" {if $_SESSION['user']} class="hideme" {/if}>
        <div class="menuCaption">Регистрация</div>
        <div>
            email:</br>
            <input type="text" id="email" name="email" value=""/>
            Пароль: </br>
            <input type="password" id="pwd1" name="pwd1" value=""/>

            Посторить пароль</br>
            <input type="password" id="pwd2" name="pwd2" value=""/>
            <input type="button" onclick="registerNewUser();" value="Зарегистрироваться"/>
        </div>

    </div>

    <div class="menuCaption">Корзина</div>
    <a href="/www/cart/" title="Перейти в корзину"> В корзине </a>
    <span id="cartCntItems">
    {if $cartCntItems > 0}{$cartCntItems}{else}пусто{/if}
    </span>

</div>