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
        $book->setIsbn('12345678912345');

        return $book;
    }
    public function testSettersAndGetters(): void
    {
        $book = $this->makeBook();
        $this->assertEquals('The Lord of the Rings', $book->getTitle());
        $this->assertEquals(new \DateTime('1954-07-29'), $book->getPublishedAt());
        $this->assertEquals('12345678912345', $book->getIsbn());

    }

}
