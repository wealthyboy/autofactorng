 {% extends "cashinmybag.layouts.app" %} 

 {% block title %}

    Your order was successful

 {% endblock %} 

 {% block content %}

<section class="sec-padding">
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                {% include 'cashinmybag/account/nav.twig' %}
            </div>
            <div class="col-md-9">
                <h2 class="page-title">Orders</h2>

                <div class="card card-plain">
                    <div class="card-body">
                        <p> Your order has been placed. Thank you</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>

{% endblock %}