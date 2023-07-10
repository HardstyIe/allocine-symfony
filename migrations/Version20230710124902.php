<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230710124902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE console ADD entreprise_id INT NOT NULL, ADD pays_id INT NOT NULL');
        $this->addSql('ALTER TABLE console ADD CONSTRAINT FK_3603CFB6A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE console ADD CONSTRAINT FK_3603CFB6A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_3603CFB6A4AEAFEA ON console (entreprise_id)');
        $this->addSql('CREATE INDEX IDX_3603CFB6A6E44244 ON console (pays_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE console DROP FOREIGN KEY FK_3603CFB6A4AEAFEA');
        $this->addSql('ALTER TABLE console DROP FOREIGN KEY FK_3603CFB6A6E44244');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP INDEX IDX_3603CFB6A4AEAFEA ON console');
        $this->addSql('DROP INDEX IDX_3603CFB6A6E44244 ON console');
        $this->addSql('ALTER TABLE console DROP entreprise_id, DROP pays_id');
    }
}
