<?php

namespace App\Model;

class WeekTaskInfo
{
    private $id;
    private $name;
    private $duration;
    private $reservedDuration;
    private $remeanigDuration;
    private $difficult;
    private $normalizedDuration;
    private $reservedNormalizedDuration;
    private $remeanigNormalizedDuration;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getDifficult()
    {
        return $this->difficult;
    }

    /**
     * @param mixed $difficult
     */
    public function setDifficult($difficult): void
    {
        $this->difficult = $difficult;
    }

    /**
     * @return mixed
     */
    public function getNormalizedDuration()
    {
        return $this->normalizedDuration;
    }

    /**
     * @param mixed $normalizedDuration
     */
    public function setNormalizedDuration($normalizedDuration): void
    {
        $this->normalizedDuration = $normalizedDuration;
    }

    /**
     * @return mixed
     */
    public function getReservedDuration()
    {
        return $this->reservedDuration;
    }

    /**
     * @param mixed $reservedDuration
     */
    public function setReservedDuration($reservedDuration): void
    {
        $this->reservedDuration = $reservedDuration;
    }

    /**
     * @return mixed
     */
    public function getRemeanigDuration()
    {
        return $this->remeanigDuration;
    }

    /**
     * @param mixed $remeanigDuration
     */
    public function setRemeanigDuration($remeanigDuration): void
    {
        $this->remeanigDuration = $remeanigDuration;
    }

    /**
     * @return mixed
     */
    public function getReservedNormalizedDuration()
    {
        return $this->reservedNormalizedDuration;
    }

    /**
     * @param mixed $reservedNormalizedDuration
     */
    public function setReservedNormalizedDuration($reservedNormalizedDuration): void
    {
        $this->reservedNormalizedDuration = $reservedNormalizedDuration;
    }

    /**
     * @return mixed
     */
    public function getRemeanigNormalizedDuration()
    {
        return $this->remeanigNormalizedDuration;
    }

    /**
     * @param mixed $remeanigNormalizedDuration
     */
    public function setRemeanigNormalizedDuration($remeanigNormalizedDuration): void
    {
        $this->remeanigNormalizedDuration = $remeanigNormalizedDuration;
    }
}