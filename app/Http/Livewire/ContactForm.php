<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Snowfire\Beautymail\Beautymail;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $comment;
    public $subject;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'subject' => 'required',
        'comment' => 'required|min:5',
    ];

    public function contactFormSubmit()
    {
        $contact = $this->validate();
        if(config('saas.admin_mail') == null){
            $this->alert('error', __('Please add an admin email on .env file!'));
            return; 
        }

        $data = array(
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'comment' => $this->comment,
        );
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.contact_mail', $data, function ($message) {
            $message
                    ->from(config('mail.from.address'))
                    ->to(config('saas.admin_mail'))
                    ->subject(__('Your Site Contact Form'));
        });

        $this->alert('success', __('Thank you for reaching out to us!'));

        $this->clearFields();
    }

    private function clearFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->subject = '';
        $this->comment = '';
    }
    public function render()
    {
        return view('livewire.contact-form');
    }
}
