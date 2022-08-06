<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220806100252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkbox DROP FOREIGN KEY FK_1E7B08ED9E5F45AB');
        $this->addSql('DROP INDEX IDX_1E7B08ED9E5F45AB ON checkbox');
        $this->addSql('ALTER TABLE checkbox DROP critere_id');
        $this->addSql('ALTER TABLE input DROP FOREIGN KEY FK_D82832D79E5F45AB');
        $this->addSql('DROP INDEX IDX_D82832D79E5F45AB ON input');
        $this->addSql('ALTER TABLE input DROP critere_id');
        $this->addSql('ALTER TABLE radio DROP FOREIGN KEY FK_E0461B0F9E5F45AB');
        $this->addSql('DROP INDEX IDX_E0461B0F9E5F45AB ON radio');
        $this->addSql('ALTER TABLE radio DROP critere_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkbox ADD critere_id INT NOT NULL');
        $this->addSql('ALTER TABLE checkbox ADD CONSTRAINT FK_1E7B08ED9E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id)');
        $this->addSql('CREATE INDEX IDX_1E7B08ED9E5F45AB ON checkbox (critere_id)');
        $this->addSql('ALTER TABLE input ADD critere_id INT NOT NULL');
        $this->addSql('ALTER TABLE input ADD CONSTRAINT FK_D82832D79E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id)');
        $this->addSql('CREATE INDEX IDX_D82832D79E5F45AB ON input (critere_id)');
        $this->addSql('ALTER TABLE radio ADD critere_id INT NOT NULL');
        $this->addSql('ALTER TABLE radio ADD CONSTRAINT FK_E0461B0F9E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id)');
        $this->addSql('CREATE INDEX IDX_E0461B0F9E5F45AB ON radio (critere_id)');
    }
}
