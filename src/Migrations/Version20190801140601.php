<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190801140601 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE animals (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, age VARCHAR(255) NOT NULL, race VARCHAR(255) NOT NULL, filename VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, gites_id INT NOT NULL, begin_at DATETIME NOT NULL, end_at DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(10) NOT NULL, INDEX IDX_E00CEDDE80C9DB47 (gites_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, articles_id INT NOT NULL, contenu VARCHAR(255) NOT NULL, email VARCHAR(100) NOT NULL, note VARCHAR(2) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_67F068BC1EBAF6CC (articles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gites (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, chambres INT NOT NULL, douches INT NOT NULL, surface LONGTEXT NOT NULL, lits LONGTEXT NOT NULL, dressing VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, tarifs VARCHAR(6) DEFAULT NULL, image_name_miniature VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, gite_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_C53D045F652CAE9B (gite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE80C9DB47 FOREIGN KEY (gites_id) REFERENCES gites (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F652CAE9B FOREIGN KEY (gite_id) REFERENCES gites (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC1EBAF6CC');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE80C9DB47');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F652CAE9B');
        $this->addSql('DROP TABLE animals');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE gites');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE users');
    }
}
