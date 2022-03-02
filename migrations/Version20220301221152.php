<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301221152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication ADD publication_objects_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C677925992CD2 FOREIGN KEY (publication_objects_id) REFERENCES publication_object (id)');
        $this->addSql('CREATE INDEX IDX_AF3C677925992CD2 ON publication (publication_objects_id)');
        $this->addSql('ALTER TABLE publication_object DROP FOREIGN KEY FK_4C46BAA138B217A7');
        $this->addSql('DROP INDEX IDX_4C46BAA138B217A7 ON publication_object');
        $this->addSql('ALTER TABLE publication_object DROP publication_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C677925992CD2');
        $this->addSql('DROP INDEX IDX_AF3C677925992CD2 ON publication');
        $this->addSql('ALTER TABLE publication DROP publication_objects_id');
        $this->addSql('ALTER TABLE publication_object ADD publication_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE publication_object ADD CONSTRAINT FK_4C46BAA138B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id)');
        $this->addSql('CREATE INDEX IDX_4C46BAA138B217A7 ON publication_object (publication_id)');
    }
}
