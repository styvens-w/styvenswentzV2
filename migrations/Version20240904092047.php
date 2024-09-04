<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240904092047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_AC74095AC54C8C93 ON activity (type_id)');
        $this->addSql('ALTER TABLE picture ADD project_id INT NOT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89166D1F9C ON picture (project_id)');
        $this->addSql('ALTER TABLE project ADD activity_id INT NOT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE81C06096 ON project (activity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095AC54C8C93');
        $this->addSql('DROP INDEX IDX_AC74095AC54C8C93 ON activity');
        $this->addSql('ALTER TABLE activity DROP type_id');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89166D1F9C');
        $this->addSql('DROP INDEX IDX_16DB4F89166D1F9C ON picture');
        $this->addSql('ALTER TABLE picture DROP project_id');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE81C06096');
        $this->addSql('DROP INDEX IDX_2FB3D0EE81C06096 ON project');
        $this->addSql('ALTER TABLE project DROP activity_id');
    }
}
