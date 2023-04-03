<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="integer")
     */
    private $difficult;

    /**
     * @ORM\Column(type="integer")
     */
    private $normalizedDuration;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return int
     */
    public function getDifficult(): int
    {
        return $this->difficult;
    }

    /**
     * @param int $difficult
     */
    public function setDifficult(int $difficult): void
    {
        $this->difficult = $difficult;
    }

    /**
     * @return int
     */
    public function getNormalizedDuration(): int
    {
        return $this->normalizedDuration;
    }

    /**
     * @param int $normalizedDuration
     */
    public function setNormalizedDuration(int $normalizedDuration): void
    {
        $this->normalizedDuration = $normalizedDuration;
    }
}