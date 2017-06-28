<?php
  namespace Metatavu\Kangastus\Settings;
  
  if (!defined('ABSPATH')) { 
    exit;
  }
  
  require_once('settings-ui.php');  
  
  define(KANGASTUS_MANAGEMENT_SETTINGS_OPTION, 'kangastus_management');
  
  if (!class_exists( '\Metatavu\Kangastus\Settings\Settings' ) ) {

    class Settings {

      public static function getValue($name) {
        $options = get_option(KANGASTUS_MANAGEMENT_SETTINGS_OPTION);
        if ($options) {
          return $options[$name];
        }

        return null;
      }
      
    }

  }
  

?>