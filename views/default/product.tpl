{**Страница продукта
{$rsProduct[0]['name']} - Название продукта
{$rsProduct[0]['price']} - Цена продкута
{$rsProduct[0]['description']} - Описение продукта
{$rsProduct[0]['image']} - изображение продкута
*}

<h3>{$rsProduct[0]['name']}</h3>
<img width="575" src="/www/images/products/{$rsProduct[0]['image']}" /><br/>
Стоймость: {$rsProduct[0]['price']}
<a id="addToCart_{$rsProduct[0]['id']}" href="#" onClick="addToCart({$rsProduct[0]['id']}); return false;" alt="Добавить в корзину">Добавить в корзину</a>
<a id="removeCart_{$rsProduct[0]['id']}" href="#" onClick="remFromCart({$rsProduct[0]['id']}); return false;" alt="Добавить в корзину">Удалить из корзины</a>

<p> Описание: <br/>{$rsProduct[0]['description']}</p>