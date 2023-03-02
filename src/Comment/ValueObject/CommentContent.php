<?php

declare(strict_types=1);

namespace Comment\ValueObject;

use Assert\Assert;
use Assert\LazyAssertionException;
use Comment\Exception\InvalidCommentContentException;

class CommentContent
{
    private string $content;

    public function __construct(string $content)
    {
        $content = trim($content);
        try{
            Assert::lazy()
                ->that($content, 'content')
                ->string("must be a string")
                ->minLength(2)
                ->maxLength(255)
                ->verifyNow();
        } catch (LazyAssertionException $exception){
            throw new InvalidCommentContentException(sprintf($exception->getPropertyPath().'%s'.$exception->getMessage()," "));
        }

        $this->content = trim($content);
    }

    public function getContent(): string
    {
        return $this->content;
    }
}