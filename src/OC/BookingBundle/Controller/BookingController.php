<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 05/02/2019
 * Time: 16:54
 */

namespace OC\BookingBundle\Controller;

use OC\BookingBundle\Entity\Reservation;
use OC\BookingBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BookingController extends Controller {

    public function bookAction($id, Request $request)
    {
        $booking = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCBookingBundle:Booking')
            ->find($id);
        $reservation = new Reservation();


        for ($i=1; $i<$booking->getNbTickets();$i++)
        {
            $form = $this->createForm(ReservationType::class, $reservation);
        }

        return $this->render('@OCBooking/Booking/book.html.twig', array(
            'id' => $id,
            'order' => $booking,
            'form' => $form->createView(),
        ));


    }
}