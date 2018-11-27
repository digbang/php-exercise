<?php

namespace spec;

use Money\Money;
use Transaction;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransactionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(Money::USD(100));
        $this->shouldHaveType(Transaction::class);
    }
}
