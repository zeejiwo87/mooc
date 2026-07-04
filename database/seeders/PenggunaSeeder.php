<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengguna = [
            [
                'nama' => 'Muhammad Fikri',
                'email' => 'muhammadfikri@gmail.com',
                'bio' => 'Mahasiswa yang suka belajar hal baru, aktif mencari pengalaman, dan terus berkembang untuk menjadi pribadi yang lebih baik.',
                'telepon' => '081273469021',
            ],
            [
                'nama' => 'Siti Aisyah',
                'email' => 'sitiaisyah@gmail.com',
                'bio' => 'Mahasiswa yang senang mencoba hal baru, suka belajar online, dan ingin terus upgrade kemampuan diri.',
                'telepon' => '085218847630',
            ],
            [
                'nama' => 'Nur Hidayah',
                'email' => 'nurhidayah@gmail.com',
                'bio' => 'Suka belajar dengan cara yang fleksibel, apalagi kalau materinya mudah dipahami dan bisa diakses kapan saja.',
                'telepon' => '087842193056',
            ],
            [
                'nama' => 'Ahmad Zaini',
                'email' => 'ahmadzaini@gmail.com',
                'bio' => 'Mahasiswa yang tertarik dengan dunia digital, aktif belajar mandiri, dan suka mencoba platform pembelajaran baru.',
                'telepon' => '082190574482',
            ],
            [
                'nama' => 'Laila Rahma',
                'email' => 'lailarahma@gmail.com',
                'bio' => 'Suka belajar secara bertahap, aktif mengembangkan diri, dan senang mencoba hal-hal yang bermanfaat.',
                'telepon' => '089631748205',
            ],
            [
                'nama' => 'Abdul Karim',
                'email' => 'abdulkarim@gmail.com',
                'bio' => 'Mahasiswa yang suka mengeksplor materi baru, belajar dari pengalaman, dan terus berusaha menjadi lebih baik.',
                'telepon' => '081366201198',
            ],
            [
                'nama' => 'Nurul Fitri',
                'email' => 'nurulfitri@gmail.com',
                'bio' => 'Senang mengikuti kelas online untuk menambah wawasan, skill, dan pengalaman belajar yang lebih luas.',
                'telepon' => '085724089361',
            ],
            [
                'nama' => 'Muhammad Irfan',
                'email' => 'muhammadirfan@gmail.com',
                'bio' => 'Suka belajar hal baru, aktif mencoba berbagai materi, dan ingin terus berkembang sesuai minat yang dimiliki.',
                'telepon' => '083859412073',
            ],
            [
                'nama' => 'Rina Oktavia',
                'email' => 'rinaoktavia@gmail.com',
                'bio' => 'Mahasiswa yang suka belajar dengan santai tapi tetap konsisten, terutama lewat media pembelajaran online.',
                'telepon' => '088273196044',
            ],
            [
                'nama' => 'Dwi Saputra',
                'email' => 'dwisaputra@gmail.com',
                'bio' => 'Tertarik belajar mandiri, suka mencoba fitur baru, dan ingin terus meningkatkan kemampuan secara bertahap.',
                'telepon' => '081746902835',
            ],
            [
                'nama' => 'Andi Pratama',
                'email' => 'andipratama@gmail.com',
                'bio' => 'Mahasiswa yang suka explore teknologi, belajar lewat praktik, dan aktif mencari pengalaman baru.',
                'telepon' => '085390265178',
            ],
            [
                'nama' => 'Dewi Lestari',
                'email' => 'dewilestari@gmail.com',
                'bio' => 'Suka belajar online karena lebih fleksibel, praktis, dan bisa disesuaikan dengan kegiatan sehari-hari.',
                'telepon' => '089511874209',
            ],
            [
                'nama' => 'Rizky Ramadhan',
                'email' => 'rizkyramadhan@gmail.com',
                'bio' => 'Mahasiswa yang senang belajar lewat video, latihan soal, dan materi yang langsung bisa dipahami.',
                'telepon' => '082264057731',
            ],
            [
                'nama' => 'Fajar Maulana',
                'email' => 'fajarmaulana@gmail.com',
                'bio' => 'Suka belajar hal praktis, aktif mencoba materi baru, dan ingin punya skill yang bisa dipakai ke depannya.',
                'telepon' => '081529846507',
            ],
            [
                'nama' => 'Nabila Putri',
                'email' => 'nabilaputri@gmail.com',
                'bio' => 'Mahasiswa yang suka belajar dengan tampilan yang rapi, alur yang jelas, dan materi yang tidak membingungkan.',
                'telepon' => '087793615042',
            ],

            // Data tambahan dari kuesioner pengguna
            [
                'nama' => 'Nurul Istiqomah',
                'email' => 'vcitrivolia@gmail.com',
                'bio' => 'Mahasiswa yang suka mencoba sistem baru, aktif belajar, dan terbuka dengan pengalaman pembelajaran digital.',
                'telepon' => '085670421938',
            ],
            [
                'nama' => 'Siti Aisyah',
                'email' => 'sitiaisyah11091987@gmail.com',
                'bio' => 'Suka belajar dengan cara yang simpel, mudah dipahami, dan tetap bisa menambah wawasan baru.',
                'telepon' => '081958732604',
            ],
            [
                'nama' => 'Aisatur Ridho',
                'email' => 'aisaturridho2321500017@gmail.com',
                'bio' => 'Mahasiswa yang aktif mencoba hal baru, suka belajar online, dan tertarik dengan fitur kelas bersertifikat.',
                'telepon' => '089924168750',
            ],
            [
                'nama' => 'Ainur Rohimah',
                'email' => 'ainurrohimah2321500049@gmail.com',
                'bio' => 'Suka belajar secara mandiri, aktif mencari pengalaman, dan senang mencoba media belajar yang praktis.',
                'telepon' => '083176054928',
            ],
            [
                'nama' => 'Ahmad Fanani',
                'email' => 'ahmadfanani232150001@gmail.com',
                'bio' => 'Mahasiswa yang tertarik dengan pembelajaran online, suka belajar santai, tapi tetap ingin berkembang.',
                'telepon' => '081493572086',
            ],
            [
                'nama' => 'Muhammad Khoironi Shiddiq',
                'email' => 'muhammadkhoironi2321500002@gmail.com',
                'bio' => 'Suka mencoba platform digital, aktif belajar hal baru, dan tertarik dengan sistem yang punya progres belajar.',
                'telepon' => '088841069372',
            ],
            [
                'nama' => 'Dwi Mardiana',
                'email' => 'dwimardiana2321500104@gmail.com',
                'bio' => 'Mahasiswa yang senang belajar dengan alur yang jelas, praktis, dan bisa diikuti sesuai waktu luang.',
                'telepon' => '085862713490',
            ],
            [
                'nama' => 'Moch Arif Maulana',
                'email' => 'mocharifmaulana2321500141@gmail.com',
                'bio' => 'Suka explore kelas online, aktif mencoba fitur baru, dan ingin terus menambah skill secara bertahap.',
                'telepon' => '082319508647',
            ],
            [
                'nama' => 'Muizzuddin',
                'email' => 'muizzuddin2321500020@gmail.com',
                'bio' => 'Mahasiswa yang suka belajar lewat materi dan kuis, karena bisa tahu sejauh mana pemahaman yang didapat.',
                'telepon' => '081673945201',
            ],
            [
                'nama' => 'Nur Ahmad',
                'email' => 'nurahmad2321500089@gmail.com',
                'bio' => 'Tertarik dengan pembelajaran digital, suka mencoba fitur baru, dan ingin terus upgrade kemampuan diri.',
                'telepon' => '089750283164',
            ],
            [
                'nama' => 'Dwi Mardiana',
                'email' => 'dwimardiana104@gmail.com',
                'bio' => 'Suka belajar dengan sistem yang rapi, mudah digunakan, dan tidak terlalu ribet untuk diikuti.',
                'telepon' => '085189406723',
            ],
            [
                'nama' => 'Ayu Lestari',
                'email' => 'ayulestari2321500134@gmail.com',
                'bio' => 'Mahasiswa yang suka mencoba hal baru, aktif memberi masukan, dan senang belajar lewat platform online.',
                'telepon' => '083246751098',
            ],
            [
                'nama' => 'Serli Aliansyah',
                'email' => 'serlialiansyah2321500121@gmail.com',
                'bio' => 'Suka belajar dengan cara yang fleksibel, aktif mengikuti perkembangan digital, dan ingin terus berkembang.',
                'telepon' => '081173064529',
            ],
            [
                'nama' => 'Moh. Lailul Ilham',
                'email' => 'mohlailulilham2321500073@gmail.com',
                'bio' => 'Mahasiswa yang tertarik dengan kursus online, apalagi kalau setelah selesai bisa mendapatkan sertifikat.',
                'telepon' => '087820597416',
            ],
            [
                'nama' => 'Siti Aisa',
                'email' => 'sitiaisah2321500120@gmail.com',
                'bio' => 'Suka belajar hal baru, aktif mencoba sistem digital, dan senang dengan platform yang mudah digunakan.',
                'telepon' => '088169423075',
            ],

            // Data tambahan random
            [
                'nama' => 'Rahmat Hidayat',
                'email' => 'rahmathidayat@gmail.com',
                'bio' => 'Mahasiswa yang suka belajar sedikit demi sedikit, aktif mencari pengalaman, dan terus upgrade diri.',
                'telepon' => '081250847396',
            ],
            [
                'nama' => 'Salsabila Zahra',
                'email' => 'salsabilazahra@gmail.com',
                'bio' => 'Suka belajar lewat video dan materi singkat, karena lebih mudah dipahami dan tidak membosankan.',
                'telepon' => '085537209186',
            ],
            [
                'nama' => 'Ilham Maulana',
                'email' => 'ilhammaulana@gmail.com',
                'bio' => 'Mahasiswa yang tertarik dengan teknologi, suka praktik langsung, dan aktif mencoba hal baru.',
                'telepon' => '089684015273',
            ],
            [
                'nama' => 'Putri Amelia',
                'email' => 'putriamelia@gmail.com',
                'bio' => 'Suka belajar online karena lebih fleksibel, bisa menyesuaikan waktu, dan tetap produktif dari mana saja.',
                'telepon' => '083821576049',
            ],
            [
                'nama' => 'Bagus Setiawan',
                'email' => 'bagussetiawan@gmail.com',
                'bio' => 'Mahasiswa yang suka materi praktis, aktif belajar skill baru, dan ingin terus berkembang di dunia digital.',
                'telepon' => '082167493058',
            ],
            [
                'nama' => 'Intan Permatasari',
                'email' => 'intanpermatasari@gmail.com',
                'bio' => 'Suka mengikuti kelas online untuk menambah pengalaman, wawasan, dan bekal untuk masa depan.',
                'telepon' => '087749061825',
            ],
            [
                'nama' => 'Hasan Basri',
                'email' => 'hasanbasri@gmail.com',
                'bio' => 'Mahasiswa yang suka mencoba platform belajar baru, aktif mencari ilmu, dan terus berusaha lebih baik.',
                'telepon' => '081325809467',
            ],
            [
                'nama' => 'Maulida Safitri',
                'email' => 'maulidasafitri@gmail.com',
                'bio' => 'Suka belajar mandiri, aktif mengeksplor materi, dan senang kalau bisa belajar sesuai kecepatan sendiri.',
                'telepon' => '088970632145',
            ],
            [
                'nama' => 'Ardiansyah Putra',
                'email' => 'ardiansyahputra@gmail.com',
                'bio' => 'Mahasiswa yang suka belajar dari pengalaman, mencoba hal baru, dan mengembangkan kemampuan secara bertahap.',
                'telepon' => '085741986302',
            ],
            [
                'nama' => 'Fitri Handayani',
                'email' => 'fitrihandayani@gmail.com',
                'bio' => 'Suka belajar online karena praktis, fleksibel, dan bisa membantu tetap produktif di sela aktivitas.',
                'telepon' => '081863259074',
            ],
            [
                'nama' => 'Reza Aditya',
                'email' => 'rezaaditya@gmail.com',
                'bio' => 'Mahasiswa yang tertarik dengan sistem informasi, teknologi digital, dan cara belajar yang lebih modern.',
                'telepon' => '089827145609',
            ],
            [
                'nama' => 'Khadijah Azzahra',
                'email' => 'khadijahazzahra@gmail.com',
                'bio' => 'Suka ikut kelas online untuk menambah skill, pengalaman, dan wawasan yang berguna ke depannya.',
                'telepon' => '085294063187',
            ],
            [
                'nama' => 'Yoga Pratama',
                'email' => 'yogapratama@gmail.com',
                'bio' => 'Mahasiswa yang suka belajar hal teknis, aktif praktik, dan terus mencoba meningkatkan kemampuan diri.',
                'telepon' => '083371284950',
            ],
            [
                'nama' => 'Silvia Rahmawati',
                'email' => 'silviarahmawati@gmail.com',
                'bio' => 'Suka belajar dengan materi yang ringan, jelas, dan tetap membantu untuk berkembang secara pribadi.',
                'telepon' => '081650492738',
            ],
            [
                'nama' => 'Bayu Nugroho',
                'email' => 'bayunugroho@gmail.com',
                'bio' => 'Mahasiswa yang suka belajar mandiri, aktif mencari peluang baru, dan terus mengembangkan potensi diri.',
                'telepon' => '088716958204',
            ],
        ];

        foreach ($pengguna as $item) {
            DB::table('pengguna')->updateOrInsert(
                ['email' => $item['email']],
                [
                    'nama' => $item['nama'],
                    'password' => Hash::make('pengguna123'),
                    'foto_profil' => null,
                    'bio' => $item['bio'],
                    'telepon' => $item['telepon'],
                    'terverifikasi' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}