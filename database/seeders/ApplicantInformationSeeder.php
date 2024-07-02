<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicantInformation;

class ApplicantInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApplicantInformation::create([
            'rate' => '$6',
            'videolink' => 'https://drive.google.com/file/d/1Oc68HLHWv92kj8-LVXHEWKZjrAcLrUHt/view?usp=sharing',
            'portfolio' => 'None',
            'experience' => 4,
            'resume' => 'pdfs/14CBKMQkg5npitKz1g2NuoQHnt7Qp7GxEwNr9mPi.pdf',
            'user_id' => 7
        ]);

        ApplicantInformation::create([
            'rate' => '$6',
            'videolink' => 'https://www.loom.com/share/b26ec024fbf0479fb0b1f9afc3b2cc3a?sid=b3cb16d4-76a3-40d9-a4ad-f0054383e386',
            'portfolio' => 'https://docs.google.com/presentation/d/1V4o6Pd3RMwL_qwNMhBBkHXsQm305Rd2I/edit?usp=sharing&ouid=112287636690359432606&rtpof=true&sd=true',
            'experience' => 2,
            'resume' => 'pdfs/Pi05lvQiY9SaghgFozheFj02v2sjqwv4ZfdGdcZz.pdf',
            'user_id' => 9
        ]);

        ApplicantInformation::create([
            'rate' => '$8/hr',
            'videolink' => 'https://www.loom.com/share/be1fbd3637724aed870abc95efe4c7c0',
            'portfolio' => 'None',
            'experience' => 2,
            'resume' => 'pdfs/EFrMBSBt3gXpdEgsm2cVu3fQM11V6qlawcvFO7Gg.pdf',
            'user_id' => 14
        ]);

        ApplicantInformation::create([
            'rate' => '30,000-40,000',
            'videolink' => '.',
            'portfolio' => 'None',
            'experience' => 1,
            'resume' => 'pdfs/pIQiwvW8wJ1hB1nuJDb2bCw2wYG7WjZfoBdFMzYY.pdf',
            'user_id' => 22
        ]);

        ApplicantInformation::create([
            'rate' => '587.00',
            'videolink' => 'https://drive.google.com/file/d/1o2In7Q1hBMP4qe2xZMKlJ38-4O7ErBvr/view?usp=sharing',
            'portfolio' => 'https://drive.google.com/file/d/1WRQTtYuNRWNGWhVOpuU36rirUIEqhG-c/view?usp=sharing',
            'experience' => 4,
            'resume' => 'pdfs/oaNtMaIdbU98MlgWXjkE665My97BICayjPjzu48l.pdf',
            'user_id' => 25
        ]);

        ApplicantInformation::create([
            'rate' => '40,000',
            'videolink' => 'https://www.youtube.com/watch?v=KnTfQQJLW_g',
            'portfolio' => 'https://bit.ly/myportfoliokaidea',
            'experience' => 2,
            'resume' => 'pdfs/eaq9TPvTFJkT7y5HxE83ZHpeE9YRQRq9RGJ4D4iB.pdf',
            'user_id' => 27
        ]);

        ApplicantInformation::create([
            'rate' => '25,000',
            'videolink' => 'https://drive.google.com/file/d/1IXdWr45YKg3LHHlqsdOeD9cggIxYJz5K/view?usp=drive_link',
            'portfolio' => 'https://drive.google.com/drive/u/5/folders/1ztnMPa2Z7WtrPFDR_v8gIdmQZSjPCmWM',
            'experience' => 1,
            'resume' => 'pdfs/qKTDQ4z1cAUsO4A2hoQu0EoUc61TjK1hi8f78Glg.pdf',
            'user_id' => 31
        ]);

        ApplicantInformation::create([
            'rate' => '40,000',
            'videolink' => 'https://drive.google.com/file/d/19aMqWRjhYDblXs3Sq-NaBpsdOMCVuxRE/view?usp=sharing',
            'portfolio' => 'None',
            'experience' => 9,
            'resume' => 'pdfs/I8yzqBcsEGxg0bdR0PwETN56hSTmjO5VzUkukBbc.pdf',
            'user_id' => 36
        ]);

        ApplicantInformation::create([
            'rate' => '30,000',
            'videolink' => 'https://www.loom.com/share/9500486c651a4803aedefecb58919e21?sid=3ce1139a-0875-4168-b85e-10de55891e7a',
            'portfolio' => 'None',
            'experience' => 3,
            'resume' => 'pdfs/fGL5CUde6LPPNqAQZS1REToXXTdUXqBYa99qZB81.pdf',
            'user_id' => 41
        ]);

        ApplicantInformation::create([
            'rate' => '30,000 and up',
            'videolink' => 'https://www.loom.com/share/eee77907d4a84cf0b60a063fa0d5317c?sid=d404c62f-48be-451b-aa96-4431345d32d3',
            'portfolio' => 'None',
            'experience' => 5,
            'resume' => 'pdfs/S6tS9M5ve5N6Twn2xJB9oINFRldirx4zTfwijyx9.pdf',
            'user_id' => 49
        ]);
    }
}
