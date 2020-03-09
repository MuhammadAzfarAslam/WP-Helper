<?php
/**
 Template Name: Podcasting Page Template
 */

get_header();
?>

<style type="text/css">
.podcast-grid
{
float: left;
    width: 100%;
    margin-bottom: 20px;
    border: 2px solid #f1f1f1;
}

.podcast-image
{
    float: left;
    width: 20%;
}

.podcast-desc
{
    float: left;
    width: 70%;
    margin-left: 3%;
    padding-top: 20px;
    padding-bottom: 20px;
}

.podcast-title
{
    margin-top: 20px;
    float: left;
    width: 100%;
    margin-bottom: 10px;
}

.podcast-title a
{
    color: #333;
    font-size: 25px;
}

.podcast-description
{
    font-size: 18px;
}

.podcast-media
{
    background-color: #bf0a30;
    padding-top: 1%;
    padding-bottom: 1%;
    text-align: center;
}


#media
{
    width: 70%;
}

.podcast_episode
{
color: #fff;
    font-size: 17px;
    margin-bottom: 13px;
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
		
		</div>
		
		
		
		
		<div class="podcast-lislting">
		
		<div class="select-div">
			<div>
			<hr/> 
			</div>
			<div>
				
			
		<select name="episodes" class="episodes" id="episodes">
		<option value="all">All Episodes</option>

		<?php
		$terms = get_terms( array(
           'taxonomy' => 'podcast_categories',
           'hide_empty' => true
           ));
		   
		  foreach($terms as $term)
		  {
		?>
		<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
		<?php } ?>
		</select>
				</div>
		 	<div>
			<hr/> 
			</div>
		</div>
		<br/>
		
		<div class="podcast-season1">
		<div class="container">
			<div class="space-class">
			
			</div>
				
		<?php
		$query = new WP_Query( array(
        'post_type' => 'podcasts',
        'tax_query' => array(
         array (
            'taxonomy' => 'podcast_categories',
            'field' => 'slug',
			/*'terms' => $sleelctedterm*/
            'terms' => 'season-1'
         )
         ),
         ));

		
		//$args = array('post_type' => 'podcasts','orderby' => 'publish_date', 'order' => 'DESC');
	    //$query = new WP_Query($args);
        if ($query->have_posts() ) : 
        while ( $query->have_posts() ) : $query->the_post();
		
		$podcasturl = get_field('podcast_url',$post->ID);
		
		 $purl = str_replace('.mp3', '', $podcasturl); // remove mp3 from coming url of podcast
		 
		 $podcasttitle = get_field('podcast_episode_title',$post->ID);
		
		?>
		
		<div class="podcast-grid">
		
		<div class="podcast-image">
		<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>
        <a href="#podcast-media" data-src="<?php echo $purl; ?>" data-title="<?php echo $podcasttitle; ?>" id="podcasturl" class="podcast-imagea">
		<img src="<?php echo $url ?>"  />
		</a>
		</div>
		
		<div class="podcast-desc">
		
		<div class="podcast-title">
		<a href="#podcast-media" data-src="<?php echo $purl; ?>" data-title="<?php echo $podcasttitle; ?>" id="podcasturl" class="podcast-imagea">
		<?php echo get_the_title(); ?>
		</a>
		</div>
		
		<div class="podcast-description"><?php $substr = get_the_content(); echo substr($substr,0,500); ?></div>
		
		<div class="podcast-meta">
		<a href="#podcast-media" data-src="<?php echo $purl; ?>" data-title="<?php echo $podcasttitle; ?>" id="podcasturl" class="podcast-imagea"> 
         Listen Now
		 </a>
		 </div>
		
		</div>
		
		</div>
		
		
		
		<?php endwhile; endif;  ?>
		
		</div>
		</div>
		
		
		<div class="podcast-season2">
		<div class="container">
				
		<?php
		$query = new WP_Query( array(
        'post_type' => 'podcasts',
        'tax_query' => array(
         array (
            'taxonomy' => 'podcast_categories',
            'field' => 'slug',
            'terms' => 'season-2'
         )
         ),
         ));

		
		//$args = array('post_type' => 'podcasts','orderby' => 'publish_date', 'order' => 'DESC');
	    //$query = new WP_Query($args);
        if ($query->have_posts() ) : 
        while ( $query->have_posts() ) : $query->the_post();
		
		$podcasturl = get_field('podcast_url',$post->ID);
		
		 $purl = str_replace('.mp3', '', $podcasturl); // remove mp3 from coming url of podcast
		 
		 $podcasttitle = get_field('podcast_episode_title',$post->ID);
		
		?>
		
		<div class="podcast-grid">
		
		<div class="podcast-image">
		<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>
        <a href="#podcast-media" data-src="<?php echo $purl; ?>" data-title="<?php echo $podcasttitle; ?>" id="podcasturl" class="podcast-imagea">
		<img src="<?php echo $url ?>"  />
		</a>
		</div>
		
		<div class="podcast-desc">
		
		<div class="podcast-title">
		<a href="#podcast-media" data-src="<?php echo $purl; ?>" data-title="<?php echo $podcasttitle; ?>" id="podcasturl" class="podcast-imagea">
		<?php echo get_the_title(); ?>
		</a>
		</div>
		
		<div class="podcast-description"><?php $substr = get_the_content(); echo substr($substr,0,500); ?></div>
		
		<div class="podcast-meta">
		<a href="#podcast-media" data-src="<?php echo $purl; ?>" data-title="<?php echo $podcasttitle; ?>" id="podcasturl" class="podcast-imagea"> 
         Listen Now
		 </a>
		 </div>
		
		</div>
		
		</div>
		
		
		
		<?php endwhile; endif;  ?>
		
		</div>
		</div>
		
		
		</div>
		
		


		</div>

		

	</div>
</div>



<div class="podcast-media" id="podcast-media">
<center>
<div class="podcast_episode"></div>
<audio id="media" autoplay src="" controls controlsList="nodownload">
Your browser does not support the audio element.
</audio>

</center>

</div>

<script type="text/javascript">
		
jQuery(document).ready(function(){
jQuery('#episodes').on('change', function()
{
   var optionval = jQuery(this).val();
   
   if(optionval == 'season-1')
   {
   jQuery('.podcast-season2').hide();
   jQuery('.podcast-season1').show();
   }
   else if(optionval == 'season-2')
   {
    jQuery('.podcast-season1').hide();
   jQuery('.podcast-season2').show();
   }
   else
   {
   jQuery('.podcast-season2').hide();
   jQuery('.podcast-season1').show();
   }
   
   
   
});
 });
</script>

<script type="text/javascript">
//working with media palyer 

jQuery(document).ready(function(){
  jQuery(".podcast-imagea").click(function(){
    var id = jQuery(this).attr("id");
	var datasrc = jQuery(this).attr("data-src");
	var datatitle = jQuery(this).attr("data-title");
    
	jQuery('.podcast_episode').html(datatitle);

    var datasrc2 =  datasrc + '.mp3';
	
	audio_core= jQuery('#media').attr('src', datasrc2)[0];
    audio_core.play() // <- play the song!!!
    });
    });    
</script>


<?php  get_footer();
