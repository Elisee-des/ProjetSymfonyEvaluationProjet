<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220806130525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, input LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE checkbox ADD reponse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE checkbox ADD CONSTRAINT FK_1E7B08EDCF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id)');
        $this->addSql('CREATE INDEX IDX_1E7B08EDCF18BB82 ON checkbox (reponse_id)');
        $this->addSql('ALTER TABLE input ADD reponse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE input ADD CONSTRAINT FK_D82832D7CF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id)');
        $this->addSql('CREATE INDEX IDX_D82832D7CF18BB82 ON input (reponse_id)');
        $this->addSql('ALTER TABLE radio ADD reponse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE radio ADD CONSTRAINT FK_E0461B0FCF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id)');
        $this->addSql('CREATE INDEX IDX_E0461B0FCF18BB82 ON radio (reponse_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkbox DROP FOREIGN KEY FK_1E7B08EDCF18BB82');
        $this->addSql('ALTER TABLE input DROP FOREIGN KEY FK_D82832D7CF18BB82');
        $this->addSql('ALTER TABLE radio DROP FOREIGN KEY FK_E0461B0FCF18BB82');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP INDEX IDX_1E7B08EDCF18BB82 ON checkbox');
        $this->addSql('ALTER TABLE checkbox DROP reponse_id');
        $this->addSql('DROP INDEX IDX_D82832D7CF18BB82 ON input');
        $this->addSql('ALTER TABLE input DROP reponse_id');
        $this->addSql('DROP INDEX IDX_E0461B0FCF18BB82 ON radio');
        $this->addSql('ALTER TABLE radio DROP reponse_id');
    }
}
