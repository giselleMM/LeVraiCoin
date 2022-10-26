<?php

namespace App\Factory;

use App\Entity\PicturePost;
use App\Repository\PicturePostRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<PicturePost>
 *
 * @method static PicturePost|Proxy createOne(array $attributes = [])
 * @method static PicturePost[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static PicturePost[]|Proxy[] createSequence(array|callable $sequence)
 * @method static PicturePost|Proxy find(object|array|mixed $criteria)
 * @method static PicturePost|Proxy findOrCreate(array $attributes)
 * @method static PicturePost|Proxy first(string $sortedField = 'id')
 * @method static PicturePost|Proxy last(string $sortedField = 'id')
 * @method static PicturePost|Proxy random(array $attributes = [])
 * @method static PicturePost|Proxy randomOrCreate(array $attributes = [])
 * @method static PicturePost[]|Proxy[] all()
 * @method static PicturePost[]|Proxy[] findBy(array $attributes)
 * @method static PicturePost[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static PicturePost[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PicturePostRepository|RepositoryProxy repository()
 * @method PicturePost|Proxy create(array|callable $attributes = [])
 */
final class PicturePostFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'photo' => self::faker()->image(null, 360, 360, 'object', true),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(PicturePost $picturePost): void {})
        ;
    }

    protected static function getClass(): string
    {
        return PicturePost::class;
    }
}
