<?php
get_header(); // Include the header template

// Get current taxonomy information
$term = get_queried_object();


$args = array(
    'post_type' => 'travel-package',
    'tax_query' => array(
        array(
            'taxonomy' => $term->taxonomy,
            'field' => 'slug',
            'terms' => $term->slug,
        ),
    ),
);
$query = new WP_Query($args);
$popular_args = array(
    'post_type' => 'travel-package',
    'posts_per_page' => 4,
    'meta_query' => array(
        array(
            'key' => 'show_as_popular',
            'value' => 'yes',
            'compare' => 'LIKE',
        ),
    ),
    'tax_query' => array(
        array(
            'taxonomy' => $term->taxonomy, 
            'field' => 'slug',
            'terms' => $term->slug, 
        ),
    ),
);
$popular_query = new WP_Query($popular_args);
 
?>
<style>
    /* kd class css 10/10/2024 */
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

.banner_section {
    background-image: url('https://travelduniyaa.com/wp-content/uploads/2024/10/famous-dubai-scaled.webp');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    height: 500px;
}

.container {
    max-width: 1440px;
    margin: 0 auto;
}

.banner_mainContainer {
    width: 100%;
    height: 100%;
    background-color: #0000008C;
    color: #fff;
    padding: 54px 0 80px;
}

.bcontnet_box h1 {
    font-size: 90px;
    font-weight: 700;
    line-height: 87px;
    margin-bottom: 60px;
}

.bcontnet_box p {
    font-size: 22px;
    font-weight: 400;
    line-height: 28px;
    padding: 9px 64px 8px 40px;
    width: fit-content;
    background-color: #EC3230;
    clip-path: polygon(100% 0, 0 0, 0 calc(0% - 0px), 15px calc(50% - 0px / 2), 0px 100%, 100% calc(100% - 0px), 100% calc(100% - 0px), calc(100% - 15px) calc(50% - 0px / 2));
}

.get_started_btn,
.seeall_tripbtnCont .kdseeall, .viewall_btn {
    background-color: #ED3236;
    color: #fff;
    border: 1px solid #ED3236;
    padding: 10px 39px;
    border-radius: 30px;
    font-size: 18px;
    font-weight: 500;
    line-height: 27px;
    position: relative;
    display: flex;
    align-items: center;
    gap: 5px;
}

.seeall_tripbtnCont .kdseeall{
        width: fit-content;
}
.get_started_btn:after,
.get_started_btn:before, .viewall_btn:after, .viewall_btn:before {
    position: absolute;
    content: '';
    top: 8px;
    right: 13px;
    height: 7px;
    width: 7px;
    outline: 2.8px solid #fff;
    border-radius: 50%;
}

.get_started_btn:before, .viewall_btn:before {
    left: 14px;
    bottom: 9px;
    top: unset;
}
.viewall_btn{
    display: none;
}
.seeall_tripbtnCont .kdseeall:after,
.seeall_tripbtnCont .kdseeall:before {
    position: absolute;
    content: '';
    bottom: 8px;
    right: 13px;
    height: 7px;
    width: 7px;
    outline: 2.8px solid #fff;
    border-radius: 50%;
}

.seeall_tripbtnCont .kdseeall:before {
    left: 14px;
    bottom: unset;
}

.bannner_content {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: start;
}

.banner_mainContainer .container {
    height: 100%;
}

/* popular destination section start */
.popular_destinationSection {
    padding: 48px 0 58px;
}

.heading_section {
    margin-bottom: 40px;
}

.heading_section h2 {
    font-size: 36px;
    font-weight: 600;
    line-height: 50.4px;
}

.heading_section p {
    font-size: 16px;
    font-weight: 400;
    line-height: 22.4px;
    color: #333333;
    margin-top: 7px;
}

.destination_cardsContainer {
    display: flex;
    align-items: center;
    gap: 20px;
}

.destination_Card {
   
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    flex: 1 1 0%;
    height: 523px;
    border-radius: 10px;
    max-height: 100%;
    width: 100%;
    overflow: hidden;
    transition: all ease-in-out .3s;
}

.destination_Card:hover {
    flex: 2 1 0%;
    transition: all ease-in-out .3s;
}

.destination_content_box>div {
    display: none;
}

.destination_Card:hover .destination_content_box .seeall_tripbtnCont {
    display: block;
}

.destination_Card:hover .destination_content_box .title_cont {
    display: flex;
}

.seeall_tripbtnCont .kdseeall {
    margin-left: auto;
}

.title_cont {
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #fff;
}

.title_cont h3 {
    font-size: 28px;
    font-weight: 600;
    line-height: 42px;
}

.destination_content_box {
    min-width: 500px;
    padding: 52px 30px 33px 26px;
    background-color: #00000059;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}


.all-packages-wrapper {
    gap: 20px;
    display: grid !important;
    grid-template-columns: 1fr 1fr;
}

.packages-section-tem {
    border: 1px solid #EBEBEB;
    box-shadow: 0px 1px 3px #0000000D;
    height: 100%;
    background: #fff;
}

.packages-section-inner-item {
    display: flex;
    position: relative;
    overflow: hidden;
    gap: 22px;
    flex-direction: row-reverse;
}

.packages-section-inner-item img {
    height: 100%;
    width: 370px;
    max-width: 370px;
    object-fit: cover;
}

.package-sec-text {
    padding: 21px 0px 22px 20px !important;
}

.package-sec-text a {
    text-decoration: none;
}

.package-sec-text h4 {
    margin: 0;
    font-family: var(--e-global-typography-primary-font-family), Sans-serif;
    font-size: 22px;
    font-weight: 500;
    margin-bottom: 10px;
    color: #ec3230;
    line-height: 33px;
}

.package-sec-text p {
    font-size: 16px;
    font-weight: 400;
    line-height: 23px;
    color: #222222;
    margin-bottom: 12px;
}

.package-sec-text h6 {
    margin: 0;
    padding: 0 0 5px 0;
    font-size: 16px;
    font-weight: 400;
    line-height: 22px;
    color: #ec3230;
}

.main_packagesContianer .packages-section-tem .package-inner-includes {
    display: flex;
    align-items: center;
    gap: 27px;
    padding: 27px 0 12px;
    font-size: 11px;
    line-height: 15px;
    font-weight: 500;
    list-style: none;
    text-align: center;
}

ul.package-inner-includes img {
    display: block;
    width: 30px;
    height: 20px;
    object-fit: contain;
    margin: 0 auto 2px;
}

.package-price {
    padding: 0 0 5px;
}

.package-price h6 strong {
    font-size: 16px;
    font-weight: 400;
    line-height: 22px;
}

.main_packagesContianer .packages-section-tem .package-price h6 strong span {
    font-size: 16px;
    font-weight: 500;
    line-height: 26px;
}

.package-sec-textabc {
    margin-top: 24px;
}

.package-sec-textabc a button {
    font-size: 16px;
    font-weight: 600;
    line-height: 24px;
    color: #FFFFFF;
    background: #ec3230;
    border: 1px solid #ec3230;
    padding: 6px 20px;
    width: 100%;
    border-radius: 30px;
}

.dubai_packages_section {
    padding: 0 0 50px;
}


/* review section css start */
.inter_testimonial_section .user_image {
    border-radius: 50%;
    object-fit: cover;
}

.inter_testimonial_section .user_header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.inter_testimonial_section .user_data {
    display: flex;
    gap: 13px;
    align-items: center;
}

.inter_testimonial_section .user_data .d-flex.flex-column.ml-2 {
    display: flex;
    flex-direction: column;
}

.inter_testimonial_section .card.review_card {
    position: relative;
    border: unset;
    max-width: 100%;
}

.reviews_card_container.owl-carousel .owl-stage-outer {
    overflow-x: hidden;
    overflow-y: unset;
    padding: 15px 0;
}


.inter_testimonial_section .owl-carousel .owl-dots.disabled,
.inter_testimonial_section .owl-dots {
    display: flex;
    gap: 10px;
    justify-content: center;
    align-items: center;
}

.inter_testimonial_section button.owl-dot.active span {
    border: 1px solid #EC3230;
    background-color: #EC3230 !important;
    /* padding: 2px; */
    margin: 0 !important;
}

.inter_testimonial_section button.owl-dot.active {
    border: 1px solid #EC3230;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    text-align: center;
    padding: 4px !important;
}

.inter_testimonial_section button.owl-dot span {
    border: 1px solid #DFDFDF;
    background-color: #DFDFDF !important;
    /* padding: 2px; */
    margin: 0 !important;
}

.inter_testimonial_section button.owl-dot {
    border: 1px solid #DFDFDF;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    text-align: center;
    padding: 4px !important;
}





@media(max-width:1440px) {
    .container {
        padding: 0 15px;
    }
}

@media (max-width:1300px) {
    .destination_content_box {
        min-width: 300px;
    }
}

@media (max-width:1024px) {
    .star_rating_container {
        display: none;
    }
}
 @media(max-width:900px) and (min-width:768px){
    .title_cont h3 {
        font-size: 24px;
        line-height: 31px;
    }
 }

@media(max-width:767px) {

    .destination_cardsContainer {
        flex-wrap: wrap;
        flex-direction: column;
        gap: 25px;
    }

    .destination_content_box {
        min-width: 300px;
        padding: 27px 18px 16px 23px;
        height: 138px;
    }

    .destination_Card:hover .destination_content_box {
        height: 272px;
    }

    .destination_Card:hover {
        min-height: 272px;
    }

    .all-packages-wrapper {
        grid-template-columns: 1fr;
    }

    .bcontnet_box h1 {
        font-size: 30px;
        font-weight: 600;
        line-height: 45px;
        margin-bottom: 29px;
    }

    .bcontnet_box p {
        font-size: 12px;
        font-weight: 500;
        line-height: 28px;
        padding: 9px 19px 8px 25px;
    }

    .get_started_btn,
    .destination_content_box .seeall_tripbtnCont,
    .destination_content_box .seeall_tripbtnCont .kdseeall {
        display: none;
    }

    .banner_section {
        height: 251px;
    }

    .bannner_content {
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .heading_section h2 {
        font-size: 25px;
        font-weight: 600;
        line-height: 39px;
    }

    .heading_section p {
        font-size: 16px;
        font-weight: 400;
        line-height: 22.4px;
    }

    .title_cont h3 {
        font-size: 25px;
        font-weight: 600;
        line-height: 38px;
    }

    /* .destination_content_box .title_cont{
        display: block;
    } */
    .destination_Card:hover .destination_content_box .title_cont,
    .destination_content_box .title_cont {
        display: block;
        height: 100%;
    }

    .destination_Card .destination_content_box .title_cont a {
        display: block;
        text-align: right;
    }

    .destination_Card .destination_content_box .title_cont h3 {
        margin-bottom: 134px;
    }

    .inter_testimonial_section .review_card .card-body {
        padding: 22px 22px 22px 26px !important;
    }

    .review_card p {
        text-align: justify;
    }
    .heading_section {
        margin-bottom: 20px;
    }
    .reviews_card_container{
        margin: 0;
    }
    .viewall_btn{
        display: flex;
        margin: 35px auto 0;
    }
    .popular_destinationSection, .dubai_packages_section, .inter_testimonial_section {
        padding: 30px 0;
    }
}

</style>
 <!-- banner section start -->
    <section class="banner_section">
        <div class="banner_mainContainer">
            <div class="container">
                <div class="bannner_content">
                    <div class="bcontnet_box">
                        <h1><?php echo single_term_title(); ?></h1>
                       <?= get_the_archive_description(); ?>
                        
                    </div>
                    <button class="get_started_btn">Get Started <img src="<?= home_url().'/wp-content/uploads/2024/09/book-now.svg'?>" alt="arrow image"></button>
                </div>
            </div>
        </div>
    </section>
    <!-- banner section end -->

    <!-- popular destination section start -->
    <section class="popular_destinationSection">
        <div class="container">
            <div class="main_destinationContianer">
                <div class="heading_section">
                    <h2>Popular Destinations</h2>
                    <!--<p>Vacations to make your experience enjoyable in india!</p>-->
                </div>
                <div class="destination_cardsContainer">
                    <!-- destination card start -->
                    
                    <?php if ($popular_query->have_posts()) : 
                    while ($popular_query->have_posts()) : $popular_query->the_post(); ?>
                    <!-- destination card start -->
                    <div class="destination_Card" style="background-image:url('<?php echo get_the_post_thumbnail_url(); ?>')">
                        <div class="destination_content_box">
                            <div class="seeall_tripbtnCont">
                                <a class="kdseeall" href="<?= home_url().'/travel-package/?location='.$term->slug; ?>">See All Trip <img
                                        src="<?= home_url().'/wp-content/uploads/2024/09/book-now.svg'?>"
                                        alt="arrow image"></a>
                            </div>
                            <div class="title_cont">
                                <h3><?php the_title(); ?></h3>
                                <a href="<?php the_permalink(); ?>"><img src="<?= home_url().'/wp-content/uploads/2024/09/arrow-travel-destination.svg' ?>" alt="arrow image"></a>
                            </div>
                        </div>
                    </div>
               
                    <?php endwhile; else : ?>
                        <p><?php _e('No popular destinations found.', 'textdomain'); ?></p>
                    <?php endif; wp_reset_postdata(); ?>
                    
                        <!-- destination card end -->
                    
                    
                </div>
            </div>

                <div class="viewall_destinationCont">
                    <button class="viewall_btn">View All</button>
                </div>
            </div>
        </div>
    </section>
    <!-- popular destination section end -->

    <!-- dubai international tour packages start -->
    <section class="dubai_packages_section">
        <div class="container">
            <div class="main_packagesContianer">
                <div class="heading_section">
                    <h2><?php echo single_term_title(); ?> Tour Packages</h2>
                   <!--  <p>Vacations to make your experience enjoyable International!</p> -->
                </div>
                <div class="all-packages-wrapper">
                <?php if ($query->have_posts()) : 
                     while ($query->have_posts()) : $query->the_post(); 
                     
                    ?>
                    <div class="col-md-4">
                        <div class="packages-section-tem">
                            <div class="container">
                                <div class="packages-section-inner-item">
                                    <div class="image-section-division">
                                        <a
                                            href="https://travelduniyaa.com/travel-package/luxury-manali-shimla/">
                                            <img decoding="async" class="package-image"
                                                src="https://travelduniyaa.com/wp-content/uploads/2024/09/Luxury-Manali-Shimla.webp"
                                                alt="Luxury Manali &amp; Shimla">
                                        </a>
                                        <div class="position-star-rating-section">
                                            <h5 class="pl_starrating"><i
                                                    class="fa fa-star txt-warning mx-2 ratingz"></i> 5
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="package-sec-text">
                                        <div class="package-sec-textanchor">
                                            <a
                                                href="https://travelduniyaa.com/travel-package/luxury-manali-shimla/">
                                                <h4><?php the_title(); ?></h4>
                                            </a>
                                            <p><?php the_excerpt(); ?></p>
                                        </div>
                                        <h6><span class="package-span-text">3 days 2 night-Couple</span></h6>

                                        <ul class="package-inner-includes">
                                            <li><img decoding="async"
                                                    src="https://travelduniyaa.com/wp-content/uploads/2024/09/hotel-vector.svg">Hotels
                                            </li>
                                            <li><img decoding="async"
                                                    src="https://travelduniyaa.com/wp-content/uploads/2024/09/transport.svg">Transport
                                            </li>
                                            <li><img decoding="async"
                                                    src="https://travelduniyaa.com/wp-content/uploads/2024/09/meal.svg">Meals
                                            </li>
                                        </ul>
                                        <div class="package-price">
                                            <h6 class="text-primary"><strong> From <span> ₹6,999.00</span></strong></h6>
                                        </div>
                                        <div class="package-sec-textabc">
                                            <a
                                                href="https://travelduniyaa.com/travel-package/luxury-manali-shimla/">
                                                <button class="view_btn_arch">Book Now </button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; else : ?>
                        <p><?php _e('No travel packages found in this category.', 'textdomain'); ?></p>
                        <?php endif; wp_reset_postdata(); ?>
                </div>
                
                
                
                
                
            </div>
        </div>
    </section>
    <!-- dubai international tour packages end -->


    <!-- testimonial section start-->
    <section class="inter_testimonial_section">
        <div class="container">
            <div class="heading_section">
                <h2>What Our Users Say</h2>
                <p>Vacations to make your experience enjoyable in india!</p>
            </div>
            <div class="reviews_card_container owl-carousel owl-theme">
                <div class="card review_card item">
                    <div class="card-body">
                        <div class="d-flex justify-content-between user_header">
                            <div class="d-flex align-items-center gap-3 user_data">
                                <img src="https://travelduniyaa.com/wp-content/uploads/2024/09/Esther-Howard.webp"
                                    class="rounded-circle user_image">
                                <div class="d-flex flex-column ml-2">
                                    <span class="user_name">Esther Howard</span>
                                    <span class="user_profession">Doctor</span>
                                </div>

                            </div>
                            <div class="star_rating_container ">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p>Arrival in Leh on the first day Our agent will meet you at the airport and take you to your
                            accommodation when you arrive in Leh. The sightseeing tour can begin once you …</p>
                    </div>
                </div>
                <div class="card review_card item">
                    <div class="card-body">
                        <div class="d-flex justify-content-between user_header">
                            <div class="d-flex align-items-center gap-3 user_data">
                                <img src="https://travelduniyaa.com/wp-content/uploads/2024/09/Esther-Howard.webp"
                                    class="rounded-circle user_image">
                                <div class="d-flex flex-column ml-2">
                                    <span class="user_name">Kuldeep</span>
                                    <span class="user_profession">Doctor</span>
                                </div>

                            </div>
                            <div class="star_rating_container ">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p>Arrival in Leh on the first day Our agent will meet you at the airport and take you to your
                            accommodation when you arrive in Leh. The sightseeing tour can begin once you …</p>
                    </div>
                </div>
                <div class="card review_card item">
                    <div class="card-body">
                        <div class="d-flex justify-content-between user_header">
                            <div class="d-flex align-items-center gap-3 user_data">
                                <img src="https://travelduniyaa.com/wp-content/uploads/2024/09/Esther-Howard.webp"
                                    class="rounded-circle user_image">
                                <div class="d-flex flex-column ml-2">
                                    <span class="user_name">Rahul</span>
                                    <span class="user_profession">Doctor</span>
                                </div>

                            </div>
                            <div class="star_rating_container ">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p>Arrival in Leh on the first day Our agent will meet you at the airport and take you to your
                            accommodation when you arrive in Leh. The sightseeing tour can begin once you …</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial section end-->


<?php get_footer();  ?>
