<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10, unique:true)]

    private ?string $code = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $discount = null;

    #[ORM\Column]
    private ?int $max_usage = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $validity = null;

    #[ORM\Column]
    private ?bool $is_valid = null;

    #[ORM\Column(type :'datetime_immutable', options:['default'=>'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'promotions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PromotionTypes $promotion_types = null;

    #[ORM\OneToMany(mappedBy: 'promotions', targetEntity: Orders::class)]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getMaxUsage(): ?int
    {
        return $this->max_usage;
    }

    public function setMaxUsage(int $max_usage): self
    {
        $this->max_usage = $max_usage;

        return $this;
    }

    public function getValidity(): ?\DateTimeInterface
    {
        return $this->validity;
    }

    public function setValidity(\DateTimeInterface $validity): self
    {
        $this->validity = $validity;

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->is_valid;
    }

    public function setIsValid(bool $is_valid): self
    {
        $this->is_valid = $is_valid;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPromotionTypes(): ?PromotionTypes
    {
        return $this->promotion_types;
    }

    public function setPromotionTypes(?PromotionTypes $promotion_types): self
    {
        $this->promotion_types = $promotion_types;

        return $this;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setPromotions($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getPromotions() === $this) {
                $order->setPromotions(null);
            }
        }

        return $this;
    }
}
