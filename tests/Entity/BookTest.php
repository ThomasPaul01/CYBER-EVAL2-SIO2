<?php

namespace App\Tests\Entity;

use App\Entity\Book;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function makeBook()
    {
        $book = new Book();
        $book->setTitle('The Lord of the Rings');
        $book->setPublishedAt(new \DateTime('1954-07-29'));
        $book->setIsbn('978-3-16-148410-0');

        return $book;
    }
    public function testSettersAndGetters(): void
    {
        $book = $this->makeBook();
        $this->assertEquals('The Lord of the Rings', $book->getTitle());
        $this->assertEquals(new \DateTime('1954-07-29'), $book->getPublishedAt());
        $this->assertEquals('978-3-16-148410-0', $book->getIsbn());

    }

}
