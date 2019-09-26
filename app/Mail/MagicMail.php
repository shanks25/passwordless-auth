<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MagicMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $options;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,array $options)
    {
        $this->user = $user;
        $this->options = $options;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Magic Login Link')->view('email')->with([
            'link' =>$this->buildLink(),
        ]);
    }

    protected function buildLink()
    {
        return url('login/magic/'.$this->user->token->token.'?'.http_build_query($this->options));
    }
}
