<?php

namespace Tests\Feature;

use App\Models\Banner;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class BannerControllerTest extends TestCase
{
    use WithFaker;

    public function testGetBanner()
    {
        $user = User::findOrFail(1);
        $response = $this->actingAs($user)->get(route('banner.index'));
        $response->assertStatus(200);
    }

    /**
     * Feature store test
     *
     * @return void
     */
    public function testStoreBanner()
    {
        $user = User::findOrFail(1);
        $start = $this->faker->dateTimeBetween('next Monday', 'next Monday +7 days');
        $end = $this->faker->dateTimeBetween($start, $start->format('Y-m-d') . ' +30 days');
        $file = UploadedFile::fake()->image('banner.jpg');
        $response = $this->actingAs($user)->post(route('banner.store'), [
            'name' => $this->faker->name,
            'image' => $file,
            'description' => $this->faker->paragraphs(3, true),
            'active_date' => $start->format('m/d/Y') . ' / ' . $end->format('m/d/Y'),
            'end_date' => $end,
            'link' => $this->faker->url,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('banner.index'));
    }

    public function testUpdateBanner()
    {
        $user = User::findOrFail(1);
        $banner = Banner::latest()->first();
        $start = $this->faker->dateTimeBetween('next Monday', 'next Monday +7 days');
        $end = $this->faker->dateTimeBetween($start, $start->format('Y-m-d') . ' +30 days');
        $file = UploadedFile::fake()->image('banner.jpg');
        $response = $this->actingAs($user)->patch(route('banner.update', $banner->id), [
            'name' => $this->faker->name,
            'image' => $file,
            'description' => $this->faker->paragraphs(3, true),
            'active_date' => $start->format('m/d/Y') . ' / ' . $end->format('m/d/Y'),
            'end_date' => $end,
            'link' => $this->faker->url,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('banner.index'));
    }

    public function testDeleteBanner()
    {
        $user = User::findOrFail(1);
        $banner = Banner::latest()->first();
        $response = $this->actingAs($user)->delete(route('banner.destroy', $banner->id));
        $response->assertStatus(302);
        $response->assertRedirect(route('banner.index'));
    }
}
