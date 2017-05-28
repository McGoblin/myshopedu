{**Страница продукта
{$rsProduct[0]['name']} - Название продукта
{$rsProduct[0]['price']} - Цена продкута
{$rsProduct[0]['description']} - Описение продукта
{$rsProduct[0]['image']} - изображение продкута
*}

<h3>{$rsProduct[0]['name']}</h3>
<img width="250" src="/www/images/products/{$rsProduct[0]['image']}" /><br/>
Стоймость: {$rsProduct[0]['price']}
<a id="addtocart_{$rsProduct[0]['id']}" href="" onclick="addtocart({$rsProduct[0]['id']}); return false;" alt="Добавить в корзину">Добавить в корзину</a>
<a class="hideme" id="removecart_{$rsProduct[0]['id']}" href="" onclick="remfromcart({$rsProduct[0]['id']}); return false;" alt="удалить из корзину">Удалить из корзины</a>

<p> Описание: <br/>{$rsProduct[0]['description']}</p>