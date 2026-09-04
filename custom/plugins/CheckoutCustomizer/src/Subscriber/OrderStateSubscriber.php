<?php declare(strict_types=1);

namespace CheckoutCustomizer\Subscriber;

use CheckoutCustomizer\Service\EmailService;
use Psr\Log\LoggerInterface;
use Shopware\Core\Checkout\Order\Event\OrderStateMachineStateChangeEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OrderStateSubscriber implements EventSubscriberInterface
{
    public function __construct(private EmailService $emailService, private LoggerInterface $logger) {}

    public static function getSubscribedEvents(): array
    {
        return [
            'state_enter.order.state.completed' => 'onOrderCompleted',
        ];
    }

    public function onOrderCompleted(OrderStateMachineStateChangeEvent $event): void
    {
        $order = $event->getOrder();
        $customer = $order->getOrderCustomer();

        if (!$customer) {
            return;
        }

        $to = $customer->getEmail();
        $subject = 'Ihre Bestellung wurde abgeschlossen';
        $body = sprintf('Bestellung %s wurde erfolgreich abgeschlossen.', $order->getOrderNumber());

        try {
            $this->emailService->send($to, $subject, $body);
        } catch (\Throwable $e) {
            $this->logger->error('Email API failed', [
                'orderId' => $order->getId(),
                'error' => $e->getMessage(),
            ]);
        }
    }
}
