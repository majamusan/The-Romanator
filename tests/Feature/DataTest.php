<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataTest extends TestCase
{
    /**
     * Test data creation and reporting
     *
     * @return void
     */
    public function testExample()
    {
        //a reandom status test
        $random = $this->call('put', route('store', ['number' => rand(1, config('romanator.limits.conversion')) ]));
        $this->assertEquals(200, $random->status());

        //testing knowen coversion and incramenting
        $starting = $this->json('get', route('show', ['number' => config('romanator.tests.roman') ]));
        if ($starting->status() == 404) {
            $starting = 0;
        } else {
            $starting = $starting->getData()->data->count;
        }
        $conversion = $this->call('put', route('store', ['number' => config('romanator.tests.arabic') ]));
        $this->assertEquals(200, $conversion->status());
        $ending = $this->json('get', route('show', ['number' => config('romanator.tests.roman') ]));
        $this->assertEquals(200, $ending->status());
        $this->assertTrue($conversion->getContent() == config('romanator.tests.roman'));
        $this->assertTrue($starting == $ending->getData()->data->count - 1);

        //testing recent results
        $recentResults =  $this->json('get', route('recent'))->getData()->data[1];
        $this->assertTrue((
            \Carbon\Carbon::now()->format(config('romanator.tests.date_time')) ==
                        \Carbon\Carbon::parse($recentResults->updated_at)->format(config('romanator.tests.date_time'))
            ));
        $this->assertTrue($recentResults->number  == config('romanator.tests.roman')) ;

        //testing top results
        $topResults =  $this->json('get', route('topResults'));
        $this->assertTrue($topResults ->original->count() < config('romanator.limits.display') + 1) ;
    }
}
