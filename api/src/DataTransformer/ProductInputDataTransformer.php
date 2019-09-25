<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Product;

class ProductInputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $product = new Product();
        $product->name = $data->name;
        $product->description = $data->description;

        return $product;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a product we transformed the data already
        if ($data instanceof Product) {
          return false;
        }

        return Product::class === $to && null !== ($context['input']['class'] ?? null);
    }
}
