<?php

namespace OC\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Booking
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="OC\BookingBundle\Repository\BookingRepository")
 */
class Booking
{
    public function __construct()
    {
        $this->bookingDate =  new \DateTime();
        $this->visitDate = new \DateTime();
        $this->bookingToken = $this->generateToken(25);
        $this->nbTickets = $this->getNbTickets();
    }

    /**
     * Maximum ammount of tickets sold in one day per visitor
     */
    const TICKETS_MAX = 5;

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
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(message = "{{ value }} n'est pas une adressse mail valide", checkMX = true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="bookingToken", type="string", length=255, unique=true)
     */
    private $bookingToken;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bookingDate", type="datetime")
     */
    private $bookingDate;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visitDate", type="datetime")
     */
    private $visitDate;


    /**
     * @var int
     *
     * @ORM\Column(name="nbTickets", type="integer")
     */
    private $nbTickets;


    /**
     * @var bool
     *
     * @ORM\Column(name="visitType", type="boolean")
     */
    private $visitType;


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
     * Set email.
     *
     * @param string $email
     *
     * @return Booking
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set bookingToken.
     *
     * @param string $bookingToken
     *
     * @return Booking
     */
    public function setBookingToken($bookingToken)
    {
        $this->bookingToken = $bookingToken;

        return $this;
    }

    /**
     * Get bookingToken.
     *
     * @return string
     */
    public function getBookingToken()
    {
        return $this->bookingToken;
    }

    /**
     * Set bookingDate.
     *
     * @param $bookingDate
     *
     * @return Booking
     */
    public function setBookingDate($bookingDate)
    {
        $this->bookingDate = $bookingDate;

        return $this;
    }

    /**
     * Get bookingDate.
     *
     * @return \DateTime
     */
    public function getBookingDate()
    {
        return $this->bookingDate;
    }

    protected function generateToken($car)
    {
        $token = '';
        $salt = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        srand((double)microtime()*1000000);
        for($i=0; $i<$car; $i++)
        {
            $token .= $salt[rand()%strlen($salt)];
        }
        return $token;
    }

    /**
     * Set nbTickets.
     *
     * @param int $nbTickets
     *
     * @return Booking
     */
    public function setNbTickets($nbTickets)
    {
        $this->nbTickets = $nbTickets;

        return $this;
    }

    /**
     * Get nbTickets.
     *
     * @return int
     */
    public function getNbTickets()
    {
        return $this->nbTickets;
    }

    /**
     * Set visitDate.
     *
     * @param \DateTime $visitDate
     *
     * @return Booking
     */
    public function setVisitDate(\DateTime $visitDate)
    {
        $this->visitDate = $visitDate;

        return $this;
    }

    /**
     * Get visitDate.
     *
     * @return \DateTime
     */
    public function getVisitDate()
    {
        return $this->visitDate;
    }

    /**
     * Set visitType.
     *
     * @param bool $visitType
     *
     * @return Booking
     */
    public function setVisitType($visitType)
    {
        $this->visitType = $visitType;

        return $this;
    }

    /**
     * Get visitType.
     *
     * @return bool
     */
    public function getVisitType()
    {
        return $this->visitType;
    }
}
