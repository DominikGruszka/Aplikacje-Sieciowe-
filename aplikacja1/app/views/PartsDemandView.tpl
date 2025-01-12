{extends file="main.tpl"}

{block name="title"}Zamówienia części{/block}

{block name="content"}
<section id="order-parts" class="order-parts-section">
    <div class="container">
        <h1>Zamówienia części</h1>

        <h2>Lista zamówionych części</h2>
        {if isset($parts) && $parts|@count > 0}
        <table class="pure-table">
            <thead>
                <tr>
                    <th>Nazwa części</th>
                    <th>Numer seryjny</th>
                    <th>Ilość</th>
                    <th>Status zamówienia</th>
                    <th>Notatka</th>
                    <th>Data dodania</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$parts item=part}
                <tr>
                    <td>
                        {if $part.edit_mode}
                        <input type="text" name="part_name_{$part.id_part}" value="{$part.part_name|escape}">
                        {else}
                        {$part.part_name|escape}
                        {/if}
                    </td>
                    <td>
                        {if $part.edit_mode}
                        <input type="text" name="serial_number_{$part.id_part}" value="{$part.serial_number|escape}">
                        {else}
                        {$part.serial_number|escape}
                        {/if}
                    </td>
                    <td>
                        {if $part.edit_mode}
                        <input type="number" name="quantity_{$part.id_part}" value="{$part.quantity}">
                        {else}
                        {$part.quantity}
                        {/if}
                    </td>
                    <td>{$part.order_status|escape}</td>
                    <td>
                        {if $part.edit_mode}
                        <textarea name="note_{$part.id_part}">{$part.notatka|escape}</textarea>
                        {else}
                        {$part.notatka|escape|default:"Brak notatki"}
                        {/if}
                    </td>
                    <td>{$part.created_at|date_format:"%Y-%m-%d %H:%M:%S"}</td>
                    <td>
                        {if $part.edit_mode}
                        <form method="post" action="{$conf->action_root}partsDemand">
                            <input type="hidden" name="part_id" value="{$part.id_part}">
                            <button type="submit" name="edit_part" class="pure-button pure-button-primary">Zapisz</button>
                        </form>
                        {else}
                        <form method="post" action="{$conf->action_root}deletePart">
                            <input type="hidden" name="part_id" value="{$part.id_part}">
                            <button type="submit" class="pure-button pure-button-secondary">Usuń</button>
                        </form>
                        <form method="post" action="{$conf->action_root}partsDemand">
                            <input type="hidden" name="part_id" value="{$part.id_part}">
                            <button type="submit" name="edit_part" class="pure-button pure-button-primary">Edytuj</button>
                        </form>
                        {/if}
                    </td>
                </tr>
                {/foreach}
            </tbody>
        </table>
        {else}
        <p>Brak zamówionych części.</p>
        {/if}

        <h2>Zamów nową część</h2>
        <form method="post" action="{$conf->action_root}partsDemand?vehicle_id={$vehicle.id}">
            <input type="hidden" name="add_part" value="1">
            <label for="part_name">Nazwa części:</label>
            <input type="text" name="part_name" id="part_name" required>

            <label for="serial_number">Numer seryjny:</label>
            <input type="text" name="serial_number" id="serial_number" required>

            <label for="quantity">Ilość:</label>
            <input type="number" name="quantity" id="quantity" min="1" required>

            <label for="note">Notatka (opcjonalnie):</label>
            <textarea name="note" id="note"></textarea>

            <button type="submit" class="pure-button pure-button-primary">Dodaj część</button>
        </form>

        <div class="action-buttons">
            <a href="{$conf->action_root}workshopPanel" class="pure-button pure-button-secondary">Powrót do poprzedniej strony</a>
        </div>
    </div>
</section>
{/block}
