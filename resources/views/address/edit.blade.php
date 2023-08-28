 {% extends "cashinmybag.layouts.app" %} {% block title %}{{ settings.name }} | Edit Address{% endblock %} {% block content %}

<section class="sec-padding">
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                {% include 'cashinmybag/account/nav.twig' %}
            </div>
            <div class="col-md-9">
                <h2 class="page-title">Edit Address</h2>

                <div class="card card-plain">
                    <div class="card-body">
                       <form method="POST" action="">
                            {{method_field('PUT')}}
                            {% if session('success') %}
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            {% endif %}
                           {% if errors.any() %}
                                <div class="alert alert-danger">
                                    <ul>
                                        {% for error in errors.all() %}
                                           <li>{{ error }}</li>
                                        {% endfor %}
                                    </ul>
                                </div>
                            {% endif %} 

                            <h2></h2>
                            {{ csrf_field() }}

                             <p class="form-field-wrapper">
                                <label for="first_name">First Name</label>
                                <input id="first_name" type="text" class="input--lg form-full" name="first_name" value="{{ address.firstname }}" required autofocus>

                            </p>
                             <p class="form-field-wrapper">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" class="input--lg form-full" name="last_name" value="{{ address.lastname }}" required autofocus>
                            </p>
                          
                             <p class="form-field-wrapper">
                                <label for="address">Address</label>
                                <input id="address" type="text" class="input--lg form-full" name="address" value="{{ address.address }}" required autofocus>
                            </p>

                             <p class="form-field-wrapper">
                                <label for="address">Address 2</label>
                                <input id="address" type="text" class="input--lg form-full" name="address2" value="{{ address.address2 }}"  autofocus>
                            </p>

                             <p class="form-field-wrapper">
                                <label for="city">City</label>
                                <input id="city" type="text" class="input--lg form-full" name="city" value="{{ address.city }}"  required autofocus>
                            </p>

                            <p class="form-field-wrapper">
                                <label for="zip">Zip</label>
                                <input id="zip" type="text" class="input--lg form-full" name="zip" value="{{ address.zip }}"  autofocus>
                            </p>

                            <p class="form-field-wrapper form-row">
                              <div class="form-field-wrapper">
                                <label for="country">Country</label>
                                    <select name="country" class="selectBox form-full">
                                        <option value="" selected="selected">Choose</option>
                                        {% for country in countries %}
                                          <option value="{{ country.name }}">{{ country.name }}</option>
                                        {% endfor %}
                                    </select>
                                </div>
                            </p>


                             <p class="form-field-wrapper">
                                <label for="state">State</label>
                                <input id="state" type="text" class="input--lg form-full" name="state"  value="{{ address.state }}"  required autofocus>
                            </p>
                            <p class="form-field-wrapper lost_password">
                                <button type="submit" class="btn btn--lg btn--primary" name="register" value="Log in">Submit</button>
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>
<!--End Contact Form & Info-->

{% endblock %}