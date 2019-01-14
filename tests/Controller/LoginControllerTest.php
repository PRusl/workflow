<?php
namespace App\Tests\Controller;

class LoginControllerTest extends AControllerTest
{
    const BASE_URI = '/login';

    /**
     * @return array
     */
    public function provideElements()
    {
        return [
            ['#inputUsername'],
            ['#inputPassword'],
            ['button[type="submit"]'],
        ];
    }

    public function getSubmittedFormClient(string $username, string $password)
    {
        $client = $this->getClient();

        $node = $client
            ->request(static::BASE_METHOD, static::BASE_URI)
            ->filter('#formLogin');

        if ($node->count() > 0) {
            $form = $node->form();

            $client->submit($form, [
                'username' => $username,
                'password' => $password
            ]);
        }

        return $client;
    }

    /**
     * @dataProvider provideRedirects
     * @param string $username
     * @param string $password
     * @param string $expectedUri
     */
    public function testLoginRedirect(string $username, string $password, string $expectedUri)
    {
        $this->assertTrue(
            $this
                ->getSubmittedFormClient($username, $password)
                ->getResponse()
                ->isRedirect($expectedUri),
            'Redirected to unexpected uri.'
        );
    }

    /**
     * @return array
     */
    public function provideRedirects()
    {
        return [
            ['testFailedLogin', 'testFailedPassword', static::BASE_URI],
        ];
    }
}