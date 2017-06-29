<?php
  namespace Metatavu\Kangastus\Kangastus;
  
  if (!defined('ABSPATH')) { 
    exit;
  }
  
  add_action('init', function () {
  	register_taxonomy('kangastus_categories', 'kangastus', [
  	  'label' =>  'Kangastus kategoriat',
  	  'rewrite' => array( 'slug' => 'categories' ),
  	  'show_ui' => true
  	]);
  	
  });
  
?>
