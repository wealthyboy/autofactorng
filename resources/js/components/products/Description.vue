<template>
     <div class="product-tabs-wrapper">
                    <!--Tabs-->
        <ul class="product-tabs-nav nav" role="tablist">
            <li>
                <a class="active" href="product_detail_2.html#tab_description" role="tab" data-toggle="tab" aria-expanded="false">Description</a>
            </li>
            <li>
                <a class="" href="product_detail_2.html#tab_information" role="tab" data-toggle="tab" aria-expanded="true">Additional information</a>
            </li>
            <li>
                <a class="" href="product_detail_2.html#tab_reviews" role="tab" data-toggle="tab">Reviews (3)</a>
            </li>
            <li>
                <a class="" href="product_detail_2.html#tab_custom" role="tab" data-toggle="tab">Custom Tab</a>
            </li>
        </ul>
        <!--End Tabs-->

        <!--Tabs Content-->
        <div id="product-accordian-Content" class="product-Content-tabs">
            <!--Description-->
            <div id="tab_description" role="tabpanel" class="tab-pane fade show active">

                <!--Header-->
                <div id="accrodianOne" class="product-Content-toggle">
                    <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Description</a>
                </div>

                <!--Body-->
                <div id="collapseOne" class="product-tab-Content-body collapse show" aria-labelledby="accrodianOne" data-parent="#product-accordian-Content">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <p>There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain.</p>
                </div>
            </div>

            <!--Additional information-->
            <div id="tab_information" role="tabpanel" class="tab-pane fade">

                <!--Header-->
                <div id="accrodianTwo" class="product-Content-toggle">
                    <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Additional information</a>
                </div>

                <!--Body-->
                <div id="collapseTwo" class="product-tab-Content-body collapse" aria-labelledby="accrodianTwo" data-parent="#product-accordian-Content">
                    <div class="detail-table">
                        <table>
                            <tbody>
                                <tr>
                                    <th>Color</th>
                                    <td>Black, Blue, Orange, Gray, White, Green</td>
                                </tr>
                                <tr>
                                    <th>Size</th>
                                    <td>XS, Small, Large, Mediam, Small, XL, XXL</td>
                                </tr>
                                <tr>
                                    <th>Weight</th>
                                    <td>5 kg</td>
                                </tr>
                                <tr>
                                    <th>Dimensions</th>
                                    <td>60 x 40 x 60 cm</td>
                                </tr>
                                <tr>
                                    <th>Washcare</th>
                                    <td>Dry Clean</td>
                                </tr>
                                <tr>
                                    <th>Composition</th>
                                    <td>100% Polyester</td>
                                </tr>
                                <tr>
                                    <th>Lining composition</th>
                                    <td>Polyester</td>
                                </tr>
                                <tr>
                                    <th>Other info</th>
                                    <td>Ullamcorper nisl mus integer mollis vestibulu</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!--Reviews -->
            <div id="tab_reviews" role="tabpanel" class="tab-pane fade">

                <!--Header-->
                <div id="accrodianThree" class="product-Content-toggle">
                    <a data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Reviews (3)</a>
                </div>

                <!--Body-->
                <div id="collapseThree" class="product-tab-Content-body collapse" aria-labelledby="accrodianThree" data-parent="#product-accordian-Content">
                    <div class="row">
                        <!--Add a Review-->
                        <div class="col-md-6">
                            <div class="review-form-wrapper">
                                <h4 class="review-title">Add a Review</h4>
                                <p>Your email address will not be published. Required fields are marked *</p>
                                <form id="comment-form" class="comment-form">
                                    <div class="form-field-wrapper">
                                        <label>Your Rating</label>
                                        <p class="stars selected">
                                            <span>
                                                <a class="star-1" href="javascript:void(0)"></a>
                                                <a class="star-2" href="javascript:void(0)"></a>
                                                <a class="star-3" href="javascript:void(0)"></a>
                                                <a class="star-4" href="javascript:void(0)"></a>
                                                <a class="star-5" href="javascript:void(0)"></a>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="form-field-wrapper">
                                        <label>Your Review<span class="required">*</span></label>
                                        <textarea id="comment" name="comment" class="form-full" cols="45" rows="10" aria-required="true" required=""></textarea>
                                    </div>
                                    <div class="form-field-wrapper">
                                        <label>Name<span class="required">*</span></label>
                                        <input id="author" name="author" class="form-full" value="" size="30" aria-required="true" required="" type="text" />
                                    </div>
                                    <div class="form-field-wrapper">
                                        <label>Email<span class="required">*</span></label>
                                        <input id="email" name="email" class="form-full" value="" size="30" aria-required="true" required="" type="email" />
                                    </div>
                                    <div class="form-field-wrapper">
                                        <input name="submit" id="submit" class="btn btn--primary" value="Submit" type="submit" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--Comments-->
                        <div class="col-md-6">
                            <div class="comments">
                                <h4 class="review-title">3 Review for <span>This Product</span></h4>
                                <ul class="commentlist">
                                    <!--Item-->
                                    <li class="comment-item">
                                        <img class="avtar" src="img/avtar.jpg" alt="avtar" />
                                        <div class="comment-text">
                                            <div class="star-rating" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating" title="Rated 4 out of 5">
                                                <span style="width: 80%"></span>
                                            </div>
                                            <p class="meta">
                                                <strong>James Koster</strong>
                                                <span>–</span>
                                                <time datetime="">August 21, 2018</time>
                                            </p>
                                            <div class="description">
                                                <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>
                                            </div>
                                        </div>
                                    </li>
                                    <!--Item-->
                                    <li class="comment-item">
                                        <img class="avtar" src="img/avtar.jpg" alt="avtar" />
                                        <div class="comment-text">
                                            <div class="star-rating" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating" title="Rated 4 out of 5">
                                                <span style="width: 100%"></span>
                                            </div>
                                            <p class="meta">
                                                <strong>Michel</strong>
                                                <span>–</span>
                                                <time datetime="">August 21, 2018</time>
                                            </p>
                                            <div class="description">
                                                <p>Wow Special!</p>
                                            </div>
                                        </div>
                                    </li>
                                    <!--Item-->
                                    <li class="comment-item">
                                        <img class="avtar" src="img/avtar.jpg" alt="avtar" />
                                        <div class="comment-text">
                                            <div class="star-rating" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating" title="Rated 4 out of 5">
                                                <span style="width: 60%"></span>
                                            </div>
                                            <p class="meta">
                                                <em>Your comment is awaiting approval</em>
                                            </p>
                                            <div class="description">
                                                <p>When an unknown printer took a galley!</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Custom Tab-->
            <div id="tab_custom" role="tabpanel" class="tab-pane fade">

                <!--Header-->
                <div id="accrodianFour" class="product-Content-toggle">
                    <a data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Custom Tab</a>
                </div>

                <!--Body-->
                <div id="collapseFour" class="product-tab-Content-body collapse" aria-labelledby="accrodianFour" data-parent="#product-accordian-Content">
                    <div class="row">
                        <!--Add a Review-->
                        <div class="col-md-5 mb-0 mb-sm-3">
                            <img src="img/blank.png" alt="banner">
                        </div>
                        <!--Comments-->
                        <div class="col-md-7 d-flex">
                            <div class="align-self-center">
                                <span class="page-sub-title">New Arrival</span>
                                <h3>Spring Collection 2019</h3>
                                <p class="large">
                                    Vibrant color with floral pattern becoming the fashion<br>
                                    trending in this summer.
                                </p>
                                <a href="product_detail_2.html#" class="btn btn--primary btn--sm space-t--1">More Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Tabs Content-->
    </div>
</template>