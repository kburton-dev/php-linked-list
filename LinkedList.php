<?php declare(strict_types=1);

require_once('LinkedListNode.php');

/**
 * Linked list of nodes containing integer values. This linked list will maintain
 * an ordered list of nodes from smallest to greatest. Inserting a new node will
 * place it in the correct position, so the list should never need to be reordered.
 */
class LinkedList
{
    /**
     * @var ?LinkedListNode
     */
    protected $head = null;

    /**
     * Return the head node, first node in the list
     *
     * @return LinkedListNode|null
     */
    public function getHead(): ?LinkedListNode
    {
        return $this->head;
    }

    /**
     * Add a new node in the relevant position in the list
     *
     * @param integer $value
     * @return self
     */
    public function add(int $value): self
    {
        $newNode = new LinkedListNode($value);

        if ($this->head === null) {
            $this->head = $newNode;
        } else {
            $node = $this->_findLastNodeLteValue($value);

            $newNode->setNext($node->getNext());
            $node->setNext($newNode);
        }

        return $this;
    }

    /**
     * Reverse list
     *
     * @return self
     */
    public function reverse(): self
    {
        $current = $this->head;
        $previous = null;
        $next = null;

        while ($current !== null) {
            $next = $current->getNext();
            $current->setNext($previous);
            $previous = $current;
            $current = $next;
        }

        $this->head = $previous;

        return $this;
    }

    /**
     * Find last node that has a value less-than-or-equal-to the supplied value
     *
     * @param integer $value
     * @return LinkedListNode
     */
    protected function _findLastNodeLteValue(int $value): LinkedListNode
    {
        $current = $this->head;

        if ($current === null) {
            throw new \RuntimeException('List is empty, cannot find "next" node.');
        }

        while ($current->getNext() !== null && $value >= $current->getNext()->getValue()) {
            $current = $current->getNext();
        }

        return $current;
    }

    /**
     * Debug list by just echoing the values of each node
     *
     * @return self
     */
    public function debug(): self
    {
        $node = $this->getHead();
        $values = [];

        while ($node) {
            $values[] = $node->getValue();
            $node = $node->getNext();
        }

        echo implode(', ', $values) . "\n";

        return $this;
    }
}