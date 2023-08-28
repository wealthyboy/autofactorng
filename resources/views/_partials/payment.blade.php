<div id="billing-info" class="product-checkout-customer_details">
    <h3>
        <span>PAYMENT METHOD</span>
        {% if credit_cards | length %}
            <a href="#" id="enter-new-payment"> + New Payment Method</a>
        {% endif %}
    </h3>
    <h5> Pay by Credit / Card </h5>
    {% if credit_cards %}
        <ul class="card-container">
            {% for card in credit_cards %}
                <li>
                    <div class="card-info">
                        <p class="bold">{{ card.card_type|capitalize }}</p>
                        <p>Card ending in {{card.last_4}}</p>
                        <p>Exp: Card ending in {{card.expiry}}</p>
                    </div>
                </li>
            {% endfor %}
        </ul>

    {% endif %}
        {# Display Stripe Here for new info #}

    <div class="form-field-wrapper">
        <div class="cards-display">&nbsp;</div>
        <label for="cardholder-name">Name on Card</label>
        <input placeholder="Name on card" id="cardholder-name" type="text" class="input--lg form-full" name="name" required autofocus>
    </div>
                                
    <label> Credit Card Number</label>
    <div id="card-element"></div>
</div>