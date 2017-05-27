

    <H2>Товары категории {$rsCategory[0]['name']}</H2>

    {foreach $rsProducts as $item name=products}
        <div style="float: left; padding: 0px 30px 40px 0px">
            <a href="/www/products/{$item['id']}/">
                <img src="/www/images/products/{$item['image']}" width="100">
            </a><br>
            <a href="/www/products/{$item['id']}/">
                {$item['name']}
            </a>
        </div>
        {if $smarty.foreach.products.iteration mod 3 == 0}
            <div style="clear: both;"></div>
        {/if}
    {/foreach}
    {foreach $rsChildCats as $item name=childCats}
        <h3><a href="/www/category/{$item['id']}/">{$item['name']}</a> </h3>
    {/foreach}
