<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717084209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_actor (movie_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_3A374C658F93B6FC (movie_id), INDEX IDX_3A374C6510DAF24A (actor_id), PRIMARY KEY(movie_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_category (movie_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_DABA824C8F93B6FC (movie_id), INDEX IDX_DABA824C12469DE2 (category_id), PRIMARY KEY(movie_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_realisator (movie_id INT NOT NULL, realisator_id INT NOT NULL, INDEX IDX_A3E0FCAF8F93B6FC (movie_id), INDEX IDX_A3E0FCAF139504F0 (realisator_id), PRIMARY KEY(movie_id, realisator_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_actor ADD CONSTRAINT FK_3A374C658F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_actor ADD CONSTRAINT FK_3A374C6510DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_category ADD CONSTRAINT FK_DABA824C8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_category ADD CONSTRAINT FK_DABA824C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_realisator ADD CONSTRAINT FK_A3E0FCAF8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_realisator ADD CONSTRAINT FK_A3E0FCAF139504F0 FOREIGN KEY (realisator_id) REFERENCES realisator (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_movie DROP FOREIGN KEY FK_39DA19FB10DAF24A');
        $this->addSql('ALTER TABLE actor_movie DROP FOREIGN KEY FK_39DA19FB8F93B6FC');
        $this->addSql('ALTER TABLE category_movie DROP FOREIGN KEY FK_F56DBD2612469DE2');
        $this->addSql('ALTER TABLE category_movie DROP FOREIGN KEY FK_F56DBD268F93B6FC');
        $this->addSql('ALTER TABLE realisator_movie DROP FOREIGN KEY FK_55967804139504F0');
        $this->addSql('ALTER TABLE realisator_movie DROP FOREIGN KEY FK_559678048F93B6FC');
        $this->addSql('DROP TABLE actor_movie');
        $this->addSql('DROP TABLE category_movie');
        $this->addSql('DROP TABLE realisator_movie');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor_movie (actor_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_39DA19FB10DAF24A (actor_id), INDEX IDX_39DA19FB8F93B6FC (movie_id), PRIMARY KEY(actor_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE category_movie (category_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_F56DBD2612469DE2 (category_id), INDEX IDX_F56DBD268F93B6FC (movie_id), PRIMARY KEY(category_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE realisator_movie (realisator_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_55967804139504F0 (realisator_id), INDEX IDX_559678048F93B6FC (movie_id), PRIMARY KEY(realisator_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE actor_movie ADD CONSTRAINT FK_39DA19FB10DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_movie ADD CONSTRAINT FK_39DA19FB8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_movie ADD CONSTRAINT FK_F56DBD2612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_movie ADD CONSTRAINT FK_F56DBD268F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE realisator_movie ADD CONSTRAINT FK_55967804139504F0 FOREIGN KEY (realisator_id) REFERENCES realisator (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE realisator_movie ADD CONSTRAINT FK_559678048F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_actor DROP FOREIGN KEY FK_3A374C658F93B6FC');
        $this->addSql('ALTER TABLE movie_actor DROP FOREIGN KEY FK_3A374C6510DAF24A');
        $this->addSql('ALTER TABLE movie_category DROP FOREIGN KEY FK_DABA824C8F93B6FC');
        $this->addSql('ALTER TABLE movie_category DROP FOREIGN KEY FK_DABA824C12469DE2');
        $this->addSql('ALTER TABLE movie_realisator DROP FOREIGN KEY FK_A3E0FCAF8F93B6FC');
        $this->addSql('ALTER TABLE movie_realisator DROP FOREIGN KEY FK_A3E0FCAF139504F0');
        $this->addSql('DROP TABLE movie_actor');
        $this->addSql('DROP TABLE movie_category');
        $this->addSql('DROP TABLE movie_realisator');
    }
}
