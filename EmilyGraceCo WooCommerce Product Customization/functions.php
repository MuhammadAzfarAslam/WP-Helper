<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	etheme_child_styles();
}


// 1. Display custom fields for variable products
  
add_action( 'woocommerce_before_add_to_cart_form', 'my_funtion_sample', 30 );
function my_funtion_sample() {
  global $product;
  $pid = $product->get_id();
    ?>

    <label for="more-cus">Do you want more Customization:</label>

        <select id="more-cus">
            <option value="">Please Select An Option</option>
            <option value="no">NO</option>
            <option value="yes">YES</option>
        </select>
    
    <div class="more-customization">
        <br/>
        <label for="fonts">Choose a Font:</label>

        <select id="fonts">
            <option value="">Choose A Font</option>
            <option value="as-jiggy-roman">A&amp;S JIGGY ROMAN</option>
            <option value="as-snapper-script">A&amp;S SNAPPER SCRIPT</option>
            <option value="as-graceland">A&amp;S GRACELAND</option>
            <option value="boingo">BOINGO</option>
            <option value="frscript">FRSCRIPT</option>
            <option value="nebraskb">NEBRASKB</option>
            <option value="heartmid">HEART</option>
            <option value="interlockingvine">INTER LOCKING VINE</option>
            <option value="vinemonogram">VINE MONOGRAM</option>
            <option value="vinesplit">VINE SPLIT</option>
            <option value="circlemonogram">CIRCLE MONOGRAM</option>
        </select>
    </div>
	
	<div class="form-cus-div">
	<br/>
        <label for="fonts">Choose a Font Color:</label>
	<select id="font-color">
            <option value="">Choose A Color</option>
            <option value="#fdd26e">Flesh Tan</option>
            <option value="#DDCBA4">Khaki </option>
            <option value="#653819">Chocolate Brown</option>
            <option value="#946037">Teddy</option>
            <option value="#4E3629">Dark Brown</option>
            <option value="#502B3A">Maroon</option>
            <option value="#6C1D45">Light Maroon</option>
            <option value="#8A1538">Cardinal </option>
            <option value="#D22630">Scarlet </option>
            <option value="#E10098">Rhodamine Red</option>
            <option value="#FE5000">Orange</option>
            <option value="#FFBF3F">Light Gold</option>
            <option value="#FFCD00">Primrose </option>
            <option value="#FED141">Lemon</option>
            <option value="#F3D54E">Blazer Gold</option>
            <option value="#D0C883">Vegas Gold</option>
            <option value="#97D700">Lime </option>
            <option value="#009639">Bright Green </option>
            <option value="#046A38">Kelly  </option>
            <option value="#284734">Forest  </option>
            <option value="#40E0D0">Turquoise  </option>
            <option value="#2AD2C9">Paradise Green </option>
            <option value="#00b4e4">Light Blue </option>
            <option value="#0078bf">Solar Blue </option>
            <option value="#6787b7">Columbia</option>
            <option value="#1d4f91">Royal   </option>
            <option value="#001e62">Light Navy  </option>
            <option value="#003057">Navy   </option>
            <option value="#7d55c7">Light Purple  </option>
            <option value="#BB29BB">Purple   </option>
            <option value="#aaa9ad">Metallic Silver  </option>
            <option value="#D4AF37">Metallic Gold  </option>
    </select>
	</div>
	
	
    <div class="form-cus-div1">
     
     <?php  
     
     foreach( wp_get_post_terms( $pid, 'product_cat' ) as $term ){
        if( $term ){
		
            //echo 'Category: ' .$term->slug . '<br>'; // product category name
        }
    
        echo '<form action="https://perfectwebsoldev.com/emilygraceco/custom-page/" method="GET" name="myform">';
        echo '<label for="fname">First Initial: </label><input type="text" id="fname" name="fname">';
		if ($term->slug == 'pants'){
            echo '<label for="mname">Middle Initial: </label><input type="text" id="mname" name="mname">'; 
            //echo '<label for="lname">Last Initial: </label><input type="text" id="lname" name="lname">';
        }
        echo '<input type="hidden" name="pimg" value="'.$pid.'" >';
        echo '<input type="hidden" name="v-id" value="" id="v-id" >';
        echo '<input type="hidden" name="d-name" value="" id="d-id" >';
        echo '<input type="hidden" name="c-name" value="" id="c-id" >';
        //echo '<input type="submit" name="submit" value="Customize"> <br/>';

        }
          echo '</form>';
    echo '</div>';
	
	
	}

// step2:

add_filter( 'woocommerce_add_cart_item_data', 'myaddtocartfun' , 10, 3 );

function myaddtocartfun( $cartItemData, $productId, $variationId ) {
   
      // global $session;
	 if(!empty($_POST['hiddenfontname']))
	 { 
	  $fontname = '<br />Font Name: ' . $_POST['hiddenfontname']."<br />";
	 }
	 else
	 {
	  $fontname = '';
	 }
	 
	 if(!empty($_POST['hiddenfont-color']))
	 { 
	  $fontcolor = 'Font Color: ' . $_POST['hiddenfont-color'] ."<br />";
	  
	 }
	 else
	 {
	  $fontcolor = '';
	 }
	 
	 if(!empty($_POST['hiddenfname'] ))
	 { 
	  $finitial = 'First Initial : ' . $_POST['hiddenfname'] ."<br />";
	 }
	 else
	 {
	  $finitial = '';
	 }
	 
	 
	 if(!empty($_POST['hiddenmname']))
	 { 
	  $minitial = 'Middel Initial: ' . $_POST['hiddenmname'] ."<br />";
	 }
	 else
	 {
	  $minitial = '';
	 }
	 
	 if(!empty($_POST['hiddenlname']))
	 { 
	  $lname = 'Last Initial: ' . $_POST['hiddenlname']."<br />";
	  }
	  else
	 {
	  $lname = '';
	 }
	  
    $cartItemData['myCustomData'] =   $fontname;
	$cartItemData['myCustomData'] .=  $fontcolor;
	$cartItemData['myCustomData'] .=  $finitial;
	$cartItemData['myCustomData'] .=  $minitial;
	$cartItemData['myCustomData'] .=  $lname;
   
 
	return $cartItemData;

	}

// step2.1: 

//add_filter( 'woocommerce_get_cart_item_from_session','myaddtocartsess' , 10, 3 );
/*
function myaddtocartsess( $cartItemData, $cartItemSessionData, $cartItemKey ) {
	
    if (isset($cartItemData['myCustomData'])) {
      
       $cartItemData['myCustomData'] = $cartItemSessionData['myCustomData'];
    }

    return $cartItemSessionData;
	}*/

// Step3 cart and checkout page

add_filter( 'woocommerce_get_item_data', function ( $data, $cartItemData ) {
   
  print_r($cartItemData['myCustomData']);
   
   
   if (empty($cartItemData['myCustomData'])) {
      $data[] =  array(
        'name' => 'NO Customizations',
        'value'   => $cartItemData['myCustomData']    
    );
 
    return $data;
    }
 
}, 10, 2 );

//step 4  adding data in order

add_action( 'woocommerce_add_order_item_meta', function ( $itemId, $values, $key ) {
    if ( isset( $values['myCustomData'] ) ) {
        wc_add_order_item_meta( $itemId, 'Customizations', $values['myCustomData'] );
    }
}, 10, 3 );




// adding preview button in cart


add_action( 'woocommerce_before_single_variation', 'mypreviewbuttn', 30 );

function mypreviewbuttn()
{

   global $product;
   $pid = $product->get_id();

        //   echo '<form action="" method="GET" name="myform" id="myhiddenform">';
        //   echo '<input type="hidden" id="fname1" name="fname">';

        //   echo '<input type="hidden" id="mname1" name="mname">';

        //   echo '<input type="hidden" id="lname1" name="lname">';
        //   echo '<input type="hidden" name="pimg" value="'.$pid.'" >';
        //   echo '<input type="hidden" name="v-id" value="" id="vid" >';
        //   echo '<input type="hidden" name="dname" value="" id="did" >';
        //   echo '<input type="hidden" name="cname" value="" id="cid" >';
        //   echo '<input type="submit" name="submit" value="Preview"> <br/>';
        //   echo '</form>';


          ?>
          
          <!-- Modal HTML embedded directly into document -->

          <?php   foreach( wp_get_post_terms( $pid, 'product_cat' ) as $term ){
                    if( $term ){
                        // If statement for Bags /////////////////////////// 
                        if($term->slug == 'bags'){ ?>            

            <div class="container mt-20 bags">
                <div class="row">
                    <div id="ex1" class="modal">
                    <p>
					   
            <script type="text/javascript">				   
                jQuery(document).ready(function(e) {
                    $('#mypopup').click(function(){
                            var imgsrc=$('.swiper-slide-active img').attr('src');
                            $('#myimg').attr("src", imgsrc);
                            
                        // alert("Image Source Is :"+ imgsrc);
                        });
                    });
					
            </script>
					   
					   
					   
                        <div id="fname11"></div>
                        <img src="" alt="Bags" id="myimg">
                        <div id="productname"><?php echo $product->get_name(); ?></div>
                        <!-- <div id="mname11"></div>
                        <div id="lname11"></div> -->
                        <div id="pimg"></div>
                        <div id="pimg"></div>
                        <div id="v-id11"></div>
                        <div id="dname11"></div>
                        <div id="cname11"></div>  
                        <?php 
                            foreach( wp_get_post_terms( $pid, 'product_cat' ) as $term ){
                                if( $term ){
                                    echo 'Category: ' .$term->name . '<br>'; // product category name
                                }
                            }
                        ?>                  
                    <a href="#"  rel="modal:close">Close</a>
                    </div>
                </div>
            </div>
      
            <?php 
                        }
                    // Else IF statement for Mousepad ///////////////////////////
                    elseif($term->slug == 'mouse-pads'){ ?> 
                        <div class="container mt-20 mouse-pad">
                        <div class="row">
                            <div id="ex1" class="modal">
                            <p>
                               
                    <script type="text/javascript">				   
                        jQuery(document).ready(function(e) {
                            $('#mypopup').click(function(){
                                    var imgsrc=$('.swiper-slide-active img').attr('src');
                                    $('#myimg').attr("src", imgsrc);
                                    
                                // alert("Image Source Is :"+ imgsrc);
                                });
                            });
                    </script>
                               
                               
                               
                                <div id="fname11"></div> 
                                <p>Mouse Pad Container</p>
                                <img src="" alt="Mouse Pad" id="myimg">
                                <div id="productname"><?php echo $product->get_name(); ?></div>
                                <!-- <div id="mname11"></div>
                                <div id="lname11"></div> -->
                                <div id="pimg"></div>
                                <div id="pimg"></div>
                                <div id="v-id11"></div>
                                <div id="dname11"></div>
                                <div id="cname11"></div>  
                                <?php 
                                    foreach( wp_get_post_terms( $pid, 'product_cat' ) as $term ){
                                        if( $term ){
                                            echo 'Category: ' .$term->name . '<br>'; // product category name
                                        }
                                    }
                                ?>                  
                            <a href="#"  rel="modal:close">Close</a>
                            </div>
                        </div>
                    </div>
            <?php       }
						
					// Else IF statement for Pajamas & Robes ///////////////////////////
                    elseif($term->slug == 'pajamas-robes'){ ?> 
                        <div class="container mt-20 mouse-pad">
                        <div class="row">
                            <div id="ex1" class="modal">
                            <p>
                               
                    <script type="text/javascript">				   
                        jQuery(document).ready(function(e) {
                            $('#mypopup').click(function(){
                                    var imgsrc=$('.swiper-slide-active img').attr('src');
                                    $('#myimg').attr("src", imgsrc);
                                    
                                // alert("Image Source Is :"+ imgsrc);
                                });
                            });
                    </script>
                               
                               
                               
                                <div id="fname11"></div> 
                                <p>Pajamas and Robes Container</p>
                                <img src="" alt="Pajamas and Robes" id="myimg">
                                <div id="productname"><?php echo $product->get_name(); ?></div>
                                <!-- <div id="mname11"></div>
                                <div id="lname11"></div> -->
                                <div id="pimg"></div>
                                <div id="pimg"></div>
                                <div id="v-id11"></div>
                                <div id="dname11"></div>
                                <div id="cname11"></div>  
                                <?php 
                                    foreach( wp_get_post_terms( $pid, 'product_cat' ) as $term ){
                                        if( $term ){
                                            echo 'Category: ' .$term->name . '<br>'; // product category name
                                        }
                                    }
                                ?>                  
                            <a href="#"  rel="modal:close">Close</a>
                            </div>
                        </div>
                    </div>
            <?php       }	
						
                    // Else statement for Anonymous ///////////////////////////
                    else{
                        echo '<p>Hello World</p>';
                    }
                    }
                }
            ?>			

            <!-- Link to open the modal -->
            <p><a href="#ex1" id="mypopup" rel="modal:open">Preview</a></p>

          <?php

}