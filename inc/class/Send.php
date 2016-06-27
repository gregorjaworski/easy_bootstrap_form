<?php
namespace Wsph\Ebf;

/**
 * Description of Send
 *
 * @author grzegorz
 */
class Send {

    private $result = FALSE;
    private $send_success = 'Dziękujemy, wiadomość została wysłana';
    private $send_error = 'Przykro nam, ale wystąpił błąd podczas wysyłania wiadomości';
    private $to = 'office@grzegorzjaworski.de';
    private $subject = 'Easy Bootstrap Form - Wiadomość testowa';
    private $message;
    private $headers;
    private $wsph_ebf_name;
    private $wsph_ebf_email;
    private $wsph_ebf_phone;
    private $wsph_ebf_message;

    public function __construct() {
        add_action('wp_ajax_nopriv_wsph_ebf_send', array($this, 'send_message'));
        add_action('wp_ajax_wsph_ebf_send', array($this, 'send_message'));
    }

    public function make_message() {

        $this->wsph_ebf_name = sanitize_text_field($_POST["wsph_ebf_name"]);
        $this->wsph_ebf_email = sanitize_email($_POST["wsph_ebf_email"]);
        $this->wsph_ebf_phone = sanitize_text_field($_POST["wsph_ebf_phone"]);
        $this->wsph_ebf_message = sanitize_text_field($_POST["wsph_ebf_message"]);


        $this->headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
        $this->headers .= "Reply-To: " . $this->wsph_ebf_email . "" . "\r\n";

        $this->message = sprintf(__('Message from <b>%1s</b><br>', 'wsph_ebf'), $this->wsph_ebf_name
        );
        if ($this->wsph_ebf_email !== '') {
            $this->message .= sprintf(__('Email: <b>%1s</b><br>', 'wsph_ebf'), $this->wsph_ebf_email);
        }
        if ($this->wsph_ebf_phone !== '') {
            $this->message .= sprintf(__('Phone: <b>%1s</b><br>', 'wsph_ebf'), $this->wsph_ebf_phone);
        }        
        $this->message .= '<br>-------------------------------<br>';
        $this->message .= $this->wsph_ebf_message;
    }

    public function send_message() {
        if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->make_message();
            $this->result = wp_mail($this->to, $this->subject, $this->message, $this->headers);

            if ($this->result === TRUE) {
                wp_send_json_success(__($this->send_success, 'wsph_ebf'));
            } else {
                wp_send_json_error(__($this->send_error, 'wsph_ebf'));
            }
        }
    }
}
