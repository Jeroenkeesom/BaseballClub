<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190428142830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql(
            'CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, date DATE NOT NULL, no_of_innings INT DEFAULT NULL, INDEX IDX_3BAE0AA7C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, team_id INT NOT NULL, active TINYINT(1) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, nick_name VARCHAR(255) NOT NULL, shirt_number INT DEFAULT NULL, preferred_position VARCHAR(255) DEFAULT NULL, active_since DATE DEFAULT NULL, INDEX IDX_98197A65296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );
        $this->addSql('CREATE TABLE event_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql(
            'CREATE TABLE event_presence (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, no_of_innings_played INT DEFAULT NULL, INDEX IDX_2F9B2E7571F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE event_presence_player (event_presence_id INT NOT NULL, player_id INT NOT NULL, INDEX IDX_BC5BAF4558A12C44 (event_presence_id), INDEX IDX_BC5BAF4599E6F5DF (player_id), PRIMARY KEY(event_presence_id, player_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7C54C8C93 FOREIGN KEY (type_id) REFERENCES event_type (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE event_presence ADD CONSTRAINT FK_2F9B2E7571F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event_presence_player ADD CONSTRAINT FK_BC5BAF4558A12C44 FOREIGN KEY (event_presence_id) REFERENCES event_presence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_presence_player ADD CONSTRAINT FK_BC5BAF4599E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65296CD8AE');
        $this->addSql('ALTER TABLE event_presence DROP FOREIGN KEY FK_2F9B2E7571F7E88B');
        $this->addSql('ALTER TABLE event_presence_player DROP FOREIGN KEY FK_BC5BAF4599E6F5DF');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7C54C8C93');
        $this->addSql('ALTER TABLE event_presence_player DROP FOREIGN KEY FK_BC5BAF4558A12C44');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE event_type');
        $this->addSql('DROP TABLE event_presence');
        $this->addSql('DROP TABLE event_presence_player');
    }
}
