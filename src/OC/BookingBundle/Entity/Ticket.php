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
    public function __construct()
    {
        $this->booking = $this->getBooking();
        $this->firstname = $this->getFirstname();
        $this->lastname = $this->getLastname();
        $this->birthdayDate = $this->getBirthdayDate();
        $this->country = $this->getCountry();
        $this->reducPrice = $this->getReducPrice();
        $this->price = $this->getPrice();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Booking", inversedBy="details", cascade={"persist"})
     *@ORM\JoinColumn(name="bookingId", referencedColumnName="id")
     */
    private $booking;

    /**
     * @var int
     *
     * @ORM\Column(name="bookingId", type="integer")
     */
    private $bookingId = 0;

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
     * @var \DateTime
     * @ORM\Column(name="birthdayDate", type="date")
     */
    private $birthdayDate;


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
     * @var int
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

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
     * Set birthdayDate.
     *
     * @param \DateTime $birthdayDate
     *
     * @return Ticket
     */
    public function setBirthdayDate($birthdayDate)
    {
        $this->birthdayDate = $birthdayDate;

        return $this;
    }

    /**
     * Get birthdayDate.
     *
     * @return \DateTime
     */
    public function getBirthdayDate()
    {
        return $this->birthdayDate;
    }

    /**
     * Set booking.
     *
     * @param \OC\BookingBundle\Entity\Booking|null $booking
     *
     * @return Ticket
     */
    public function setBooking(\OC\BookingBundle\Entity\Booking $booking = null)
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * Get booking.
     *
     * @return \OC\BookingBundle\Entity\Booking|null
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * Set price.
     *
     * @param int $price
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
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
}
