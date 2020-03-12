<?php
/**
 * @version 0.6
 * 
 * template for participants list shortcode output
 *
 * this is the default template which formats the list of records as a table
 * using shortcut functions to display the componenets
 *
 * If you need more control over the display, look at the detailed template
 * (pdb-list-detailed.php) for an example of how this can be done
 *
 */
?>
<div class="wrap <?php echo $this->wrap_class ?>" id="<?php echo $this->list_anchor ?>">
  <?php
  /*
   * SEARCH/SORT FORM
   *
   * the search/sort form is only presented when enabled in the shortcode.
   *
   */
  $this->show_search_sort_form();

  /* LIST DISPLAY */
  /*
   * NOTE: the container for the list itself (excluding search and pagination 
   * controls) must have a class of "list-container" for AJAX search/sort to 
   * function
   */
  ?>
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
  
  
  <div class="shakeel wp-list-table widefat fixed pages list-container" >

    <?php if ( has_action( 'pdb-prepend_to_list_container_content' ) ) : ?>
      <caption>
        <?php do_action( 'pdb-prepend_to_list_container_content' ) ?>
        <?php $this->print_list_count( '<div class="%s"><span class="list-display-count">' ) ?>
      </caption>
    <?php else : ?>
      <?php
      /* print the count if enabled in the shortcode
       * 
       * the tag wrapping the count statment can be supplied in the function argument, example here
       */
      $this->print_list_count( '<caption class="%s" ><span class="list-display-count">' );
      ?>
    <?php endif ?>


    <?php 
	
	
	
	if ( $record_count > 0 ) : // print only if there are records to show ?>

      <!--<thead>
        <tr>
          <?php
          /*
           * this function prints headers for all the fields
           * replacement codes:
           * %2$s is the form element type identifier
           * %1$s is the title of the field
           */
         // $this->print_header_row( '<th class="%2$s" scope="col">%1$s</th>' );
         // http://cslainstitute.perfectwebsoldev.com/wp-content/uploads/participants-database/
          ?>
        </tr>
      </thead>-->

      <div class="my-block">
      <div class="container mysearch-page">
				<div class="row">
        <?php
          $filter = $_POST['search_field'];
          $svalue = $_POST['value'];
          global $wpdb;
          $query = "SELECT `first_name`,`last_name`,`id`,`photo`,`client_specialties`,`designations`,`photograph`,`description` FROM `wp_participants_database` WHERE $filter LIKE '%%$svalue%%'";
          $results = $wpdb->get_results($query);
          //echo '<pre>';
          //print_r($results);
          //echo'</pre>';
          foreach ($results as $result){
            ?>
            <div class="col-sm-4">
            <div class="card" style="">
                <div class="row cardheader">
                  <div class="col-sm-6">
                  <?php
                  if($result->photograph == ""){
                    ?><img width="225" height="219" src="http://cslainstitute.perfectwebsoldev.com/wp-content/uploads/2020/01/meagan_landress.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""><?php
                  }
                  else{
                    ?><img width="225" height="219" src="http://cslainstitute.perfectwebsoldev.com/wp-content/uploads/participants-database/<?php echo $result->photograph; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""><?php
                  }
                  ?>
                   
                  </div>
                  <div class="col-sm-6">
                      <h5><?php echo $result->first_name.' '.$result->last_name; ?></h5>
                      <p><?php echo $result->designations; ?></p>
                  </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">CLIENT SPECIALTIES</h5>
                    <p class="card-text"><?php echo $result->client_specialties; ?></p>
                    <h5 class="card-title">QUICK BIO</h5>
                    <p class="card-text"></p><p><?php echo $result->description; ?></p>
<p></p>
                    <p><a href="http://cslainstitute.perfectwebsoldev.com/single-db-participant/?aid=<?php echo $result->id; ?>" class="btn btn-primary">View Advisor Profile</a></p>
                    <!-- <a href="#" class="btn btn-primary"></a> -->
                </div>
              </div>
            </div>
        

            <?php
          }
        ?>
        </div>
        </div>
      </div>
<!-- -->

<!-- -->
<?php else : // if there are no records  ?>

      <div class="tbody">
        <div class="error">
          <div class="err-1"><?php if ( $this->is_search_result ) echo Participants_Db::plugin_setting('no_records_message') ?></div>
        </div>
      </div>

<?php endif; // $record_count > 0  ?>

  </div>
  <?php
  /*
   * this shortcut function presents a pagination control with default layout
   */
  $this->show_pagination_control();
  ?>
</div>