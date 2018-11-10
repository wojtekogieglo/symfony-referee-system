<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GamesRepository")
 */
class Games
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clubs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $club_id_home;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clubs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $club_id_away;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Referee")
     * @ORM\JoinColumn(nullable=false)
     */
    private $referee_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $season;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $match_day;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $round;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $score;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $yellow_cards;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $red_cards;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $penalties;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClubIdhome(): ?Clubs
    {
        return $this->club_id_home;
    }

    public function setClubIdhome(?Clubs $club_id_home): self
    {
        $this->club_id_home = $club_id_home;

        return $this;
    }

    public function getClubIdAway(): ?Clubs
    {
        return $this->club_id_away;
    }

    public function setClubIdAway(?Clubs $club_id_away): self
    {
        $this->club_id_away = $club_id_away;

        return $this;
    }

    public function getRefereeId(): ?Referee
    {
        return $this->referee_id;
    }

    public function setRefereeId(?Referee $referee_id): self
    {
        $this->referee_id = $referee_id;

        return $this;
    }

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function setSeason(string $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getMatchDay(): ?string
    {
        return $this->match_day;
    }

    public function setMatchDay(string $match_day): self
    {
        $this->match_day = $match_day;

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

    public function getRound(): ?string
    {
        return $this->round;
    }

    public function setRound(string $round): self
    {
        $this->round = $round;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(?string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getYellowCards(): ?string
    {
        return $this->yellow_cards;
    }

    public function setYellowCards(?string $yellow_cards): self
    {
        $this->yellow_cards = $yellow_cards;

        return $this;
    }

    public function getRedCards(): ?int
    {
        return $this->red_cards;
    }

    public function setRedCards(?int $red_cards): self
    {
        $this->red_cards = $red_cards;

        return $this;
    }

    public function getPenalties(): ?int
    {
        return $this->penalties;
    }

    public function setPenalties(?int $penalties): self
    {
        $this->penalties = $penalties;

        return $this;
    }

}
