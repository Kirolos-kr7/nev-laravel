<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'kirolos rafaat',
            'username' => 'kirolos',
            'email' => 'k@k.co',
            'password' => bcrypt('k123456'),
            'location' => 'egypt',
            'bio' => '',
        ]);

        Post::create([
            'title' => 'How to Change Your Life: 19 Ways to Improve Your Life Right Now',
            'slug' => 'how-to-change-your-life-19-ways-to-improve-your-life-right-now',
            'content' => '<p style="text-align: left">Life is rough sometimes. It’s hard, and it’s painful, and it’s every day. But it doesn’t have to be hard all the time. Starting today, you can change your life by&nbsp;<a target="_blank" rel="noopener noreferrer nofollow" href="https://partnersinfire.com/lifestyle/goal-setting/">setting goals</a>&nbsp;and implementing small changes that add up over time. Start developing good habits and learn how to change your life.&nbsp;</p><h3 style="text-align: left"><strong>What 3 Habits Will Improve Your Life?</strong></h3><p style="text-align: start">Improving your life is sometimes about building good habits. There are many things on this list, but when we talk about building a healthy lifestyle, we are talking about building good habits that will improve your life.</p><p style="text-align: start">Here are the top three habits you develop to improve your life.&nbsp;</p><hr><h3 style="text-align: start"><strong>Meditate</strong></h3><p style="text-align: start">Meditation is on every life improvement list for a reason. It works. Meditating for just 10 minutes a day can make you happier and healthier. It will reduce stress and improve your mindfulness.</p><p style="text-align: start">Getting started with meditation can be difficult. I was resistant to it because the thought of sitting still with just my thoughts for ten whole minutes (or more!) seemed horrible! How do you even clear your mind?</p><p style="text-align: start">The key to learning to meditate, like anything, is practice. It’s going to feel weird the first few times. Your brain won’t stop thinking it’s random thoughts, so don’t expect it. Acknowledge the thoughts and let them flow through you, and move on. Don’t linger on anything. As you get used to it, you’ll see that it decreases stress and increases your wellbeing. <a target="_blank" rel="noopener noreferrer nofollow" href="google">clickhere</a></p><hr><h3 style="text-align: start"><strong>Exercise</strong></h3><p style="text-align: start">When you’re feeling down, the last thing you want to do is work out. I know. Moving your body in a strenuous workout sounds terrible. But exercising doesn’t have to be harsh. I’m not telling you to run a marathon or compete in a trilithon. I’m telling you that you can improve your life right now just by getting your blood flowing a little.</p>',
            'image' => 'https://firebasestorage.googleapis.com/v0/b/bloxy-x.appspot.com/o/posts%2Ff891ecab-61d8-4de5-bc11-b3dd5168a8da?alt=media&token=3644bc39-d7ab-4bd0-b45a-fe3668abb7ee',
            'description' => 'How to Change Your Life: 19 Ways to Improve Your Life Right Now'
        ]);
    }
}
