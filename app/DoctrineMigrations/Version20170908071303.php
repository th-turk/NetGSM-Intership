<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170908071303 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE status ADD employee_id INT DEFAULT NULL, DROP employee, DROP photo');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651C8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('CREATE INDEX IDX_7B00651C8C03F15C ON status (employee_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE status DROP FOREIGN KEY FK_7B00651C8C03F15C');
        $this->addSql('DROP INDEX IDX_7B00651C8C03F15C ON status');
        $this->addSql('ALTER TABLE status ADD employee VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD photo VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP employee_id');
    }
}
