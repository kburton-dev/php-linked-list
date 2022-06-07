<?php declare(strict_types=1);

class LinkedListNode
{
    /**
     * @var int
     */
    protected $value;

    /**
     * @var ?LinkedListNode
     */
    protected $next = null;

    /**
     * Create linked list node by supplying value
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Get node value
     *
     * @return integer
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * Get next node
     *
     * @return LinkedListNode|null
     */
    public function getNext(): ?LinkedListNode
    {
        return $this->next;
    }

    /**
     * Set next node
     *
     * @param LinkedListNode $next
     * @return void
     */
    public function setNext(?LinkedListNode $next): void
    {
        $this->next = $next;
    }
}