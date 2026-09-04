<?php declare(strict_types=1);

namespace CheckoutCustomizer\Controller;

use CheckoutCustomizer\Service\EmailService;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[RouteScope(scopes: ['store-api'])]
class EmailController
{
    public function __construct(private EmailService $emailService) {}

    #[Route(path: '/api/_action/checkout-customizer/send-email', name: 'api.action.checkout-customizer.send-email', methods: ['POST'], defaults: ['_acl' => ['admin' => true]])]
    public function sendEmail(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $to = $data['to'] ?? '';
        $subject = $data['subject'] ?? '';
        $body = $data['body'] ?? '';
        foreach([$data[$to], $data[$subject], $data[$body]]as $field){
            if (!empty ($field)) {
                return new JsonResponse([ 'success' => false, 'message' => 'Invalid field values' ], 400);
            }
            
        }

        if (!$to || !$subject || !$body) {
            return new JsonResponse(['success' => false, 'message' => 'Missing fields'], 400);
        }

        try {
            $this->emailService->send($to, $subject, $body);
            return new JsonResponse(['success' => true]);
        } catch (\Throwable $e) {
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
