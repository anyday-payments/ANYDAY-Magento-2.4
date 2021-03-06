<?php
declare(strict_types=1);

namespace Anyday\PaymentAndTrack\Controller\Payment;

use Magento\Checkout\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\Order;

class Cancel extends Action implements HttpGetActionInterface, HttpPostActionInterface
{
    /**
     * @var Session
     */
    private $checkoutSession;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * Cancel constructor.
     *
     * @param Context $context
     * @param Session $checkoutSession
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        Context $context,
        Session $checkoutSession,
        OrderRepositoryInterface $orderRepository
    ) {
        parent::__construct($context);
        $this->checkoutSession  = $checkoutSession;
        $this->orderRepository  = $orderRepository;
    }

    /**
     * Update status order and status order
     *
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $orderId = $this->checkoutSession->getLastOrderId();
        /** @var Order $order */
        $order = $orderId ? $this->orderRepository->get($orderId) : false;
        if ($order && $order->getId()) {
            $this->orderRepository->save($order->cancel());
            $this->checkoutSession->restoreQuote();
            $this->messageManager->addSuccessMessage(
                __('ANYDAY Order have been canceled.')
            );
        } else {
            $this->messageManager->addErrorMessage(
                __('Not Load Order.')
            );
        }

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('checkout/cart');
    }
}
