<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250525205811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE url url VARCHAR(1200) DEFAULT NULL');
        $this->addSql('ALTER TABLE news CHANGE title title VARCHAR(1200) NOT NULL, CHANGE content content VARCHAR(1200) NOT NULL, CHANGE img_url img_url VARCHAR(1200) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news CHANGE title title VARCHAR(255) NOT NULL, CHANGE content content VARCHAR(255) NOT NULL, CHANGE img_url img_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE category CHANGE url url VARCHAR(255) DEFAULT NULL');
    }
}
