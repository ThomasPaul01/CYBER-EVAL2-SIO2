<?php

namespace App\Tests\Service;

use App\Entity\Book;
use App\Entity\Client;
use App\Service\BorrowingManager;
use PHPUnit\Framework\TestCase;

class BorrowTest extends TestCase
{
    public function makeBook()
    {
        $book = new Book();
        $book->setTitle('The Lord of the Rings');
        $book->setPublishedAt(new \DateTime('1954-07-29'));
        $book->setIsbn('978-3-16-148410-0');

        return $book;
    }
    public function makeClient()
    {
        $client = new Client();
        $client->setFirstName('John');
        $client->setLastName('Doe');
        $client->setEmail('John.Doe@mail.dev');

        return $client;

    }
    public function testBorrowed5Books(): void
    {
        $borrowingManager = new BorrowingManager();
        $client = $this->makeClient();
        $book = $this->makeBook();

        $client->setBorrowedBooksCount(5);

        $result=$borrowingManager->canBorrowBook($client,$book);
        $this->assertEquals(false, $result);
    }
    public function testBookBorrowedAlreadyBorrowed(): void
    {
        $borrowingManager = new BorrowingManager();
        $client = $this->makeClient();
        $book = $this->makeBook();

        $client->setBorrowedBooksCount(0);
        $book->setBorrowed(true);

        $result=$borrowingManager->canBorrowBook($client,$book);
        $this->assertEquals(false, $result);
    }
    public function testBookWellBorrowed(): void
    {
        $borrowingManager = new BorrowingManager();
        $client = $this->makeClient();
        $book = $this->makeBook();

        $client->setBorrowedBooksCount(0);
        $book->setBorrowed(false);

        $result=$borrowingManager->canBorrowBook($client,$book);
        $this->assertEquals(true, $result);
    }

}
