<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 05/02/2019
 * Time: 16:54
 */

namespace OC\BookingBundle\Controller;

use OC\BookingBundle\Entity\Booking;
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
            ->find($id);

        $ticket = new Ticket();

        $form = $this->get('form.factory')->create(TicketType::class, $ticket);

        return $this->render('@OCBooking/Booking/book.html.twig', array(
            'id' => $id,
            'order' => $booking,
            'form' => $form->createView(),
        ));


    }
}