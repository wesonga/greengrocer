<?php
session_start();
include_once("admin/class/adminback.php");
$obj = new adminback();

$cata_info = $obj->p_display_catagory();
$cataDatas = array();
while ($data = mysqli_fetch_assoc($cata_info)) {
    $cataDatas[] = $data;
}

if (isset($_GET['status'])) {
    $pdtId = $_GET['id'];
    if ($_GET['status'] == 'singleproduct') {
        $pdt_info = $obj->display_product_byId($pdtId);
        $pdt_fetch = mysqli_fetch_assoc($pdt_info);
        $pro_datas = array();
        $pro_datas[] = $pdt_fetch;
    }
}
$ctg_id = $pdt_fetch['ctg_id'];
$rel_pro = $obj->related_product($ctg_id);


if(isset($_POST['post_comment'])){
    $cmt_msg = $obj->post_comment($_POST);
}


$cmt_fetch = $obj->view_comment_id($_GET['id']);
if(isset($cmt_fetch)){
    $cmt_row = mysqli_num_rows($cmt_fetch);
}

?>




<?php
include_once("includes/head.php");
?>

<body class="biolife-body">
    <!-- Preloader -->

    <?php
    include_once("includes/preloader.php");
    ?>

    <!-- HEADER -->
    <header id="header" class="header-area style-01 layout-03">

        <?php
        include_once("includes/header_top.php");
        ?>

        <?php
        include_once("includes/header_middle.php");
        ?>

        <?php
        include_once("includes/header_bottom.php");
        ?>

    </header>

    <!-- Page Contain -->
    <div class="page-contain">

        <!-- Main content -->
        <div id="main-content" class="main-content">

            <!--Hero Section-->
            <div class="hero-section hero-background">
                <h1 class="page-title">
                    <?php
                    foreach ($pro_datas as $pro_data) {
                        echo $pro_data['pdt_name'];
                    }
                    ?>
                </h1>

               
            </div>




            <!--Navigation section-->
            <div class="container">
                <nav class="biolife-nav">
                    <ul>
                        <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>

                        <li class="nav-item"><span class="current-page">

                                <?php
                                foreach ($pro_datas as $pro_data) {
                                    echo $pro_data['ctg_name'];
                                }
                                ?>
                            </span></li>

                        <li class="nav-item"><span class="current-page">

                                <?php
                                foreach ($pro_datas as $pro_data) {
                                    echo $pro_data['pdt_name'];
                                }
                                ?>
                            </span></li>
                    </ul>
                </nav>


            </div>

            <div class="container">
                <div class="page-contain single-product">
                    <div class="container">

                        <!-- Main content -->
                        <div id="main-content" class="main-content">

                            <?php
                            foreach ($pro_datas as $pro_data) {


                            ?>



                                <div>
                                    <!-- summary info -->
                                    <form action="addtocart.php" method="POST">

                                        <div class="sumary-product single-layout">
                                            <div class="media">
                                                <ul class="biolife-carousel slider-for" data-slick='{"arrows":false,"dots":false,"slidesMargin":30,"slidesToShow":1,"slidesToScroll":1,"fade":true,"asNavFor":".slider-nav"}'>
                                                    <li><img src="admin/uploads/<?php echo $pro_data['pdt_img'] ?>" alt="" width="500" height="500"></li>

                                                </ul>

                                            </div>
                                            <div class="product-attribute">
                                                <h3 class="title"><?php echo $pro_data['pdt_name'] ?></h3>
                                                <div class="rating">
                                                    <p class="star-rating"><span class="width-80percent"></span></p>
                                                    <span class="review-count">(04 Reviews)</span>
                                                    <span class="qa-text">Q&A</span>
                                                    <b class="category">By: <?php echo $pro_data['ctg_name'] ?></b>
                                                </div>
                                                <span class="sku">Sku: <?php echo $pro_data['pdt_id'] ?></span>
                                                <span class="stock" style="margin-left: 200px;">Stock: <?php echo $pro_data['product_stock'] ?> </span>


                                                <p class="excerpt"><?php echo $pro_data['pdt_des'] ?></p>
                                                <div class="price">
                                                    <ins><span class="price-amount"><span class="currencySymbol">Ugx. </span><?php echo $pro_data['pdt_price'] ?></span></ins>

                                                </div>

                                                <div class="delivery-info">
                                                    <p class="delivery-day">1-hour Delivery</p>
                                                    <p class="for-today">Free Pickup Today</p>
                                                </div>
                                            </div>
                                            <div class="action-form">

                                                <div class="total-price-contain">
                                                    <span class="title">Total Price:</span>
                                                    <p class="price">Ugx.
                                                        <?php

                                                        echo $pro_data['pdt_price'];

                                                        ?>


                                                    </p>
                                                </div>
                                                <div class="buttons">
                                                    <input type="hidden" name="pdt_name" value="<?php echo $pro_data['pdt_name'] ?>">

                                                    <input type="hidden" name="pdt_price" value="<?php echo $pro_data['pdt_price'] ?>">

                                                    <input type="hidden" name="pdt_img" value="<?php echo $pro_data['pdt_img'] ?>">
                                                    <input type="hidden" name="pdt_id" value="<?php echo $pro_data['pdt_id'] ?>">

                                                    <input type="submit" value="Add To Cart" class="btn btn-block btn-success" name="addtocart">

                                                </div>

                                    </form>

                                    <div class="social-media">
                                        <ul class="social-list">
                                            <li><a href="#" class="social-link"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                            <li><a href="www.facebook.com" class="social-link"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            <li><a href="#" class="social-link"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                            <li><a href="#" class="social-link"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                                            <li><a href="#" class="social-link"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="acepted-payment-methods">
                                        <ul class="payment-methods">
                                            <li><img src="assets/images/card1.jpg" alt="" width="51" height="36"></li>
                                            <li><img src="assets/images/card2.jpg" alt="" width="51" height="36"></li>
                                            <li><img src="assets/images/card3.jpg" alt="" width="51" height="36"></li>
                                            <li><img src="assets/images/card4.jpg" alt="" width="51" height="36"></li>
                                        </ul>
                                    </div>
                                </div>
                        </div>
                        </form>

                        <!-- Tab info -->
                        <div class="product-tabs single-layout biolife-tab-contain">
                            <div class="tab-head">
                                <ul class="tabs">
                                    <li class="tab-element active"><a href="#tab_1st" class="tab-link">Products Descriptions</a></li>

                                    <li class="tab-element"><a href="#tab_3rd" class="tab-link">delivery & Delivery</a></li>
                                    <li class="tab-element"><a href="#tab_4th" class="tab-link">Customer Reviews <sup>(3)</sup></a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div id="tab_1st" class="tab-contain desc-tab active">
                                    <p class="desc">Mbarara Greengrocer is an online shop for providing fresh fruits in Mbarara city. Here you can get a huge collection of locally grown fruits grown in Western Uganda at your fingertips          </p>
                                    <div class="desc-expand">
                                        <span class="title">Organic Fresh Fruit</span>
                                        <ul class="list">
                                            <li>100% real fruit ingredients</li>
                                            <li>100 fresh fruit bags individually wrapped</li>
                                        </ul>
                                    </div>
                                </div>

                                <div id="tab_3rd" class="tab-contain delivery-delivery-tab">
                                    <div class="accodition-tab biolife-accodition">
                                        <ul class="tabs">
                                            <li class="tab-item">
                                                <span class="title btn-expand">How long will it take to receive my order?</span>
                                                <div class="content">
                                                    <p>Orders placed before 6pm will normally be processed and delivered by the end of the day. For orders received after 6pm, they will generally be processed and delivered the next day. </p>
                                                    
                                                </div>
                                            </li>
                                            <li class="tab-item">
                                                <span class="title btn-expand">How  is the delivery cost calculated?</span>
                                                <div class="content">
                                                    <p>You will pay a delivery rate based on the weight and size of the order. Large or heavy items may include an oversized handling fee. Total delivery fees are shown in your shopping cart. Please refer to the following delivery table:</p>
                                                    <p>Note: delivery weight calculated in cart may differ from weights listed on product pages due to size and actual weight of the item.</p>
                                                </div>
                                            </li>
                                            <li class="tab-item">
                                                <span class="title btn-expand">Why Didn’t My Order Qualify for FREE delivery?</span>
                                                <div class="content">
                                                    <p>We do not deliver to P.O. boxes boxes. We deliver to all parts of Mbarara. Certain items may be excluded for delivery. This will be indicated on the product page.</p>
                                                </div>
                                            </li>
                                            <li class="tab-item">
                                                <span class="title btn-expand">delivery Restrictions?</span>
                                                <div class="content">
                                                    <p>We do not deliver to P.O. boxes. We deliver to all parts of Mbarara. Certain items may be excluded for delivery. This will be indicated on the product page.</p>
                                                </div>
                                            </li>
                                            <li class="tab-item">
                                                <span class="title btn-expand">Undeliverable Packages?</span>
                                                <div class="content">
                                                    <p>Occasionally packages are returned to us as undeliverable by the carrier. When the carrier returns an undeliverable package to us, we will cancel the order and refund the purchase price less the delivery charges.</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="tab_4th" class="tab-contain review-tab">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                                <div class="rating-info">
                                                    <p class="index"><strong class="rating">4.4</strong>out of 5</p>
                                                    <div class="rating">
                                                        <p class="star-rating"><span class="width-80percent"></span></p>
                                                    </div>
                                                    <p class="see-all">See all <?php echo $cmt_row?> reviews</p>
                                                    <ul class="options">
                                                        <li>
                                                            <div class="detail-for">
                                                                <span class="option-name">5stars</span>
                                                                <span class="progres">
                                                                    <span class="line-100percent"><span class="percent width-90percent"></span></span>
                                                                </span>
                                                                <span class="number">90</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail-for">
                                                                <span class="option-name">4stars</span>
                                                                <span class="progres">
                                                                    <span class="line-100percent"><span class="percent width-30percent"></span></span>
                                                                </span>
                                                                <span class="number">30</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail-for">
                                                                <span class="option-name">3stars</span>
                                                                <span class="progres">
                                                                    <span class="line-100percent"><span class="percent width-40percent"></span></span>
                                                                </span>
                                                                <span class="number">40</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail-for">
                                                                <span class="option-name">2stars</span>
                                                                <span class="progres">
                                                                    <span class="line-100percent"><span class="percent width-20percent"></span></span>
                                                                </span>
                                                                <span class="number">20</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail-for">
                                                                <span class="option-name">1star</span>
                                                                <span class="progres">
                                                                    <span class="line-100percent"><span class="percent width-10percent"></span></span>
                                                                </span>
                                                                <span class="number">10</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>



                                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                                                <?php
                                                if (isset($_SESSION['user_id'])) {
                                                ?>

                                                    <div class="review-form-wrapper">
                                                        <span class="title">Submit your review</span>
                                                        <form action="#" name="frm-review" method="post">
                                                            <div class="comment-form-rating">

                                                            <?php 
                                                                if(isset($cmt_msg)){
                                                                    echo '<script>alert("Thanks for your valuable feedback")</script>';
                                                                }
                                                            ?>
                                                                <label>1. Your Comment about this products:</label>




                                                            </div>




                                                            <p class="form-row">
                                                                <input type="hidden" value="<?php echo $_SESSION['user_id'] ?>" name="user_id">
                                                                <input type="hidden" value="<?php echo  $_SESSION['username'] ?>" name="user_name">
                                                                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="pdt_id">

                                                                <textarea name="comment" id="txt-comment" cols="30" rows="10" placeholder="Write your review here..." required></textarea>
                                                            </p>


                                                            <p class="">
                                                                <input type="submit" name="post_comment" value="Post Comment" class="btn btn-success">
                                                            </p>




                                                        </form>
                                                    </div>


                                                <?php } ?>
                                            </div>

                                           


                                        </div>
                                        <div id="comments">
                                            <ol class="commentlist">

                                            <?php 
                                            
                                               
                                        while($cmtinfo=mysqli_fetch_assoc($cmt_fetch)){
                                                  
                                            
                                            ?>
                                                <li class="review">
                                                    <div class="comment-container">
                                                        <div class="row">
                                                            <div class="comment-content col-lg-8 col-md-9 col-sm-8 col-xs-12">

                                                            <p class="comment-in"><span class="post-name"></span>
                                                            <span class="post-date"><?php echo $cmtinfo['comment_date'] ?></span></p>
                                                              
                                                                
                                                                <p class="author">by: <b><?php echo $cmtinfo['user_name'] ?></b></p>

                                                                <p class="comment-text"><?php echo $cmtinfo['comment'] ?>.</p>

                                                            </div>
                                                            <div class="comment-review-form col-lg-3 col-lg-offset-1 col-md-3 col-sm-4 col-xs-12">
                                                                <span class="title">Was this review helpful?</span>
                                                                <ul class="actions">
                                                                    <li><a href="#" class="btn-act like" data-type="like"><i class="fa fa-thumbs-up" aria-hidden="true"></i>Yes (100)</a></li>
                                                                    <li><a href="#" class="btn-act hate" data-type="dislike"><i class="fa fa-thumbs-down" aria-hidden="true"></i>No (20)</a></li>
                                                                    <li><a href="#" class="btn-act report" data-type="dislike"><i class="fa fa-flag" aria-hidden="true"></i>Report</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <?php     
                                            }
                                            ?>
                                                
                                            </ol>
                                            <div class="biolife-panigations-block version-2">
                                                <ul class="panigation-contain">
                                                    <li><span class="current-page">1</span></li>
                                                    <li><a href="#" class="link-page">2</a></li>
                                                    <li><a href="#" class="link-page">3</a></li>
                                                    <li><span class="sep">....</span></li>
                                                    <li><a href="#" class="link-page">20</a></li>
                                                    <li><a href="#" class="link-page next"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                                </ul>
                                                <div class="result-count">
                                                    <p class="txt-count"><b>1-5</b> of <b>126</b> reviews</p>
                                                    <a href="#" class="link-to">See all<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- related products -->
                        <div class="product-related-box single-layout">
                            <div class="biolife-title-box lg-margin-bottom-26px-im">
                                <span class="biolife-icon icon-organic"></span>
                                <span class="subtitle">All the best items for You</span>
                                <h3 class="main-title">Related Products</h3>
                            </div>
                            <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20 }},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>


                                <?php while ($r_pro = mysqli_fetch_assoc($rel_pro)) { ?>

                                    <li class="product-item">
                                        <div class="contain-product layout-default">
                                            <div class="product-thumb">
                                                <a href="single_product.php?status=singleproduct&&id=<?php echo $r_pro['pdt_id'] ?>" class="link-to-product">
                                                    <img src="admin/uploads/<?php echo $r_pro['pdt_img'] ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories"><?php echo $r_pro['ctg_name'] ?></b>
                                                <h4 class="product-title"><a href="single_product.php?status=singleproduct&&id=<?php echo $r_pro['pdt_id'] ?>" class="pr-name"> <?php echo $r_pro['pdt_name'] ?> </a></h4>
                                                <div class="price">
                                                    <ins><span class="price-amount"><span class="currencySymbol">$</span>
                                                            <?php echo $r_pro['pdt_price'] ?>
                                                        </span></ins>

                                                </div>
                                                <div class="slide-down-box">
                                                    <p class="message">All products are carefully selected to ensure food safety.</p>

                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                <?php } ?>
                            </ul>
                        </div>
                    </div>




                <?php } ?>
                </div>
            </div>
        </div>

    </div>



    </div>
    </div>

    <!-- FOOTER -->

    <?php
    include_once("includes/footer.php");
    ?>

    <!--Footer For Mobile-->
    <?php
    include_once("includes/mobile_footer.php");
    ?>

    <?php
    include_once("includes/mobile_global.php")
    ?>


    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <?php
    include_once("includes/script.php")
    ?>
</body>

</html>