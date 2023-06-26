<?php

declare(strict_types=1);

namespace App\Listeners;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Rental;
use App\Services\PriceCalculator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RentalSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly PriceCalculator $priceCalculator,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['setPrice', EventPriorities::PRE_WRITE],
        ];
    }

    public function setPrice(ViewEvent $event): void
    {
        $rental = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$rental instanceof Rental || Request::METHOD_POST !== $method) {
            return;
        }

        $rental->setPrice($this->priceCalculator->getPrice($rental));
        $event->setControllerResult($rental);
    }
}
