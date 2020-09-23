<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200923141056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill ADD price NUMERIC(10, 2) DEFAULT NULL, DROP price_euro, DROP price_cent');
        $this->addSql('ALTER TABLE work_type ADD budget NUMERIC(10, 2) DEFAULT NULL, DROP budget_euro, DROP budget_cent');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill ADD price_euro INT DEFAULT NULL, ADD price_cent SMALLINT DEFAULT NULL, DROP price');
        $this->addSql('ALTER TABLE work_type ADD budget_euro INT DEFAULT NULL, ADD budget_cent SMALLINT DEFAULT NULL, DROP budget');
    }
}
