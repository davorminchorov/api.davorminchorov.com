<?php

namespace DavorMinchorov\Contact\DataTransferObjects;

use DavorMinchorov\Contact\Api\V1\FormRequests\ContactFormRequest;
use Spatie\DataTransferObject\DataTransferObject;

class ContactDataTransferObject extends DataTransferObject
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $message;

    /**
     * Populates the properties of the data transfer object from the request object.
     *
     * @param ContactFormRequest $contactFormRequest
     *
     * @return ContactDataTransferObject
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public static function fromRequest(ContactFormRequest $contactFormRequest): self
    {
        return new self([
            'name' => $contactFormRequest->input('name'),
            'email' => $contactFormRequest->input('email'),
            'message' => $contactFormRequest->input('message'),
        ]);
    }
}
