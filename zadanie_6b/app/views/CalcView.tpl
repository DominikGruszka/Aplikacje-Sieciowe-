{extends file="main.tpl"}

{block name=content}

<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="{$conf->action_url}logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: {$user->login}, rola: {$user->role}</span>
</div>

<form action="{$conf->action_url}calcCompute" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Kalkulator</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_kwota_kredytu">Kwota kredytu: </label>
			<input id="id_kwota_kredytu" type="text" name="kwota_kredytu" value="{$form->kwota_kredytu}" />
                        
                        <label for="id_lata_splaty">Lata spłaty kredytu: </label>
			<input id="id_lata_splaty" type="text" name="lata_splaty" value="{$form->lata_splaty}" />
                        
                        <label for="id_oprocentowanie">Aktualne oprocentowanie: </label>
			<input id="id_oprocentowanie" type="text" name="oprocentowanie" value="{$form->oprocentowanie}" />
		</div>
   
		<div class="pure-controls">
			<input type="submit" value="Oblicz" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	

{include file='messages.tpl'}

{if isset($res->result)}
<div class="messages info">
	Wynik: {$res->round(result,2)}
</div>
{/if}

{/block}