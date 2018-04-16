<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180413132316 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE basket (id_user_id INT NOT NULL, id_product_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_2246507B79F37AE5 (id_user_id), INDEX IDX_2246507BE00EE68D (id_product_id), PRIMARY KEY(id_user_id, id_product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, event_id_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, reported TINYINT(1) NOT NULL, INDEX IDX_9474526C9D86650F (user_id_id), INDEX IDX_9474526C3E5F2F7B (event_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, begin_date DATETIME NOT NULL, end_date DATETIME NOT NULL, ponctual TINYINT(1) NOT NULL, free TINYINT(1) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE idea (id INT AUTO_INCREMENT NOT NULL, id_creator_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, upvotes INT NOT NULL, INDEX IDX_A8BCA45C4A88E71 (id_creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liked_comment (user_id_id INT NOT NULL, comment_id_id INT NOT NULL, INDEX IDX_EE6C11269D86650F (user_id_id), INDEX IDX_EE6C1126D6DE06A6 (comment_id_id), PRIMARY KEY(user_id_id, comment_id_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liked_event (user_id_id INT NOT NULL, event_id_id INT NOT NULL, INDEX IDX_252B04619D86650F (user_id_id), INDEX IDX_252B04613E5F2F7B (event_id_id), PRIMARY KEY(user_id_id, event_id_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liked_photo (user_id_id INT NOT NULL, photo_id_id INT NOT NULL, INDEX IDX_A328ADE9D86650F (user_id_id), INDEX IDX_A328ADEC51599E0 (photo_id_id), PRIMARY KEY(user_id_id, photo_id_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, product_id_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_F52993989D86650F (user_id_id), INDEX IDX_F5299398DE18E50B (product_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, event_id_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, reported TINYINT(1) NOT NULL, INDEX IDX_14B784189D86650F (user_id_id), INDEX IDX_14B784183E5F2F7B (event_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, price INT NOT NULL, popularity VARCHAR(255) NOT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (user_id INT NOT NULL, event_id INT NOT NULL, PRIMARY KEY(user_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, modo TINYINT(1) NOT NULL, admin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BE00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C3E5F2F7B FOREIGN KEY (event_id_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE idea ADD CONSTRAINT FK_A8BCA45C4A88E71 FOREIGN KEY (id_creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE liked_comment ADD CONSTRAINT FK_EE6C11269D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE liked_comment ADD CONSTRAINT FK_EE6C1126D6DE06A6 FOREIGN KEY (comment_id_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE liked_event ADD CONSTRAINT FK_252B04619D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE liked_event ADD CONSTRAINT FK_252B04613E5F2F7B FOREIGN KEY (event_id_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE liked_photo ADD CONSTRAINT FK_A328ADE9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE liked_photo ADD CONSTRAINT FK_A328ADEC51599E0 FOREIGN KEY (photo_id_id) REFERENCES photo (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784189D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784183E5F2F7B FOREIGN KEY (event_id_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE liked_comment DROP FOREIGN KEY FK_EE6C1126D6DE06A6');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C3E5F2F7B');
        $this->addSql('ALTER TABLE liked_event DROP FOREIGN KEY FK_252B04613E5F2F7B');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784183E5F2F7B');
        $this->addSql('ALTER TABLE liked_photo DROP FOREIGN KEY FK_A328ADEC51599E0');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507BE00EE68D');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398DE18E50B');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B79F37AE5');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C9D86650F');
        $this->addSql('ALTER TABLE idea DROP FOREIGN KEY FK_A8BCA45C4A88E71');
        $this->addSql('ALTER TABLE liked_comment DROP FOREIGN KEY FK_EE6C11269D86650F');
        $this->addSql('ALTER TABLE liked_event DROP FOREIGN KEY FK_252B04619D86650F');
        $this->addSql('ALTER TABLE liked_photo DROP FOREIGN KEY FK_A328ADE9D86650F');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989D86650F');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784189D86650F');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE idea');
        $this->addSql('DROP TABLE liked_comment');
        $this->addSql('DROP TABLE liked_event');
        $this->addSql('DROP TABLE liked_photo');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE user');
    }
}
