<?php
  namespace Metatavu\Kangastus\Kangastus;
  
  if (!defined('ABSPATH')) { 
    exit;
  }
  
  if (!class_exists( '\Metatavu\Kangastus\Kangastus\KangastusWidgets' ) ) {
    
    class KangastusWidgets {
      
      public function __construct() {
        add_action ('add_meta_boxes', [$this, 'addMetaBoxes'], 9999, 2 );
        add_action ('save_post', [$this, 'saveLink']);
        wp_enqueue_script('kangastus-widget', plugin_dir_url(__FILE__) . 'kangastus-widget.js', array( 'cs-wp-color-picker' ), false, true);
        wp_enqueue_style('wp-color-picker');
      }
      
      public function addMetaBoxes() {
      	add_meta_box('kangastus-properties-meta-box', 'Kangastus', [$this, 'renderKangastusMetaBox'], 'kangastus', 'side', 'default');
      }
      
      public function renderKangastusMetaBox($kangastus) {
      	$colorMask = get_post_meta($kangastus->ID, "kangastus-color-mask", true);
        $this->renderMetaBoxField('Peiteväri', "kangastus-color-mask", "text", $colorMask);
      }
      
      private function renderMetaBoxField($title, $name, $type, $value) {
      	echo "<p>";
      	echo sprintf('<label for="%s">%s</label>',  $name, $title);
     	  echo sprintf('<p><input name="%s" id="%s" type="%s" style="%s" value="%s"/></p>', $name, $name, $type, "width: 100%", $value);
      	echo "</p>";
      }
      
      public function saveLink($kangastusId) {
      	foreach (['kangastus-color-mask'] as $key) {
      	  if (array_key_exists($key, $_POST)) {
      		  update_post_meta($kangastusId, $key, $_POST[$key]);
      	  } else {
      	  	delete_post_meta($kangastusId, $key);
      	  }
        }
      }
    }
  
  }
  
  add_action('init', function () {
    new KangastusWidgets();
  });
  
?>