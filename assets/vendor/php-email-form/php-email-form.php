<?php
class PHP_Email_Form
{
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $smtp;

    public function add_message($content, $label = '')
    {
        if ($label && $content) {
            return $label . ": " . $content . "\n";
        }
        return '';
    }

    public function send()
    {
        if (empty($this->to) || empty($this->from_name) || empty($this->from_email) || empty($this->subject)) {
            return 'Error: Missing required fields.';
        }

        $headers = "From: {$this->from_name} <{$this->from_email}>" . "\r\n";
        $headers .= "Reply-To: {$this->from_email}" . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8" . "\r\n";

        // Uncomment and modify the following section if you want to use SMTP to send emails
        /*
        if ($this->smtp) {
            $smtp_host = $this->smtp['host'];
            $smtp_username = $this->smtp['username'];
            $smtp_password = $this->smtp['password'];
            $smtp_port = $this->smtp['port'];

            // Use the PHPMailer library or other third-party libraries for handling SMTP emails.
            // Implementing SMTP properly is beyond the scope of this simplified example.
        }
        */

        $message = $this->add_message($this->from_name, 'From');
        $message .= $this->add_message($this->from_email, 'Email');
        $message .= $this->add_message($_POST['message'], 'Message', 10);

        if (mail($this->to, $this->subject, $message, $headers)) {
            return 'Email sent successfully!';
        } else {
            return 'Error: Failed to send the email. Please try again later.';
        }
    }
}