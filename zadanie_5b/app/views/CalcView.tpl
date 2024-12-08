{extends file="main.tpl"}
{* przy zdefiniowanych folderach nie trzeba już podawać pełnej ścieżki *}

{block name=footer}przykładowa tresć stopki {/block}

{block name=content}

<h3>Kalkulator kredytowy</h2>


<form class="pure-form pure-form-stacked" action="{$conf->action_root}calcCompute" method="post">
	<fieldset>
		<label for="kwota_kredytu">Kwota kredytu</label>
		<input id="kwota_kredytu" type="text" placeholder="kwota_kredytu" name="kwota_kredytu" value="{$form->kwota_kredytu}">
		
                <label for="lata_splaty">Okres spłaty kredytu</label>
		<input id="lata_splaty" type="text" placeholder="lata_splaty" name="lata_splaty" value="{$form->lata_splaty}">
                
                <label for="oprocentowanie">Aktualne oprocentowanie</label>
		<input id="oprocentowanie" type="text" placeholder="oprocentowanie" name="oprocentowanie" value="{$form->oprocentowanie}">

	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>

<div class="messages">

{* wyświeltenie listy błędów, jeśli istnieją *}
{if $msgs->isError()}
	<h4>Wystąpiły błędy: </h4>
	<ol class="err">
	{foreach $msgs->getErrors() as $err}
	{strip}
		<li>{$err}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{* wyświeltenie listy informacji, jeśli istnieją *}
{if $msgs->isInfo()}
	<h4>Informacje: </h4>
	<ol class="inf">
	{foreach $msgs->getInfos() as $inf}
	{strip}
		<li>{$inf}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{if isset($res->result)}
	<h4>Wynik</h4>
	<p class="res">
	{$res->(result)}
	</p>
{/if}

</div>

{/block}