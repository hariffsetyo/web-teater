<?php
namespace Database\Factories;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
class CommentFactory extends Factory {
    public function definition(): array {
        return [
            'article_id'  => Article::inRandomOrder()->value('id'),
            'nama_guest'  => $this->faker->name(),
            'email_guest' => $this->faker->safeEmail(),
            'isi'         => $this->faker->randomElement(['Artikel yang sangat informatif! Terima kasih.','Sangat menginspirasi. Semoga teaternya terus berprestasi.','Saya jadi ingin bergabung setelah membaca ini!','Kontennya bagus, ditunggu artikel selanjutnya.','Keren banget! Terus semangat untuk teater kita.']),
            'status'      => $this->faker->randomElement(['approved','approved','pending']),
        ];
    }
}