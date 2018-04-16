<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180415094010 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product CHANGE popularity popularity INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE category ADD category INT NOT NULL');
        $this->addSql('ALTER TABLE event CHANGE ponctual ponctual TINYINT(1) DEFAULT \'1\' NOT NULL, CHANGE free free TINYINT(1) DEFAULT \'1\' NOT NULL, CHANGE price price INT DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category DROP category');
        $this->addSql('ALTER TABLE event CHANGE ponctual ponctual TINYINT(1) NOT NULL, CHANGE free free TINYINT(1) NOT NULL, CHANGE price price INT NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE popularity popularity VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
