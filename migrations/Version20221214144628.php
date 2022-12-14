<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214144628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE computer_list_by_user (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, computers_id INT DEFAULT NULL, INDEX IDX_4C0E160567B3B43D (users_id), INDEX IDX_4C0E1605F4B903A6 (computers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE computer_list_by_user ADD CONSTRAINT FK_4C0E160567B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE computer_list_by_user ADD CONSTRAINT FK_4C0E1605F4B903A6 FOREIGN KEY (computers_id) REFERENCES computer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE computer_list_by_user DROP FOREIGN KEY FK_4C0E160567B3B43D');
        $this->addSql('ALTER TABLE computer_list_by_user DROP FOREIGN KEY FK_4C0E1605F4B903A6');
        $this->addSql('DROP TABLE computer_list_by_user');
    }
}
