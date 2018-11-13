<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClubsRepository")
 */
class Clubs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $club_name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\League")
     * @ORM\JoinColumn(nullable=false)
     */
    private $league_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stadium;

    /**
     * @ORM\Column(type="integer")
     */
    private $founded_year;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClubName(): ?string
    {
        return $this->club_name;
    }

    public function setClubName(string $club_name): self
    {
        $this->club_name = $club_name;

        return $this;
    }

    public function getLeagueId(): ?League
    {
        return $this->league_id;
    }

    public function setLeagueId(?League $league_id): self
    {
        $this->league_id = $league_id;

        return $this;
    }

    public function getStadium(): ?string
    {
        return $this->stadium;
    }

    public function setStadium(string $stadium): self
    {
        $this->stadium = $stadium;

        return $this;
    }

    public function getFoundedYear(): ?int
    {
        return $this->founded_year;
    }

    public function setFoundedYear(int $founded_year): self
    {
        $this->founded_year = $founded_year;

        return $this;
    }
}
