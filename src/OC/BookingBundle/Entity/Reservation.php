<?php

namespace OC\BookingBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use OC\BookingBundle\Form\TicketType;

/**
 * Reservation
 *
 *
 * @ORM\Entity(repositoryClass="OC\BookingBundle\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\OneToMany (targetEntity="Ticket", mappedBy="reservation", cascade={"persist"})
     */
    private $tickets;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ticket.
     *
     * @param string $ticket
     *
     * @return Reservation
     */
    public function setTickets($tickets)
    {
        $this->tickets = $tickets;

        return $this;
    }

    /**
     * Get ticket.
     *
     * @return string
     */
    public function getTickets()
    {
        return $this->tickets;
    }
}
