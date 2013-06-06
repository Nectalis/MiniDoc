<?php

namespace Nectalis\MiniDocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appointment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Appointment
{

    /**
     * Get the computed end date by adding the duration to the start date
     *
     * @return \DateTime 
     */

    public function getEndDate() {
        $durationInterval = new DateInterval('PT'.$this->getDurationMinutes().'M');
        return $this->getStartDate()->add($durationInterval);
    }



    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="patientName", type="string", length=255)
     */
    private $patientName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="durationMinutes", type="integer", length=255)
     */
    private $durationMinutes;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set patientName
     *
     * @param string $patientName
     * @return Appointment
     */
    public function setPatientName($patientName)
    {
        $this->patientName = $patientName;
    
        return $this;
    }

    /**
     * Get patientName
     *
     * @return string 
     */
    public function getPatientName()
    {
        return $this->patientName;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Appointment
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    
        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set durationMinutes
     *
     * @param integer $durationMinutes
     * @return Appointment
     */
    public function setDurationMinutes($durationMinutes)
    {
        $this->durationMinutes = $durationMinutes;
    
        return $this;
    }

    /**
     * Get durationMinutes
     *
     * @return integer 
     */
    public function getDurationMinutes()
    {
        return $this->durationMinutes;
    }


}
