<?php
/**
 Template Name: fonts and colors Page
 * 
 */

get_header();
?>


<?php


//print_r($str_arr); 
// $rows = get_field('fonts2');
// $str_arr = explode (",", $rows);
// if($rows)
// {
// 	echo '<ul>';

// 	foreach($rows as $row)
// 	{
// 		$str_arr = explode (",", $row['options']);
// 		echo '<li>';
// 		print_r($str_arr[0]);
// 		print_r($str_arr[1]);
// 		echo '</li>';
// 		//echo '<li>Title = ' .$row['options'].'</li>';
// 	}

// 	echo '</ul>';
// }
////////////////////////////////////
echo "Choose Your Font";

//print_r($str_arr); 
$rows = get_field('fonts');
//$str_arr = explode (",", $rows);
if($rows)
{
	echo '<select id="fonts">';

	foreach($rows as $row)
	{
		$str_arr = explode (",", $row['options']); ?>
		<option value="<?php print_r($str_arr[0]) ?>"> <?php
        print_r($str_arr[1]);
		echo '</option>';
		//echo '<li>Title = ' .$row['options'].'</li>';
	}

	echo '</select>';
}

////////////////////////////////////

echo "Choose Your Color";

$rows = get_field('colors');
//$str_arr = explode (",", $rows);
if($rows)
{
	echo '<select id="font-color">';

	foreach($rows as $row)
	{
		$str_arr = explode (",", $row['options2']); ?>
		<option value="<?php print_r($str_arr[0]) ?>"> <?php
        print_r($str_arr[1]);
		echo '</option>';
		//echo '<li>Title = ' .$row['options'].'</li>';
	}

	echo '</select>';
}

?>



<?php get_footer();
