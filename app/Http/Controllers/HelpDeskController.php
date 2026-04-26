<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpDeskController extends Controller
{
    public function index()
    {
        $faqs = [
            [
                'icon' => 'bi-shield-check',
                'question' => 'Layanan apa yang ditawarkan oleh AgriSmart?',
                'answer' => 'Kami menyediakan solusi sistem pertanian cerdas, monitoring lahan, analisis data, dan konsultasi teknologi pertanian.'
            ],
            [
                'icon' => 'bi-cpu',
                'question' => 'Jenis sistem apa yang dikembangkan?',
                'answer' => 'Kami mengembangkan sistem monitoring IoT, dashboard analitik, dan aplikasi pendukung pertanian.'
            ],
            [
                'icon' => 'bi-tools',
                'question' => 'Apakah tersedia dukungan dan pemeliharaan?',
                'answer' => 'Ya, kami menyediakan dukungan berkelanjutan untuk memastikan sistem berjalan optimal.'
            ],
            [
                'icon' => 'bi-clock-history',
                'question' => 'Berapa lama waktu pengembangan sistem?',
                'answer' => 'Waktu pengembangan tergantung pada kompleksitas sistem dan kebutuhan pengguna.'
            ],
            [
                'icon' => 'bi-graph-up',
                'question' => 'Apa manfaat konsultasi teknologi?',
                'answer' => 'Membantu meningkatkan efisiensi, produktivitas, dan pengambilan keputusan berbasis data.'
            ],
            [
                'icon' => 'bi-chat-dots',
                'question' => 'Bagaimana proses konsultasi?',
                'answer' => 'Dimulai dari analisis kebutuhan, perencanaan solusi, hingga implementasi.'
            ],
        ];

        return view('helpdesk', compact('faqs'));
    }
}
