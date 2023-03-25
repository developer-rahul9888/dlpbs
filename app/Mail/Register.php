<?php
 
namespace App\Mail;
 
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
 
class Register extends Mailable
{
    use Queueable, SerializesModels;
 
    /**
     * The Customer instance.
     *
     * @var \App\Models\Customer
     */
    protected $customer;
 
    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function __construct()
    {
       // $this->customer = $customer;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('fxearner@gmail.com', 'fxearner')->view('emails.register');
    }
}