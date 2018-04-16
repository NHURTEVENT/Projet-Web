<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180413133122 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subscription DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE subscription ADD user_id_id INT NOT NULL, ADD event_id_id INT NOT NULL, DROP user_id, DROP event_id');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D39D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D33E5F2F7B FOREIGN KEY (event_id_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_A3C664D39D86650F ON subscription (user_id_id)');
        $this->addSql('CREATE INDEX IDX_A3C664D33E5F2F7B ON subscription (event_id_id)');
        $this->addSql('ALTER TABLE subscription ADD PRIMARY KEY (user_id_id, event_id_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D39D86650F');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D33E5F2F7B');
        $this->addSql('DROP INDEX IDX_A3C664D39D86650F ON subscription');
        $this->addSql('DROP INDEX IDX_A3C664D33E5F2F7B ON subscription');
        $this->addSql('ALTER TABLE subscription DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE subscription ADD user_id INT NOT NULL, ADD event_id INT NOT NULL, DROP user_id_id, DROP event_id_id');
        $this->addSql('ALTER TABLE subscription ADD PRIMARY KEY (user_id, event_id)');
    }
}
