<?php

namespace Database\Seeders;

use App\Models\PatientVideo;
use Illuminate\Database\Seeder;

class PatientVideoSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            [
                'youtube_id'        => 'vrF2ciqFfrg',
                'topic_label'       => 'Veteran Testimonial',
                'title'             => 'Clear Speech Restored for Veteran',
                'card_description'  => 'Wg Cdr S.K. Bhatia (Shaurya Chakra) shares his journey of natural hearing clarity.',
                'badge'             => 'Patient Story',
                'duration'          => '3:12',
                'location'          => 'Noida Clinic',
                'modal_title'       => 'Wg Cdr SK Bhatia Shaurya Chakra — Hearing Transformation',
                'modal_badge'       => 'Patient Testimonial',
                'speaker'           => 'Wg Cdr S.K. Bhatia (Shaurya Chakra)',
                'modal_description' => 'Watch Wing Commander S.K. Bhatia (Shaurya Chakra) share his inspiring journey of digital hearing restoration with Turtle Maarks Hearing Health.',
                'sort_order'        => 1,
            ],
            [
                'youtube_id'        => 'juOmFzxFBMg',
                'topic_label'       => 'Life Transformation',
                'title'             => 'Better Hearing for Better Social Life',
                'card_description'  => 'Overcoming hearing loss to reconnect with family conversations and gatherings.',
                'badge'             => 'Social Life',
                'duration'          => '1:15',
                'location'          => 'Greater Noida',
                'modal_title'       => 'Better Hearing for Better Social Life',
                'modal_badge'       => 'Life Transformation',
                'speaker'           => 'Patient Consultation & Journey',
                'modal_description' => 'How advanced digital speech clarity eliminates social isolation and brings confidence back to family gatherings and social outings.',
                'sort_order'        => 2,
            ],
            [
                'youtube_id'        => 'vkNae-Vqu0U',
                'topic_label'       => 'Clinical Guidance',
                'title'             => 'Do Voices Sound Whispered?',
                'card_description'  => 'Doctor explains early symptoms of frequency loss & importance of timely PTA tests.',
                'badge'             => 'Doctor Advice',
                'duration'          => '1:45',
                'location'          => 'Gaur City Clinic',
                'modal_title'       => 'Do you feel People have started speaking with slow voice?',
                'modal_badge'       => 'Doctor Consultation',
                'speaker'           => 'Audiology Clinical Team',
                'modal_description' => 'Clinical explanation on why voices start sounding muffled or low, and how timely Pure Tone Audiometry (PTA) testing prevents irreversible hearing loss.',
                'sort_order'        => 3,
            ],
            [
                'youtube_id'        => 'gL8awpcAedw',
                'topic_label'       => 'Expert Insights',
                'title'             => '1 in 5 in India Has Hearing Loss',
                'card_description'  => 'Medical insights on invisible hearing aids, AI noise reduction & free home trials.',
                'badge'             => 'Awareness',
                'duration'          => '1:30',
                'location'          => 'Noida & G. Noida',
                'modal_title'       => '1 Out of 5 People in India Has Hearing Loss',
                'modal_badge'       => 'Audiologist Guide',
                'speaker'           => 'Turtle Maarks Hearing Health Team',
                'modal_description' => 'Important statistics and medical insights on hearing health in India, highlighting invisible hearing aids, AI noise reduction, and free home trials.',
                'sort_order'        => 4,
            ],
            [
                'youtube_id'        => '4yAlwfAl_i8',
                'topic_label'       => 'Official Anthem',
                'title'             => 'Tere Kaano Ki Awaaz | Official Theme Song',
                'card_description'  => 'Celebrating the joy and beauty of clear sound with our official brand anthem.',
                'badge'             => 'Official Anthem',
                'duration'          => null,
                'location'          => 'Official Studio Release',
                'modal_title'       => 'Tere Kaano Ki Awaaz | Official Theme Song',
                'modal_badge'       => 'Official Anthem',
                'speaker'           => 'Turtle Maarks Hearing Health',
                'modal_description' => 'The official brand anthem celebrating the joy of listening and restoring sound to every life.',
                'is_active'         => false, // extra video — kept off the homepage grid (max 4), visible via edit
                'sort_order'        => 5,
            ],
            [
                'youtube_id'        => 'aH7jAW4jz58',
                'topic_label'       => 'Celebration Event',
                'title'             => 'Gratification Ceremony',
                'card_description'  => 'Special gratification and patient care celebration ceremony at Turtle Maarks.',
                'badge'             => 'Celebration Event',
                'duration'          => null,
                'location'          => 'Turtle Maarks Clinic',
                'modal_title'       => 'Gratification Ceremony @TurtleMaarksHearingHealth',
                'modal_badge'       => 'Celebration Event',
                'speaker'           => 'Audiology Team & Patients',
                'modal_description' => 'Special gratification and patient care celebration ceremony at Turtle Maarks Hearing Health.',
                'is_active'         => false, // extra video — kept off the homepage grid (max 4), visible via edit
                'sort_order'        => 6,
            ],
        ];

        foreach ($videos as $video) {
            $video['is_active'] = $video['is_active'] ?? true;
            PatientVideo::updateOrCreate(['youtube_id' => $video['youtube_id']], $video);
        }
    }
}
