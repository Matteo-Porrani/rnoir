<?php

namespace App\Service;

use App\Entity\Book;

class BookEngine
{

    private $shortenSummaryLength;

    public function __construct($shortenSummaryLength)
    {
        $this->shortenSummaryLength = $shortenSummaryLength;
    }


    /**
     * @param Book $book
     * @return Book
     */
    public function shortenSummary(Book $book): Book
    {
        $originalSummary = $book->getSummary();

        $words = explode(" ", $originalSummary);

//        $fewWords = array_slice($words, 0, 10);

//        using a parameter defined in service.yaml
        $fewWords = array_slice($words, 0, $this->shortenSummaryLength);

        $shortenedSummary = implode(" ", $fewWords);
        $book->setSummary($shortenedSummary . "...");

        return $book;
    }

}