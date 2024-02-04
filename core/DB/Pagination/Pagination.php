<?php

namespace Core\DB\Pagination;

use ArrayAccess;
use Iterator;

class Pagination implements ArrayAccess, Iterator
{
    public function __construct(
        private array $results,
        private readonly array $links,
    )
    {
    }

    public function getDatas(): array
    {
        return $this->results;
    }

    public function links(): array
    {
        return $this->links;
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->results[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->results[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->results[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->results[$offset]);
    }

    public function current(): mixed
    {
        return current($this->results);
    }

    public function next(): void
    {
        next($this->results);
    }

    public function key(): mixed
    {
        return key($this->results);
    }

    public function valid(): bool
    {
        $key = key($this->results);
        return ($key !== null && $key !== false);
    }

    public function rewind(): void
    {
        reset($this->results);
    }
}