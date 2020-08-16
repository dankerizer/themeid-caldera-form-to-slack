<?php
/**
 * Autoloader for the plugin.
 *
 * @package Caladea_Slack
 * @subpackage Autoloader
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class loader using SPL autoloader.
 */
class Caladea_Slack_Autoloader {

    /**
     * Base path supplied when calling register method.
     *
     * @var string
     */
    private static $base_path;

    /**
     * This loader only load class with this prefix.
     *
     * @var string
     */
    private static $class_prefix;

    /**
     * Registers Autoloader as an SPL autoloader.
     *
     * @param string $class_prefix Prefix on class name to be autoloaded.
     * @param string $base_path    Path to load the classes.
     */
    public static function register( $class_prefix, $base_path ) {
        self::$class_prefix = $class_prefix;
        self::$base_path    = $base_path;

        spl_autoload_register( array( __CLASS__, 'autoload' ) );
    }

    /**
     * Handles autoloading of classes.
     *
     * @param string $classname Class name.
     */
    public static function autoload( $classname ) {
        if ( false === strpos( $classname, self::$class_prefix . '_' ) ) {
            return;
        }

        $classname_without_prefix = str_replace( self::$class_prefix . '_', '', $classname );

        $filename  = str_replace( '_', '-', strtolower( $classname_without_prefix ) );

        require_once self::$base_path . $filename . '.php';
    }
}
