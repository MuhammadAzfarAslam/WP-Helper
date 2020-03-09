<?php


get_header(); 

?>
<section class="main-heading">
    <div class="container">
        <div class="row align-middle">
            <div class="col-sm-4">
                <div class="my-feature"><?php echo get_the_post_thumbnail() ?></div>
            </div>
            <div class="col-sm-8 justify-content-center align-self-center">
                <h5 class="m-title"><?php  echo CFS()->get('title'); ?></h5>
                <p class="m-desc"><?php echo CFS()->get('designation'); ?></p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row mt-20 mb-20">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <br/>
                <span class="address mr-10"><i class="fas fa-map-marker-alt"></i> <?php echo CFS()->get('address'); ?></span>
                <span class="Phone mr-10"><i class="fas fa-phone"></i> <?php echo CFS()->get('phone_number'); ?></span>
                <span class="Email mr-10"><i class="fas fa-envelope"></i> <?php echo CFS()->get('email_address'); ?></span>
                <span class="Website mr-10"><i class="fas fa-link"></i> <?php echo CFS()->get('website_url'); ?></span>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <!-- <div class="col-sm-4"></div> -->
            <div class="col-sm-9">
                <br/>
                <h4><?php echo CFS()->get('title'); ?></h4>
                <?php the_content(); ?> 
            </div>
            <div class="col-sm-3">
                <br>
                <h4>Ideal Clients</h4>
                <p><i class="far fa-check-circle"></i> <a href="#">Business Executive</a></p>
                <p><i class="far fa-check-circle"></i> <a href="#">Entrepreneur</a></p>
                <p><i class="far fa-check-circle"></i> <a href="#">Family Financial Planning</a></p>
                <p><i class="far fa-check-circle"></i> <a href="#">Gen X</a></p>

                <br>
                <h4>Ideal Clients</h4>
                <p><i class="far fa-check-circle"></i> <a href="#">Business Executive</a></p>
                <p><i class="far fa-check-circle"></i> <a href="#">Entrepreneur</a></p>
                <p><i class="far fa-check-circle"></i> <a href="#">Family Financial Planning</a></p>
                <p><i class="far fa-check-circle"></i> <a href="#">Gen X</a></p>
            </div>
        </div>
    </div>
</section>
<?php
get_footer(); 

?>