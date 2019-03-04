<?php

namespace OC\BookingBundle\Controller;

use OC\BookingBundle\Entity\Booking;
use OC\BookingBundle\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $booking = new Booking();

        $form = $this->get('form.factory')->create(BookingType::class, $booking);

        if($request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($booking);
                $em->flush();
                return $this->redirectToRoute('oc_booking_recap', array('id' => $booking->getId()));
            }
        }

        return $this->render('@OCBooking/Default/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function mailAction($id)
    {
        $booking = $booking = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCBookingBundle:Booking')
            ->findOneById($id);

        $tickets = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCBookingBundle:Ticket')
            ->myFinder($id);

        return $this->render('@OCBooking/Email/test.html.twig', array('order' => $booking, 'tickets' => $tickets));
    }
}
