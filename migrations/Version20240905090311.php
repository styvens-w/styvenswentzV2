<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240905090311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity CHANGE start start DATE NOT NULL, CHANGE end end DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE project CHANGE start start DATE NOT NULL, CHANGE end end DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity CHANGE start start INT NOT NULL, CHANGE end end INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project CHANGE start start INT NOT NULL, CHANGE end end INT DEFAULT NULL');
    }
}
