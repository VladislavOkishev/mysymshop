<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $processor;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $motherChipset;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $amountRam;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $videocard;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getProcessor(): ?string
    {
        return $this->processor;
    }

    public function setProcessor(string $processor): self
    {
        $this->processor = $processor;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getMotherChipset(): ?string
    {
        return $this->motherChipset;
    }

    public function setMotherChipset(string $motherChipset): self
    {
        $this->motherChipset = $motherChipset;

        return $this;
    }

    public function getAmountRam(): ?string
    {
        return $this->amountRam;
    }

    public function setAmountRam(string $amountRam): self
    {
        $this->amountRam = $amountRam;

        return $this;
    }

    public function getVideocard(): ?string
    {
        return $this->videocard;
    }

    public function setVideocard(string $videocard): self
    {
        $this->videocard = $videocard;

        return $this;
    }
}
