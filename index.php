<?php declare(strict_types=1);

require_once('LinkedList.php');

$linkedList = new LinkedList();

$linkedList->add(1)
    ->add(3)
    ->add(5)
    ->add(2)
    ->add(7)
    ->add(2)
    ->add(9)
    ->add(8)
    ->add(3)
    ->add(1);

$linkedList->debug()
    ->reverse()
    ->debug();
