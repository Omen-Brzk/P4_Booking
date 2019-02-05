<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 05/02/2019
 * Time: 16:54
 */

namespace OC\BookingBundle\Controller;

use OC\BookingBundle\Entity\Booking;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookingController extends Controller {

    public function bookAction($id)
    {
        $booking = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCBookingBundle:Booking')
            ->find($id);

        return $this->render('@OCBooking/Booking/book.html.twig', array(
            'id' => $id,
            'order' => $booking
        ));
    }
}