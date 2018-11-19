<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "Nazwa klubu musi składać się z przynajmniej {{ limit }} znaków",
     *      maxMessage = "Nazwa klubu nie może być dłuższa niż {{ limit }} znaków"
     * )
     */
    private $club_name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\League")
     * @ORM\JoinColumn(nullable=false)
     */
    private $league_id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "Nazwa stadionu musi składać się z przynajmniej {{ limit }} znaków",
     *      maxMessage = "Nazwa stadionu nie może być dłuższa niż {{ limit }} znaków"
     * )
     */
    private $stadium;

    /**
     * @ORM\Column(type="integer")
     * @Assert\LessThanOrEqual(
     *     value = 2018,
     *     message="Rok założenia musi być mniejszy niż 2018"
     * )
     * @Assert\GreaterThanOrEqual(
     *     value = 1880,
     *     message="Rok założenia musi być większy niż 1880"
     * )
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

    public function __toString() {
        return (string) $this->getClubName();
    }
}
