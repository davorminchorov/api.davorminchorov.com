<?php

namespace DavorMinchorov\Contact\Api\V1\Controllers;

use DavorMinchorov\Contact\Actions\ContactAction;
use DavorMinchorov\Contact\Api\V1\FormRequests\ContactFormRequest;
use DavorMinchorov\Contact\DataTransferObjects\ContactDataTransferObject;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class ContactController
{
    /**
     * ContactController constructor.
     *
     * @param ContactAction $contactAction
     */
    public function __construct(private ContactAction $contactAction)
    {
        //
    }

    /**
     * Contact the administrator via email.
     *
     * @param ContactFormRequest $contactFormRequest
     *
     * @return Response
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __invoke(ContactFormRequest $contactFormRequest): Response
    {
        ($this->contactAction)(contactDataTransferObject: ContactDataTransferObject::fromRequest($contactFormRequest));

        return new Response(content: null, status: SymfonyResponse::HTTP_NO_CONTENT);
    }
}
