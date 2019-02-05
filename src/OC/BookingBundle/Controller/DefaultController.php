<?php

namespace OC\BookingBundle\Controller;

use OC\BookingBundle\Entity\Booking;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $booking);

        $formBuilder->add('email', EmailType::class, array('required' => true))
            ->add('Valider', SubmitType::class);

        $form = $formBuilder->getForm();

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
