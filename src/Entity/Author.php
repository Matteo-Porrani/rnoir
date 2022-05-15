<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=50)
   */
  private $lsName;

  /**
   * @ORM\Column(type="string", length=50)
   */
  private $fsName;

  /**
   * @ORM\Column(type="date", nullable=true)
   */
  private $dateBirth;

  /**
   * @ORM\ManyToMany(targetEntity=Book::class, mappedBy="authors")
   */
  private $books;

  public function __construct()
  {
    $this->books = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getLsName(): ?string
  {
    return $this->lsName;
  }

  public function setLsName(string $lsName): self
  {
    $this->lsName = $lsName;

    return $this;
  }

  public function getFsName(): ?string
  {
    return $this->fsName;
  }

  public function setFsName(string $fsName): self
  {
    $this->fsName = $fsName;

    return $this;
  }

  public function getDateBirth(): ?\DateTimeInterface
  {
    return $this->dateBirth;
  }

  public function setDateBirth(?\DateTimeInterface $dateBirth): self
  {
    $this->dateBirth = $dateBirth;

    return $this;
  }

  /**
   * @return Collection<int, Book>
   */
  public function getBooks(): Collection
  {
    return $this->books;
  }

  public function addBook(Book $book): self
  {
    if (!$this->books->contains($book)) {
      $this->books[] = $book;
      $book->addAuthor($this);
    }

    return $this;
  }

  public function removeBook(Book $book): self
  {
    if ($this->books->removeElement($book)) {
      $book->removeAuthor($this);
    }

    return $this;
  }

  public function __toString(): string
  {
    return $this->fsName . ' ' . $this->lsName;
  }
}