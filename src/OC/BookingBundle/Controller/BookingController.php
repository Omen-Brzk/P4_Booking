<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 05/02/2019
 * Time: 16:54
 */

namespace OC\BookingBundle\Controller;

use OC\BookingBundle\Entity\Ticket;
use OC\BookingBundle\Form\TicketType;
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


        return $this->render('@OCBooking/Booking/checkout.html.twig', array(
            'id' => $id,
            'order' => $booking,
            'tickets' => $tickets,
        ));
    }
}