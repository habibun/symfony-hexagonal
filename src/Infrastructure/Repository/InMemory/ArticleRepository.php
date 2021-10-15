<?php

namespace Infrastructure\Repository\InMemory;

use Doctrine\Common\Collections\ArrayCollection;
use Domain\Model\Article\Article;
use Domain\Model\Article\ArticleException;
use Domain\Model\Article\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface
{
    public array $articles = [];

    public function __construct()
    {
        $this->articles = [
            new Article('a', true, 'A', 'aaa'),
            new Article('b', true, 'B', 'bbb'),
            new Article('c', true, 'C', 'ccc'),
        ];
    }

    public function create(Article $article): void
    {
        $this->articles[$article->getId()] = $article;
    }

    /**
     * @throws ArticleException
     */
    public function getById(int $id): Article
    {
        if (!array_key_exists($id, $this->articles)) {
            throw new ArticleException('Article don\'t exist.');
        }

        return $this->articles[$id];
    }

    /**
     * @return ArrayCollection|Article[]
     */
    public function getList(int $limit = 0, int $offset = 0): ArrayCollection
    {
        return new ArrayCollection($this->articles);
    }
}
