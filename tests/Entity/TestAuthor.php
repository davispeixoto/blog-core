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
use PHPUnit_Framework_TestCase;
use Ramsey\Uuid\Uuid;

class TestAuthor extends PHPUnit_Framework_TestCase
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

    public function authorConstructorProvider()
    {
        return [
            [Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime(), Author::class, 'Regular test'],
        ];
    }
}
