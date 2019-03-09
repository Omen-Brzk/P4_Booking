<?php

namespace Tests\AppBundle\Controller;

use OC\BookingBundle\Entity\Ticket;
use OC\BookingBundle\Services\Handler;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    //Test Homepage loading & form submitting
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $form = $crawler->selectButton('Valider')->form();
        $form['oc_bookingbundle_booking[email]'] = 'test@test.fr';
        $form['oc_bookingbundle_booking[nb_tickets]'] = 1;
        $form['oc_bookingbundle_booking[visitDate]'] = '2020-03-09 12:15';
        $form['oc_bookingbundle_booking[visitType]'] = 1;

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("Votre réservation")')->count());
    }

    //Test order page loading with id 1 & ticket form submitting
    public function testOrder()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/order/1');

        $form = $crawler->selectButton('Valider')->form();
        $form['form[tickets][0][lastname]'] = 'Doe';
        $form['form[tickets][0][firstname]'] = 'John';
        $form['form[tickets][0][country]'] = 'FR';
        $form['form[tickets][0][reducPrice]'] = false;

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("Votre réservation")')->count());
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

    //testing mail rendering with id 1
    public function testMail()
    {
        $client = static::createClient();

        $client->request('GET', '/mail/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    //testing checkout route with null id
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
            ['1920-01-01', 1, true, 10],
            ['2015-01-01', 1, false, 8],
            ['2019-01-01', 1, false, 0],
            ['2000-01-01', 1, false, 16],
            ['2000-01-01', 1, true, 10],
            ['2010-01-01', 0, true, 4],
            ['2019-01-01', 0, true, 0],
            ['2000-01-01', 0, true, 5],
            ['2015-01-01', 0, true, 4],
            ['1920-01-01', 0, true, 5],
            ['2000-01-01', 0, false, 8],
            ['2010-01-01', 0, false, 4],
            ['2019-01-01', 0, false, 0],
            ['2015-01-01', 0, false, 4],
            ['1920-01-01', 0, false, 6],
        ];
    }
}
