<?php
/**
 * Created by PhpStorm.
 * Project :  caladea-slack.
 * User: hadie MacBook
 * Date: 24/07/20
 * Time: 06.36
 */

class Caladea_Slack_Caldera{

    private static $_instance = null;

    private $plugin;

    public function __construct($plugin )
    {

        $this->plugin = $plugin;
        add_filter('caldera_forms_get_form_processors', array($this, 'register'));
        add_filter('caldera_forms_submit_complete', array($this, 'sent_message'), 10, 4);

    }

    /**
     * @return Caladea_Slack_Caldera|null
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }



    public function register($processors){
        $processors['caladea_slack_plugin'] = array(
            'name' => 'Caladea Slack',
            'description' => 'Sent Notification to slack channel on submission',
            'icon' =>  CALADEA_SLACK_URL.'/assets/images/slack.svg',
            'template' =>  CALADEA_SLACK_PATH.'includes/templates/config.php',
            'author' => 'Theme.id',
            'author_url' => 'https://caladea.com',
        );
        return $processors;
    }

    public static function fields(){
        return array(
            array(
                'id' => '_hook_url',
                'type' => 'text',
                'required' => true,
                'block' => true,
                'magic' => false,
                'label' => __('Hook Url', 'caladea-slack'),
            ),
          array(
              'id' => '_user_name',
              'type' => 'text',
              'required' => true,
              'block' => true,
              'desc' => __('The name of Bot that will be display in message','caladea-slack'),
              'label' => __('Bot Name','caladea-slack'),
          ),
            array(
                'id' => '_channel_name',
                'type' => 'text',
                'required' => false,
                'desc' => __('Overrides the default channel for this web hook (e.g #myChannel) or leave blank to use default','caladea-slack'),
                'block' => true,
                'label' => __('Channel Name', 'caladea-slack'),
            ),
            array(
                'id' => 'icon_emoji',
                'type' => 'text',
                'required' => false,
                'desc' => __('You can put URL (https://domain.com/image.png) or emoji (:taco:)  here','caladea-slack'),
                'block' => true,
                'label' => __('Icon', 'caladea-slack'),
            ),


        );
    }


    public function sent_message($form, $referrer, $process_id, $entryid){
        $config = $this->find_config($form, 'caladea_slack_plugin');
        $output = array();
        if (is_array($form['processors'])) {
            foreach ($form['processors'] as $key => $processor) {
                if (isset($processor['type'])) {
                    if ($processor['type'] === 'caladea_slack_plugin') {
                        $output[] = $key;
                    }
                }
            }
        }

        if (count($output) >= 2) {
            foreach ($output as $value) {
                $config = $form['processors'][$value]['config'];
                $this->process($config,$entryid);
            }
        }elseif ($config){
            $this->process($config,$entryid);
        }

    }


    private function process($config,$entryid){
        $hooks_url =  \Caldera_Forms::do_magic_tags($config['_hook_url'], $entryid);
        $channel_name =  \Caldera_Forms::do_magic_tags($config['_channel_name'], $entryid);
        $_user_name =  \Caldera_Forms::do_magic_tags($config['_user_name'], $entryid);
        $_message =  \Caldera_Forms::do_magic_tags($config['_message'], $entryid);
        $icon_emoji =  \Caldera_Forms::do_magic_tags($config['icon_emoji'], $entryid);

        $data = array();
        $data['text'] = $_message;


        if ($channel_name !=''){
            $data['channel'] = $channel_name;
        }
        if ($_user_name !=''){
            $data['username'] = esc_attr($_user_name);
        }

        if ($icon_emoji !=''){
            if (wp_http_validate_url($icon_emoji)){
                $data['icon_url'] = esc_url($icon_emoji);
            }else{
                $data['icon_emoji'] = esc_attr($icon_emoji);
            }
        }

        $payloads = [];
        foreach ($data as $key=>$value){
            $payloads[]='"'.$key.'": "'.$value.'"';
        }

        $payloads = 'payload={'.implode(',',$payloads).'}';


        $resp = wp_remote_post( $hooks_url, array(
                'method' => 'POST',
                'timeout' => 30,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'body' => $payloads,
                'cookies' => array()
            )
        );

        $response = [];
        if ( is_wp_error( $resp ) ) {
            return  $resp;
        } else {
            $status  = intval( wp_remote_retrieve_response_code( $resp ) );
            $message = wp_remote_retrieve_body( $resp );
            if ( 200 !== $status ) {
               return new \WP_Error( 'slack_unexpected_response', $message );
            }

            return  $message;
        }

    }


    private function find_array($array, $field, $value){
        if (is_array($array)) {
            foreach ($array as $key => $processor) {
                if( isset($processor[$field])){
                    if ($processor[$field] === $value)
                        return $key;
                }

            }
        }

        return false;
    }

    private function find_config($form, $value){
        if (isset($form['processors'])) {
            $key = $this->find_array($form['processors'], 'type', $value);
            return isset($form['processors'][$key]['config']) ? $form['processors'][$key]['config'] : false;
        }
    }
}
