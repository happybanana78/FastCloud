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
            'realName' => "err676r786r7wf7yfe",
            'name' => "doc",
            'size' => "1Mb",
            'format' => "jpg",
            'folder_id' => 1,
        ];
    }
}
