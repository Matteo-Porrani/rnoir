<?php

namespace App\Service;

use App\Entity\Book;

class BookEngine
{
    /**
     * @param Book $book
     * @return Book
     */
    public function shortenSummary(Book $book): Book
    {
        $originalSummary = $book->getSummary();

        $words = explode(" ", $originalSummary);
        $fewWords = array_slice($words, 0, 10);
        $shortenedSummary = implode(" ", $fewWords);
        $book->setSummary($shortenedSummary . "...");

        return $book;
    }

}