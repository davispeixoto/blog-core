<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 7:25 PM
 */

namespace DavisPeixoto\BlogCore\Tests\Entity;

use DateTime;
use DavisPeixoto\BlogCore\Entity\Author;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;

class TestAuthor extends TestCase
{
    /**
     * @param string|null $uuid
     * @param string $name
     * @param string $email
     * @param string $bio
     * @param DateTime|null $birthdate
     * @param string $expected
     * @param string $message
     * @dataProvider authorConstructorProvider
     */
    public function testConstructor($uuid, $name, $email, $bio, $birthdate, $expected, $message)
    {
        $author = new Author($name, $email, $bio, $uuid, $birthdate);
        $this->assertInstanceOf($expected, $author, $message);
        $this->assertEquals(true, Uuid::isValid($author->getId()));
    }

    /**
     * @param string|null $uuid
     * @param string $name
     * @param string $email
     * @param string $bio
     * @param DateTime|null $birthdate
     * @dataProvider constructorException
     */
    public function testInvalidId($uuid, $name, $email, $bio, $birthdate)
    {
        $this->expectException(InvalidUuidStringException::class);
        new Author($name, $email, $bio, $uuid, $birthdate);
    }

    /**
     * @param Author $author
     * @param string $newEmailAddress
     * @param string $expected
     * @param string $message
     * @dataProvider emailProvider
     */
    public function testEmailShouldBeValid(Author $author, $newEmailAddress, $expected, $message)
    {
        $author->setEmail($newEmailAddress);
        $email = $author->getEmail();
        $this->assertEquals($expected, $email, $message);
    }

    public function authorConstructorProvider()
    {
        return [
            [
                Uuid::uuid4()->toString(),
                'Davis',
                'email@example.org',
                'Some string',
                new DateTime(),
                Author::class,
                'Regular test',
            ],
            ['', 'Davis', 'email@example.org', 'Some string', new DateTime(), Author::class, 'new author'],
            [null, 'Davis', 'email@example.org', 'Some string', new DateTime(), Author::class, 'new author'],
        ];
    }

    public function constructorException()
    {
        $uuidv5 = Uuid::uuid5(Uuid::NAMESPACE_DNS, 'bar');

        return [
            ['non-valid-uuid', 'Davis', 'email@example.org', 'Some string', new DateTime()],
            [$uuidv5->toString(), 'Davis', 'email@example.org', 'Some string', new DateTime()],
        ];
    }

    public function emailProvider()
    {
        $author = new Author('Davis', 'email@example.org', 'Foo', null, new DateTime());

        return [
            [$author, 'example.org', 'email@example.org', 'Negative test'],
            [$author, 'email2@example.org', 'email2@example.org', 'Positive test'],
            [$author, '$#email2@example.org$#', 'email2@example.org', 'Positive test - dirty email']
        ];
    }
}
