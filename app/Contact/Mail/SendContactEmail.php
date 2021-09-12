<?php

namespace DavorMinchorov\Contact\Mail;

use DavorMinchorov\Contact\DataTransferObjects\ContactDataTransferObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param ContactDataTransferObject $contactDataTransferObject
     */
    public function __construct(public ContactDataTransferObject $contactDataTransferObject)
    {
        $this->contactDataTransferObject = $contactDataTransferObject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->to($this->contactDataTransferObject->getToEmail(), $this->contactDataTransferObject->getToName())
            ->from('info@davorminchorov.com', $this->contactDataTransferObject->fromName.' ('.$this->contactDataTransferObject->fromEmail.')')
            ->subject('Davor Minchorov, you have a message from '.$this->contactDataTransferObject->fromName.' ('.$this->contactDataTransferObject->fromEmail.')')
            ->replyTo($this->contactDataTransferObject->fromEmail, $this->contactDataTransferObject->fromName)
            ->markdown('emails.contact');
    }
}
