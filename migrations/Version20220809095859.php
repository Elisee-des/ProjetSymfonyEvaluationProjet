<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220809095859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE input_reponse ADD input_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE input_reponse ADD CONSTRAINT FK_4AA0470736421AD6 FOREIGN KEY (input_id) REFERENCES input (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4AA0470736421AD6 ON input_reponse (input_id)');
        $this->addSql('ALTER TABLE radio_reponse ADD radio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE radio_reponse ADD CONSTRAINT FK_66D2CB8C5B94ADD2 FOREIGN KEY (radio_id) REFERENCES radio (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_66D2CB8C5B94ADD2 ON radio_reponse (radio_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE input_reponse DROP FOREIGN KEY FK_4AA0470736421AD6');
        $this->addSql('DROP INDEX UNIQ_4AA0470736421AD6 ON input_reponse');
        $this->addSql('ALTER TABLE input_reponse DROP input_id');
        $this->addSql('ALTER TABLE radio_reponse DROP FOREIGN KEY FK_66D2CB8C5B94ADD2');
        $this->addSql('DROP INDEX UNIQ_66D2CB8C5B94ADD2 ON radio_reponse');
        $this->addSql('ALTER TABLE radio_reponse DROP radio_id');
    }
}
