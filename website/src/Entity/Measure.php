<?php

namespace App\Entity;

use App\Repository\MeasureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeasureRepository::class)
 */
class Measure
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var
     * @ORM\Column(name="measure_name", type="string", nullable=false)
     */
    private $measureName;

    /**
     * @return mixed
     */
    public function getMeasureName(): string
    {
        return $this->measureName;
    }

    /**
     * @param mixed $measureName
     */
    public function setMeasureName(string $measureName): void
    {
        $this->measureName = $measureName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
