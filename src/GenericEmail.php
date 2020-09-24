<?php

namespace Manuel90\TesterEmail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenericEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $title = null;
    public $info = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info, $title)
    {
        $this->title = $title;
        $this->info = $info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('testeremail::emailgeneric');
    }
}
