{% if user is defined %}

    <div class="page-header">
        <h1>Mes disques -> {{ user }}</h1>
    </div>

    {{ addDisk }}
    <hr>
    {{ lg }}

{% else %}

    {{ alert }}

{% endif %}

{{ script_foot }}