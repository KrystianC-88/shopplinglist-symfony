<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    private $name;

    #[ORM\Column(type: 'string', length: 10)]
    private $uuid;

    #[ORM\ManyToOne(targetEntity: user::class, inversedBy: 'rooms')]
    #[ORM\JoinColumn(nullable: false)]
    private $owner;

    #[ORM\OneToMany(mappedBy: 'room_id', targetEntity: Category::class, orphanRemoval: true)]
    private $categories;

    #[ORM\OneToMany(mappedBy: 'room_id', targetEntity: Item::class, orphanRemoval: true)]
    private $items;

    #[ORM\ManyToMany(targetEntity: UsersRooms::class, mappedBy: 'room_id')]
    private $usersRooms;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->items = new ArrayCollection();
        $this->usersRooms = new ArrayCollection();
    }

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

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getOwner(): ?user
    {
        return $this->owner;
    }

    public function setOwner(?user $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setRoomId($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getRoomId() === $this) {
                $category->setRoomId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setRoomId($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getRoomId() === $this) {
                $item->setRoomId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UsersRooms>
     */
    public function getUsersRooms(): Collection
    {
        return $this->usersRooms;
    }

    public function addUsersRoom(UsersRooms $usersRoom): self
    {
        if (!$this->usersRooms->contains($usersRoom)) {
            $this->usersRooms[] = $usersRoom;
            $usersRoom->addRoomId($this);
        }

        return $this;
    }

    public function removeUsersRoom(UsersRooms $usersRoom): self
    {
        if ($this->usersRooms->removeElement($usersRoom)) {
            $usersRoom->removeRoomId($this);
        }

        return $this;
    }
}
