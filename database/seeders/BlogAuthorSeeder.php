<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Stephenjude\FilamentBlog\Models\Author;

class BlogAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::updateOrCreate(
            ['email' => 'info@histone.com.pk'],
            [
                'name' => 'Histone Solutions',
                'email' => 'info@histone.com.pk',
                'bio' => 'Histone Solutions is a leading software development company specializing in Full Stack Development, Amazon SP-API Integration, and AI-powered solutions. With 14+ years of experience, we deliver enterprise-grade, production-ready software for businesses worldwide.',
                'photo' => null,
                'github_handle' => 'histoneweb',
                'twitter_handle' => null,
            ]
        );

        $this->command->info('✅ Blog author "Histone Solutions" created/updated successfully!');
    }
}
