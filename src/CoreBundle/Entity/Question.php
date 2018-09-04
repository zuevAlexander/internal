<?php

namespace CoreBundle\Entity;

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * Class Question.
 *
 * @OGM\Node(label="Question")
 */
class Question
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    private $id;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    private $text;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return (string)$this->text;
    }

    /**
     * @param string $text
     * @return Question
     */
    public function setText(string $text) : self
    {
        $this->text = $text;

        return $this;
    }
}
