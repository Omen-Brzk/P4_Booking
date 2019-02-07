<?php

namespace OC\BookingBundle\Controller;

use OC\BookingBundle\Entity\Booking;
use OC\BookingBundle\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
}
