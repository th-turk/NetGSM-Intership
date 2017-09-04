<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170903075930 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E98C03F15C');
        $this->addSql('DROP INDEX UNIQ_1483A5E98C03F15C ON users');
        $this->addSql('ALTER TABLE users CHANGE employee_id employee INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E95D9F75A1 FOREIGN KEY (employee) REFERENCES employee (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E95D9F75A1 ON users (employee)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E95D9F75A1');
        $this->addSql('DROP INDEX UNIQ_1483A5E95D9F75A1 ON users');
        $this->addSql('ALTER TABLE users CHANGE employee employee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E98C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E98C03F15C ON users (employee_id)');
    }
}
