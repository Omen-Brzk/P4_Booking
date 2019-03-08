<?php

namespace Tests\AppBundle\Controller;

use OC\BookingBundle\Entity\Ticket;
use OC\BookingBundle\Services\Handler;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    //Test Homepage
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    //Test order page with id 1
    public function testOrder()
    {
        $client = static::createClient();

        $client->request('GET', '/order/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    //Testing order page with null id
    public function testFailedOrder()
    {
        $client = static::createClient();

        $client->request('GET', '/order/9999');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    //testing checkout with id 1
    public function testCheckout()
    {
        $client = static::createClient();

        $client->request('GET', '/checkout/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    //tesing checkout route with null id
    public function testFailedCheckout()
    {
        $client = static::createClient();

        $client->request('GET', '/checkout/9999');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    /**
     * @dataProvider datasForHandler
     */
    public function testHandler($age, $type, $reducPrice, $expectedPrice)
    {
        $kernel = new \AppKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();

        $Handler = $container->get('oc_bookingbundle.handler');

        $this->assertSame($expectedPrice, $Handler->handleBill($age, $type, $reducPrice));
    }

    /**
     * @return array
     * provides data to testHandler function
     * please visit http://puu.sh/CX2nr/94dfb575b4.png to check prices
     *
     * 2nd parameter is boolean : 1 for full-day ticket, 0 for half-day ticket
     * 3rd parameter is also boolean : false for no reduction price, true for reduction price
     * The last parameter is the return price value expected from Handler service
     */
    public function datasForHandler()
    {
        return [
          ['1920-01-01', 1, false, 12],
            ['1920-01-01', 1, true, 10]
        ];
    }
}
