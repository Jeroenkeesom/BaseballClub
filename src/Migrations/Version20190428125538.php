<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190428125538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE access_token ADD token VARCHAR(255) NOT NULL, ADD expires_at INT DEFAULT NULL, ADD scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6A2DD685F37A13B ON access_token (token)');
        $this->addSql('ALTER TABLE refresh_token ADD token VARCHAR(255) NOT NULL, ADD expires_at INT DEFAULT NULL, ADD scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74F21955F37A13B ON refresh_token (token)');
        $this->addSql('ALTER TABLE `group` ADD name VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6DC044C55E237E06 ON `group` (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_B6A2DD685F37A13B ON access_token');
        $this->addSql('ALTER TABLE access_token DROP token, DROP expires_at, DROP scope');
        $this->addSql('DROP INDEX UNIQ_6DC044C55E237E06 ON `group`');
        $this->addSql('ALTER TABLE `group` DROP name, DROP roles');
        $this->addSql('DROP INDEX UNIQ_C74F21955F37A13B ON refresh_token');
        $this->addSql('ALTER TABLE refresh_token DROP token, DROP expires_at, DROP scope');
    }
}
