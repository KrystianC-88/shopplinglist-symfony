<?php

namespace App\Entity;

use App\Repository\UsersRoomsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRoomsRepository::class)]
class UsersRooms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToMany(targetEntity: user::class, inversedBy: 'usersRooms')]
    private $user_id;

    #[ORM\ManyToMany(targetEntity: room::class, inversedBy: 'usersRooms')]
    private $room_id;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->room_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(user $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id[] = $userId;
        }

        return $this;
    }

    public function removeUserId(user $userId): self
    {
        $this->user_id->removeElement($userId);

        return $this;
    }

    /**
     * @return Collection<int, room>
     */
    public function getRoomId(): Collection
    {
        return $this->room_id;
    }

    public function addRoomId(room $roomId): self
    {
        if (!$this->room_id->contains($roomId)) {
            $this->room_id[] = $roomId;
        }

        return $this;
    }

    public function removeRoomId(room $roomId): self
    {
        $this->room_id->removeElement($roomId);

        return $this;
    }
}
