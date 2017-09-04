<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170904102405 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE profile_photo (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee ADD profilephoto INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1FF5A7B97 FOREIGN KEY (profilephoto) REFERENCES profile_photo (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A1FF5A7B97 ON employee (profilephoto)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1FF5A7B97');
        $this->addSql('DROP TABLE profile_photo');
        $this->addSql('DROP INDEX UNIQ_5D9F75A1FF5A7B97 ON employee');
        $this->addSql('ALTER TABLE employee DROP profilephoto');
    }
}
