<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use App\Service\AbstractFixtureMigration;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180220191959 extends AbstractMigration implements ContainerAwareInterface
{
    private $container;

    public function up(Schema $schema)
    {
        //$this->container->get();
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
