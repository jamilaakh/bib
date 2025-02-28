<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->unique()->sentence(),
            "description" => $this->faker->text(),
            "type" => $this->faker->randomElement(["Roman", "Nouvelle", "Essai", "Biographie", "Manuel scolaire", "Livre de référence", "Livre jeunesse", "Bande dessinée"]),
            "language" => $this->faker->randomElement(["Francais", "Anglais", "Espagnol", "Allemand", "Italien", "Arabe"]),
            "editor" => $this->faker->company(),
            "category" => $this->faker->randomElement(["Documentaires", "Poesie", "Mangas", "Journaux", "Magazines", "Albums", "Technologie"]),
            "price" => $this->faker->randomFloat(2, 0, 100),
            "author" => $this->faker->name(),
            "cover" => "no_cover.png"
        ];
    }
}
