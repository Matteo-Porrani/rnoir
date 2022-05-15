<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=100)
   */
  private $title;

  /**
   * @ORM\Column(type="text", nullable=true)
   */
  private $summary;

  /**
   * @ORM\Column(type="date", nullable=true)
   */
  private $datePublished;

  /**
   * @ORM\Column(type="boolean", nullable=true)
   */
  private $recent;

  /**
   * @ORM\ManyToMany(targetEntity=Author::class, inversedBy="books")
   */
  private $authors;

  /**
   * @ORM\Column(type="integer", nullable=true)
   */
  private $pages;

  /**
   * @ORM\Column(type="float")
   */
  private $price;

  public function __construct()
  {
      $this->authors = new ArrayCollection();
  }

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

  public function getSummary(): ?string
  {
    return $this->summary;
  }

  public function setSummary(?string $summary): self
  {
    $this->summary = $summary;

    return $this;
  }

  public function getDatePublished(): ?\DateTimeInterface
  {
    return $this->datePublished;
  }

  public function setDatePublished(?\DateTimeInterface $datePublished): self
  {
    $this->datePublished = $datePublished;

    return $this;
  }

  public function getRecent(): ?bool
  {
    return $this->recent;
  }

  public function setRecent(?bool $recent): self
  {
    $this->recent = $recent;

    return $this;
  }

  /**
   * @return Collection<int, Author>
   */
  public function getAuthors(): Collection
  {
      return $this->authors;
  }

  public function addAuthor(Author $author): self
  {
      if (!$this->authors->contains($author)) {
          $this->authors[] = $author;
      }

      return $this;
  }

  public function removeAuthor(Author $author): self
  {
      $this->authors->removeElement($author);

      return $this;
  }

  public function getPages(): ?int
  {
      return $this->pages;
  }

  public function setPages(?int $pages): self
  {
      $this->pages = $pages;

      return $this;
  }

  public function getPrice(): ?float
  {
      return $this->price;
  }

  public function setPrice(float $price): self
  {
      $this->price = $price;

      return $this;
  }
}