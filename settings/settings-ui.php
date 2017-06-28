<?php
  namespace Metatavu\Kangastus\Settings;
  
  if (!defined('ABSPATH')) { 
    exit;
  }
  
  define(KANGASTUS_MANAGEMENT_SETTINGS_OPTION, 'kangastus_management');
  define(KANGASTUS_MANAGEMENT_SETTINGS_GROUP, 'kangastus_management');
  define(KANGASTUS_MANAGEMENT_SETTINGS_PAGE, 'kangastus_management');
  
  if (!class_exists( '\Metatavu\Kangastus\Settings\SettingsUI' ) ) {

    class SettingsUI {

      public function __construct() {
        add_action('admin_init', array($this, 'adminInit'));
        add_action('admin_menu', array($this, 'adminMenu'));
      }

      public function adminMenu() {
        add_options_page (__( "Kangastus Settings", 'kangastus_management' ), __( "Kangastus Settings", 'kangastus_management' ), 'manage_options', KANGASTUS_MANAGEMENT_SETTINGS_OPTION, array($this, 'settingsPage'));
      }

      public function adminInit() {
        register_setting(KANGASTUS_MANAGEMENT_SETTINGS_GROUP, KANGASTUS_MANAGEMENT_SETTINGS_PAGE);
        add_settings_section('settings', __( "Settings", 'kangastus_management' ), null, KANGASTUS_MANAGEMENT_SETTINGS_PAGE);
      }

      private function addOption($group, $name, $title) {
        add_settings_field($name, $title, array($this, 'createFieldUI'), KANGASTUS_MANAGEMENT_SETTINGS_PAGE, $group, [
          'name' => $name, 
          'type' => 'url'
        ]);
      }

      public function createFieldUI($opts) {
        $name = $opts['name'];
        $type = $opts['type'];
        $value = Settings::getValue($name);
        echo "<input id='$name' name='" . KANGASTUS_MANAGEMENT_SETTINGS_PAGE . "[$name]' size='42' type='$type' value='$value' />";
      }

      public function settingsPage() {
        if (!current_user_can('manage_options')) {
          wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

        echo '<div class="wrap">';
        echo "<h2>" . __( "Kangastus Management", 'kangastus_management') . "</h2>";
        echo '<form action="options.php" method="POST">';
        settings_fields(KANGASTUS_MANAGEMENT_SETTINGS_GROUP);
        do_settings_sections(KANGASTUS_MANAGEMENT_SETTINGS_PAGE);
        submit_button();
        echo "</form>";
        echo "</div>";
      }
    }

  }
  
  if (is_admin()) {
    $settingsUI = new SettingsUI();
  }

?>