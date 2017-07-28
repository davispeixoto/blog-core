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
use Ramsey\Uuid\Uuid;

class TestAuthor extends TestCase
{
    /**
     * @param $uuid
     * @param $name
     * @param $email
     * @param $bio
     * @param $birthdate
     * @param $expected
     * @param $message
     * @dataProvider authorConstructorProvider
     */
    public function testConstructor($uuid, $name, $email, $bio, $birthdate, $expected, $message)
    {
        $author = new Author($uuid, $name, $email, $bio, $birthdate);
        $this->assertInstanceOf($expected, $author, $message);
    }

    /**
     * @param Author $author
     * @param $newEmailAddress
     * @param $expected
     * @param $message
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
            [Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime(), Author::class, 'Regular test'],
        ];
    }

    public function emailProvider()
    {
        $author = new Author(Uuid::uuid4(), 'Davis', 'email@example.org', 'Foo', new DateTime());

        return [
            [$author, 'example.org', 'email@example.org', 'Negative test'],
            [$author, 'email2@example.org', 'email2@example.org', 'Positive test'],
            [$author, '$#email2@example.org$#', 'email2@example.org', 'Positive test - dirty email']
        ];
    }
}
