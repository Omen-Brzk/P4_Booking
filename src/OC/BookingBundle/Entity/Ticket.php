<?php

namespace OC\BookingBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="OC\BookingBundle\Repository\TicketRepository")
 */
class Ticket
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
     * @var int
     *
     * @ORM\Column(name="bookingId", type="integer")
     * @ORM\ManyToOne(targetEntity="Booking", cascade={"persist"})
     * @ORM\JoinColumn(name="bookingId", referencedColumnName="id")
     */
    private $bookingId;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", unique=true)
     */
    private $age;


    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string")
     */
    private $country;


    /**
     * @var boolean
     *
     * @ORM\Column(name="reducPrice", type="boolean")
     */
    private $reducPrice;

    /**
     * @ORM\ManyToOne(targetEntity="Reservation", inversedBy="tickets", cascade={"persist"})
     * @ORM\JoinColumn(name="bookingId", referencedColumnName="id")
     */
    private $reservation;

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
     * Set bookingId.
     *
     * @param int $bookingId
     *
     * @return Ticket
     */
    public function setBookingId($bookingId)
    {
        $this->bookingId = $bookingId;

        return $this;
    }

    /**
     * Get bookingId.
     *
     * @return int
     */
    public function getBookingId()
    {
        return $this->bookingId;
    }

    /**
     * Set firstname.
     *
     * @param string $firstname
     *
     * @return Ticket
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname.
     *
     * @param string $lastname
     *
     * @return Ticket
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set age.
     *
     * @param int $age
     *
     * @return Ticket
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age.
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set country.
     *
     * @param string $country
     *
     * @return Ticket
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set reducPrice.
     *
     * @param bool $reducPrice
     *
     * @return Ticket
     */
    public function setReducPrice($reducPrice)
    {
        $this->reducPrice = $reducPrice;

        return $this;
    }

    /**
     * Get reducPrice.
     *
     * @return bool
     */
    public function getReducPrice()
    {
        return $this->reducPrice;
    }

    /**
     * Set reservation.
     *
     * @param \OC\BookingBundle\Entity\Reservation|null $reservation
     *
     * @return Ticket
     */
    public function setReservation(\OC\BookingBundle\Entity\Reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation.
     *
     * @return \OC\BookingBundle\Entity\Reservation|null
     */
    public function getReservation()
    {
        return $this->reservation;
    }
}
