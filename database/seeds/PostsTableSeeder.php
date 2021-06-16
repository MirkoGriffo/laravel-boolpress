<?php

use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            //istanza
            $new_post = new Post();

            $new_post->title = 'Post title ' . ($i + 1);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->content = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            Hic rerum quasi dicta nostrum nisi eius soluta distinctio nihil molestiae modi.
            Cumque laborum nobis illo tempora nulla rem in quo enim!';

            //save
            $new_post->save();

        }
    }
}
