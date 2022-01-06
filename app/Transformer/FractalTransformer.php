<?php

namespace App\Transformer;

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\TransformerAbstract;

trait FractalTransformer
{
    private Manager|null $fractal = null;

    public function item(mixed $resource, TransformerAbstract $transformer): array
    {
        return $this->fractal()
            ->createData(new Item($resource, $transformer))
            ->toArray();
    }

    public function collection(
        mixed $resources,
        TransformerAbstract $transformer,
        mixed $paginator = null
    ): array {
        $collection = new Collection($resources, $transformer);
        if ($paginator) {
            $collection->setPaginator(new IlluminatePaginatorAdapter($paginator));
        }

        return $this->fractal()->createData($collection)->toArray();
    }

    public function parseIncludes(array|string $includes): self
    {
        $this->fractal()->parseIncludes($includes);

        return $this;
    }

    private function fractal(): Manager
    {
        if (!$this->fractal) {
            $this->fractal = new Manager();
        }

        $this->fractal->setSerializer(new ArraySerializer());

        return $this->fractal;
    }
}
