<?php

declare(strict_types=1);

namespace App\Migrations;

use AppBundle\Entity\Main\Category;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class Version20201124194051 extends AbstractMigration implements ContainerAwareInterface
{
    /** @var ContainerInterface */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        /** @var EntityManagerInterface $em */
        $em = $this->container->get('doctrine.orm.entity_manager');

        /** @var Category[] $categories */
        $categories = $em->getRepository(Category::class)->findAll();
        $urlSlugsArray = [];
        foreach ($categories as $key => $category) {
            $slugExploded = explode('-', $category->getSlug());
            array_shift($slugExploded);
            $urlSlug = str_replace(' ', '-', implode('-', $slugExploded));
            if (in_array($urlSlug, $urlSlugsArray)) {
                $urlSlug = $urlSlug . '-1';
            }
            $urlSlugsArray[] = $urlSlug;

            $category->setSlugUrl($urlSlug);
        }
        $em->flush();
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
