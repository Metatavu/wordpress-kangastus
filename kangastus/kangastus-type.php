<?php
  namespace Metatavu\Kangastus\Kangastus;
  
  if (!defined('ABSPATH')) { 
    exit;
  }
  
  add_action ('init', function () {
    register_post_type ( 'kangastus', array (
      'labels' => array (
        'name'               => __( 'Kangastukset', 'kangastus_management'),
        'singular_name'      => __( 'Kangastus', 'kangastus_management'),
        'add_new'            => __( 'Lisää Kangastus', 'kangastus_management'),
        'add_new_item'       => __( 'Lisää Kangastus', 'kangastus_management'),
        'edit_item'          => __( 'Muokkaa Kangastusta', 'kangastus_management'),
        'new_item'           => __( 'Uusi Kangastus', 'kangastus_management'),
        'view_item'          => __( 'Näytä Kangastus', 'kangastus_management'),
        'search_items'       => __( 'Etsi Kangastuksia', 'kangastus_management'),
        'not_found'          => __( 'Kangastuksia ei löytynyt', 'kangastus_management'),
        'not_found_in_trash' => __( 'Kangastuksia ei löytynyt roskakorista', 'kangastus_management'),
        'menu_name'          => __( 'Kangastus', 'kangastus_management'),
        'all_items'          => __( 'Kangastus', 'kangastus_management')
      ),
      'menu_icon' => 'dashicons-welcome-view-site',
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'supports' => array (
        'title',
        'editor',
        'thumbnail'
      )
    ));
  });
  
?>