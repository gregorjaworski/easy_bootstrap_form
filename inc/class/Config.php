<?php
namespace Wsph\Ebf;

/**
 * Description of Config
 *
 * @author grzegorz
 */
class Config {

    public function __construct() {
        add_shortcode('ebf', array($this, 'schortcode'));
        add_action('init', array($this, 'wsph_ebf_load_textdomain'));
//        add_action('wp_enqueue_scripts', array($this, 'inc_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'js_localize'));
    }

    public function wsph_ebf_load_textdomain() {
        load_plugin_textdomain('wsph_ebf', 'false', 'easy-bootstrap-form/lang');
    }

    public function js_localize() {

        $protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';

        $wsph_ebf_validation_setup = array(
            'ajaxurl' => admin_url('admin-ajax.php', $protocol),
            'emptyName' => __('Please enter name or surname', 'wsph_ebf'),
            'wrongName' => __('In this field are allowed only letters and the sign "-"', 'wsph_ebf'),
            'emptyContact' => __('Please enter e-mail or phone number', 'wsph_ebf'),
            'wrongMail' => __('Please enter a valid email address', 'wsph_ebf'),
            'wrongPhone' => __('Please enter a phone number in the format "012345678" or "+4812345678"', 'wsph_ebf'),
            'emptyMessage' => __('Please write a few words, how can I help you', 'wsph_ebf')
        );

        wp_localize_script('wsph_ebf_validation', 'wsph_ebf_validation_setup', $wsph_ebf_validation_setup);
    }

//    public function inc_scripts() {
//        wp_enqueue_script(
//                'wsph_ebf_validation', plugin_dir_url(__FILE__) . '/../../js/wsph_ebf_validation.js', FALSE, '1.0', TRUE
//        );
//    }

    public function schortcode() {
        $new_form = new \Wsph\Ebf\Form;
        return $new_form->get_form('default');
    }

}
