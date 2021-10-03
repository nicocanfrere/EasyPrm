<?php

namespace Application\Api\Listener;

use EasyPrm\Core\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

/**
 * Class ValidationListener
 */
class ValidationListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = method_exists($event, 'getThrowable') ? $event->getThrowable() : $event->getException();
        if ($exception instanceof HandlerFailedException) {
            $exception = $exception->getPrevious();
        }
        if (!$exception instanceof ValidationException) {
            return;
        }

        $event->setResponse(
            new JsonResponse(
                [
                    'message' => 'error',
                    'data' => $exception->getErrors()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY,
                [
                    'Content-Type' => 'application/json',
                    'X-Content-Type-Options' => 'nosniff',
                    'X-Frame-Options' => 'deny',
                ]
            )
        );
    }
}
