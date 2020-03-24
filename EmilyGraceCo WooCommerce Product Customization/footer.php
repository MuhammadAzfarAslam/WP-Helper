<?php

defined( 'ABSPATH' ) || exit( 'Direct script access denied.' );

$page = get_query_var('et_page-id');
$page_id =  ( isset( $page['id'] ) ) ? $page['id'] : false;
$fd = etheme_get_option('footer_demo');
$fcolor = etheme_get_option('footer_color');
$copyrights_color = etheme_get_option('copyrights_color');
if ( $page_id ) {
	$custom_footer = etheme_get_custom_field('custom_footer', $page_id);
	$custom_prefooter = etheme_get_custom_field('custom_prefooter', $page_id);
	$disable_copyrights = etheme_get_custom_field('remove_copyrights', $page_id);
} else {
	$custom_footer = false;
	$custom_prefooter = false;
	$disable_copyrights = false;
}

?>
	<?php if( $custom_prefooter != 'without' || ( $custom_prefooter == '' && is_active_sidebar('prefooter') ) ): ?>
		<footer class="prefooter">
			<div class="container">
				<?php if(empty($custom_prefooter) && is_active_sidebar('prefooter')): ?>
					<?php dynamic_sidebar('prefooter'); ?>
				<?php elseif(!empty($custom_prefooter)): ?>
					<?php etheme_static_block($custom_prefooter, true); ?>
				<?php endif; ?>
			</div>
		</footer>
	<?php endif; ?>

</div> <!-- page wrapper -->

<div class="et-footers-wrapper">
	<?php //if( ( function_exists('is_checkout') && ! is_checkout() ) || ! function_exists('is_checkout') ):  ?>

		<?php if($custom_footer != 'without' && ( ! empty( $custom_footer ) || is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') )): ?>
			<footer class="footer text-color-<?php echo esc_attr($fcolor); ?>">
				<div class="container">
					<?php if(empty($custom_footer)): ?>
						<div class="row">
							<?php
							$footer_columns = (int) etheme_get_option('footer_columns');
							if( $footer_columns < 1 || $footer_columns > 4) $footer_columns = 4;
							$footer_widget_class = etheme_get_footer_widget_class($footer_columns);
							for($_i=1; $_i<=$footer_columns; $_i++) {
								echo '<div class="footer-widgets ' . $footer_widget_class .'">';
									if(is_active_sidebar('footer-'.$_i)) dynamic_sidebar( 'footer-'.$_i );
								echo '</div>';
							}
							?>
						</div>
					<?php elseif(!empty($custom_footer)): ?>
						<?php etheme_static_block($custom_footer, true); ?>
					<?php endif; ?>
				</div>
			</footer>
		<?php endif; ?>
	<?php //endif; ?>

	<?php if( ! $disable_copyrights && ( is_active_sidebar('footer-copyrights') || is_active_sidebar('footer-copyrights2') || $fd )): ?>
		<div class="footer-bottom text-color-<?php echo esc_attr($copyrights_color); ?>">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 footer-copyrights"><?php if(is_active_sidebar('footer-copyrights')): dynamic_sidebar('footer-copyrights'); else: if($fd) etheme_footer_demo('footer-copyrights'); endif; ?></div>
					<div class="col-sm-6 footer-copyrights-right"><?php if(is_active_sidebar('footer-copyrights2')): dynamic_sidebar('footer-copyrights2'); else: if($fd) etheme_footer_demo('footer-copyrights2'); endif; ?></div>
				</div>
			</div>
		</div>
	<?php endif ?>
</div>

</div> <!-- template-content -->

<?php do_action('after_page_wrapper'); ?>
</div> <!-- template-container -->


<script type="text/javascript">

    jQuery(document).ready(function() {
      jQuery('#fonts').each( function () {
        jQuery(this).change( function ()  {
          jQuery("#mname,#lname,#mname1,#lname1,#mname11,#lname11").css('display', 'block');
            // if (jQuery(this).val()=="heartmid") {
            //     //jQuery("#mname,#lname,#mname1,#lname1,#mname11,#lname11").css('display', 'block');
            //     jQuery("#fname11").css('left', '47%');
            //     jQuery("#fname11").css('top', '267px');
            //     jQuery("#mname11").css('top', '267px');
            //     jQuery("#lname11").css('top', '267px');
            //   }
            // else if (jQuery(this).val()=="circlemonogram") {
            //     //jQuery("#mname,#lname,#mname1,#lname1,#mname11,#lname11").css('display', 'block');
            //     jQuery("#mname11").css('top', '267px');
            //     jQuery("#fname11").css('top', '264px');
            //     jQuery("#lname11").css('top', '264px');
            //     jQuery("#fname11").css('left', '47%');
            //      }
            // else {
            //     jQuery("#mname,#lname,#mname1,#lname1,#mname11,#lname11").css('display', 'block');
            //     jQuery("#fname11").css('left', '50%');
            //     jQuery("#mname11").css('top', '267px');
            //     jQuery("#fname11").css('top', '267px');
            //     jQuery("#lname11").css('top', '267px');
            // } 
          }); 
        });
    });

    // Mouse pad Styling
 
    jQuery(document).ready(function() {
        jQuery('#fonts').on("change", function () {
          var fieldvalinput= jQuery(this).val();
          if(fieldvalinput ==  'heartmid' || fieldvalinput == 'circlemonogram')
          {
              //jQuery('#fname,#mname,#lname').val("");
              jQuery('#fname,#mname,#lname').attr("maxlength", "1");
          }
          else
            {
              //jQuery('#fname,#mname,#lname').val("");
              jQuery('#fname,#mname,#lname').attr("maxlength", "1");
            }
        });           
    });
    
    jQuery(document).ready(function() {
        
       jQuery('.more-customization').hide();
        jQuery('#more-cus').on("change", function () {
          var morecus= jQuery(this).val();
          if(morecus == 'yes')
          {
            jQuery('.more-customization').show();
			//jQuery('.single_add_to_cart_button').hide();
			
          }
          else
            {
               jQuery('.more-customization').hide();
			  // jQuery('.single_add_to_cart_button').show();
            }
        }); 
    });
    
    jQuery(document).ready(function() {
          
         $('input.variation_id').change( function(){
            if( '' != $('input.variation_id').val() ) {  
              var var_id = $('input.variation_id').val();     
				      $("#v-id").val(var_id);
				      $("#vid").val(var_id);
              $("#v-id11").text(var_id);                
            }
         });  
      });
    
    
	
	jQuery(document).ready(function() {
           jQuery('.form-cus-div').hide();
            jQuery('#fonts').on("change", function () {
              var morecus1= jQuery(this).val();
              if(morecus1 != '')
              {
                jQuery('.form-cus-div').show();
              }
              else
                {
                   jQuery('.form-cus-div').hide();
                }
              //alert(jQuery(this).val());
            });
    });
    
	
	
	jQuery(document).ready(function() {
           jQuery('.form-cus-div1').hide();
            jQuery('#font-color').on("change", function () {
              var morecus1= jQuery(this).val();
              if(morecus1 != '')
              {
                jQuery('.form-cus-div1').show();
              }
              else
                {
                   jQuery('.form-cus-div1').hide();
                }
              //alert(jQuery(this).val());
            });
    });
	
    jQuery(document).ready(function() {
        jQuery('#fonts').each( function () {
          jQuery(this).change( function () {
              var fieldvalinput2= jQuery(this).val();
              $("#did").val(fieldvalinput2); 
              $( "#hiddenfontname" ).val(fieldvalinput2);
              $( "#dname11" ).text(fieldvalinput2); 
              //$( "#fname11" ).css('font-family',fieldvalinput2); 
              if (fieldvalinput2 == 'heartmid'){
                $( "#fnames" ).css('font-family','heart-left');
                $( "#lnames" ).css('font-family','heartmid'); 
                $( "#mnames" ).css('font-family','heart-right');  
              }
              else if (fieldvalinput2 == 'circlemonogram'){
                $( "#fnames" ).css('font-family','circle-left');
                $( "#lnames" ).css('font-family','circlemonogram'); 
                $( "#mnames" ).css('font-family','circle-right');   
              }
              else{
                //$( "#preview-p" ).css('font-family',fieldvalinput2);
                $( "#fnames" ).css('font-family',fieldvalinput2);
                $( "#mnames" ).css('font-family',fieldvalinput2); 
                $( "#lnames" ).css('font-family',fieldvalinput2);
              }
        }); 
      }); 
    });

    jQuery(document).ready(function() {
          jQuery('#font-color').on("change", function () {
              var fieldvalinput3= jQuery(this).val();
              $("#cid").val(fieldvalinput3); 
              $( "#hiddenfont-color" ).val(fieldvalinput3); 
              //$( "#cname11" ).text(fieldvalinput3); 
              $( "#preview-p" ).css('color',fieldvalinput3);
              //$( "#mname11" ).css('color',fieldvalinput3); 
              //$( "#lname11" ).css('color',fieldvalinput3);       
      }); 
    });
	
	
	jQuery(document).ready(function() {
          jQuery('#fname').on("change", function () {
            var fieldvalinput4= jQuery(this).val(); 
            $( "#hiddenfname" ).val(fieldvalinput4); 
            $( "#fname1" ).val(fieldvalinput4);
            $( "#fname11" ).text(fieldvalinput4);    
      }); 
    });
	
	
	jQuery(document).ready(function() {
          jQuery('#mname').on("change", function () {
            var fieldvalinput5= jQuery(this).val(); 
            $( "#hiddenmname" ).val(fieldvalinput5); 
			      $( "#mname1" ).val(fieldvalinput5);
				    $( "#mname11" ).text(fieldvalinput5);              
      }); 
    });
	
	
	jQuery(document).ready(function() {
          jQuery('#lname').on("change", function () {
            var fieldvalinput6= jQuery(this).val(); 
			      $( "#hiddenlname" ).val(fieldvalinput6); 
			      $( "#lname1" ).val(fieldvalinput6); 
			      $( "#lname11" ).text(fieldvalinput6);   
      }); 
    });


    jQuery(document).ready(function() {
      jQuery('#myModal').on('shown.bs.modal', function () {
        jQuery('#myInput').trigger('focus')
      }) 
    });


    $(document).ready(function(){
      //jQuery('input').each( function () {
        $("input").change(function(){
          var inputVal1 = document.getElementById("fname").value;
          var inputVal2 = document.getElementById("mname").value;
          var inputVal3 = document.getElementById("lname").value;
          $("#fnames").empty();
          $("#lnames").empty();
          $("#mnames").empty();
          $("#fnames").append(inputVal1);
          $("#lnames").append(inputVal3);
          $("#mnames").append(inputVal2);
          
          //alert(inputVal1);
        });
      //});  
    });


    jQuery(document).ready(function() {
        jQuery('#fonts').each( function () {
          jQuery(this).change( function () {
              var fieldvalinput5= jQuery(this).val(); 
              if (fieldvalinput5 == 'as-snapper-script' || fieldvalinput5 == 'as-graceland'){
                $( "#preview-p" ).css('font-size','45px'); 
              }
              else if (fieldvalinput5 == 'aj-jiggy-roman' || fieldvalinput5 == 'nebraskb'){
                $( "#preview-p" ).css('font-size','55px'); 
              }
              else if (fieldvalinput5 == 'boingo' || fieldvalinput5 == 'frscript'){
                $( "#preview-p" ).css('font-size','70px'); 
              }
              else if (fieldvalinput5 == 'vinemonogram'){
                $( "#preview-p" ).css('font-size','80px'); 
              }
              else if (fieldvalinput5 == 'interlockingvine' || fieldvalinput5 == 'vinesplit'){
                $( "#preview-p" ).css('font-size','90px'); 
              }
              else{
                $( "#preview-p" ).css('font-size','150px');
              }
        }); 
      }); 
    });

    


</script>





<?php
/* Always have wp_footer() just before the closing </body>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to reference JavaScript files.
 */

wp_footer();
?>

</body>

</html>