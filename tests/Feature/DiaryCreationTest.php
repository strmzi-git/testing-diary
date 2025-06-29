<?php

use App\Models\Diary;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\actingAs;

test('user can create a new diary entry', function () {
    $user = User::create([
        'name' => 'demo user',
        'email' => 'tester@gmail.com',
        'password' => Hash::make('password'),
    ]);

    actingAs($user);

    Diary::create([
        'title' => 'demo diary title',
        'entry' => 'demo diary entry',
        'user_id' => $user->id
    ]);

    $this->assertDatabaseHas('diaries', [
        'title' => 'demo diary title',
        'entry' => 'demo diary entry',
        'user_id' => $user->id,
    ]);
});

test('diary entry is not saved if title is missing', function () {
    $user = User::factory()->create();
    actingAs($user);


    $this->post('/diary/create', [
        'title' => '',
        'entry' => 'test no title',
    ]);

    $this->assertDatabaseMissing('diaries', ['entry' => 'test no title']);
});

test('diary entry can be created and assigned to user', function () {
    $user = User::factory()->create();

    $diary = Diary::create([
        'user_id' => $user->id,
        'title' => 'another testing title',
        'entry' => 'cool entry content',
    ]);

    expect($diary->user_id)->toBe($user->id);
    expect($diary->title)->toBe('another testing title');
    expect($diary->entry)->toBe('cool entry content');
});

test('user can see their own entry', function () {
    $user = User::factory()->create();
    $diary = Diary::create([
        'user_id' => $user->id,
        'title' => 'test 3 title',
        'entry' => 'diary content',
    ]);

    actingAs($user);

    $response = $this->get("/diary/{$diary->id}");

    $response->assertStatus(200);
    $response->assertSee('test 3 title');
    $response->assertSee('diary content');
});

test('user cannot view another user entry', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $user1_entry = Diary::create([
        'user_id' => $user1->id,
        'title' => 'private entry',
        'entry' => 'should be unavailable',
    ]);

    actingAs($user2);

    $response = $this->get("/diary/{$user1_entry->id}");

    $response->assertStatus(403);
});

test('user unable to access another diary entry due to different id', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $diary = Diary::create([
        'user_id' => $user1->id,
        'title' => 'basic title text',
        'entry' => 'basic entry text'
    ]);

    $same_user = $diary->user_id === $user2->id;

    expect($same_user)->toBeFalse();
});




// Also unit test:
test('title is required for diary entry', function () {
    $data = ['title' => '', 'entry' => 'My thoughts'];

    $validator = Validator::make($data, [
        'title' => 'required',
        'entry' => 'nullable',
    ]);

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('title'))->toBeTrue();
});
