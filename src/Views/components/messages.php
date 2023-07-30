{% if (flash.hasMessage('success')) %}
    <div class="msg-container">
        <p class="msg success"> {{ flash.getFirstMessage('success') }} </p>
    </div>
{% endif %}

{% if (flash.hasMessage('error')) %}
    <div class="msg-container">
        <p class="msg error"> {{ flash.getFirstMessage('error') }} </p>
    </div>
{% endif %}