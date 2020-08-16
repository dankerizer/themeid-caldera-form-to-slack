<?php
/**
 * Created by PhpStorm.
 * Project :  caladea-slack.
 * User: hadie MacBook
 * Date: 24/07/20
 * Time: 06.34
 */

class Caladea_Slack_Plugin {

        public $name;

        public  $version;
        public  $plugin_path;
        public  $plugin_url;
        public  $includes_path;


    public function run($path){

        $this->name    = 'caladea_slack';

        $this->version = '0.6.0';

        $this->plugin_path   = trailingslashit( plugin_dir_path( $path ) );
        $this->plugin_url    = trailingslashit( plugin_dir_url( $path ) );
        $this->includes_path = $this->plugin_path . trailingslashit( 'includes' );



      new Caladea_Slack_Caldera($this);
    }
}
