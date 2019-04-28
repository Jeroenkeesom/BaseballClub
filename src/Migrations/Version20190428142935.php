<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190428142935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE event_presence_player');
        $this->addSql('ALTER TABLE event_presence ADD player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event_presence ADD CONSTRAINT FK_2F9B2E7599E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('CREATE INDEX IDX_2F9B2E7599E6F5DF ON event_presence (player_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql(
            'CREATE TABLE event_presence_player (event_presence_id INT NOT NULL, player_id INT NOT NULL, INDEX IDX_BC5BAF4558A12C44 (event_presence_id), INDEX IDX_BC5BAF4599E6F5DF (player_id), PRIMARY KEY(event_presence_id, player_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' '
        );
        $this->addSql('ALTER TABLE event_presence_player ADD CONSTRAINT FK_BC5BAF4558A12C44 FOREIGN KEY (event_presence_id) REFERENCES event_presence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_presence_player ADD CONSTRAINT FK_BC5BAF4599E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_presence DROP FOREIGN KEY FK_2F9B2E7599E6F5DF');
        $this->addSql('DROP INDEX IDX_2F9B2E7599E6F5DF ON event_presence');
        $this->addSql('ALTER TABLE event_presence DROP player_id');
    }
}
