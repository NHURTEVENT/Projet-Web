<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180416144327 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE upvote (user_id_id INT NOT NULL, idea_id_id INT NOT NULL, INDEX IDX_68AB87669D86650F (user_id_id), INDEX IDX_68AB87663E83AD82 (idea_id_id), PRIMARY KEY(user_id_id, idea_id_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE upvote ADD CONSTRAINT FK_68AB87669D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE upvote ADD CONSTRAINT FK_68AB87663E83AD82 FOREIGN KEY (idea_id_id) REFERENCES idea (id)');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B79F37AE5');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507BE00EE68D');
        $this->addSql('DROP INDEX IDX_2246507B79F37AE5 ON basket');
        $this->addSql('DROP INDEX IDX_2246507BE00EE68D ON basket');
        $this->addSql('ALTER TABLE basket DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE basket ADD user_id_id INT NOT NULL, ADD product_id_id INT NOT NULL, DROP id_user_id, DROP id_product_id');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BDE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_2246507B9D86650F ON basket (user_id_id)');
        $this->addSql('CREATE INDEX IDX_2246507BDE18E50B ON basket (product_id_id)');
        $this->addSql('ALTER TABLE basket ADD PRIMARY KEY (user_id_id, product_id_id)');
        $this->addSql('ALTER TABLE event ADD reported INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE admin admin TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE upvote');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B9D86650F');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507BDE18E50B');
        $this->addSql('DROP INDEX IDX_2246507B9D86650F ON basket');
        $this->addSql('DROP INDEX IDX_2246507BDE18E50B ON basket');
        $this->addSql('ALTER TABLE basket DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE basket ADD id_user_id INT NOT NULL, ADD id_product_id INT NOT NULL, DROP user_id_id, DROP product_id_id');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BE00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_2246507B79F37AE5 ON basket (id_user_id)');
        $this->addSql('CREATE INDEX IDX_2246507BE00EE68D ON basket (id_product_id)');
        $this->addSql('ALTER TABLE basket ADD PRIMARY KEY (id_user_id, id_product_id)');
        $this->addSql('ALTER TABLE event DROP reported');
        $this->addSql('ALTER TABLE user CHANGE admin admin VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
