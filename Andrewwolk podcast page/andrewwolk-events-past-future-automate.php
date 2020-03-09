<?php
/**
 Template Name: Events
 */

get_header();
?>


<style type="text/css">
.upcomingevents , .normalevents
{
float:left;
width:100%;
margin-bottom:20px;
}

h2#hhh {
    border-bottom: 2px solid #002868;
    padding-bottom: 10px;
    border-width: 2px;
    width: 21%;
    margin: 0 auto;
	    margin-bottom: 20px;
    margin-top: 20px;
	color: #002868;
	text-align: center
}
.lef {
    border: 1px solid #0d73d6;
    color: #0d73d6;
    height: 5em;
    width: 5em;
    text-align: center;
    border-radius: 100px;
    margin-right: 20px;
    margin-left: 25px;
    float: left;
    width: 17%;
}

.d_day {
    font-size: 12px;
    letter-spacing: .125em;
    font-family: 'Ubuntu', sans-serif !important;
    font-weight: 900;
    margin-bottom: -8px;
}
.d_month {
    font-weight: 900!important;
    font-size: 15px;
    letter-spacing: .125em;
    font-family: 'Ubuntu', sans-serif !important;
}
.d_date {
    font-size: 16px;
    margin-top: -4px;
    font-weight: 900!important;
    letter-spacing: .125em;
    font-family: 'Ubuntu', sans-serif !important;
}
.event {
    background: #fff;
    padding: 30px 0px;
    width: 33%;
    float: left;
    box-shadow: 0 2px 3px 0 rgba(0,0,0,.18);
    min-height: 16em;
    margin-right: .33%;
    margin-bottom: 10px;
}
.event a
{
    text-decoration:none!important;
}
.up{
    font-size: 12px;
    letter-spacing: .125em;
    font-family: 'Ubuntu', sans-serif !important;
    font-weight: 900;
}
.eve_title {
    color: #000;
    font-size: 20px;
    font-weight: 700;
}
.ece_desc {
    color: #000;
    font-size: 14px;
    letter-spacing: 2px;
    font-weight: 100!important;
    margin-top: 5px;
}
.rig {
    float: left;
    width: 67%;
}
</style>

<div id="Content">
	<div class="content_wrapper clearfix">

		<div class="sections_group">
		
		
		<div class="container">
		
		<div class="content-section">
		<?php 
		while (have_posts()) {

						the_post();
		
		the_content();
		
		}
		 ?>
		</div>
		
		
		
		<div class="upcomingevents">
		
			<h2 class="vc_custom_heading" id="hhh">UPCOMING EVENTS</h2>
		
		<?php
		$args = array('post_type' => 'event','orderby' => 'publish_date', 'order' => 'DESC');
	    $query = new WP_Query($args);
        if ($query->have_posts() ) : 
        while ( $query->have_posts() ) : $query->the_post();
		
		 $date = get_field('event_date',$post->ID); 
		//$parts2 = explode(',',$date2);
		
		$today = date('j F Y');
		
	     $today1 = strtotime($today);
		 $date1 = strtotime($date);
		
		

		if ($today1 < $date1){
 		//echo "date in future";
		
		
		//echo $dbdate = $parts2[0] . $parts2[1] .",".$parts2[2];
        
		?>
	
		<div class="event">
			<a href="<?php echo get_field('event_link',$post->ID); ?>">
			
			<div class="lef">
			<?php 
			 $date2 = get_field('event_date',$post->ID); 
			$parts = explode(' ',$date2);
			?>
			<div class="d_day"><?php echo $parts[1]; ?></div>
			<div class="d_month"><?php echo $parts[0]; ?></div>
			<div class="d_date"><?php echo $parts[2]; ?></div>
			</div>
			<div class="rig">
			<div class="up">upcoming event</div>
			<div class="eve_title"><?php the_title(); ?></div>
			<div class="ece_desc"><?php the_content(); ?></div>
			</div>
			</a>
			</div>
		
		<?php
		}
		?>
		   
		    
		   
		<?php   
        endwhile;

        endif;
		?>
		</div>
		
		
		
		<div class="normalevents">
		
		
		
		<h2 class="vc_custom_heading" id="hhh">PAST EVENTS</h2>
		
		
		<?php
		$args = array('post_type' => 'event', 'orderby' => 'publish_date', 'order' => 'DESC');
	    $query = new WP_Query($args);
        if ($query->have_posts() ) : 
        while ( $query->have_posts() ) : $query->the_post();
		
		$dates = get_field('event_date',$post->ID); 
		//$parts2 = explode(',',$date2);
		
		$todays = date('j F Y');
		
	     $today1s = strtotime($todays);
		 $date1s = strtotime($dates);
		
		

		if ($today1s > $date1s){
		
        ?>      
		   
		    <div class="event">
			<a href="https://creativemornings.com/cities/bos">
			<div class="lef">
			<?php 
			 $date2s = get_field('event_date',$post->ID); 
			$partss = explode(' ',$date2s);
			?>
			<div class="d_day"><?php echo $partss[1]; ?></div>
			<div class="d_month"><?php echo $partss[0]; ?></div>
			<div class="d_date"><?php echo $partss[2]; ?></div>
			</div>
			<div class="rig">
			<div class="up">past event</div>
			<div class="eve_title"><?php the_title(); ?></div>
			<div class="ece_desc"><?php the_content(); ?></div>
			</div>
			</a>
			</div>
		   
		   
		<?php 
		}  
        endwhile;
        endif;
		?>
		
		</div>
		
		
		
		</div>
		
		
		
		
		


		</div>

		

	</div>
</div>


<?php  get_footer();
