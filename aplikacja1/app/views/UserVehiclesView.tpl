{extends file="main.tpl"}

{block name="title"}Pojazdy użytkownika{/block}

{block name="content"}
    <section id="user-vehicles" class="user-vehicles-section">
        <div class="container">
            <h1>Pojazdy użytkownika</h1>
            <table class="pure-table">
                <thead>
                    <tr>
                        <th>Marka</th>
                        <th>Model</th>
                        <th>Rok produkcji</th>
                        <th>VIN</th>
                        <th>Data rejestracji</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$vehicles item=vehicle}
                    <tr>
                        <td>{$vehicle.brand|escape}</td>
                        <td>{$vehicle.model|escape}</td>
                        <td>{$vehicle.production_year|escape}</td>
                        <td>{$vehicle.vin|escape}</td>
                        <td>{$vehicle.created_at|date_format:"%Y-%m-%d %H:%M:%S"}</td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
            <a href="{$conf->action_root}adminPanel" class="pure-button pure-button-primary">Powrót do panelu</a>
        </div>
    </section>
{/block}
