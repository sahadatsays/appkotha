<?php

use App\Http\Requests\Admin\StoreServiceRequest;
use Illuminate\Support\Facades\Validator;

it('requires english service name in store request', function () {
    $request = new StoreServiceRequest;

    $validator = Validator::make([
        'name_en' => '',
    ], $request->rules(), $request->messages());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name_en'))->toBeTrue();
});

it('allows missing bangla fields in store request', function () {
    $request = new StoreServiceRequest;

    $validator = Validator::make([
        'name_en' => 'Service Name',
        'name_bn' => null,
    ], $request->rules(), $request->messages());

    expect($validator->fails())->toBeFalse();
});
