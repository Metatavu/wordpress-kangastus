<?php
  namespace Metatavu\Kangastus\Kangastus;
  
  if (!defined('ABSPATH')) { 
    exit;
  }
  
  if (!class_exists( 'Metatavu\Pakkasmarja\ChatThreads\ChatThreadsRest' ) ) {
    
    class ChatThreadsRest {
      
      public function __construct() {
        register_rest_field( 'kangastus', 'tags', [
          'get_callback' => [$this, 'getTags'],
          'update_callback' => null,
          'schema' => [
            "type" => "array",
        	  "description" => "Tags",
            "items" => [
              "type" => "string"
            ] 
          ]
        ]);
        
        register_rest_field( 'kangastus', 'tagsSearch', [
          'get_callback' => [$this, 'getTagsSearch'],
          'update_callback' => null,
          'schema' => [
            "type" => "string",
        	  "description" => "Tag searchs"
          ]
        ]);
        
        register_rest_field( 'kangastus', 'colorMask', [
          'get_callback' => [$this, 'getColorMask'],
          'update_callback' => null,
          'schema' => [
        	"type" => "string",
        	"description" => "Color mask"
          ] 
        ]);
      }

      public function getTags($object) {
        $result = [];
        $terms = wp_get_post_terms( $object[ 'id' ], 'kangastus_categories');
        
        foreach ($terms as $term) {
          $result[] = $term->slug;
        }
        
        return $result;
      }
      
      public function getTagsSearch($object) {
        return '|' . implode('|', $this->getTags($object)) . '|';
      }
      
      public function getColorMask($object) {
        $value = get_post_meta($object[ 'id' ], 'kangastus-color-mask', true);
      	if ($value) {
      	  return $value;
      	}
      	
      	return null;
      }

    }
  
  }
  
  add_action('rest_api_init', function () {
    new ChatThreadsRest();
  });
  
?>