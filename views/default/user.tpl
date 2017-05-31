<table style="width: 100%; text-align: left; margin: 20px 0px;">

    <tr>
        <td width="30%">
            <style1>Логин (e-mail)</style1>
        </td>
        <td>
            <style1>{$arUser['email']}</style1>
        </td>
    </tr>

    <tr>
        <td>
            <style1>ФИО</style1>
        </td>
        <td>
            <input id="newName" size="30" type="text"
                   value="{$arUser['name']}" style="text-align: left;" />
        </td>
    </tr>

    <tr>
        <td>
            <style1>Телефон</style1>
        </td>
        <td>
            <input id="newPhone" size="30" type="text"
                   value="{$arUser['phone']}" style="text-align: left;" />
        </td>
    </tr>

    <tr>
        <td>
            <style1>Адрес</style1>
        </td>
        <td>
            <input id="newAdress" size="30" type="text"
                   value="{$arUser['address']}" style="text-align: left;" />
        </td>
    </tr>

    <tr>
        <td>
            Новый пароль
        </td>
        <td>
            <input  id="newPwd" size="30" type="password" style="text-align: left;" />
        </td>
    </tr>

    <tr>
        <td>
            Подтвердите пароль
        </td>
        <td>
            <input  id="newPwd2" size="30" type="password" style="text-align: left;" />
        </td>
    </tr>
    <tr>
        <td>Для  того что бы сохранить данные введите текущий пароль</td>
        <td>
            <input  id="curPwd" size="30" type="password" style="text-align: left;" />
        </td>
    </tr>
    <tr valign="bottom" style="height: 40px;">
        <td>
            <input  value="Сохранить" type="button" style="width: 100px;" onclick="saveUserData();">
        </td>
        <td />
    </tr>

</table>

{*
<div style='margin-bottom: 20px;'>
    <style4>Заказы<br/></style4>
</div>
<table width="100%" border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th style="width: 32px; ">№</th>
        <th style="width: 150px; ">Статус</th>
        <th style="width: 150px; ">Дата создания</th>
        <th style="width: 150px; ">Дата оплаты</th>
        <th style="width: 100px; ">Сумма</th>
    </tr>
    {foreach from=$rsBuys item=item key=key}
        <tr>
            <td style="text-align: center; " rowspan="2"><a href="#"
                                                            onclick="showItems('{$key}'); return false;">{$key}</a></td>
            <td style="text-align: center; ">
                {if $item['status'] == 0}
                    сформирован
                {elseif $item['status'] == 1}
                    оплачен
                {else}
                    {$item['status']}
                {/if}
            </td>
            <td style="text-align: center; ">{$item['date_crt']}</td>
            <td style="text-align: center; ">{$item['date_pay']}</td>
            <td style="text-align: right; ">{if isset($item['sum'])}{$item['sum']}{/if}</td>
        </tr>
        <tr>
            <td colspan="3">{$item['comment']}</td>
            <td style="text-align: center; ">
                {if $item['status'] == 0}
                    <a href="/buy/pay/{$key}/">оплатить</a>
                {/if}
            </td>
        </tr>
        <tr id="buyItems_{$key}" style="display: none;">
            <td colspan="5">
                {if isset($item['items'])}
                    <table border="0" cellpadding="10" cellspacing="0" width="100%">
                        {foreach from=$item['items'] item=row}
                            <tr>
                                <td width="55px" align="center">
                                    <a href="/product/{$row['product']}/">{$row['product']}</a>
                                </td>
                                <td>{$row['name']}</td>
                                <td width="30px" align="right">{$row['num']}</td>
                                <td width="80px" align="right">{$row['price']}</td>
                            </tr>
                        {/foreach}
                    </table>
                {else}
                    <div style="padding: 0px 10px; ">нет позиций товара</div>
                {/if}
            </td>
        </tr>
    {/foreach}
</table>
*}