<?php


namespace App\EventSubscriber;
use App\Controller\Interfaces\TokenControllerInterface;
use App\Service\AuthService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TokenSubscriber implements EventSubscriberInterface
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }

    public function onKernelController(ControllerEvent $controllerEvent)
    {
        $controller = $controllerEvent->getController();

        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof TokenControllerInterface)
        {
            if(!$this->authService->supports($controllerEvent->getRequest()))
            {
                throw  new HttpException(Response::HTTP_UNAUTHORIZED, "invalid token");
            }
        }
    }
}