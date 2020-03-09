<?php
        /* Template Name: Custom Search */        
        get_header(); ?>

        <style type="text/css">
            div#financity-full-no-header-wrap {
                display: none;
            }

            img.attachment-post-thumbnail.size-post-thumbnail.wp-post-image {
                border-radius: 50%;
            }

            .cardheader {
                padding: 1.25rem 1.25rem 0rem;
            }

            a.btn.btn-primary {
                color: #fff;
                background: #007bff;
                padding: 10px 20px;
            }

            .col-sm-4 {
                padding-bottom: 25px;
            }
        </style>

        <div class="contentarea">
            <div id="content" class="content_right">  
                      
                     <?php //if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>    

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
                
				<div class="container mysearch-page">
				<div class="row">
				
				<?php
// print_r($_GET);
$cusfilter = $_GET['cus-filter'];
$s = $_GET['s'];

    global $wpdb;
    $query = "select * from wp_postmeta where meta_key in ('$cusfilter') and meta_value like '%%$s%%'";
    $results = $wpdb->get_results($query);
    /*print_r('<pre>');
    print_r($results);
    print_r('</pre>');*/

    foreach ($results as $result){
         $myresult = $result->post_id;
        //echo "select * from wp_posts where ID = '$myresult' AND post_type = 'advisor' AND post_status = 'publish'";
        $query2 = "select * from wp_posts where ID = '$myresult' AND post_type = 'advisor' AND post_status = 'publish'";
        $results2 = $wpdb->get_results($query2);
       /* print_r('<pre>');
        print_r($results2);
        print_r('</pre>');*/
		 foreach ($results2 as $result2){
		?>
		
		
		<div class="col-sm-4">
            <div class="card" style="">
                <div class="row cardheader">
                    <div class="col-sm-6">
                    
					<?php if (has_post_thumbnail($myresult) ): ?>
  					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($myresult), 'single-post-thumbnail' ); ?>
 					
					<img width="225" height="219" src="<?php echo $image[0]; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">                    
					    <?php endif; ?>
						
						<!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                    </div>
                    <div class="col-sm-6">
                        <h5><?php $p_title = get_post_meta($myresult,'title'); echo $p_title[0]; ?></h5>
                        <p><?php $p_designation = get_post_meta($myresult,'designation'); echo $p_designation[0]; ?></p>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">CLIENT SPECIALTIES</h5>
                    <p class="card-text"><?php $client_specialities = get_post_meta($myresult,'client_specialities'); echo $client_specialities[0]; ?></p>
                    <h5 class="card-title">QUICK BIO</h5>
                    <p class="card-text"></p><p><?php echo $result2->post_excerpt; ?></p>
<p></p>
                    <p><a href="<?php echo $result2->guid; ?>" class="btn btn-primary">View Advisor Profile</a></p>
                    <!-- <a href="#" class="btn btn-primary"></a> -->
                </div>
            </div>
        </div>
		
		
		
		<?php
    }
	}
	
	?>
				</div>
				</div>
           </div><!-- content -->    
        </div><!-- contentarea -->   
        <?php get_sidebar(); ?>


<?php
    // echo '----------';
    //  print_r('<pre>');
    //  print_r(get_post_meta(4467));
    //  print_r('</pre>');
    //  echo '----------';
    //  $re = get_post_meta(4467);
    //  echo $re['_edit_last'][0];
    //  echo '----------';

?>

<?php
get_footer(); 

?>