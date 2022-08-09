<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220809095333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE checkbox_reponse (id INT AUTO_INCREMENT NOT NULL, reponses_id INT NOT NULL, reponse LONGTEXT NOT NULL, INDEX IDX_BEF1958CE4084792 (reponses_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE input_reponse (id INT AUTO_INCREMENT NOT NULL, reponses_id INT NOT NULL, reponse LONGTEXT NOT NULL, INDEX IDX_4AA04707E4084792 (reponses_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE radio_reponse (id INT AUTO_INCREMENT NOT NULL, reponses_id INT NOT NULL, reponse LONGTEXT NOT NULL, INDEX IDX_66D2CB8CE4084792 (reponses_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE checkbox_reponse ADD CONSTRAINT FK_BEF1958CE4084792 FOREIGN KEY (reponses_id) REFERENCES reponse (id)');
        $this->addSql('ALTER TABLE input_reponse ADD CONSTRAINT FK_4AA04707E4084792 FOREIGN KEY (reponses_id) REFERENCES reponse (id)');
        $this->addSql('ALTER TABLE radio_reponse ADD CONSTRAINT FK_66D2CB8CE4084792 FOREIGN KEY (reponses_id) REFERENCES reponse (id)');
        $this->addSql('DROP TABLE critere');
        $this->addSql('ALTER TABLE projet DROP nombre_input, DROP nombre_radio, DROP nombre_checkbox');
        $this->addSql('ALTER TABLE reponse ADD titre VARCHAR(255) NOT NULL, DROP input_reponse, DROP radio_reponse');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE critere (id INT AUTO_INCREMENT NOT NULL, projets_id INT NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_7F6A8053597A6CB7 (projets_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE critere ADD CONSTRAINT FK_7F6A8053597A6CB7 FOREIGN KEY (projets_id) REFERENCES projet (id)');
        $this->addSql('DROP TABLE checkbox_reponse');
        $this->addSql('DROP TABLE input_reponse');
        $this->addSql('DROP TABLE radio_reponse');
        $this->addSql('ALTER TABLE projet ADD nombre_input INT NOT NULL, ADD nombre_radio INT NOT NULL, ADD nombre_checkbox INT NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD input_reponse LONGTEXT DEFAULT NULL, ADD radio_reponse LONGTEXT DEFAULT NULL, DROP titre');
    }
}
