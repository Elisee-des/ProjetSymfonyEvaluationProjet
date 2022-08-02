<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220802184514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE checkbox (id INT AUTO_INCREMENT NOT NULL, critere_id INT NOT NULL, label VARCHAR(255) NOT NULL, checkbox VARCHAR(255) NOT NULL, INDEX IDX_1E7B08ED9E5F45AB (critere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critere (id INT AUTO_INCREMENT NOT NULL, projets_id INT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_7F6A8053597A6CB7 (projets_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE input (id INT AUTO_INCREMENT NOT NULL, critere_id INT NOT NULL, label VARCHAR(255) NOT NULL, input VARCHAR(255) NOT NULL, INDEX IDX_D82832D79E5F45AB (critere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, nombre_evaluateur INT NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet_user (projet_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FA413966C18272 (projet_id), INDEX IDX_FA413966A76ED395 (user_id), PRIMARY KEY(projet_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE radio (id INT AUTO_INCREMENT NOT NULL, critere_id INT NOT NULL, label VARCHAR(255) NOT NULL, radio VARCHAR(255) NOT NULL, INDEX IDX_E0461B0F9E5F45AB (critere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE checkbox ADD CONSTRAINT FK_1E7B08ED9E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id)');
        $this->addSql('ALTER TABLE critere ADD CONSTRAINT FK_7F6A8053597A6CB7 FOREIGN KEY (projets_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE input ADD CONSTRAINT FK_D82832D79E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id)');
        $this->addSql('ALTER TABLE projet_user ADD CONSTRAINT FK_FA413966C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_user ADD CONSTRAINT FK_FA413966A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE radio ADD CONSTRAINT FK_E0461B0F9E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkbox DROP FOREIGN KEY FK_1E7B08ED9E5F45AB');
        $this->addSql('ALTER TABLE input DROP FOREIGN KEY FK_D82832D79E5F45AB');
        $this->addSql('ALTER TABLE radio DROP FOREIGN KEY FK_E0461B0F9E5F45AB');
        $this->addSql('ALTER TABLE critere DROP FOREIGN KEY FK_7F6A8053597A6CB7');
        $this->addSql('ALTER TABLE projet_user DROP FOREIGN KEY FK_FA413966C18272');
        $this->addSql('DROP TABLE checkbox');
        $this->addSql('DROP TABLE critere');
        $this->addSql('DROP TABLE input');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE projet_user');
        $this->addSql('DROP TABLE radio');
    }
}
