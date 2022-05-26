<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    private $name;

    #[ORM\ManyToOne(targetEntity: room::class, inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private $room_id;

    #[ORM\ManyToOne(targetEntity: category::class, inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\Column(type: 'boolean')]
    private $is_bought;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRoomId(): ?room
    {
        return $this->room_id;
    }

    public function setRoomId(?room $room_id): self
    {
        $this->room_id = $room_id;

        return $this;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function isIsBought(): ?bool
    {
        return $this->is_bought;
    }

    public function setIsBought(bool $is_bought): self
    {
        $this->is_bought = $is_bought;

        return $this;
    }
}
