<?php

namespace DavorMinchorov\Contact\Actions;

use DavorMinchorov\Contact\DataTransferObjects\ContactDataTransferObject;
use DavorMinchorov\Contact\Mail\SendContactEmail;
use Illuminate\Contracts\Mail\Mailer;

class ContactAction
{
    /**
     * ContactAction constructor.
     *
     * @param Mailer $mailer
     */
    public function __construct(private Mailer $mailer)
    {
        //
    }

    /**
     * Log the administrator in the administration panel.
     *
     * @param ContactDataTransferObject $contactDataTransferObject
     */
    public function __invoke(ContactDataTransferObject $contactDataTransferObject): void
    {
        $this->mailer->queue(new SendContactEmail($contactDataTransferObject->toArray()));
    }
}
