{extends file="main.tpl"}

{block name=top}

<div class="bottom-margin">
<form action="{$conf->action_root}personSave" method="post" class="pure-form pure-form-aligned">
	<fieldset>
		<legend>Dane osoby oraz kredytu</legend>
		<div class="pure-control-group">
            <label for="surname">Nazwisko</label>
            <input id="surname" type="text" placeholder="nazwisko" name="surname" value="{$form->surname}">
        </div>
		<div class="pure-control-group">
            <label for="rata_kredytu">Rata kredytu</label>
            <input id="rata_kredytu" type="text" placeholder="rata_kredytu" name="rata_kredytu" value="{$form->rata_kredytu}">
        </div>
		<div class="pure-control-group">
            <label for="lata_splaty">Okres spłaty kredytu</label>
            <input id="lata_splaty" type="text" placeholder="lata_splaty" name="lata_splaty" value="{$form->lata_splaty}">
        </div>
                <div class="pure-control-group">
            <label for="oprocentowanie">Aktualne oprocentowanie</label>
            <input id="oprocentowanie" type="text" placeholder="oprocentowanie" name="oprocentowanie" value="{$form->oprocentowanie}">
        </div>
		<div class="pure-controls">
			<input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
			<a class="pure-button button-secondary" href="{$conf->action_root}personList">Powrót</a>
		</div>
	</fieldset>
    <input type="hidden" name="id" value="{$form->id}">
</form>	
</div>

{/block}
