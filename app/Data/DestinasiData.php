<?php

namespace App\Data;

/**
 * Data dummy destinasi (diambil dari project React Bali Ticket).
 * Nanti diganti data dari database saat masuk modul REST API.
 */
class DestinasiData
{
    public static function kategori(): array
    {
        return [
            0 => 'Semua Kategori',
            1 => 'Pura',
            2 => 'Budaya & Sejarah',
            3 => 'Alam',
            4 => 'Pantai & Tebing',
            5 => 'Keluarga',
        ];
    }

    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Tanah Lot',
                'slug' => 'tanah-lot',
                'price' => 40000,
                'child_price' => 25000,
                'stock' => 500,
                'category' => 1,
                'category_name' => 'Pura',
                'rating' => 5,
                'img' => 'Tanah-Lot.jpg',
                'location' => 'Tabanan',
                'opening_hours' => '06.00 – 19.00 WITA',
                'duration' => '1,5 – 2 jam',
                'description' => 'Pura laut ikonik di atas batu karang, terkenal dengan panorama matahari terbenam.',
            ],
            [
                'id' => 2,
                'name' => 'Ulun Danu Beratan',
                'slug' => 'ulun-danu-beratan',
                'price' => 50000,
                'child_price' => 25000,
                'stock' => 500,
                'category' => 1,
                'category_name' => 'Pura',
                'rating' => 5,
                'img' => 'Ulun-Danu.jpg',
                'location' => 'Bedugul, Tabanan',
                'opening_hours' => '07.00 – 18.00 WITA',
                'duration' => '1 – 1,5 jam',
                'description' => 'Kompleks pura di tepi Danau Beratan dengan udara sejuk dataran tinggi Bedugul.',
            ],
            [
                'id' => 3,
                'name' => 'Tegallalang Rice Terrace',
                'slug' => 'tegallalang-rice-terrace',
                'price' => 25000,
                'child_price' => 15000,
                'stock' => 500,
                'category' => 3,
                'category_name' => 'Alam',
                'rating' => 4,
                'img' => 'Tegallalang.jpg',
                'location' => 'Ubud, Gianyar',
                'opening_hours' => '08.00 – 18.00 WITA',
                'duration' => '1 – 2 jam',
                'description' => 'Sawah terasering hijau khas Bali dengan sistem irigasi subak di utara Ubud.',
            ],
            [
                'id' => 4,
                'name' => 'Garuda Wisnu Kencana',
                'slug' => 'garuda-wisnu-kencana',
                'price' => 150000,
                'child_price' => 100000,
                'stock' => 500,
                'category' => 2,
                'category_name' => 'Budaya & Sejarah',
                'rating' => 5,
                'img' => 'Garuda-Wisnu.jpg',
                'location' => 'Ungasan, Badung',
                'opening_hours' => '09.00 – 21.00 WITA',
                'duration' => '2 – 3 jam',
                'description' => 'Taman budaya dengan patung Dewa Wisnu mengendarai Garuda berukuran monumental.',
            ],
            [
                'id' => 5,
                'name' => 'Tirta Empul',
                'slug' => 'tirta-empul',
                'price' => 50000,
                'child_price' => 25000,
                'stock' => 500,
                'category' => 1,
                'category_name' => 'Pura',
                'rating' => 5,
                'img' => 'Tirta-Empul.jpg',
                'location' => 'Tampaksiring, Gianyar',
                'opening_hours' => '08.00 – 18.00 WITA',
                'duration' => '1 – 1,5 jam',
                'description' => 'Pura dengan mata air suci tempat ritual penyucian diri (melukat) umat Hindu Bali.',
            ],
            [
                'id' => 6,
                'name' => 'Uluwatu Temple',
                'slug' => 'uluwatu-temple',
                'price' => 50000,
                'child_price' => 30000,
                'stock' => 500,
                'category' => 1,
                'category_name' => 'Pura',
                'rating' => 5,
                'img' => 'Uluwatu.jpg',
                'location' => 'Pecatu, Badung',
                'opening_hours' => '07.00 – 19.00 WITA',
                'duration' => '1,5 – 2 jam',
                'description' => 'Pura di atas tebing tinggi menghadap Samudra Hindia, populer untuk sunset dan tari Kecak.',
            ],
            [
                'id' => 7,
                'name' => 'Kelingking Beach',
                'slug' => 'kelingking-beach',
                'price' => 10000,
                'child_price' => 5000,
                'stock' => 500,
                'category' => 4,
                'category_name' => 'Pantai & Tebing',
                'rating' => 5,
                'img' => 'Kelingking.jpg',
                'location' => 'Nusa Penida, Klungkung',
                'opening_hours' => '07.00 – 17.00 WITA',
                'duration' => '1,5 – 3 jam',
                'description' => 'Tebing berbentuk menyerupai kepala dinosaurus dengan pantai pasir putih di bawahnya.',
            ],
            [
                'id' => 8,
                'name' => 'Lempuyang Temple',
                'slug' => 'lempuyang-temple',
                'price' => 75000,
                'child_price' => 40000,
                'stock' => 500,
                'category' => 1,
                'category_name' => 'Pura',
                'rating' => 5,
                'img' => 'Lempuyang.jpg',
                'location' => 'Karangasem',
                'opening_hours' => 'Pagi – sore (disarankan sebelum 10.00 WITA)',
                'duration' => '2 – 3 jam',
                'description' => 'Kompleks pura di lereng Gunung Lempuyang dengan gerbang “Gate of Heaven” berlatar Gunung Agung.',
            ],
            [
                'id' => 9,
                'name' => 'Goa Gajah',
                'slug' => 'goa-gajah',
                'price' => 50000,
                'child_price' => 25000,
                'stock' => 500,
                'category' => 2,
                'category_name' => 'Budaya & Sejarah',
                'rating' => 4,
                'img' => 'Goa-Gajah.jpg',
                'location' => 'Bedulu, Gianyar',
                'opening_hours' => '08.00 – 16.00 WITA',
                'duration' => '45 – 60 menit',
                'description' => 'Situs gua pertapaan kuno dengan pemandian dan relief batu di dekat Ubud.',
            ],
            [
                'id' => 10,
                'name' => 'Bali Safari and Marine Park',
                'slug' => 'bali-safari-marine-park',
                'price' => 250000,
                'child_price' => 175000,
                'stock' => 500,
                'category' => 5,
                'category_name' => 'Keluarga',
                'rating' => 5,
                'img' => 'Bali-Safari1.jpg',
                'location' => 'Gianyar',
                'opening_hours' => '09.00 – 17.30 WITA',
                'duration' => '3 – 5 jam',
                'description' => 'Taman safari keluarga dengan koleksi satwa dan pertunjukan di Gianyar.',
            ],
        ];
    }

    public static function find(string $slug): ?array
    {
        foreach (self::all() as $d) {
            if ($d['slug'] === $slug) {
                return $d;
            }
        }
        return null;
    }
}
