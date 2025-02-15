<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit;

use OnurSimsek\Craftgate\Tests\TestCase;
use OnurSimsek\Craftgate\Tests\Traits\WithRequest;
use OnurSimsek\Craftgate\Util;
use PHPUnit\Framework\Attributes\Test;

class UtilTest extends TestCase
{
    use WithRequest;

    #[Test]
    public function it_should_be_generate_signature()
    {
        $this->assertEquals(
            expected: 'G6RjCpLNVWxKAf2XKhqFGqSEO7mW4r5/Bvndvh7c4HI=',
            actual: Util::signature($this->baseRequest(), '1234')
        );

        // Installment endpoint
        $request = $this->baseRequest('/installment/v1/installments');
        $this->assertEquals(
            expected: 'uK7LkWOEzVH+Px/YOiMuSXvPkHLR4KoA7PuykXcYovQ=',
            actual: Util::signature($request, '1234')
        );

        // Payment endpoint
        $request = $this->baseRequest('/payment/v1/cards', [
            'cardUserKey' => 'de050909-39a9-473c-a81a-f186dd55cfef',
        ]);
        $this->assertEquals(
            expected: 'kQm62AfjXCw6rS6QBCLXta9tV1GqD/SXsAlYP+cEhG8=',
            actual: Util::signature($request, '1234')
        );

        // Onboarding endpoint
        $request = $this->baseRequest('/onboarding/v1/members?name=Zeytinya%C4%9F%C4%B1%20%C3%9Cretim');
        $this->assertEquals(
            expected: 'vxYA+5LH3F4m8tHQA2LpVBwzVgCqGRHue4XAgcVjjYQ=',
            actual: Util::signature($request, '1234')
        );
    }

    #[Test]
    public function it_should_be_generate_a_guid()
    {
        $this->assertMatchesRegularExpression('/^([a-fA-F\d]{8})-?([a-fA-F\d]{4})-?([a-fA-F\d]{4})-?([a-fA-F\d]{4})-?([a-fA-F\d]{12})$/', Util::guid());
    }
}
