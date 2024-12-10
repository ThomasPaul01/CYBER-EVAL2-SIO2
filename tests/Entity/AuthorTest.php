<?php

namespace App\Tests\Entity;

use App\Entity\Author;
use App\Entity\Book;
use PHPUnit\Framework\TestCase;

class AuthorTest extends TestCase
{
    public function makeBook()
    {
        $book = new Book();
        $book->setTitle('The Lord of the Rings');
        $book->setPublishedAt(new \DateTime('1954-07-29'));
        $book->setIsbn('978-3-16-148410-0');

        return $book;
    }
    public function makeAuthor()
    {
        $author = new Author();
        $author->setName('JACK');
        return $author;
    }
    public function testLinkAuthorAndBooks(): void
    {
        $author = $this->makeAuthor();
        $book1=$this->makeBook();
        $book2=$this->makeBook();
        $book2->setTitle('The Hobbit');

        $author->addBook($book1);
        $author->addBook($book2);

        $this->assertCount(2, $author->getBooks());

        $this->assertEquals($book1,$author->getBooks()[0]);
        $this->assertEquals($book2,$author->getBooks()[1]);

        $this->assertEquals($author,$book1->getAuthor());

        $this->assertEquals($book1->getTitle(),$author->getBooks()[0]->getTitle());

    }
    public function testRemoveBook():void {

        $author = $this->makeAuthor();
        $book1=$this->makeBook();
        $book2=$this->makeBook();

        $author->addBook($book1);
        $author->addBook($book2);

        $this->assertCount(2, $author->getBooks());

        $author->removeBook($book1);

        $this->assertCount(1, $author->getBooks());
        $this->assertEquals($book2,$author->getBooks()[1]);

    }

}
