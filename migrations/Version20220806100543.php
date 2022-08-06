<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220806100543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkbox ADD projet_id INT NOT NULL');
        $this->addSql('ALTER TABLE checkbox ADD CONSTRAINT FK_1E7B08EDC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_1E7B08EDC18272 ON checkbox (projet_id)');
        $this->addSql('ALTER TABLE input ADD projet_id INT NOT NULL');
        $this->addSql('ALTER TABLE input ADD CONSTRAINT FK_D82832D7C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_D82832D7C18272 ON input (projet_id)');
        $this->addSql('ALTER TABLE radio ADD projet_id INT NOT NULL');
        $this->addSql('ALTER TABLE radio ADD CONSTRAINT FK_E0461B0FC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_E0461B0FC18272 ON radio (projet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkbox DROP FOREIGN KEY FK_1E7B08EDC18272');
        $this->addSql('DROP INDEX IDX_1E7B08EDC18272 ON checkbox');
        $this->addSql('ALTER TABLE checkbox DROP projet_id');
        $this->addSql('ALTER TABLE input DROP FOREIGN KEY FK_D82832D7C18272');
        $this->addSql('DROP INDEX IDX_D82832D7C18272 ON input');
        $this->addSql('ALTER TABLE input DROP projet_id');
        $this->addSql('ALTER TABLE radio DROP FOREIGN KEY FK_E0461B0FC18272');
        $this->addSql('DROP INDEX IDX_E0461B0FC18272 ON radio');
        $this->addSql('ALTER TABLE radio DROP projet_id');
    }
}
