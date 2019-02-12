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
use Symfony\Component\HttpFoundation\Request;

class BookingController extends Controller {

    public function bookAction($id, Request $request)
    {
        $booking = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCBookingBundle:Booking')
            ->findOneById($id);

        $ticket = new Ticket();

        $ticketForm = $this->createTicketForm($ticket);


        if($request->isMethod('POST')){

            $ticketForm->handleRequest($request);

            if($ticketForm->isSubmitted() && $ticketForm->isValid())
            {
                $ticket->setBooking($booking);
                $em = $this->getDoctrine()->getManager();
                $em->persist($ticket);
                $em->flush();
                return $this->redirectToRoute('oc_booking_recap', array('id' => $booking->getId()));
            }
        }

        return $this->render('@OCBooking/Booking/book.html.twig', array(
            'id' => $id,
            'order' => $booking,
            'ticketForm' => $ticketForm
        ));
    }

    private function createTicketForm($ticket)
    {
        return $this->get('form.factory')->create(TicketType::class, $ticket);
    }
}