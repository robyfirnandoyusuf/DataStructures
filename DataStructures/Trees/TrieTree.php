<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Trees;

use DataStructures\Trees\Nodes\TrieNode;

/**
 * TrieTree
 *
 * The TrieTree class is a trie (also called digital tree and sometimes radix tree or prefix tree)
 * that is used to get in O(m) being m the word length.
 * It is used in software like word corrector and word suggest.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class TrieTree implements Countable {
    private $root;
    private $numWords;
    private $size;
    
    public function __construct() {
        $this->root = new TrieNode();
        $this->numWords = 0;
        $this->size = 0;
    }

    public function numWords() : int {
        return $this->numWords;
    }

    public function size() : int {
        return $this->size;
    }

    public function add($word) {
        $word = trim($word);
        if(mb_strlen($word) === 0) {
            return;
        }

        $current = &$this->root;
        for($i = 0; $i < mb_strlen($word); $i++) {
            $char = mb_substr($word, $i, 1, 'UTF-8');
            if(!isset($current->children[$char])) {
                if($i === mb_strlen($word) - 1) {
                    $current->children[$char] = new TrieNode($char, true);
                } else {
                    $current->children[$char] = new TrieNode($char, false);
                }
            }
            $current = &$current->children[$char];
        }
    }

    public function count() {
        return $this->size();
    }
}