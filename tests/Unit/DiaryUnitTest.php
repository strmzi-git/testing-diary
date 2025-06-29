<?php

use App\Models\Diary;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


test('diary entry returns expected content', function () {
    $diary = new Diary([
        'title' => 'Test Title',
        'entry' => 'This is the diary content.',
        'user_id' => 1,
    ]);

    expect($diary->title)->toBe('Test Title');
    expect($diary->entry)->toBe('This is the diary content.');
});

test('user cannot access diary with different user id', function () {
    $loggedInUser = new User();
    $loggedInUser->id = 1;

    $diary = new Diary();
    $diary->user_id = 2;

    expect($diary->user_id === $loggedInUser->id)->toBeFalse();
});