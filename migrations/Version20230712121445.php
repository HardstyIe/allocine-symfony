<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230712121445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_console (user_id INT NOT NULL, console_id INT NOT NULL, INDEX IDX_6E0ED1BCA76ED395 (user_id), INDEX IDX_6E0ED1BC72F9DD9F (console_id), PRIMARY KEY(user_id, console_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_console ADD CONSTRAINT FK_6E0ED1BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_console ADD CONSTRAINT FK_6E0ED1BC72F9DD9F FOREIGN KEY (console_id) REFERENCES console (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_console DROP FOREIGN KEY FK_6E0ED1BCA76ED395');
        $this->addSql('ALTER TABLE user_console DROP FOREIGN KEY FK_6E0ED1BC72F9DD9F');
        $this->addSql('DROP TABLE user_console');
    }
}
