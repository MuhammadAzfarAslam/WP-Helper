<?php
/**
 Template Name: My Grid Page Template
 * 
 */

get_header(); 

?>

<style type="text/css">
    .col-sm-4 {
                padding-bottom: 25px;
            }
</style>

<br/><br/>  
<section class="mysearch">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
                    <select id="cus-filter" name="cus-filter">
                        <option value="">Select</option>
                        <option value="last_name">Last Name</option>
                        <option value="first_name">First Name</option>
                        <option value="designation">Designations</option>
                        <option value="state">State</option>
                        <option value="phone_number">Phone</option>
                        <option value="website_url">Website</option>
                        <option value="finra">FINRA#</option>
                    </select>
                    <input type="text" name="s" placeholder="Search Products"/>
                    <input type="hidden" name="post_type" value="advisor" /> <!-- // hidden 'products' value -->
                    <input type="submit" alt="Search" value="Search" />
                </form>
            </div>
        </div>
    </div>
</section> 

<br/><br/>

<div class="container">
    <div class="row">
        
<?php 
$args = array(
    'post_type'=> 'advisor',
    'order'    => 'DESC'
    );              
$the_query = new WP_Query( $args );
if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		
		<div class="col-sm-4">
            <div class="card" style="">
                <div class="row cardheader">
                    <div class="col-sm-6">
                    <?php echo get_the_post_thumbnail() ?>
                        <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                    </div>
                    <div class="col-sm-6">
                        <h5><?php  echo CFS()->get('title'); ?></h5>
                        <p><?php echo CFS()->get('designation'); ?></p>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">CLIENT SPECIALTIES</h5>
                    <p class="card-text"><?php  echo CFS()->get('client_specialities'); ?></p>
                    <h5 class="card-title">QUICK BIO</h5>
                    <p class="card-text"><?php  the_excerpt(); ?></p>
                    <p><a href="<?php echo get_permalink() ?>" class="btn btn-primary">View Advisor Profile</a></p>
                    <!-- <a href="#" class="btn btn-primary"></a> -->
                </div>
            </div>
        </div>
        
<?php endwhile; endif; ?>
		

    </div>
</div>
<br><br>
<?php
get_footer(); 

?>