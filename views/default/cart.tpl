<h1>Корзина</h1>
{if !$rsProducts}
  <div><style1>Нет товара</style1></div>
{else}
  <form action="/buy/" method="POST">
    <table id="table">
      <tr align="center">
        <td width="20px">№</td>

        <td width="300px">Наименование</td>
        <td width="20px">Количество</td>
        <td width="80px">Цена за единицу</td>
        <td width="90px">Сумма</td>
        <td width="90px"> действие </td>
      </tr>
      {foreach $rsProducts as $item name=product}
        <tr>
          <td align="right"><style1>{$smarty.foreach.product.iteration}</style1></td>
          <td align="left">
            <style1><a href="/www/products/{$item['id']}/">{$item['name']}</a></style1>
          </td>
          </td>
          <td align="left">
            <input name="{$item['id']}" id="itemCnt_{$item['id']}" size="1"
            type="text" value="1" style="text-align: center;"
            onchange="convPrice('{$item["id"]}');"/>
          </td>
          <td align="left">
            <style1>
              <span id="itemPrice_{$item['id']}" value="{$item['price']}">{$item['price']}</span>
            </style1>
          </td>
          <td align="right">
            <style1>
              <span id="itemSum_{$item['id']}">{$item['price']}</span>
            </style1>
          </td>
          <td style="padding-left: 10px;">
            <style1>
              <a id="addtocart_{$rsProduct[0]['id']}" href="" onclick="addtocart({$rsProduct[0]['id']}); return false;" alt="Добавить в корзину">Восстановить</a>
              <a class="hideme" id="removecart_{$rsProduct[0]['id']}" href="" onclick="remfromcart({$rsProduct[0]['id']}); return false;" alt="Удалить из корзину">Удалить </a>
            </style1>
          </td>
        </tr>
      {/foreach}
      <tr align="right">
        <td />
        <td />
        <td />
        <td />
        <td>Итого:</td>
        <td><style1><b>
          <span id="itemTotal" value="{$total}">{$total}</span>
        </b></style1></td>
      </tr>
    </table>
    <div style="margin-top: 10px;">
      <input type="submit" style="width: 150px;" value="Оформить заказ" />
    </div>
  </form>
{/if}