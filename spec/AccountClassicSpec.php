<?php

namespace spec;

use AccountClassic;
use Cake\Chronos\Date;
use Money\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AccountClassicSpec extends ObjectBehavior
{
    function it_is_initializable(\Client $client)
    {
        $this->beConstructedWith($client);
        $this->shouldHaveType(AccountClassic::class);
    }

    public function it_debits_a_person_from_banelco(\Client $client)
    {
        $client->beADoubleOf(\Person::class);
        $this->beConstructedWith($client);


        $this->debit('Online payment', Money::USD(10000), Date::now(), \Origin::banelco())->shouldReturnAnInstanceOf(\Transaction::class);
        $this->getTransactions()->shouldHaveCount(1);
        $this->getBalance()->shouldBeLike(Money::USD(-10000));
    }

    public function it_credits_a_person_from_link(\Client $client)
    {
        $client->beADoubleOf(\Person::class);
        $this->beConstructedWith($client);


        $this->credit('Link deposit', Money::USD(10000), Date::now(), \Origin::link())->shouldReturnAnInstanceOf(\Transaction::class);
        $this->getTransactions()->shouldHaveCount(1);
        $this->getBalance()->shouldBeLike(Money::USD(10000));
    }

    public function it_credits_a_pyme_from_banelco(\Client $client)
    {
        $client->beADoubleOf(\Pyme::class);
        $this->beConstructedWith($client);


        $this->credit('Banelco deposit', Money::USD(10000), Date::now(), \Origin::banelco())->shouldReturnAnInstanceOf(\Transaction::class);
        $this->getTransactions()->shouldHaveCount(2);
        $this->getBalance()->shouldBeLike(Money::USD(9995));
    }

    public function it_credits_a_business_in_person(\Client $client)
    {
        $client->beADoubleOf(\Business::class);
        $this->beConstructedWith($client);


        $this->credit('Person deposit', Money::USD(10000), Date::now(), \Origin::inPerson())->shouldReturnAnInstanceOf(\Transaction::class);
        $this->getTransactions()->shouldHaveCount(2);
        $this->getBalance()->shouldBeLike(Money::USD(9995));
    }

    public function it_debits_a_multinational_from_link(\Client $client)
    {
        $client->beADoubleOf(\Multinational::class);
        $this->beConstructedWith($client);


        $this->debit('Link debit', Money::USD(10000), Date::now(), \Origin::link())->shouldReturnAnInstanceOf(\Transaction::class);
        $this->getTransactions()->shouldHaveCount(2);
        $this->getBalance()->shouldBeLike(Money::USD(-9990));
    }

    public function it_debits_a_business_in_person(\Client $client)
    {
        $client->beADoubleOf(\Business::class);
        $this->beConstructedWith($client);


        $this->debit('Person extraction', Money::USD(10000), Date::now(), \Origin::inPerson())->shouldReturnAnInstanceOf(\Transaction::class);
        $this->getTransactions()->shouldHaveCount(1);
        $this->getBalance()->shouldBeLike(Money::USD(-10000));
    }
}
