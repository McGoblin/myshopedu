	{* левый столбец *}

<div id="leftColumn">


<div id="leftMenu">
	<div class="menuCaption">Меню:</div>
		{foreach $rsCategories as $item}
			<a href="#">{$item['name']}</a><br>
			{if isset($item['children'])}
				{foreach $item['children'] as $children}
					<a href="#">--{$children['name']}</a><br>
				{/foreach}
			{/if}
		{/foreach}
</div>  

</div>