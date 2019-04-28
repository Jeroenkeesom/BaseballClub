<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190428143922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add default data.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            "
            INSERT INTO `event_type`(`id`, `name`) VALUES (1, 'Game');
            INSERT INTO `event_type`(`id`, `name`) VALUES (2, 'Training');
        "
        );

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
