<?php

namespace OC\BookingBundle\Entity;

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
     * @var int
     *
     * @ORM\Column(name="type", type="smallint", unique=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=2, scale=0, unique=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="booking", type="string", length=255)
     */
    private $booking;


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
     * Set type.
     *
     * @param int $type
     *
     * @return Ticket
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set price.
     *
     * @param string $price
     *
     * @return Ticket
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set booking.
     *
     * @param string $booking
     *
     * @return Ticket
     */
    public function setBooking(Booking $booking)
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * Get booking.
     *
     * @return string
     */
    public function getBooking()
    {
        return $this->booking;
    }
}
