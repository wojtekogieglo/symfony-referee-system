<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeagueRepository")
 */
class League
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
     *      min = 3,
     *      max = 255,
     *      minMessage = "Nazwa ligi musi składać się przynajmniej z  {{ limit }} znaków",
     *      maxMessage = "Nazwa ligi musi mieć mniej niż {{ limit }} znaków"
     * )
     */
    private $league_name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeagueName(): ?string
    {
        return $this->league_name;
    }

    public function setLeagueName(string $league_name): self
    {
        $this->league_name = $league_name;

        return $this;
    }

    public function __toString() {
        return (string) $this->league_name;
    }
}
