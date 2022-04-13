<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411122325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dcategorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dproduit (id INT AUTO_INCREMENT NOT NULL, dcategories_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix NUMERIC(10, 2) NOT NULL, INDEX IDX_854A4271E9AC2BC0 (dcategories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wproduit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zcatecorie (id INT AUTO_INCREMENT NOT NULL, wproduit_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_5815197D5020E011 (wproduit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dproduit ADD CONSTRAINT FK_854A4271E9AC2BC0 FOREIGN KEY (dcategories_id) REFERENCES dcategorie (id)');
        $this->addSql('ALTER TABLE zcatecorie ADD CONSTRAINT FK_5815197D5020E011 FOREIGN KEY (wproduit_id) REFERENCES wproduit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dproduit DROP FOREIGN KEY FK_854A4271E9AC2BC0');
        $this->addSql('ALTER TABLE zcatecorie DROP FOREIGN KEY FK_5815197D5020E011');
        $this->addSql('DROP TABLE dcategorie');
        $this->addSql('DROP TABLE dproduit');
        $this->addSql('DROP TABLE wproduit');
        $this->addSql('DROP TABLE zcatecorie');
    }
}
