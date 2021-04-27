<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Snowfire\Beautymail\Beautymail;

class Payments extends Component
{
    public $paymentMethods = [];

    public function mount()
    {
        $this->getPayment();
    }

    public function getPayment()
    {
        $this->paymentMethods = currentTeam()->paymentMethods()->map(function ($paymentMethod) {
            return $paymentMethod->asStripePaymentMethod();
        });
    }

    public function delete($id)
    {
        $paymentMethod = currentTeam()->findPaymentMethod($id);
        $paymentMethod->delete();

        $this->dispatchBrowserEvent('swal', ['title' => __('Payment method has been deleted !'), 'icon'=> 'success', 'toast'=>true, 'timerProgressBar'=> true, 'position'=>'top-right']);
        $this->getPayment();
    }

    public function makeDefault($paymentID)
    {
        currentTeam()->updateDefaultPaymentMethod($paymentID);

        // $beautymail = app()->make(Beautymail::class);
        // $beautymail->send('emails.subscription.card', ['user' => currentTeam()->owner], function ($message) {
        //     $message
        //         ->from(config('mail.from.address'))
        //         ->to(currentTeam()->owner->email)
        //         ->subject(__('Default payment method changed'));
        // });

        $this->getPayment();
        $this->alert('success', __('Payment method has been updated !'));
        // $this->dispatchBrowserEvent('swal', ['title' => __('Payment method has been updated !'), 'icon'=> 'success', 'toast'=>true, 'timerProgressBar'=> true, 'position'=>'top-right']);
    }

    public function render()
    {
        return view('livewire.payments');
    }
}
