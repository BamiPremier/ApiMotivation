<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301200918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE publication ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C677912469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_AF3C677912469DE2 ON publication (category_id)');
        $this->addSql('ALTER TABLE user ADD abonnes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FEDEAEF2 FOREIGN KEY (abonnes_id) REFERENCES abonnement (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649FEDEAEF2 ON user (abonnes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C677912469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP INDEX IDX_AF3C677912469DE2 ON publication');
        $this->addSql('ALTER TABLE publication DROP category_id');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649FEDEAEF2');
        $this->addSql('DROP INDEX IDX_8D93D649FEDEAEF2 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP abonnes_id');
    }
}