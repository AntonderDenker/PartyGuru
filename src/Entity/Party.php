<?php

namespace App\Entity;

use App\Repository\PartyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartyRepository::class)]
class Party
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $host_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $guest_amount;

    #[ORM\Column(type: 'text', nullable: true)]
    private $guest_list;

    #[ORM\Column(type: 'string', length: 255)]
    private $verification_type;

    #[ORM\Column(type: 'string', length: 255)]
    private $adress;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    private $zip_code;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'time')]
    private $start_time;

    #[ORM\Column(type: 'time')]
    private $end_time;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $telephone_number;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\Column(type: 'date')]
    private $created_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHostId(): ?int
    {
        return $this->host_id;
    }

    public function setHostId(int $host_id): self
    {
        $this->host_id = $host_id;

        return $this;
    }

    public function getGuestAmount(): ?int
    {
        return $this->guest_amount;
    }

    public function setGuestAmount(?int $guest_amount): self
    {
        $this->guest_amount = $guest_amount;

        return $this;
    }

    public function getGuestList(): ?string
    {
        return $this->guest_list;
    }

    public function setGuestList(?string $guest_list): self
    {
        $this->guest_list = $guest_list;

        return $this;
    }

    public function getVerificationType(): ?string
    {
        return $this->verification_type;
    }

    public function setVerificationType(string $verification_type): self
    {
        $this->verification_type = $verification_type;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code): self
    {
        $this->zip_code = $zip_code;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->start_time;
    }

    public function setStartTime(\DateTimeInterface $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->end_time;
    }

    public function setEndTime(\DateTimeInterface $end_time): self
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function getTelephoneNumber(): ?string
    {
        return $this->telephone_number;
    }

    public function setTelephoneNumber(?string $telephone_number): self
    {
        $this->telephone_number = $telephone_number;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->created_date;
    }

    public function setCreatedDate(\DateTimeInterface $created_date): self
    {
        $this->created_date = $created_date;

        return $this;
    }
}
