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
     * @var boolean
     */
    protected $isReversed = false;

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
            $previous = $this->_findPrevious($value);

            if ($previous === null) {
                $newNode->setNext($this->head);
                $this->head = $newNode;
            } else {
                $newNode->setNext($previous->getNext());
                $previous->setNext($newNode);
            }
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
        $this->isReversed = !$this->isReversed;

        return $this;
    }

    /**
     * Find last node that has a value less-than-or-equal-to the supplied value (if list is forward-ordered).
     * If list is reverse ordered, this will find the node with value greater-than-or-equal-to the supplied value.
     *
     * @param integer $value
     * @return LinkedListNode|null
     */
    protected function _findPrevious(int $value): ?LinkedListNode
    {
        $previous = null;
        $current = $this->head;

        while ($current !== null) {
            if ($this->_isNodeAfterValue($current, $value)) {
                break;
            }

            $previous = $current;
            $current = $previous->getNext();
        }

        return $previous;
    }

    /**
     * Check if the supplied node should be placed later in the list than the value passed.
     *
     * @param LinkedListNode $node
     * @param integer $value
     * @return boolean
     */
    protected function _isNodeAfterValue(LinkedListNode $node, int $value): bool
    {
        return $this->isReversed
            ? $value >= $node->getValue()
            : $value <= $node->getValue();
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