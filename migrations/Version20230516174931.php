<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516174931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bieres_saveurs (bieres_id INT NOT NULL, saveurs_id INT NOT NULL, INDEX IDX_B34A56CF750422F9 (bieres_id), INDEX IDX_B34A56CF3E2A04D2 (saveurs_id), PRIMARY KEY(bieres_id, saveurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bieres_saveurs ADD CONSTRAINT FK_B34A56CF750422F9 FOREIGN KEY (bieres_id) REFERENCES bieres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bieres_saveurs ADD CONSTRAINT FK_B34A56CF3E2A04D2 FOREIGN KEY (saveurs_id) REFERENCES saveurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bieres ADD couleur_id INT NOT NULL');
        $this->addSql('ALTER TABLE bieres ADD CONSTRAINT FK_EAD71EA5C31BA576 FOREIGN KEY (couleur_id) REFERENCES couleurs (id)');
        $this->addSql('CREATE INDEX IDX_EAD71EA5C31BA576 ON bieres (couleur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bieres_saveurs DROP FOREIGN KEY FK_B34A56CF750422F9');
        $this->addSql('ALTER TABLE bieres_saveurs DROP FOREIGN KEY FK_B34A56CF3E2A04D2');
        $this->addSql('DROP TABLE bieres_saveurs');
        $this->addSql('ALTER TABLE bieres DROP FOREIGN KEY FK_EAD71EA5C31BA576');
        $this->addSql('DROP INDEX IDX_EAD71EA5C31BA576 ON bieres');
        $this->addSql('ALTER TABLE bieres DROP couleur_id');
    }
}
