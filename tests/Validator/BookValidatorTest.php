<?php

namespace App\Tests\Validator;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BookValidatorTest extends KernelTestCase
{
    public function makeBook()
    {
        $book = new Book();
        $book->setTitle('The Lord of the Rings');
        $book->setPublishedAt(new \DateTime('1954-07-29'));
        $book->setIsbn('12345678912345');

        return $book;
    }
    public function testEmptyTitleValidator(): void
    {
        self::bootKernel();

        $validator = static::getContainer()->get('validator');

        $book= $this->makeBook();
        $book->setTitle('');

        $errors = $validator->validate($book);

        $this->assertCount(1, $errors);
    }
    public function testEmptyDateValidator(): void
    {
        self::bootKernel();
        $validator = static::getContainer()->get('validator');

        $book = new Book();
        $book->setTitle('The Lord of the Rings');
        $book->setIsbn('12345678912345');

        $errors = $validator->validate($book);

        $this->assertCount(1, $errors);
    }
    public function testEmptyIsbnValidator(): void
    {
        self::bootKernel();
        $validator = static::getContainer()->get('validator');

        $book = $this->makeBook();
        $book->setIsbn('');
        $errors = $validator->validate($book);

        $this->assertCount(2, $errors);
    }
    public function testRegexIsbnValidator(): void
    {
        self::bootKernel();
        $validator = static::getContainer()->get('validator');

        $book = $this->makeBook();
        $book->setIsbn('1212121212121k');
        $errors = $validator->validate($book);

        $this->assertCount(1, $errors);
    }
    public function testLengthIsbnValidator(): void
    {
        self::bootKernel();
        $validator = static::getContainer()->get('validator');

        $book = $this->makeBook();
        $book->setIsbn('12121');
        $errors = $validator->validate($book);

        $this->assertCount(2, $errors);
    }
    public function testValidBook(): void
    {
        self::bootKernel();
        $validator = static::getContainer()->get('validator');

        $book = $this->makeBook();
        $errors = $validator->validate($book);

        $this->assertCount(0, $errors);
    }

}
