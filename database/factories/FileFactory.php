<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'realName' => "RkxCmYYtcNcfCu8qH4tHV8k3YLHTbg0h9sTkdcXd.png",
            'name' => "doc",
            'size' => 30305,
            'format' => "png",
            'folder_id' => 1,
        ];
    }
}
