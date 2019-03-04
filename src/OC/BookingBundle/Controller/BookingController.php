<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 05/02/2019
 * Time: 16:54
 */

namespace OC\BookingBundle\Controller;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use OC\BookingBundle\Entity\Ticket;
use OC\BookingBundle\Form\TicketType;
use Stripe\Error\Api;
use Stripe\Error\Card;
use Stripe\Stripe;
use Stripe\Charge;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;

class BookingController extends Controller {

    public function bookAction($id, Request $request)
    {
        $booking = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCBookingBundle:Booking')
            ->findOneById($id);

        if (is_null($booking))
        {
            $session = $request->getSession();
            $session->getFlashBag()->add('error_id', 'La commande que vous avez demandé n\' à pas été trouvée.');
            return $this->redirectToRoute('oc_booking_homepage');
        }

        $ticketsLimit = $booking->getNbTickets();

        $clientTickets = [
            'tickets' => [
                []
            ]
        ];

        for ($i=1; $i<$ticketsLimit;$i++)
        {

            $x =  [
                'field1', 'lastname',
                'field2', 'firstname',
                'field3', 'birthdayDate',
                'field4', 'country',
                'field5', 'reducPrice'
            ];

            array_push($clientTickets['tickets'], $x);
        }


        $ticketForm = $this->createFormBuilder($clientTickets)
            ->add('tickets', CollectionType::class, array('entry_type' =>  TicketType::class))
            ->getForm();

        if($request->isMethod('POST'))
        {
            $ticketForm->handleRequest($request);

            if($ticketForm->isSubmitted() && $ticketForm->isValid())
            {
                $datas = $ticketForm->getData();

                $em = $this->getDoctrine()->getManager();
                $service = $this->container->get('oc_bookingbundle.handler');


                foreach ($datas['tickets'] as $data) {
                    $ticket = new Ticket();
                    $ticket->setBooking($booking);
                    $ticket->setFirstname($data["firstname"]);
                    $ticket->setLastname($data["lastname"]);
                    $ticket->setBirthdayDate($data["birthdayDate"]);
                    $ticket->setCountry($data["country"]);
                    $ticket->setReducPrice($data["reducPrice"]);
                    $ticket->setPrice($service->handleBill(
                        $ticket->getBirthdayDate()->format('Y'),
                        $ticket->getBooking()->getVisitType(),
                        $ticket->getReducPrice()));
                    $em->persist($ticket);
                    $em->flush();
                }
                $em->clear();
            }

            return $this->redirectToRoute('oc_booking_checkout', array(
                'id' => $id
            ));
        }


        return $this->render('@OCBooking/Booking/book.html.twig', array(
            'id' => $id,
            'form' => $ticketForm->createView(),
            'order' => $booking
        ));

    }

    public function checkoutAction($id, Request $request)
    {
        $booking = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCBookingBundle:Booking')
            ->findOneById($id);

        if (is_null($booking))
        {
            $session = $request->getSession();
            $session->getFlashBag()->add('error_id', 'La commande que vous avez demandé n\' à pas été trouvée.');
            return $this->redirectToRoute('oc_booking_homepage');
        }

         $tickets = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCBookingBundle:Ticket')
            ->myFinder($id);

        \Stripe\Stripe::setApiKey('sk_test_I6LUeBdgSM4bsBN5MsCXw0yo'); //Stripe API key

        if($request->isMethod('POST'))
        {
           $token = $request->request->get('stripeToken');
           $email = $request->request->get('stripeEmail');
           $total = $request->request->get('total');

           try {
               $charge = \Stripe\Charge::create(array(
                   "amount" => $total * 100,
                   "currency" => "eur",
                   "source" => $token,
                   "description" => 'Paiement Stripe de' .$total .'€ pour la réservation #' . $booking->getId() . '/' . $booking->getBookingToken()
               ));

               //Save charge in charges.log file
               $logger = new Logger('charge');
               $logger->pushHandler(new StreamHandler('./var/logs/charges.log', Logger::NOTICE));
               $logger->addNotice('Contenu ' . $charge);

               //preparing E-mail

               $message = \Swift_Message::newInstance()
                   ->setSubject('Musée du Louvre - Votre réservation [' .$booking->getBookingToken(). ']')
                   ->setFrom('reservation-louvre@omen-design.com')
                   ->setTo($email)
                   ->setContentType('text/html')
                   ->setBody($this->renderView('@OCBooking/Email/email.html.twig', array('order' => $booking, 'tickets' => $tickets)), 'text/html', 'UTF-8');

                $mailer = $this->get('mailer');

                $mailer->send($message);

               //Redirect to homepage after billing
               $this->addFlash('billing_ok', 'Votre commande ' . $booking->getId() . ' est bien enregistrée ! 
               Un email de confirmation a été envoyé à l\'adresse : '  . $email . '');
               return $this->redirectToRoute('oc_booking_homepage');
           }

           //Card has been declined
           catch (\Stripe\Error\Card $e)
           {
               return $this->redirectToRoute('oc_booking_checkout');
           }
        }


        return $this->render('@OCBooking/Booking/checkout.html.twig', array(
            'id' => $id,
            'order' => $booking,
            'tickets' => $tickets,
        ));
    }
}