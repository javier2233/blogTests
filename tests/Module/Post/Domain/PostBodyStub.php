<?php


namespace BlogTest\Module\Post\Domain;


use Badcow\LoremIpsum\Generator;
use Blog\Module\Post\Domain\PostBody;

class PostBodyStub
{

    public function create($paragraphs)
    {
        $generator = new Generator();
        $body = $generator->getParagraphs($paragraphs);
        $body = implode(PHP_EOL, $body);
        return new PostBody($body);
    }

}