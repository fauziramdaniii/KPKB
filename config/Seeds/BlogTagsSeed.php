<?php
use Migrations\AbstractSeed;

/**
 * BlogTags seed.
 */
class BlogTagsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'blog_id' => '1',
                'tag_id' => '1',
            ],
            [
                'id' => '2',
                'blog_id' => '1',
                'tag_id' => '2',
            ],
            [
                'id' => '3',
                'blog_id' => '2',
                'tag_id' => '1',
            ],
            [
                'id' => '4',
                'blog_id' => '3',
                'tag_id' => '1',
            ],
            [
                'id' => '5',
                'blog_id' => '4',
                'tag_id' => '2',
            ],
            [
                'id' => '6',
                'blog_id' => '5',
                'tag_id' => '2',
            ],
            [
                'id' => '7',
                'blog_id' => '6',
                'tag_id' => '1',
            ],
            [
                'id' => '8',
                'blog_id' => '7',
                'tag_id' => '2',
            ],
        ];

        $table = $this->table('blog_tags');
        $table->insert($data)->save();
    }
}
