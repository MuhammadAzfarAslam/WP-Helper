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
    <br>
    <label for="more-cus">Do you want more Customization:</label>

        <select id="more-cus">
            <option value="">Please Select An Option</option>
            <option value="no">NO</option>
            <option value="yes">YES</option>
        </select>
    
    <div class="more-customization">
        <br/>
        <label for="fonts">Choose a Font:</label>

        <?php
        $rows = get_field('fonts', 6786); // 6786 is page id
        if($rows)
        {
        	echo '<select id="fonts">';
        	foreach($rows as $row)
        	{
        		$str_arr = explode (",", $row['options']);?>
    		<option value="<?php print_r($str_arr[0]) ?>"> <?php
                print_r($str_arr[1]);
        		echo '</option>';
        	}
        	echo '</select>';
        } ?>
    </div>
	
	<div class="form-cus-div">
	<br/>
        <label for="font-color">Choose a Font Color:</label>
        <?php
        $rows = get_field('colors', 6786); // 6786 is page id
        if($rows)
        {
        	echo '<select id="font-color">';
        	foreach($rows as $row)
        	{
        		$str_arr = explode (",", $row['options2']);?>
    		<option value="<?php print_r($str_arr[0]) ?>"> <?php
                print_r($str_arr[1]);
        		echo '</option>';
        	}
        	echo '</select>';
        } ?>
	</div>
	
	
    <div class="form-cus-div1">
     
     <?php  
     
     foreach( wp_get_post_terms( $pid, 'product_cat' ) as $term ){
        if( $term ){
		
            //echo 'Category: ' .$term->slug . '<br>'; // product category name
        }
    
        echo '<form action="https://perfectwebsoldev.com/emilygraceco/custom-page/" method="GET" name="myform">';
        echo '<label for="fname" id="fname1">First Initial: </label><input type="text" id="fname" name="fname">';
        echo '<label for="mname" id="mname1">Middle Initial: </label><input type="text" id="mname" name="mname">'; 
        echo '<label for="lname" id="lname1">Last Initial: </label><input type="text" id="lname" name="lname">';
        // echo '<h3>Preview: </h3><div class="preview-div"><p id="preview-p"></p></div>';
        
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
    echo '<h3 style="font-size: 17px; text-transform: uppercase;">Preview: </h3><div class="preview-div"><p id="preview-p"><span id="fnames"></span><span id="lnames"></span><span id="mnames"></span></p></div>';
    

}