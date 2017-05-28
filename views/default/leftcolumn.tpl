	{* левый столбец *}

<div id="leftColumn">


<div id="leftMenu">
	<div class="menuCaption">Меню:</div>
		{foreach $rsCategories as $item}
			<a href="/www/?controller=Category&id={$item['id']}">{$item['name']}</a><br>
			{if isset($item['children'])}
				{foreach $item['children'] as $children}
					<a href="/www/?controller=Category&id={$children['id']}">--{$children['name']}</a><br>
				{/foreach}
			{/if}
		{/foreach}
</div>
	<div class="menuCaption">Корзина</div>
	<a href="/www/cart/" title="Перейти в корзину"> В корзине </a>
	<span id="cartCntItems">
	{if $cartCntItems > 0}{$cartCntItems}{else}пусто{/if}
	</span>

</div>