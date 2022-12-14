<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214091017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE computer ADD auteur_id INT NOT NULL, ADD marque_id INT NOT NULL');
        $this->addSql('ALTER TABLE computer ADD CONSTRAINT FK_A298A7A660BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE computer ADD CONSTRAINT FK_A298A7A64827B9B2 FOREIGN KEY (marque_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_A298A7A660BB6FE6 ON computer (auteur_id)');
        $this->addSql('CREATE INDEX IDX_A298A7A64827B9B2 ON computer (marque_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE computer DROP FOREIGN KEY FK_A298A7A660BB6FE6');
        $this->addSql('ALTER TABLE computer DROP FOREIGN KEY FK_A298A7A64827B9B2');
        $this->addSql('DROP INDEX IDX_A298A7A660BB6FE6 ON computer');
        $this->addSql('DROP INDEX IDX_A298A7A64827B9B2 ON computer');
        $this->addSql('ALTER TABLE computer DROP auteur_id, DROP marque_id');
    }
}
