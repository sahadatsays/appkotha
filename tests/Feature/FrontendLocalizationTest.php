<?php

it('renders translated frontend static text for bangla locale', function () {
    $response = $this->withSession(['locale' => 'bn'])->get(route('home'));

    $response->assertSuccessful();
    $response->assertSee('হোম');
    $response->assertSee('আমাদের সম্পর্কে');
});
