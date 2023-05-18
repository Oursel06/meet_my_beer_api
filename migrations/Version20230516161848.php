<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516161848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bieres (id INT AUTO_INCREMENT NOT NULL, brasserie_id_id INT NOT NULL, nom VARCHAR(255) NOT NULL, nb_degres DOUBLE PRECISION NOT NULL, saison TINYINT(1) NOT NULL, INDEX IDX_EAD71EA56A14CB8D (brasserie_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bieres ADD CONSTRAINT FK_EAD71EA56A14CB8D FOREIGN KEY (brasserie_id_id) REFERENCES brasseries (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bieres DROP FOREIGN KEY FK_EAD71EA56A14CB8D');
        $this->addSql('DROP TABLE bieres');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
