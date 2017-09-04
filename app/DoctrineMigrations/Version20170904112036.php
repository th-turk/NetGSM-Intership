<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170904112036 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE employee DROP profile_photo');
        $this->addSql('ALTER TABLE profile_photo ADD employee INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profile_photo ADD CONSTRAINT FK_E3631BCA5D9F75A1 FOREIGN KEY (employee) REFERENCES employee (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E3631BCA5D9F75A1 ON profile_photo (employee)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE employee ADD profile_photo VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE profile_photo DROP FOREIGN KEY FK_E3631BCA5D9F75A1');
        $this->addSql('DROP INDEX UNIQ_E3631BCA5D9F75A1 ON profile_photo');
        $this->addSql('ALTER TABLE profile_photo DROP employee');
    }
}
