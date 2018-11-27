<?php

namespace spec\Service;

use Money\Money;
use Service\Biller;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BillerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Biller::class);
    }

    public function it_bills_a_persons_classic_account(\Client $client, \Account $account)
    {
        $client->beADoubleOf(\Person::class);
        $account->beADoubleOf(\AccountClassic::class);
        $account->getClient()->willReturn($client);

        $transaction = $this->bill($account);
        $transaction->shouldBeAnInstanceOf(\Transaction::class);
        $transaction->getAmount()->shouldBeLike(Money::USD(10000));
    }

    public function it_bills_a_business_classic_account(\Client $client, \Account $account)
    {
        $client->beADoubleOf(\Business::class);
        $account->beADoubleOf(\AccountClassic::class);
        $account->getClient()->willReturn($client);

        $transaction = $this->bill($account);
        $transaction->shouldBeAnInstanceOf(\Transaction::class);
        $transaction->getAmount()->shouldBeLike(Money::USD(100000));
    }


    public function it_bills_a_persons_gold_account(\Client $client, \Account $account, \Transaction $transaction)
    {
        $client->beADoubleOf(\Person::class);
        $account->beADoubleOf(\AccountGold::class);
        $account->getClient()->willReturn($client);
        $transaction->getAmount()->willReturn(Money::USD(100000));
        $account->getTransactions()->willReturn([$transaction]);

        $transaction = $this->bill($account);
        $transaction->shouldBeAnInstanceOf(\Transaction::class);
        $transaction->getAmount()->shouldBeLike(Money::USD(50));
    }

    public function it_bills_a_pymes_gold_account(\Client $client, \Account $account, \Transaction $transaction)
    {
        $client->beADoubleOf(\Pyme::class);
        $account->beADoubleOf(\AccountGold::class);
        $account->getClient()->willReturn($client);
        $transaction->getAmount()->willReturn(Money::USD(100000));
        $account->getTransactions()->willReturn([$transaction]);

        $transaction = $this->bill($account);
        $transaction->shouldBeAnInstanceOf(\Transaction::class);
        $transaction->getAmount()->shouldBeLike(Money::USD(100));
    }

    public function it_bills_a_multinationals_gold_account(\Client $client, \Account $account, \Transaction $transaction)
    {
        $client->beADoubleOf(\Multinational::class);
        $account->beADoubleOf(\AccountGold::class);
        $account->getClient()->willReturn($client);
        $transaction->getAmount()->willReturn(Money::USD(100000));
        $account->getTransactions()->willReturn([$transaction]);

        $transaction = $this->bill($account);
        $transaction->shouldBeAnInstanceOf(\Transaction::class);
        $transaction->getAmount()->shouldBeLike(Money::USD(500));
    }

    public function it_bills_an_unused_multinationals_gold_account(\Client $client, \Account $account)
    {
        $client->beADoubleOf(\Multinational::class);
        $account->beADoubleOf(\AccountGold::class);
        $account->getClient()->willReturn($client);
        $account->getTransactions()->willReturn([]);

        $transaction = $this->bill($account);
        $transaction->shouldBeAnInstanceOf(\Transaction::class);
        $transaction->getAmount()->shouldBeLike(Money::USD(0));
    }

}
