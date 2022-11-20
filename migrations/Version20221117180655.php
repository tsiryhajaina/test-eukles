<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221117180655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, nom_client VARCHAR(255) NOT NULL, adresse_client LONGTEXT DEFAULT NULL, telephone_client VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lien (id INT AUTO_INCREMENT NOT NULL, idMateriel INT DEFAULT NULL, idCLient INT DEFAULT NULL, quantite INT DEFAULT NULL, prix_total DOUBLE PRECISION DEFAULT NULL, INDEX IDX_A532B4B54B719ACA (idMateriel), INDEX IDX_A532B4B5659483CB (idCLient), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, prix_unitaire DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lien ADD CONSTRAINT FK_A532B4B54B719ACA FOREIGN KEY (idMateriel) REFERENCES materiel (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE lien ADD CONSTRAINT FK_A532B4B5659483CB FOREIGN KEY (idCLient) REFERENCES clients (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lien DROP FOREIGN KEY FK_A532B4B54B719ACA');
        $this->addSql('ALTER TABLE lien DROP FOREIGN KEY FK_A532B4B5659483CB');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE lien');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
